@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'tasks'])

@section('_content')

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Tasks Assigned to Me</h3>
            <table class="table table-light table-striped table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col" class="table-dark">ID</th>
                        <th scope="col" class="table-dark">Project</th>
                        <th scope="col" class="table-dark">Task Name</th>
                        <th scope="col" class="table-dark">Priority</th>
                        <th scope="col" class="table-dark">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignedTasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->project->name }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


    <div class="row">
        <div class="col">
        <h3>Tasks Created by Me</h3>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
            <table class="table table-light table-striped table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col" class="table-dark">ID</th>
                        <th scope="col" class="table-dark">Project</th>
                        <th scope="col" class="table-dark">Task Name</th>
                        <th scope="col" class="table-dark">Priority</th>
                        <th scope="col" class="table-dark">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($createdTasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->project->name }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>

    </div>


</div>
</div>
@endsection