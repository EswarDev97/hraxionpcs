@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'projects'])

@section('_content')
<div class="container">
    <h1>Task Details</h1>
    <hr>
    <div class="mb-3 border rounded p-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="task_name">Task Name:</label>
                    <input type="text" name="task_name" id="task_name" class="form-control-plaintext" readonly value="{{ $task->task_name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <input type="text" name="priority" id="priority" class="form-control-plaintext" readonly value="{{ $task->priority }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="task_description">Task Description:</label>
            <textarea class="form-control-plaintext" id="task_description" name="task_description" readonly>{{ $task->task_description }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" name="status" id="status" class="form-control-plaintext" readonly value="{{ $task->status }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="expected_completion_date">Expected Completion Date:</label>
                    <input type="date" id="expected_completion_date" name="expected_completion_date" class="form-control-plaintext" readonly value="{{ $task->expected_completion_date }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="efforts_estimate">Efforts Estimate:</label>
                    <input type="number" id="efforts_estimate" name="efforts_estimate" class="form-control-plaintext" readonly value="{{ $task->efforts_estimate }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="actual_efforts">Actual Efforts:</label>
                    <input type="number" id="actual_efforts" name="actual_efforts" class="form-control-plaintext" readonly value="{{ $task->actual_efforts }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="assignee_id">Assignee:</label>
                    <input type="text" id="assignee_id" name="assignee_id" class="form-control-plaintext" readonly value="{{ $task->assignee_id }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="work_start_date">Work Start Date:</label>
                    <input type="date" id="work_start_date" name="work_start_date" class="form-control-plaintext" readonly value="{{ $task->work_start_date }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="work_complete_date">Work Complete Date:</label>
                    <input type="date" id="work_complete_date" name="work_complete_date" class="form-control-plaintext" readonly value="{{ $task->work_complete_date }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="completed_status">Completed Status:</label>
                    <input type="text" id="completed_status" name="completed_status" class="form-control-plaintext" readonly value="{{ $task->completed_status }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" class="form-control-plaintext" readonly>{{ $task->comments }}</textarea>
        </div>

        <div class="row">
            <div class="col-12">
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                </form>
            </div>
        </div>

    </div>
</div>


@endsection
