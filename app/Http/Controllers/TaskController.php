<?php

// app/Http/Controllers/TaskController.php


namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // $tasks = Task::with(['project', 'resourceAssignedTo'])->paginate(10); // Paginate with 10 items per page
        // return view('tasks.index', compact('tasks'));

        $user = auth()->user();
        $assignedTasks = Task::where('assignee_id', $user->id)->paginate(10);
        $createdTasks = Task::where('resource_assigned_to', $user->id)->paginate(10);
        $employees = Employee::all();
        return view('tasks.index', compact('assignedTasks', 'createdTasks', 'employees'));


    }

    public function create()
    {
        $projects = Project::all();
        $employees = Employee::all();
        return view('tasks.create', compact('projects', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'resource_assigned_to' => 'required|exists:employees,id',
            'task_name' => 'required|string|max:255',
            'task_description' => 'nullable|string',
            'priority' => 'required|in:high,medium,low',
            'status' => 'required|in:completed,not_started,in_progress',
            'expected_completion_date' => 'required|date',
            'efforts_estimate' => 'nullable|integer',
            'actual_efforts' => 'nullable|integer',
            'work_start_date' => 'nullable|date',
            'work_complete_date' => 'nullable|date',
            'completed_status' => 'required|boolean',
            'comments' => 'nullable|string',
        ]);

        Task::create(array_merge(
            $request->except('assignee_id'),
            ['assignee_id' => Auth::id()]
        ));

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        $task->load(['project', 'resourceAssignedTo']);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        $employees = Employee::all();
        return view('tasks.edit', compact('task', 'projects', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'resource_assigned_to' => 'required|exists:employees,id',
            'task_name' => 'required|string|max:255',
            'task_description' => 'nullable|string',
            'priority' => 'required|in:high,medium,low',
            'status' => 'required|in:completed,not_started,in_progress',
            'expected_completion_date' => 'required|date',
            'efforts_estimate' => 'nullable|integer',
            'actual_efforts' => 'nullable|integer',
            'work_start_date' => 'nullable|date',
            'work_complete_date' => 'nullable|date',
            'completed_status' => 'required|boolean',
            'comments' => 'nullable|string',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
