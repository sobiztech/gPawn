<?php

namespace App\Http\Controllers;

use App\Models\properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertiesController extends Controller
{
    public function index()
    {
       
        $properties=DB::table('properties')
        ->select('properties.id', 
        'properties.property_name', 
        'properties.phone_number', 
        'properties.email', 
        'properties.location', 
        'properties.description')
        ->get();

        return view('pages.property', compact('properties'));
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
                'email' => 'unique:properties,email',
                'property_name' => 'required|min:10|max:12|unique:customers,property_name'
            ]);

            $property = new properties();

        } else { // update
            $this->validate($request, [
                'email' => 'unique:properties,email,' .$id,
                'property_name' => 'required|min:10|max:12|unique:customers,property_name,' .$id
            ]);

            $property = properties::find($id);
        }
        
        try {        
            $property->property_name=$request->input('property_name');
            $property->phone_number=$request->input('phone_number');
            $property->email=$request->input('email');
            $property->location=$request->input('location');
            $property->description=$request->input('description');
            $property->save();

            return redirect()->route('property.index')->with('success', 'Property ....');

        } catch (\Throwable $th) {

            return redirect()->route('property.index')->with('error', 'error ....');
        }
    }

    public function destroy(properties $properties)
    {
        //
    }
}
