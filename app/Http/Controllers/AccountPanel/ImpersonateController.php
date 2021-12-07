<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class ImpersonateController
 * @package App\Http\Controllers
 */
class ImpersonateController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function impersonate($id)
    {
        $admin = User::impersonateTokenDecode(urldecode(request()->token));
        $user = User::find($id);

        if (null == $user || null == $admin) {
            return back()->with('error', 'Пользователь не найден')->withInput();
        }

        Auth::login($admin);
        Auth::user()->impersonate($user);
        return redirect(route('accountPanel.dashboard'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function leave()
    {
        Auth::user()->leaveImpersonation();
        return redirect(env('ADMIN_SITE_URL') . 'users');
    }
}
