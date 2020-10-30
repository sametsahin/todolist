<?php

namespace App\Http\Controllers;

use App\Events\TaskEvent;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function tasks()
    {
        $tasks = Task::where(['status' => 1, 'admin_id' => Auth::user()->id])->get();
        return view('tasks', compact('tasks'));
    }

    public function add_task()
    {
        $last_task_name = Task::orderBy('created_at', 'desc')->first();
        $last_task_number = Str::after($last_task_name->name, 'TASK');
        return view('add-task', compact('last_task_number'));
    }

    public function edit_task($id)
    {
        $task = Task::findOrFail($id);
        return view('edit-task', compact('task'));
    }

    public function add_task_post(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'description' => 'required|min:4'
        ]);

        $task = new Task;
        $task->name = $request->name;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->admin_id = $request->admin_id;
        $task->finished_at = $request->finished_at;
        $task->save();
        notify()->success('Basarili', 'Task basariyla olusturuldu.');
        return redirect()->route('tasks');
    }

    public function edit_task_post($id, Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'description' => 'min:5',
        ]);

        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->finished_at = $request->finished_at;
        $task->save();
        notify()->success('Basarili', 'Madde basariyla guncellendi.');
        return redirect()->route('tasks');
    }

    public function delete_task($id)
    {
        $task = Task::find($id);
        $task->delete();
        notify()->success('Task basariyla silindi.');
        return redirect()->back();
    }

    public function switch(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $task->is_ok = $request->is_ok == 'true' ? 1 : 0;
        $task->save();
        notify()->success('Task başarıyla bitirildi.');
        return redirect()->back();
    }
}
