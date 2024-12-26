@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'tasks'])

@section('_content')
<div class="container-fluid mt-2 px-4">
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold">Create Project</h4>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <div class="bg-light text-dark card p-3 overflow-auto">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Project Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Project Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                    <!-- Add more fields as necessary -->
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
