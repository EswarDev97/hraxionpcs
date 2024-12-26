<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'approval_to_id', 'request_name', 'request_description', 'priority', 'status',
        'amount', 'expected_date', 'upload_document', 'paid_amount', 'paid_on_date', 'payment_details', 'requester_id'
    ];

    public function approver()
    {
        return $this->belongsTo(Employee::class, 'approval_to_id');
    }

    public function requester()
    {
        return $this->belongsTo(Employee::class, 'requester_id');
    }
}
