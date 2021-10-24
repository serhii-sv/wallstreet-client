<?php

namespace App\Observers;

use App\Models\UserSidebarProperties;
use App\Models\Wallet;

class UserSidebarPropertyObserver
{
    public function creating(UserSidebarProperties $property) {
        if (!$property->user_id) {
            $property->user_id = auth()->user()->id;
        }
        $property->sb_val = 0;
    }
}
