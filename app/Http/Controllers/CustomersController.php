<?php

namespace App\Http\Controllers;

use App\Models\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    
    public function index()
    {
        $customer=DB::table('customers')
        ->select('customers.id', 
        'customers.customer_number', 
        'customers.customer_first_name', 
        'customers.customer_sur_name', 
        'customers.nic,date_of_birth',
        'customers.gender', 
        'customers.phone_number', 
        'customers.email', 
        'customers.address', 
        'customers.image', 
        'customers.is_active', 
        'customers.description', 
        'customer_types.id AS cTypeID', 
        'customer_types.customer_type_name')
        ->join('customer_types','customers.customer_type_id', '=', 'customer_types.id');

        return $customer;
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $id=0;
        $id=$request->id;

        $customer=new customers();
        $customer->customer_number=$request->input('customer_number');
        $customer->customer_first_name=$request->input('customer_first_name');
        $customer->customer_sur_name=$request->input('customer_sur_name');
        $customer->customer_type_id=$request->input('customer_type_id');
        $customer->nic=$request->input('nic');
        $customer->date_of_birth=$request->input('date_of_birth');
        $customer->gender=$request->input('gender');
        $customer->phone_number=$request->input('phone_number');
        $customer->email=$request->input('email');
        $customer->address=$request->input('address');
        $customer->image=$request->file('image');
        $customer->is_active=$request->input('is_active');
        $customer->description=$request->input('description');

        if($id)
        {
            $customer=customers::find($id);
            $customer->save();
        }
        else
        {
            $customer->save();
        }
        return $customer;
    }

   
    public function show(customers $customers)
    {
        //
    }

   
    public function edit(customers $customers)
    {
        
    }

   
    public function update(Request $request, customers $customers)
    {
        //
    }

    
    public function destroy(customers $customers)
    {
        //
    }
}
