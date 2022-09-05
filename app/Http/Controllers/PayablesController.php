<?php

namespace App\Http\Controllers;

use App\Models\payables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayablesController extends Controller
{
    public function index()
    {
        $payables=DB::table('payables')
        ->select('payables.id',
        'payables.date', 
        'payables.amount',
        'payables.loan_id', 
        'loans.id AS lID', 
        'loans.date', 
        'loans.amount', 
        'loans.period', 
        'loans.interest',
        'loans.loan_end_date')
        ->join('loans','payables.loan_id', '=', 'loans.id')
        ->get();

        return $payables;

        // return view('pages.loantype', compact('loanTypes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $payable=new payables();
        $payable->date=$request->input('date');
        $payable->amount=$request->input('amount');
        $payable->loan_id=$request->input('loan_id');
        $payable->save();

        return $payable;
    }

    public function show(payables $payables)
    {
        //
    }

    public function edit(payables $payables)
    {
        //
    }

    public function update(Request $request, payables $payables)
    {
        //
    }

    public function destroy(payables $payables)
    {
        //
    }
}
