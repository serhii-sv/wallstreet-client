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
        $user = User::find($id);

        if (null == $user) {
            return back()->with('error', __('User not found'))->withInput();
        }

        Auth::user()->impersonate($user);
        return redirect(route('accountPanel.profile'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function leave()
    {
        Auth::user()->leaveImpersonation();
        return redirect(route('admin'));
    }
}
