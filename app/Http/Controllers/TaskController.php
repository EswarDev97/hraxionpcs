<?php

// app/Http/Controllers/TaskController.php


namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // $tasks = Task::with(['project', 'resourceAssignedTo'])->paginate(10); // Paginate with 10 items per page
        // return view('tasks.index', compact('tasks'));

        $user = auth()->user();
        $assignedTasks = Task::where('assignee_id', $user->id)->get();
        $createdTasks = Task::where('resource_assigned_to', $user->id)->get();

        return view('tasks.index', compact('assignedTasks', 'createdTasks'));


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
            'efforts_estimate' => 'required|integer',
            'actual_efforts' => 'nullable|integer',
            'assignee_id' => 'required|exists:employees,id',
            'work_start_date' => 'nullable|date',
            'work_complete_date' => 'nullable|date',
            'completed_status' => 'required|boolean',
            'comments' => 'nullable|string',
        ]);

        Task::create($request->all());

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
            'efforts_estimate' => 'required|integer',
            'actual_efforts' => 'nullable|integer',
            'assignee_id' => 'required|exists:employees,id',
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
