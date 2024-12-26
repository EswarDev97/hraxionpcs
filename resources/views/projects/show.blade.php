@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'projects'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Project Details</h4>
        <hr>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12">
        <h5 class="text-center font-weight-bold mb-3">Project's Detail</h5>
        <div class="mb-3">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control-plaintext" readonly value="{{ $project->name }}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" class="form-control-plaintext" readonly value="{{ $project->description }}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" name="status" id="status" class="form-control-plaintext" readonly value="{{ $project->status }}">
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a href="{{ route('projects.edit', ['project' => $project->id]) }}" class="btn btn-warning">Edit Project</a>
            <form action="{{ route('projects.destroy', ['project' => $project->id]) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete Project</button>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection
