<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

return [
    'pm_account_id'                 => env('PM_ACCOUNT_ID'),
    'pm_account_password'           => env('PM_ACCOUNT_PASSWORD'),
    'pm_payee_account_usd'          => env('PM_PAYEE_ACCOUNT_USD'),
    'pm_payee_account_eur'          => env('PM_PAYEE_ACCOUNT_EUR'),
    'pm_payee_name'                 => env('PM_PAYEE_NAME'),
    'pm_sci_password'               => env('PM_SCI_PASSWORD'),
    'pm_memo'                       => env('PM_MEMO', 'replenishment of balance'),
    'pm_withdraw_memo'              => env('PM_WITHDRAW_MEMO', 'withdraw money'),

    'coinpayments_public_key'       => env('COINPAYMENTS_PUBLIC_KEY'),
    'coinpayments_private_key'      => env('COINPAYMENTS_PRIVATE_KEY'),
    'coinpayments_ipn_secret'       => env('COINPAYMENTS_IPN_SECRET'),
    'coinpayments_merchant_id'      => env('COINPAYMENTS_MERCHANT_ID'),
    'coinpayments_memo'             => env('COINPAYMENTS_MEMO'),
];
