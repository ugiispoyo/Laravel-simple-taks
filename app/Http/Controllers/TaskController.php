<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Inertia::render('Tasks', [
            'tasks' => Task::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Task::create([
            'title' => $request->title
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'status' => $task->status === 'pending' ? 'done' : 'pending'
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->back();
    }
}
