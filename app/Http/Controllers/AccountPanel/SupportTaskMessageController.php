<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\SupportTask;
use Illuminate\Http\Request;

class SupportTaskMessageController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $supportTask = SupportTask::findOrFail($id);

        $request->validate(
            [
                'message' => 'required|string|min:1'
            ],
            [
                'user_id.required' => 'Поле :attribute обязательно',
                'message.string' => 'Поле :attribute должно быть строкой',
                'message.min' => 'Поле :attribute должно быть не меньше :min'
            ]
        );

        $result = $supportTask->messages()->create([
            'message' => $request->message,
            'user_id' => auth()->user()->id
        ]);

        if ($result) {
            return back()->with('success_short', 'Сообщние отправлено');
        }

        return back()->with('error_short', 'Сообщние не отправлено')->withInput($request->input());
    }
}
