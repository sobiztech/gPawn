<?php

namespace App\Http\Controllers;

use App\Models\payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments=DB::table('payments')
        ->select('payments.id',
        'payments.date', 
        'payments.invoice_no', 
        'payments.amount', 
        'payments.description',
        'payments.customer_id',
        'payments.payment_type_id',
        'payments.user_id',
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
        ->join('employees','users.employee_id', '=', 'employees.id')
        ->get();

        $payment_types = DB::table('payment_types')->get();
        $customers = DB::table('customers')->get();

        return view('pages.payment', compact('payments', 'payment_types', 'customers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create
            $request['invoice_no'] = 'inv-' . rand(0,9) . date('ymdHis');
            $this->validate($request, [
                'invoice_no' => 'unique:payments,invoice_no',
            ]);

            $payment = new payments();
            $payment->invoice_no = $request->invoice_no;

        } else { // update
            $this->validate($request, [
                'invoice_no' => 'unique:payments,invoice_no,' .$id,
            ]);

            $payment = payments::find($id);
        }
        
        // try {        
            $payment->date=$request->input('date');
            $payment->customer_id=$request->input('customer_id');
            $payment->amount=$request->input('amount');
            $payment->payment_type_id=$request->input('payment_type_id');
            $payment->user_id='1';
            // $payment->user_id=$request->input('user_id');
            $payment->description=$request->input('description');
            $payment->save();

            return redirect()->route('payment.index')->with('success', 'Payment ....');

        // } catch (\Throwable $th) {
        //     return redirect()->route('payment.index')->with('error', 'error ....');
        // }
    }

    public function show(payments $payments)
    {
        //
    }

    public function edit(payments $payments)
    {
        //
    }

    public function update(Request $request, payments $payments)
    {
        //
    }

    public function destroy(payments $payments)
    {
        //
    }
}
