@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'tasks'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Create Task</h4>
        <hr>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12 mb-3">
      <div class="bg-light text-dark card p-3 overflow-auto">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="project_id">Project</label>
                    <select class="form-control" id="project_id" name="project_id" required>
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="resource_assigned_to">Resource Assigned To</label>
                    <select class="form-control" id="resource_assigned_to" name="resource_assigned_to" required>
                        @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="task_name">Task Name</label>
                    <input type="text" class="form-control" id="task_name" name="task_name" required>
                </div>
                <div class="form-group">
                    <label for="task_description">Task Description</label>
                    <textarea class="form-control" id="task_description" name="task_description"></textarea>
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select class="form-control" id="priority" name="priority" required>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="completed">Completed</option>
                        <option value="not_started">Not Started</option>
                        <option value="in_progress">In Progress</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="expected_completion_date">Expected Completion Date</label>
                    <input type="date" class="form-control" id="expected_completion_date" name="expected_completion_date" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="efforts_estimate">Efforts Estimate</label>
                    <input type="number" class="form-control" id="efforts_estimate" name="efforts_estimate" required>
                </div>
                <div class="form-group">
                    <label for="actual_efforts">Actual Efforts</label>
                    <input type="number" class="form-control" id="actual_efforts" name="actual_efforts">
                </div>
                <div class="form-group">
                    <label for="assignee_id">Assignee</label>
                    <select class="form-control" id="assignee_id" name="assignee_id" required>
                        @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="work_start_date">Work Start Date</label>
                    <input type="date" class="form-control" id="work_start_date" name="work_start_date">
                </div>
                <div class="form-group">
                    <label for="work_complete_date">Work Complete Date</label>
                    <input type="date" class="form-control" id="work_complete_date" name="work_complete_date">
                </div>
                <div class="form-group">
                    <label for="completed_status">Completed Status</label>
                    <select class="form-control" id="completed_status" name="completed_status" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea class="form-control" id="comments" name="comments"></textarea>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
