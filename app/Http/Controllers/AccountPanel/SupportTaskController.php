<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\SupportTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportTaskController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tasks = auth()->user()->supportTasks()->paginate(15);
        return view('accountPanel.support-tasks.index', compact('tasks'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('accountPanel.support-tasks.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ], [
            'title.required' => 'Поле :attribute обязательно',
            'title.string' => 'Поле :attribute должно быть строкой',
            'external.max' => 'Поле :attribute не должно быть больше чем :max',

            'description.required' => 'Поле :attribute обязательно',
            'description.string' => 'Поле :attribute должно быть строкой'
        ]);

        if (count($validator->errors()->messages())) {
            return back()->with('short_error_array', $validator->errors()->messages())->withInput($request->input());
        }

        $supportTask = auth()->user()->supportTasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($supportTask) {
            return redirect()->to(route('accountPanel.support-tasks.index'))->with('short_success', 'Задача добавлена');
        }
        return back()->with('short_success', 'Задача не добавлена')->withInput($request->input());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $supportTask = SupportTask::findOrFail($id);
        return view('accountPanel.support-tasks.show', compact('supportTask'));
    }
}
