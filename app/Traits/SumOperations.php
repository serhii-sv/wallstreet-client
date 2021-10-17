<?php


namespace App\Traits;


trait SumOperations
{
    protected static function sidebarIndicatorsFormatting($sum)
    {
        $postfix = '';
        
        if ($sum >= 1000000) {
            $sum = $sum / 1000000;
            $postfix = 'KK';
        } elseif ($sum >= 1000) {
            $sum = $sum / 1000;
            $postfix = 'K';
        }
        
        return number_format(floor($sum), 0, '.', ',') . $postfix;
    }
}