<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function checkedBy()
    {
        return $this->belongsTo(Employee::class, 'checked_by');
    }

    public function paginate($count = 10)
    {
        $user = auth()->user();
        $employee = $user->employee;

        if (!$employee) {
            // Handle case where user has no employee record
            return $this->with('employee', 'checkedBy')->latest()->paginate($count);
        }

        if ($user->isAdmin()) {
            return $this->with('employee', 'checkedBy')->latest()->paginate($count);
        }

        return $this->with('employee', 'checkedBy')
            ->where(function ($query) use ($employee) {
                $query->where('employee_id', $employee->id) // Employee sees their own requests
                    ->orWhereHas('employee', function ($subQuery) use ($employee) {
                        $subQuery->where('manager_id', $employee->id); // Manager sees assigned employees' requests
                    });
            })
            ->latest()
            ->paginate($count);
    }
}
