<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class departmentsController extends Controller
{
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
        'departments.property_id', 
        'properties.property_name')
        ->join('properties','departments.property_id', '=', 'properties.id')
        ->get();

        $properties = DB::table('properties')->select('id', 'property_name')->get();

        return view('pages.department', compact('departments', 'properties'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create
            $this->validate($request, [
                'email' => 'unique:departments,email',
                'department_number' => 'required|unique:departments,department_number',
                'department_name' => 'required|unique:departments,department_name'
            ]);

            $department = new departments();

        } else { // update
            $this->validate($request, [
                'email' => 'unique:departments,email,' .$id,
                'department_number' => 'required|unique:departments,department_number,' .$id,
                'department_name' => 'required|unique:departments,department_name,' .$id
            ]);

            $department = departments::find($id);
        }
        
        try {        
            $department->department_number=$request->input('department_number');
            $department->department_name=$request->input('department_name');
            $department->property_id=$request->input('property_id');
            $department->phone_number=$request->input('phone_number');
            $department->email=$request->input('email');
            $department->location=$request->input('location');
            $department->description=$request->input('description');
            $department->save();

            return redirect()->route('department.index')->with('success', 'Department ....');

        } catch (\Throwable $th) {
            return redirect()->route('department.index')->with('error', 'error ....');
        }
    }

    public function show(departments $departments)
    {
        //
    }

    public function edit(departments $departments)
    {
        //
    }

    public function update(Request $request, departments $departments)
    {
        //
    }

    public function destroy(departments $departments)
    {
        //
    }
}
