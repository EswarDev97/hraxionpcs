<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function checkedBy(){
        return $this->belongsTo(Employee::class, 'checked_by');
    }

    public function paginate($count = 10) {
        $user = auth()->user();
        
        if($user->isAdmin()) {
            return $this->with('employee', 'checkedBy')->latest()->paginate($count);
        } else {
            $employee = $user->employee;
            
            if ($employee) {
                return $this->with('employee', 'checkedBy')
                    ->where('employee_id', $employee->id)
                    ->latest()
                    ->paginate($count);
            } else {
                // Handle the case where the user does not have an associated employee
                // You can return an empty paginator or handle this case differently as needed
                return $this->with('employee', 'checkedBy')->latest()->paginate($count);
            }
        }
    }
}
