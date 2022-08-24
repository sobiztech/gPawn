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
        $customerType=DB::table('customer_types')
        ->select('customer_types.id', 
        'customer_types.customer_type_name', 
        'customer_types.description');

        return $customerType;
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

        $customerType=new customer_types();
        $customerType->customer_type_name=$request->input('customer_type_name');
        $customerType->description=$request->input('description');

        if($id)
        {
            $customerType=customer_types::find($id);
            $customerType->save();
        }
        else
        {
            $customerType->save();
        }
        return $customerType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer_types  $customer_types
     * @return \Illuminate\Http\Response
     */
    public function show(customer_types $customer_types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer_types  $customer_types
     * @return \Illuminate\Http\Response
     */
    public function edit(customer_types $customer_types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer_types  $customer_types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer_types $customer_types)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer_types  $customer_types
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer_types $customer_types)
    {
        //
    }
}
