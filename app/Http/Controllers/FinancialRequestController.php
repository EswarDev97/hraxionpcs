<?php

namespace App\Http\Controllers;

use App\Models\FinancialRequest;
use App\Models\User;
use App\Models\Access;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialRequestController extends Controller
{
    public function index()
    {
        $accesses = Access::all();
  
        // $financialRequests = FinancialRequest::all(); // Adjust with your query as needed
        // return view('financial-requests.index', compact('financialRequests'));
        $financialRequests = FinancialRequest::with('approver')->get();
        return view('financial-requests.index', compact('financialRequests'), ['accesses' => $accesses]);
     }

    public function create()
    {
        $managingDirectors = Employee::whereHas('position', function ($query) {
            $query->where('name', 'Managing Director');
        })->get();
        $employees = User::all();
        return view('financial-requests.create', compact('employees','managingDirectors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'approval_to_id' => 'required|exists:users,id',
            'request_name' => 'required|string|max:255',
            'request_description' => 'required|string',
            'priority' => 'required|string',
            'status' => 'required|string',
            'amount' => 'required|numeric',
            'expected_date' => 'required|date',
            'upload_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'paid_amount' => 'nullable|numeric',
            'paid_on_date' => 'nullable|date',
            'payment_details' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['requester_id'] = Auth::id();

        if ($request->hasFile('upload_document')) {
            $data['upload_document'] = $request->file('upload_document')->store('documents');
        }

        FinancialRequest::create($data);

        return redirect()->route('financial-requests.index')->with('status', 'Financial Request created successfully!');
    }

    public function show($id)
    {
        $financialRequest = FinancialRequest::findOrFail($id);
        return view('financial-requests.show', compact('financialRequest'));
    }
    

    public function edit(FinancialRequest $financialRequest)
    {
        $employees = User::all();
        return view('financial-requests.edit', compact('financialRequest', 'employees'));
    }

    public function updateStatus(Request $request, FinancialRequest $financialRequest)
    {
        $request->validate([
            'status' => 'required|string|in:approve,reject',
        ]);

        $status = $request->input('status');
        $financialRequest->status = $status;

        if ($status === 'approve') {
            $requester = $financialRequest->requester;
            $requester->save();
        }

        $financialRequest->save();

        return redirect()->route('financial-requests.index')->with('status', 'Financial Request status updated successfully!');
     // Validate the request if necessary

        // Authorization check - only MD and Cashier can update status
        // if (!auth()->user()->isManagingDirector() && !auth()->user()->isCashier()) {
        //     abort(403, 'Unauthorized action.');
        // }

        // // Update the status based on the form input
        // $financial_request->status = $request->status;
        // $financial_request->save();

        // Redirect back or to another appropriate page
        //return redirect()->back()->with('success', 'Financial request status updated successfully.');
     }
    // public function updateStatus(Request $request, FinancialRequest $financialRequest)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'status' => 'required|string|in:approve,reject',
    //     ]);
    
    //     // Authorization check - only MD and Cashier can update status
    //     if (!auth()->user()->isManagingDirector() && !auth()->user()->isCashier()) {
    //         abort(403, 'Unauthorized action.');
    //     }
    
    //     // Update the status based on the form input
    //     $financialRequest->status = $request->status;
    //     $financialRequest->save();
    
    //     // Redirect back or to another appropriate page
    //     return redirect()->back()->with('success', 'Financial request status updated successfully.');
    // }
    
    public function destroy(FinancialRequest $financialRequest)
    {
        $financialRequest->delete();

        return redirect()->route('financial-requests.index')->with('status', 'Financial Request deleted successfully!');
    }
}
