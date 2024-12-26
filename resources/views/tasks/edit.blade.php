@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'tasks'])

@section('_content')
<div class="container-fluid mt-2 px-4">
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold">Edit Task</h4>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-group">
                        <label for="project_id">Project:</label>
                        <select id="project_id" class="form-control" name="project_id" required>
                            @foreach ($projects as $proj)
                            <option value="{{ $proj->id }}" {{ $task->project_id == $proj->id ? 'selected' : '' }}>
                                {{ $proj->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="resource_assigned_to">Resource Assigned To:</label>
                        <select id="resource_assigned_to" class="form-control" name="resource_assigned_to" required>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $task->resource_assigned_to == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="task_name">Task Name:</label>
                        <input type="text" name="task_name" id="task_name" class="form-control" value="{{ $task->task_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="task_description">Task Description:</label>
                        <textarea name="task_description" id="task_description" class="form-control" rows="4">{{ $task->task_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select id="priority" class="form-control" name="priority" required>
                            <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select id="status" class="form-control" name="status" required>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="not_started" {{ $task->status == 'not_started' ? 'selected' : '' }}>Not Started</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expected_completion_date">Expected Completion Date:</label>
                        <input type="date" name="expected_completion_date" id="expected_completion_date" class="form-control" value="{{ $task->expected_completion_date }}" required>
                    </div>

                    <div class="form-group">
                        <label for="efforts_estimate">Efforts Estimate:</label>
                        <input type="number" name="efforts_estimate" id="efforts_estimate" class="form-control" value="{{ $task->efforts_estimate }}" required>
                    </div>

                    <div class="form-group">
                        <label for="actual_efforts">Actual Efforts:</label>
                        <input type="number" name="actual_efforts" id="actual_efforts" class="form-control" value="{{ $task->actual_efforts }}">
                    </div>
                    <div class="form-group">
                <label for="assignee_id">Assignee</label>
                <select class="form-control" id="assignee_id" name="assignee_id" required>
                          @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $task->resource_assigned_to == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                            @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="work_start_date">Work Start Date</label>
                <input type="date" class="form-control" id="work_start_date" name="work_start_date"  value="{{ $task->work_start_date }}">
            </div>
            <div class="form-group">
                <label for="work_complete_date">Work Complete Date</label>
                <input type="date" class="form-control" id="work_complete_date" name="work_complete_date" value="{{ $task->work_complete_date }}" >
            </div>
            <div class="form-group">
                <label for="completed_status">Completed Status</label>
                <select class="form-control" id="completed_status" name="completed_status" value="{{ $task->completed_status }}" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comments">Comments</label>
                <textarea class="form-control" id="comments" name="comments" value="{{ $task->comments }}" ></textarea>
            </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection