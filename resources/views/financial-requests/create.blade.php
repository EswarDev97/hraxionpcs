@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'tasks'])

@section('_content')
<div class="container-fluid mt-2 px-4">
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold">Create Financial Request</h4>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <div class="bg-light text-dark card p-3 overflow-auto">
                <form action="{{ route('financial-requests.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="approval_to_id">Approval To</label>
                                <select name="approval_to_id" id="approval_to_id" class="form-control" required>
                                    @foreach ($managingDirectors as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="request_name">Request Name</label>
                                <input type="text" name="request_name" id="request_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority" class="form-control" required>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="upload_document">Upload Document</label>
                                <input type="file" name="upload_document" id="upload_document" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="request_description">Request Description</label>
                                <textarea name="request_description" id="request_description" class="form-control" rows="5" required></textarea>
                            </div>




                        </div>

                        <div class="col-md-6">


                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="completed">Completed</option>
                                    <option value="in_progress">in_progress</option>
                                    <option value="Approved"> Approved</option>
                                    <option value="Rejected"> Rejected</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="expected_date">Expected Date</label>
                                <input type="date" name="expected_date" id="expected_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="paid_amount">Paid Amount</label>
                                <input type="number" step="0.01" name="paid_amount" id="paid_amount" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="paid_on_date">Paid On Date</label>
                                <input type="date" name="paid_on_date" id="paid_on_date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="payment_details">Payment Details</label>
                                <textarea name="payment_details" id="payment_details" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection