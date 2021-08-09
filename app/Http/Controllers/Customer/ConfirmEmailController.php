<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;

class ConfirmEmailController extends Controller
{
    /**
     * @param string $hash
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(string $hash)
    {
        /** @var User $findUserViaHash */
        $findUserViaHash = User::where('email_verification_hash', $hash)
            ->whereNull('email_verified_at')
            ->first();

        if (null !== $findUserViaHash) {
            $findUserViaHash->email_verified_at = now()->toDateTimeString();
            $findUserViaHash->save();

            return view('customer.email.email_confirmed');
        }
        return view('customer.email.email_can_not_be_confirmed');
    }
}
