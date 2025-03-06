@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'tasks'])

@section('_content')

<div class="container">
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>

    <div class="row">
        <div class="col">
            <h3>Tasks Created by Me</h3>
            <button class="btn btn-secondary mb-2" onclick="toggleClosedTasks()">Show Closed Tasks</button>

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
                        <tr class="{{ $task->status == 'closed' ? 'closed-task' : '' }}" style="display: {{ $task->status == 'closed' ? 'none' : '' }}">
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

            {{ $createdTasks->links() }} <!-- Pagination -->
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
                        <tr class="{{ $task->status == 'closed' ? 'closed-task' : '' }}" style="display: {{ $task->status == 'closed' ? 'none' : '' }}">
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

            {{ $assignedTasks->links() }} <!-- Pagination -->
        </div>
    </div>
</div>

<script>
    function toggleClosedTasks() {
        document.querySelectorAll('.closed-task').forEach(row => {
            row.style.display = (row.style.display === 'none') ? '' : 'none';
        });
    }
</script>

</div>
@endsection