<?php

namespace App\Http\Controllers;

use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=DB::table('employees')
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
        'employees.description',
        'departments.id AS dID', 
        'departments.department_number', 
        'departments.department_name',
        'roles.id AS rID', 
        'roles.role_name')
        ->join('departments','authentications.role_id', '=', 'departments.id')
        ->join('roles','employees.role_id', '=', 'roles.id');

        return $employee;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=0;
        $id=$request->id;

        $employee=new employees();
        $employee->employee_number=$request->input('employee_number');
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
        $employee->image=$request->file('image');
        $employee->contract_start_date=$request->input('contract_start_date');
        $employee->contract_end_date=$request->input('contract_end_date');
        $employee->is_active=$request->input('is_active');
        $employee->description=$request->input('description');

        if($id)
        {
            $employee=employees::find($id);
            $employee->save();
        }
        else
        {
            $employee->save();
        }
        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(employees $employees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employees $employees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(employees $employees)
    {
        //
    }
}
