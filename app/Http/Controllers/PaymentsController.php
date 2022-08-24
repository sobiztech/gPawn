<?php

namespace App\Http\Controllers;

use App\Models\payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment=DB::table('payments')
        ->select('payments.id',
        'payments.date', 
        'payments.invoice_no', 
        'payments.amount', 
        'payments.description',
        'payment_types.id AS pTID', 
        'payment_types.payment_type_name',
        'customers.id AS cID', 
        'customers.customer_number', 
        'customers.customer_first_name', 
        'customers.customer_sur_name',
        'users.id AS uID', 
        'employees.id AS eID', 
        'employees.employee_number', 
        'employees.employee_first_name', 
        'employees.employee_sur_name')
        ->join('payment_types','payments.payment_type_id', '=', 'payment_types.id')
        ->join('customers','payments.customer_id', '=', 'customers.id')
        ->join('users','payments.user_id', '=', 'users.id')
        ->join('employees','users.employee_id', '=', 'employees.id');

        return $payment;
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

        $payment=new payments();
        $payment->date=$request->input('date');
        $payment->customer_id=$request->input('customer_id');
        $payment->invoice_no=$request->input('invoice_no');
        $payment->amount=$request->input('amount');
        $payment->payment_type_id=$request->input('payment_type_id');
        $payment->user_id=$request->input('user_id');
        $payment->description=$request->input('description');

        if($id)
        {
            $payment=payments::find($id);
            $payment->save();
        }
        else
        {
            $payment->save();
        }
        return $payment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show(payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(payments $payments)
    {
        //
    }
}
