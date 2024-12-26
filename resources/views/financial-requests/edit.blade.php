@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'financial-requests'])

@section('_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Edit Financial Request</h3>
            <form action="{{ route('financial-requests.update', $financialRequest->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="approval_to_id">Approval To</label>
                            <select name="approval_to_id" id="approval_to_id" class="form-control" required>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" @if($employee->id == $financialRequest->approval_to_id) selected @endif>{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="request_name">Request Name</label>
                            <input type="text" name="request_name" id="request_name" class="form-control" value="{{ $financialRequest->request_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" class="form-control" required>
                                <option value="high" @if($financialRequest->priority == 'high') selected @endif>High</option>
                                <option value="medium" @if($financialRequest->priority == 'medium') selected @endif>Medium</option>
                                <option value="low" @if($financialRequest->priority == 'low') selected @endif>Low</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="{{ $financialRequest->amount }}" required>
                        </div>

                        <div class="form-group">
                            <label for="upload_document">Upload Document</label>
                            <input type="file" name="upload_document" id="upload_document" class="form-control">
                            @if($financialRequest->upload_document)
                                <small>Current Document: <a href="{{ asset('storage/' . $financialRequest->upload_document) }}" target="_blank">View Document</a></small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="request_description">Request Description</label>
                            <textarea name="request_description" id="request_description" class="form-control" rows="5" required>{{ $financialRequest->request_description }}</textarea>
                        </div>



                    </div>

                    <div class="col-md-6">
                    

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="completed" @if($financialRequest->status == 'completed') selected @endif>Completed</option>
                                <option value="not_started" @if($financialRequest->status == 'not_started') selected @endif>Not Started</option>
                                <option value="in_progress" @if($financialRequest->status == 'in_progress') selected @endif>In Progress</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="expected_date">Expected Date</label>
                            <input type="date" name="expected_date" id="expected_date" class="form-control" value="{{ $financialRequest->expected_date }}" required>
                        </div>

                        <div class="form-group">
                            <label for="paid_amount">Paid Amount</label>
                            <input type="number" step="0.01" name="paid_amount" id="paid_amount" class="form-control" value="{{ $financialRequest->paid_amount }}">
                        </div>

                        <div class="form-group">
                            <label for="paid_on_date">Paid On Date</label>
                            <input type="date" name="paid_on_date" id="paid_on_date" class="form-control" value="{{ $financialRequest->paid_on_date }}">
                        </div>

                        <div class="form-group">
                            <label for="payment_details">Payment Details</label>
                            <textarea name="payment_details" id="payment_details" class="form-control" rows="5">{{ $financialRequest->payment_details }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
