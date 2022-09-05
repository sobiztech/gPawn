<?php

namespace App\Http\Controllers;

use App\Models\payment_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentTypesController extends Controller
{
    public function index()
    {
        $paymentTypes=DB::table('payment_types')
        ->select('payment_types.id', 
        'payment_types.payment_type_name', 
        'payment_types.description')
        ->get();

        return view('pages.paymenttype', compact('paymentTypes'));
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
                'payment_type_name' => 'unique:payment_types,payment_type_name'
            ]);

            $paymentType = new payment_types();

        } else { // update
            $this->validate($request, [
                'payment_type_name' => 'unique:payment_types,payment_type_name,' .$id
            ]);

            $paymentType = payment_types::find($id);
        }
        
        try {        
            $paymentType->payment_type_name=$request->input('payment_type_name');
            $paymentType->description=$request->input('description');
            $paymentType->save();

            return redirect()->route('paymenttype.index')->with('success', 'Payment Type ....');

        } catch (\Throwable $th) {
            return redirect()->route('paymenttype.index')->with('error', 'error ....');
        }
    }

    public function show(payment_types $payment_types)
    {
        //
    }

    public function edit(payment_types $payment_types)
    {
        //
    }

    public function update(Request $request, payment_types $payment_types)
    {
        //
    }

    public function destroy(payment_types $payment_types)
    {
        //
    }
}
