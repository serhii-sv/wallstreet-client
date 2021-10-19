<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console\Commands\Automatic\TaskCheck\Telegram;

use App\Jobs\TaskCheck\Telegram\TelegramChannelSubscriptionJob;
use App\Models\UserTasks\UserTaskActions;
use Illuminate\Console\Command;

class TelegramChannelSubscriptionCommand extends Command
{
    /** @var string|null */
    private $userTaskActionId = null;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task_check:telegram:channel_subscription {userTaskActionId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking task.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->userTaskActionId = (string) $this->argument('userTaskActionId');

        if (empty($this->userTaskActionId)) {
            $msg = 'user task action ID is empty';
            \Log::error($msg);
            $this->warn($msg);
            return;
        }

        /** @var UserTaskActions $userTaskAction */
        $userTaskAction = UserTaskActions::where('finished', 0)
            ->where('id', $this->userTaskActionId)
            ->first();

        if (null === $userTaskAction) {
            $msg = 'user task action not found for ID '.$this->userTaskActionId;
            \Log::error($msg);
            $this->warn($msg);
            return;
        }

        TelegramChannelSubscriptionJob::dispatch($userTaskAction)->onQueue(getSupervisorName().'-high')->delay(now());
    }
}
