<?php


namespace App\Traits;


trait ConvertCurrency
{
    public function convertToCurrency(\App\Models\Currency $fromCurrency, \App\Models\Currency $toCurrency, float $amount)
    {
        if (null === $fromCurrency || null === $toCurrency || $amount <= 0) {
            return 0;
        }

        if ($fromCurrency->code == $toCurrency->code) {
            return $amount;
        }

        $rateInUsd = \App\Models\Setting::getValue(strtolower($fromCurrency->code).'_to_usd', 0);
        $amountInUsd = (float) $amount * (float) $rateInUsd;

        $rateInTarget = \App\Models\Setting::getValue('usd_to_'.strtolower($toCurrency->code), 0);
        $amountInTarget = $amountInUsd * $rateInTarget;

        return $amountInTarget;

    }

    public static function convertToCurrencyStatic(\App\Models\Currency $fromCurrency, \App\Models\Currency $toCurrency, float $amount)
    {
        if (null === $fromCurrency || null === $toCurrency || $amount <= 0) {
            return 0;
        }

        if ($fromCurrency->code == $toCurrency->code) {
            return $amount;
        }

        $rateInUsd = \App\Models\Setting::getValue(strtolower($fromCurrency->code).'_to_usd', 0);
        $amountInUsd = (float) $amount * (float) $rateInUsd;

        $rateInTarget = \App\Models\Setting::getValue('usd_to_'.strtolower($toCurrency->code), 0);
        $amountInTarget = $amountInUsd * $rateInTarget;

        return $amountInTarget;
    }
}
