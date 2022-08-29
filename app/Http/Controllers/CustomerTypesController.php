<?php

namespace App\Http\Controllers;

use App\Models\customer_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerTypes=DB::table('customer_types')
        ->select('customer_types.id', 
        'customer_types.customer_type_name', 
        'customer_types.description')
        ->get();

        return view('pages.customertype', compact('customerTypes'));
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
                'customer_type_name' => 'unique:customer_types,customer_type_name'
            ]);

            $customerType = new customer_types();

        } else { // update
            $this->validate($request, [
                'customer_type_name' => 'unique:customer_types,customer_type_name,' .$id
            ]);

            $customerType = customer_types::find($id);
        }
        
        try {        
            $customerType->customer_type_name=$request->input('customer_type_name');
            $customerType->description=$request->input('description');
            $customerType->save();

            return redirect()->route('customertype.index')->with('success', 'Customer Type ....');

        } catch (\Throwable $th) {
            return redirect()->route('customertype.index')->with('error', 'error ....');
        }
    }

    public function show(customer_types $customer_types)
    {
        //
    }

    public function edit(customer_types $customer_types)
    {
        //
    }

    public function update(Request $request, customer_types $customer_types)
    {
        //
    }

    public function destroy(customer_types $customer_types)
    {
        //
    }
}
