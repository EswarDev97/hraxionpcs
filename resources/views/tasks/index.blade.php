@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'tasks'])

@section('_content')

<div class="container">
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
    <div class="row">
        <div class="col">
            <h3>Tasks Created by Me</h3>
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
                        <td class="text-left">{{ $task->project->name }}</td>
                        <td class="text-left">{{ $task->task_name }}</td>
                        <td class="text-left">
                            @foreach ($employees as $employee)
                                @if ($employee->id == $task->resource_assigned_to)
                                    {{ $employee->name }}
                                    @break
                                @endif
                            @endforeach   
                        </td>
                        <td class="text-left">{{ $task->expected_completion_date }}</td>
                        <td class="text-left">{{ $task->priority }}</td>
                        <td class="text-left">{{ $task->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links for Created Tasks -->
            {{ $assignedTasks->links() }} <!-- Add pagination links -->
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Tasks Assigned to Me</h3>
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
                            <td class="text-left">{{ $task->project->name }}</td>
                            <td class="text-left">{{ $task->task_name }}</td>
                            <td class="text-left">
                                @foreach ($employees as $employee)
                                    @if ($employee->id == $task->resource_assigned_to)
                                        {{ $employee->name }}
                                        @break
                                    @endif
                                @endforeach   
                            </td>
                            <td class="text-left">{{ $task->expected_completion_date }}</td>
                            <td class="text-left">{{ $task->priority }}</td>
                            <td class="text-left">{{ $task->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links for Assigned Tasks -->
            {{ $createdTasks->links() }} <!-- Add pagination links -->
        </div>
    </div>



</div>
</div>
@endsection