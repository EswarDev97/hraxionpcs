@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'financial-requests'])

@section('_content')
<div class="container">
    <h1>Financial Request Details</h1>
    <hr>
    <div class="mb-3 border rounded p-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="request_name">Request Name:</label>
                    <input type="text" name="request_name" id="request_name" class="form-control-plaintext" readonly value="{{ $financialRequest->request_name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <input type="text" name="priority" id="priority" class="form-control-plaintext" readonly value="{{ $financialRequest->priority }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="request_description">Request Description:</label>
            <textarea class="form-control-plaintext" id="request_description" name="request_description" readonly>{{ $financialRequest->request_description }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" name="status" id="status" class="form-control-plaintext" readonly value="{{ $financialRequest->status }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="expected_date">Expected Date:</label>
                    <input type="date" id="expected_date" name="expected_date" class="form-control-plaintext" readonly value="{{ $financialRequest->expected_date }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" class="form-control-plaintext" readonly value="{{ $financialRequest->amount }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="paid_amount">Paid Amount:</label>
                    <input type="number" id="paid_amount" name="paid_amount" class="form-control-plaintext" readonly value="{{ $financialRequest->paid_amount }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="paid_on_date">Paid On Date:</label>
                    <input type="date" id="paid_on_date" name="paid_on_date" class="form-control-plaintext" readonly value="{{ $financialRequest->paid_on_date }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="payment_details">Payment Details:</label>
                    <textarea class="form-control-plaintext" id="payment_details" name="payment_details" readonly>{{ $financialRequest->payment_details }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="upload_document">Uploaded Document:</label>
            @if($financialRequest->upload_document)
                <a href="{{ asset('storage/' . $financialRequest->upload_document) }}" target="_blank">View Document</a>
            @else
                <p>No document uploaded.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('financial-requests.index') }}" class="btn btn-secondary btn-sm">Back</a>

    <a href="{{ route('financial-requests.edit', ['financial_request' => $financialRequest->id]) }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ route('financial-requests.destroy', ['financial_request' => $financialRequest->id]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this financial request?')">Delete</button>
                                </form>
</div>
@endsection
