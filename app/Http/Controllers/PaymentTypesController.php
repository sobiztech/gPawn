<?php

namespace App\Http\Controllers;

use App\Models\payment_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentType=DB::table('payment_types')
        ->select('payment_types.id', 
        'payment_types.payment_type_name', 
        'payment_types.description');
        
        return $paymentType;
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

        $paymentType=new payment_types();
        $paymentType->payment_type_name=$request->input('payment_type_name');
        $paymentType->description=$request->input('description');

        if($id)
        {
            $paymentType=payment_types::find($id);
            $paymentType->save();
        }
        else
        {
            $paymentType->save();
        }
        return $paymentType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment_types  $payment_types
     * @return \Illuminate\Http\Response
     */
    public function show(payment_types $payment_types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment_types  $payment_types
     * @return \Illuminate\Http\Response
     */
    public function edit(payment_types $payment_types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment_types  $payment_types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment_types $payment_types)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment_types  $payment_types
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment_types $payment_types)
    {
        //
    }
}
