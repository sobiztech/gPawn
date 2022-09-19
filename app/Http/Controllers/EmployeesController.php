<?php

namespace App\Http\Controllers;

use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees=DB::table('employees')
        ->select('employees.id', 
        'employees.employee_number', 
        'employees.employee_first_name', 
        'employees.employee_sur_name', 
        'employees.nic', 
        'employees.date_of_birth', 
        'employees.gender', 
        'employees.phone_number', 
        'employees.email', 
        'employees.address', 
        'employees.contract_start_date', 
        'employees.contract_end_date', 
        'employees.is_active', 
        'employees.department_id',
        'employees.role_id',
        'employees.description',
        'properties.id AS pID', 
        'properties.property_name',
        'departments.id AS dID', 
        'departments.department_number', 
        'departments.department_name',
        'departments.property_id',
        'roles.id AS rID', 
        'roles.role_name')
        ->join('departments','employees.department_id', '=', 'departments.id')
        ->join('properties','departments.property_id', '=', 'properties.id')
        ->join('roles','employees.role_id', '=', 'roles.id')
        ->get();

        $properties = DB::table('properties')->select('id', 'property_name')->get();
        $departments = DB::table('departments')->select('id', 'department_name','property_id')->get();
        $roles = DB::table('roles')->select('id', 'role_name')->get();

        return view('pages.employee', compact('employees', 'properties', 'departments', 'roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create
            $request['employee_number'] = 'emp-' . rand(0,9) . date('ymdHis');


            if($request['email']==null)
            {
                $this->validate($request, [
                    'nic' => 'required|min:10|max:12|unique:employees,nic',
                    'employee_number' => 'required|unique:employees,employee_number'
                ]);
            }
            else
            {
                $this->validate($request, [
                    'email' => 'unique:employees,email',
                    'nic' => 'required|min:10|max:12|unique:employees,nic',
                    'employee_number' => 'required|unique:employees,employee_number'
                ]);
            }

            $employee = new employees();
            $employee->employee_number = $request->employee_number;

        } else { // update

            if($request['email']==null)
            {
                $this->validate($request, [
                    'nic' => 'required|min:10|max:12|unique:employees,nic,' .$id
                ]);
            }
            else
            {
                $this->validate($request, [
                    'email' => 'unique:employees,email,' .$id,
                    'nic' => 'required|min:10|max:12|unique:employees,nic,' .$id
                ]);
            }

            $employee = employees::find($id);
        }
        
        try {        
            $employee->employee_first_name=$request->input('employee_first_name');
            $employee->employee_sur_name=$request->input('employee_sur_name');
            $employee->role_id=$request->input('role_id');
            $employee->department_id=$request->input('department_id');
            $employee->nic=$request->input('nic');
            $employee->date_of_birth=$request->input('date_of_birth');
            $employee->gender=$request->input('gender');
            $employee->phone_number=$request->input('phone_number');
            $employee->email=$request->input('email');
            $employee->address=$request->input('address');
            // $employee->image=$request->file('image');
            $employee->contract_start_date = $request->input('contract_start_date');
            $employee->contract_end_date = $request->input('contract_end_date');
            $employee->is_active = $request->input('is_active');
            $employee->description=$request->input('description');
            $employee->save();

            
            return redirect()->route('employee.index')->with('success', 'Employee ....');

        } catch (\Throwable $th) {
            
            return redirect()->route('employee.index')->with('error', 'error ....');
            
        }
    }

    // status change
    public function statusChange(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $employee = employees::find($id);
        $employee->is_active = $status;
        $employee->save();

        return 'Done';
    }

    public function show(employees $employees)
    {
        //
    }

    public function edit(employees $employees)
    {
        //
    }

    public function update(Request $request, employees $employees)
    {
        //
    }

    public function destroy(employees $employees)
    {
        //
    }
}
