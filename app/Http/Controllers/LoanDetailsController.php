<?php

namespace App\Http\Controllers;

use App\Models\loan_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanDetailsController extends Controller
{
    public function index()
    {
        $loanDetails=DB::table('loan_details')
        ->select('loan_details.id', 
        'loan_details.amount', 
        'loan_details.status', 
        'loan_details.description',
        'loans.id AS lID', 
        'loans.date', 
        'loans.amount AS lAmount', 
        'loans.period',
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
        ->join('loans','loan_details.loan_id', '=', 'loans.id')
        ->join('loan_types','loans.loan_type_id', '=', 'loan_types.id')
        ->join('customers','loans.customer_id', '=', 'customers.id')
        ->join('users','loans.user_id', '=', 'users.id')
        ->join('employees','users.employee_id', '=', 'employees.id')
        ->get();

        // $loans = DB::table('loans')->select('id', 'property_name')->get();

        return view('pages.loandetail', compact('loanDetails'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {


        $loanDetail=new loan_details();
        $loanDetail->month=$request->input('month');
        $loanDetail->loan_id=$request->input('loan_id');
        $loanDetail->amount=$request->input('amount');
        $loanDetail->status=$request->input('status');
        $loanDetail->description=$request->input('description');
        $loanDetail->save();

        return $loanDetail;
    }

    public function show(loan_details $loan_details)
    {
        //
    }

    public function edit(loan_details $loan_details)
    {
        //
    }

    public function update(Request $request, loan_details $loan_details)
    {
        //
    }

    public function destroy(loan_details $loan_details)
    {
        //
    }
}
