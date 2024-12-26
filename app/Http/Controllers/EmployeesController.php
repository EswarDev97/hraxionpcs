<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\EmployeeLeave;
use App\Models\Log;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;

class EmployeesController extends Controller
{
    private $employees;

    public function __construct()
    {
        $this->middleware('auth');  
        
        $this->employees = resolve(Employee::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employees->paginate();

        return view('pages.employees-data', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = resolve(Role::class)->get();
        $departments = resolve(Department::class)->get();
        $positions = resolve(Position::class)->get();
      
               $employees = Employee::all(); 
        return view('pages.employees-data_create', compact('roles', 'departments', 'positions', 'employees'));
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
        ]);

        $employee = Employee::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'start_of_contract' => $request->input('start_of_contract'),
            'end_of_contract' => $request->input('end_of_contract'),
            'manager_id' => $request->input('manager_id'),
            'department_id' => $request->input('department_id'),
            'position_id' => $request->input('position_id'),
            'blood_group' => $request->input('blood_group'), // Added blood_group field
            'emergency_contact_number' => $request->input('emergency_contact_number'), // Added emergency_contact_number field
            'basic_salary' => $request->input('basic_salary'),
            'variable_pay' => $request->input('variable_pay'),
        ]);

        EmployeeDetail::create([
            'employee_id' => $employee->id,
            'identity_number' => $request->input('identity_number'),
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'photo' => $request->file('photo')->store('photos', 'public'),
            'cv' => $request->file('cv')->store('cvs', 'public'),
            'last_education' => $request->input('last_education'),
            'gpa' => $request->input('gpa'),
            'work_experience_in_years' => $request->input('work_experience_in_years'),
        ]);

        EmployeeLeave::create([
            'employee_id' => $employee->id,
            'leaves_quota' => 12,
            'used_leaves' => 0 
        ]);

        Log::create([
            'description' => auth()->user()->employee->name . " created an employee named '" . $request->input('name') . "'"
        ]);

        return redirect()->route('employees-data')->with('status', 'Successfully created an employee.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('pages.employees-data_show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $roles = Role::all();
        $departments = Department::all();
        $positions = Position::all();
        $employees = Employee::all(); 
        return view('pages.employees-data_edit', compact('employees','employee', 'roles', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        User::where('id', $request->input('user_id'))
            ->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
            'is_active' => $request->input('is_active'),
        ]);

        Employee::where('id', $employee->id)
                ->update([
                    'name' => $request->input('name'),
                    'start_of_contract' => $request->input('start_of_contract'),
                    'end_of_contract' => $request->input('end_of_contract'),
                    'department_id' => $request->input('department_id'),
                    'position_id' => $request->input('position_id'),
                    'manager_id' => $request->input('manager_id'),
                    'basic_salary' => $request->input('basic_salary'),
                    'variable_pay' => $request->input('variable_pay'),
                    'blood_group' => $request->input('blood_group'), // Updated blood_group field
                    'emergency_contact_number' => $request->input('emergency_contact_number'), // Updated emergency_contact_number field
                    'is_active' => $request->input('is_active'),
                ]);

        EmployeeDetail::where('employee_id', $employee->id)
                    ->update([
                        'identity_number' => $request->input('identity_number'),
                        'name' => $request->input('name'),
                        'gender' => $request->input('gender'),
                        'date_of_birth' => $request->input('date_of_birth'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'address' => $request->input('address'),
                        'photo' => $request->file('photo')->store('photos', 'public'),
                        'cv' => $request->file('cv')->store('cvs', 'public'),
                        'last_education' => $request->input('last_education'),
                        'gpa' => $request->input('gpa'),
                        'work_experience_in_years' => $request->input('work_experience_in_years'),
                    ]);

        Log::create([
            'description' => auth()->user()->employee->name . " updated an employee's detail named '" . $employee->name . "'"
        ]);

        return redirect()->route('employees-data')->with('status', 'Successfully updated an employee.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        User::where('id', $employee->user_id)->delete();

        Log::create([
            'description' => auth()->user()->employee->name . " deleted an employee named '" . $employee->name . "'"
        ]);

        return redirect()->route('employees-data')->with('status', 'Successfully deleted an employee.');
    }

    public function print()
    {
        $employees = Employee::all();

        return view('pages.employees-data_print', compact('employees'));
    }
}
