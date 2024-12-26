<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function attendanceTime() {
        return $this->belongsTo(AttendanceTime::class);
    }

    public function attendanceType() {
        return $this->belongsTo(AttendanceType::class);
    }

    public function paginate ($count = 10) {
        $user = auth()->user();
    
        if ($user && $user->employee) {
            // Check if the user is authenticated and has an associated employee
            if ($user->isAdmin()) {
                return $this->with('employee', 'attendanceTime', 'attendanceType')->latest()->paginate($count);
            } else {
                return $this->with('employee', 'attendanceTime', 'attendanceType')
                    ->where('employee_id', $user->employee->id)
                    ->latest()
                    ->paginate($count);
            }
        } else {
            // Handle the case where the user or employee is not found
            // You could return an empty pagination or throw an exception
            return $this->latest()->paginate($count);  // Or handle as needed
        }
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }
}
