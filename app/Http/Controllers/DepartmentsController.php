<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class departmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments=DB::table('departments')
        ->select('departments.id', 
        'departments.department_number', 
        'departments.department_name', 
        'departments.phone_number', 
        'departments.email', 
        'departments.location', 
        'departments.description',
        'properties.id AS pID', 
        'properties.property_name')
        ->join('properties','departments.property_id', '=', 'properties.id')
        ->get();

        $properties = DB::table('properties')->select('id', 'property_name')->get();

        return view('pages.department', compact('departments', 'properties'));
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

        $department=new departments();
        $department->department_number=$request->input('department_number');
        $department->department_name=$request->input('department_name');
        $department->properties_id=$request->input('properties_id');
        $department->phone_number=$request->input('phone_number');
        $department->email=$request->input('email');
        $department->location=$request->input('location');
        $department->is_active=$request->input('is_active');
        $department->description=$request->input('description');

        if($id)
        {
            $department=departments::find($id);
            $department->save();
        }
        else
        {
            $department->save();
        }
        return $department;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\$departments  $$departments
     * @return \Illuminate\Http\Response
     */
    public function show(departments $departments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\$departments  $$departments
     * @return \Illuminate\Http\Response
     */
    public function edit(departments $departments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\$departments  $$departments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, departments $departments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\$departments  $$departments
     * @return \Illuminate\Http\Response
     */
    public function destroy(departments $departments)
    {
        //
    }
}
