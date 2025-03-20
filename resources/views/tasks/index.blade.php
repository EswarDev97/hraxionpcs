@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'tasks'])

@section('_content')

<div class="container">
    <div class="d-flex gap-2">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary" style="font-weight: bold; padding: 10px 20px; border-radius: 10px;">
            <i class="fas fa-plus"></i> Create Task
        </a>
    </div>
    <br>
    <div>
        <a href="{{ route('tasks.index', ['show_closed' => $showClosed ? 0 : 1]) }}"
            class="btn {{ $showClosed ? 'btn-danger' : 'btn-success' }}"
            style="font-weight: bold; padding: 10px 20px; border-radius: 10px;">
            <i class="fas {{ $showClosed ? 'fa-eye-slash' : 'fa-eye' }}"></i>
            {{ $showClosed ? 'Hide Closed Tasks' : 'Show Closed Tasks' }}
        </a>
    </div>

    <div class="row">
        <div class="col">
            <h3>Tasks Created by Me</h3>
            <div class="table-responsive">
                <table class="table table-light table-striped table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="table-dark text-left">ID</th>
                            <th scope="col" class="table-dark text-left">Project</th>
                            <th scope="col" class="table-dark text-left">Task Name</th>
                            <th scope="col" class="table-dark text-left">Resource Assigned To</th>
                            <th scope="col" class="table-dark text-left">Expected Completion Date</th>
                            <th scope="col" class="table-dark text-left">Priority</th>
                            <th scope="col" class="table-dark text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($createdTasks as $task)
                        <tr>
                            <td class="text-left">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">{{ $task->id }}</a>
                            </td>
                            <td class="text-left">{{ $task->project->name ?? 'No Project Assigned' }}</td>
                            <td class="text-left">{{ $task->task_name }}</td>
                            <td class="text-left">{{ $task->assignedEmployee->name ?? 'Not Assigned' }}</td>
                            <td class="text-left">{{ $task->expected_completion_date }}</td>
                            <td class="text-left">{{ $task->priority }}</td>
                            <td class="text-left">{{ $task->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $createdTasks->links() }}
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Tasks Assigned to Me</h3>
            <div class="table-responsive">
                <table class="table table-light table-striped table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="table-dark text-left">ID</th>
                            <th scope="col" class="table-dark text-left">Project</th>
                            <th scope="col" class="table-dark text-left">Task Name</th>
                            <th scope="col" class="table-dark text-left">Resource Assigned To</th>
                            <th scope="col" class="table-dark text-left">Expected Completion Date</th>
                            <th scope="col" class="table-dark text-left">Priority</th>
                            <th scope="col" class="table-dark text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignedTasks as $task)
                        <tr>
                            <td class="text-left">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">{{ $task->id }}</a>
                            </td>
                            <td class="text-left">{{ $task->project->name ?? 'No Project Assigned' }}</td>
                            <td class="text-left">{{ $task->task_name }}</td>
                            <td class="text-left">{{ $task->assignedEmployee->name ?? 'Not Assigned' }}</td>
                            <td class="text-left">{{ $task->expected_completion_date }}</td>
                            <td class="text-left">{{ $task->priority }}</td>
                            <td class="text-left">{{ $task->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $assignedTasks->links() }}
        </div>
    </div>
</div>

@endsection