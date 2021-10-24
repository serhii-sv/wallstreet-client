<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\UserSidebarProperties;

class TaskObserver
{
    public function created(Task $task)
    {
        $sidebar_task_count = UserSidebarProperties::where('user_id', auth()->user()->id)->where('sb_prop','tasks')->get();
    
        foreach ($sidebar_task_count as $item){
            $item->sb_val = $item->sb_val + 1;
            $item->save();
        }
    }
}
