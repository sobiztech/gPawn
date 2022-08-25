<?php

namespace App\Http\Controllers;

use App\Models\loan_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loanDetail=DB::table('loan_details')
        ->select('loan_details.id', 
        'loan_details.amount', 
        'loan_details.status', 
        'loan_details.description',
        'loans.id AS lID', 
        'loans.date', 
        'loans.amount AS lAmount', 
        'loans.period')
        ->join('loans','loan_details.loan_id', '=', 'loans.id');

        return $loanDetail;
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

        $loanDetail=new loan_details();
        $loanDetail->month=$request->input('month');
        $loanDetail->loan_id=$request->input('loan_id');
        $loanDetail->amount=$request->input('amount');
        $loanDetail->status=$request->input('status');
        $loanDetail->description=$request->input('description');

        if($id)
        {
            $loanDetail=loan_details::find($id);
            $loanDetail->save();
        }
        else
        {
            $loanDetail->save();
        }
        return $loanDetail;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\loan_details  $loan_details
     * @return \Illuminate\Http\Response
     */
    public function show(loan_details $loan_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\loan_details  $loan_details
     * @return \Illuminate\Http\Response
     */
    public function edit(loan_details $loan_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\loan_details  $loan_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, loan_details $loan_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\loan_details  $loan_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(loan_details $loan_details)
    {
        //
    }
}
