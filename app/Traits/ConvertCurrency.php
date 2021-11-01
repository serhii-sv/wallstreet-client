<?php


namespace App\Traits;


trait ConvertCurrency
{
    public function convertToCurrency(\App\Models\Currency $fromCurrency, \App\Models\Currency $toCurrency, float $amount)
    {
        if (null === $fromCurrency || null === $toCurrency || $amount <= 0) {
            return 0;
        }

        $rate = \App\Models\Setting::getValue(strtolower($fromCurrency->code).'_to_'.strtolower($toCurrency->code), 0);

        return round((float) $rate * (float) $amount, $toCurrency->precision);

    }

    public static function convertToCurrencyStatic(\App\Models\Currency $fromCurrency, \App\Models\Currency $toCurrency, float $amount)
    {
        if (null === $fromCurrency || null === $toCurrency || $amount <= 0) {
            return 0;
        }

        $rate = \App\Models\Setting::getValue(strtolower($fromCurrency->code).'_to_'.strtolower($toCurrency->code), 0);
        if ($rate) {
            return round((float) $rate * (float) $amount, $toCurrency->precision);
        }
        return round((float) $amount, $toCurrency->precision);
    }
}
