<?php

namespace App\Http\Controllers;

use App\Models\properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property=DB::table('authentication_keys')
        ->select('properties.id', 
        'properties.property_name', 
        'properties.phone_number', 
        'properties.email', 
        'properties.location', 
        'properties.description');

        return $property;
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

        $property=new properties();
        $property->properties_name=$request->input('date');
        $property->phone_number=$request->input('customer_id');
        $property->email=$request->input('invoice_no');
        $property->location=$request->input('amount');
        $property->is_active=$request->input('payment_type_id');
        $property->description=$request->input('description');

        if($id)
        {
            $property=properties::find($id);
            $property->save();
        }
        else
        {
            $property->save();
        }
        return $property;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\properties  $properties
     * @return \Illuminate\Http\Response
     */
    public function show(properties $properties)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\properties  $properties
     * @return \Illuminate\Http\Response
     */
    public function edit(properties $properties)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\properties  $properties
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, properties $properties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\properties  $properties
     * @return \Illuminate\Http\Response
     */
    public function destroy(properties $properties)
    {
        //
    }
}
