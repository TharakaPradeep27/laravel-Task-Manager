<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    public function add(Request $request){
       $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_date' => 'required|date'
        ]);
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->user_id = Auth::id();

        $task->save();
        return redirect()->route('user.dashboard')->with('success',"");
    }
    public function showTask(Request $request){
        $user = Auth::user(); 
        
        $query = Task::where('user_id', $user->id);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Finalize query with sorting
        $tasks = $query->orderBy('due_date', 'asc')->get();

        return view('userdashboard', compact('tasks'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit_task', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_date' => 'required|date'
        ]);

        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('user.dashboard')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('user.dashboard')->with('success', 'Task deleted successfully');
    }
}
