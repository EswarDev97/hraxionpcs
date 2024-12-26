@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'projects'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Projects</h4>
        <hr>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12 mb-3">
      <div class="bg-light text-dark card p-3 overflow-auto">
        <div class="d-flex justify-content-between">
          <a href="{{ route('projects.create') }}" class="btn btn-outline-dark mb-3 w-25">
            <i class="fas fa-plus mr-1"></i>
              <span>Create Project</span>
          </a>
        </div>

        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        <table class="table table-light table-striped table-hover table-bordered text-center">
          <thead>
            <tr>
              <th scope="col" class="table-dark">ID</th>
              <th scope="col" class="table-dark">Project Name</th>
              <th scope="col" class="table-dark">Description</th>
              <th scope="col" class="table-dark">Start Date</th>
              <th scope="col" class="table-dark">End Date</th>
              <!-- Add more fields as necessary -->
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            <tr>
              <td>{{ $project->id }}</td>
              <td class="w-25">
                <a href="{{ route('projects.show', ['project' => $project->id]) }}">
                  {{ $project->name }}
                </a>
              </td>
              <td>{{ $project->description }}</td>
              <td>{{ $project->start_date }}</td>
              <td>{{ $project->end_date }}</td>
              <!-- Add more fields as necessary -->
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $projects->links() }}  
      </div>
    </div>
  </div>
</div>
@endsection
