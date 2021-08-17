<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;


class Helper
{
    public static function generateMyId(): int
    {
        $maxExists = \App\Models\User::max('my_id');
        return $maxExists > 0
            ? $maxExists+1
            : rand(500000, 2000000);
    }
}