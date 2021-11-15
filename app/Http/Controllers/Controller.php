<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generatePIN($digits = 4) {
        $i = 0;
        $pin = "";
        if ($digits < 1) {
            return null;
        }
        while ($i < $digits) {
            $pin .= mt_rand(0, 9);
            $i++;
        }
        return $pin;
    }
}
