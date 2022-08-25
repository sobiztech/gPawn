<?php

namespace App\Http\Controllers;

use App\Models\loans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loan=DB::table('loans')
        ->select('loans.id', 
        'loans.date', 
        'loans.amount', 
        'loans.period', 
        'loans.description', 
        'customers.id AS cID', 
        'customers.customer_number', 
        'customers.customer_first_name', 
        'customers.customer_sur_name',
        'loan_types.id AS lTID', 
        'loan_types.loan_type_name', 
        'users.id AS uID', 
        'users.id',
        'employees.id AS eID', 
        'employees.employee_number', 
        'employees.employee_first_name', 
        'employees.employee_sur_name')
        ->join('customers','loans.customer_id', '=', 'customers.id')
        ->join('loan_types','loans.loan_type_id', '=', 'loan_types.id')
        ->join('users','loans.user_id', '=', 'users.id')
        ->join('employees','loans.employee_id', '=', 'employees.id');

        return $loan;
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

        $loan=new loans();
        $loan->date=$request->input('date');
        $loan->customer_id=$request->input('customer_id');
        $loan->amount=$request->input('amount');
        $loan->period=$request->input('period');
        $loan->loan_type_id=$request->input('loan_type_id');
        $loan->user_id=$request->input('user_id');
        $loan->description=$request->input('description');

        if($id)
        {
            $loan=loans::find($id);
            $loan->save();
        }
        else
        {
            $loan->save();
        }
        return $loan;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function show(loans $loans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function edit(loans $loans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, loans $loans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function destroy(loans $loans)
    {
        //
    }
}
