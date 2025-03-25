@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'leave-request'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
      <h4 class="font-weight-bold">Employees' Leave Requests</h4>
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12 mb-3">
      <div class="bg-light text-dark card p-3 overflow-auto">
        <div class="row mb-3">
          <div class="col-md-3">
            @if (collect($accesses)->where('menu_id', 4)->first()->status == 2)
            <a href="{{ route('employees-leave-request.create') }}" class="btn btn-outline-dark btn-block">
              <i class="fas fa-plus mr-1"></i> Create
            </a>
            @endif
          </div>
          <div class="col-md-3 offset-md-6 text-right">
            <a href="{{ route('employees-leave-request.print') }}" class="btn btn-outline-dark btn-block" target="_blank">
              <i class="fas fa-print mr-1"></i> Print
            </a>
          </div>
        </div>

        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <table class="table table-light table-striped table-hover table-bordered text-center">
          <thead>
            <tr>
              <th scope="col" class="table-dark">#</th>
              <th scope="col" class="table-dark">Name</th>
              <th scope="col" class="table-dark">From</th>
              <th scope="col" class="table-dark">To</th>
              <th scope="col" class="table-dark">Message</th>
              <th scope="col" class="table-dark">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($employeeLeaveRequests as $leaveReq)
            <tr>
              <th scope="row">{{ $loop->iteration + $employeeLeaveRequests->firstItem() - 1 }}</th>
              <td>
                @if($leaveReq->employee)
                <a href="{{ route('employees-leave-request.show', ['employeeLeaveRequest' => $leaveReq->id]) }}">
                  {{ $leaveReq->employee->name }}
                </a>
                @else
                <span class="text-muted">N/A</span>
                @endif
              </td>
              <td>{{ \Carbon\Carbon::parse($leaveReq->from)->format('d-M-Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($leaveReq->to)->format('d-M-Y') }}</td>
              <td>{{ $leaveReq->message ?: 'N/A' }}</td>
              <td>
                @if ($leaveReq->status == 'APPROVED')
                <span class="badge badge-success">{{ $leaveReq->status }}</span>
                @elseif ($leaveReq->status == 'REJECTED')
                <span class="badge badge-danger">{{ $leaveReq->status }}</span>
                @elseif ($leaveReq->status == 'WAITING_FOR_APPROVAL')
                <span class="badge badge-warning">{{ $leaveReq->status }}</span>
                @else
                <span class="badge badge-secondary">{{ $leaveReq->status }}</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="d-flex justify-content-center">
          {{ $employeeLeaveRequests->links() }}
        </div>

      </div>
    </div>
  </div>
</div>
@endsection