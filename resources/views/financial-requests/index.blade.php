@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'financial-requests'])

@section('_content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>All Financial Requests</h3>
            @auth
                @if (Auth::user()->isAdmin())
                    <a href="{{ route('financial-requests.create') }}" class="btn btn-primary mb-3">Create Request</a>
                @endif
            @endauth
            <table class="table table-light table-striped table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Requester</th>
                        <th>Approval To</th>
                        <th>Request Name</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Expected Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($financialRequests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ optional($request->requester)->name }}</td>
                            <td>{{ optional($request->approver)->name }}</td>
                            <td><a href="{{ route('financial-requests.show', ['financial_request' => $request->id]) }}">{{ $request->request_name }}</a></td>
                            <td>{{ $request->priority }}</td>
                            <td>{{ $request->status }}</td>
                            <td>{{ $request->amount }}</td>
                            <td>{{ $request->expected_date }}</td>
                            <td>
                                @if (Auth::user()->isAdmin())
                                    @if ($request->status == 'approved')
                                        <form action="{{ route('financial-requests.update-status', ['financial_request' => $request->id]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="status" value="paid">
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to mark this request as paid?')">Mark as Paid</button>
                                        </form>
                                    @endif

                                    @if ($request->status == 'pending')
                                        <form action="{{ route('financial-requests.update-status', ['financial_request' => $request->id]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="status" value="approve">
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this financial request?')">Approve</button>
                                        </form>
                                        <form action="{{ route('financial-requests.update-status', ['financial_request' => $request->id]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="status" value="reject">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject this financial request?')">Reject</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
