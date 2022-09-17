<?php

namespace App\Http\Controllers;

use App\Models\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    
    public function index()
    {

        $customers = DB::table('customers')
            ->select('customers.id', 
            'customers.customer_number', 
            'customers.customer_first_name', 
            'customers.customer_sur_name', 
            'customers.nic',
            'customers.date_of_birth',
            'customers.gender', 
            'customers.phone_number', 
            'customers.email', 
            'customers.address', 
            'customers.image', 
            'customers.is_active', 
            'customers.description', 
            'customers.customer_type_id', 
            'customer_types.customer_type_name')
            ->leftJoin('customer_types','customers.customer_type_id', 'customer_types.id')
            ->orderByDesc('customers.is_active')
            ->orderByDesc('customers.id')
            ->get();


        $customer_types = DB::table('customer_types')->select('id', 'customer_type_name')->get();

        return view('pages.customer', compact('customers', 'customer_types'));
    }

    
   
    public function store(Request $request)
    {
       
        $id = $request->id;

        if ($id == 0) { // create
            $request['customer_number'] = 'cus-' . rand(0,9) . date('ymdHis');


            $this->validate($request, [
                'email' => 'unique:customers,email',
                'nic' => 'required|min:10|max:12|unique:customers,nic',
                'customer_number' => 'required|unique:customers,customer_number'
            ]);

            $customer = new customers();
            $customer->customer_number = $request->customer_number;
            $customer->is_active = 1;

        } else { // update
            $this->validate($request, [
                'email' => 'unique:customers,email,' .$id,
                'nic' => 'required|min:10|max:12|unique:customers,nic,' .$id
            ]);

            $customer = customers::find($id);
        }
        
        try {        
        
            $customer->customer_first_name = $request->input('customer_first_name');
            $customer->customer_sur_name = $request->input('customer_sur_name');
            $customer->customer_type_id = $request->input('customer_type_id');
            $customer->nic = $request->input('nic');
            $customer->date_of_birth = $request->input('date_of_birth');
            $customer->gender = $request->input('gender');
            $customer->phone_number = $request->input('phone_number');
            $customer->email = $request->input('email');
            // $customer->image = $request->file('image');
            $customer->address = $request->input('address');
            $customer->description = $request->input('description');
            $customer->save();

            
            return redirect()->route('customer.index')->with('success', 'Customer ....');

        } catch (\Throwable $th) {
            
            return redirect()->route('customer.index')->with('error', 'error ....');
            
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

        $customer = customers::find($id);
        $customer->is_active = $status;
        $customer->save();

        return 'Done';
    }

    
    public function destroy(customers $customers)
    {
        //
    }
}
