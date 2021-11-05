<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use JoggApp\GoogleTranslate\GoogleTranslate;
use JoggApp\GoogleTranslate\GoogleTranslateClient;

class TranslateFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:files {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate files automatically';

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
     * @return int
     */
    public function handle()
    {
        $translate = new GoogleTranslate(new GoogleTranslateClient(config('googletranslate')));

        $from = $this->argument('from');
        $to = $this->argument('to');

        $this->info('available languages');
        $this->info(print_r($translate->getAvaliableTranslationsFor($from),true));

        if (!Storage::disk('lang')->exists($from.'.json') || !Storage::disk('lang')->exists($from.'_manual.json')) {
            $this->error('from files is not exists');
            return Command::FAILURE;
        }

        $fromFile = Storage::disk('lang')->get($from.'.json');
        $fromFileManual = Storage::disk('lang')->get($from.'_manual.json');

        Storage::disk('lang')->put($from.'.backup.json', $fromFile);
        Storage::disk('lang')->put($from.'_manual.backup.json', $fromFileManual);

        $fromArray = json_decode($fromFile, true);
        $fromManualArray = json_decode($fromFileManual, true);

        // ---

        $toArray = [];
        $toManualArray = [];

        foreach ($fromArray as $key => $val) {
            $toArray[$key] = $translate->translate($val, $to)['translated_text'] ?? $val;
            $this->info(print_r($val,true).' translated to '.print_r($toArray[$key],true));
        }

        foreach ($fromManualArray as $key => $val) {
            $toManualArray[$key] = $translate->translate($val, $to)['translated_text'] ?? $val;
            $this->info(print_r($val,true).' translated to '.print_r($toManualArray[$key],true));
        }

        // ---

        $toArray = json_encode($toArray);
        $toManualArray = json_encode($toManualArray);

        Storage::disk('lang')->put($to.'.json', $toArray);
        Storage::disk('lang')->put($to.'_manual.json', $toManualArray);

        $this->info('success');

        return Command::SUCCESS;
    }
}
