<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['employeeDetail', 'department', 'position', 'user'];

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'start_of_contract', 'end_of_contract',
        'department_id', 'position_id', 'gender', 'date_of_birth', 'identity_number',
        'phone', 'address', 'photo', 'cv', 'last_education', 'gpa', 'work_experience_in_years',
        'basic_salary', 'variable_pay', 'blood_group', 'emergency_contact_number', 'manager_id',
        'head_of'
    ];
  
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function headOfDepartment()
    {
        return $this->belongsTo(Department::class, 'head_of');
    }

    public function employeeDetail()
    {
        return $this->hasOne(EmployeeDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employeeLeave()
    {
        return $this->hasOne(EmployeeLeave::class);
    }

    public function employeeLeaveRequest()
    {
        return $this->hasMany(EmployeeLeaveRequest::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }

    public function getCount()
    {
        return $this->count();
    }

    public function paginate($count = 10)
    {
        return $this->with('headOfDepartment')->latest()->paginate($count);
    }

    public function getEndingContractEmployees($count = 10)
    {
        return $this->orderBy('end_of_contract', 'ASC')->paginate($count);
    }

    public function getEmployeeLeaveData($count = 10)
    {
        return $this->with('employeeLeave', 'employeeLeaveRequest')->latest()->paginate($count);
    }

    public function getOrganizationTree($employeeId = null)
    {
        $employee = is_null($employeeId) ? $this : $this->find($employeeId);
    
        if (!$employee) {
            Log::error('Employee not found', ['employeeId' => $employeeId]);
            return null;
        }
    
        Log::info('Retrieving organization tree', ['employee' => $employee]);
    
        $tree = [
            'id' => $employee->id,
            'name' => $employee->name,
            'position' => optional($employee->position)->name ?? 'No position assigned',
            'subordinates' => []
        ];
    
        foreach ($employee->subordinates as $subordinate) {
            $tree['subordinates'][] = $subordinate->getOrganizationTree();
        }
    
        return $tree;
    }
}
