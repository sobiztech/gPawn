<?php

namespace App\Http\Controllers;

use App\Models\loans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoansController extends Controller
{
    public function index()
    {
        $loans=DB::table('loans')
        ->select('loans.id', 
        'loans.date', 
        'loans.amount', 
        'loans.period', 
        'loans.interest',
        'loans.loan_end_date',
        'loans.customer_id', 
        'loans.loan_type_id', 
        'loans.user_id', 
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
        ->join('employees','users.employee_id', '=', 'employees.id')
        ->get();

        $loan_types = DB::table('loan_types')->select('id', 'loan_type_name')->get();
        $customers = DB::table('customers')->select('id', 'customer_first_name',)->get();

        return view('pages.loan.index', compact('loans', 'loan_types', 'customers'));
    }

    
    public function create()
    {
        $customers = DB::table('customers')
            ->select('customers.id', 
            'customers.customer_number', 
            'customers.customer_first_name', 
            'customers.customer_sur_name', 
            'customers.phone_number', 
            )
            ->where('customers.is_active', 1)
            ->get();

        $loan_types = DB::table('loan_types')->get();

        return view('pages.loan.create', compact('customers', 'loan_types'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create
            $this->validate($request, [
                'customer_id' => 'unique:loans,customer_id'
            ]);

            $loan = new loans();

        } else { // update
            $this->validate($request, [
                'customer_id' => 'unique:loans,customer_id,' .$id
            ]);

            $loan = loans::find($id);
        }
        
        try {        
            $loan->date=$request->input('date');
            $loan->customer_id=$request->input('customer_id');
            $loan->amount=$request->input('amount');
            $loan->period=$request->input('period');
            $loan->interest=$request->input('interest');
            $loan->loan_end_date=$request->input('loan_end_date');
            $loan->loan_type_id=$request->input('loan_type_id');
            $loan->user_id='1';
            // $loan->user_id=$request->input('user_id');
            $loan->description=$request->input('description');
            $loan->save();

            return redirect()->route('loan.index')->with('success', 'Loan ....');

        } catch (\Throwable $th) {
            return redirect()->route('loan.index')->with('error', 'error ....');
        }
    }

   
    public function show(loans $loans)
    {
        //
    }

    
    public function edit(loans $loans)
    {
        //
    }
    
    public function update(Request $request, loans $loans)
    {
        //
    }
    
    public function getLoanPaymentDetailAjax(Request $request)
    {
        $amount = $request->amount;
        $percentage = $request->percentage;
        $period = $request->period;
        $start_date = $request->date;

        $end_date = date('Y-m-d', strtotime($start_date . '+' .$period . 'month'));

        $diff_day_count =  \Carbon\Carbon::parse($end_date)->diff(\Carbon\Carbon::parse($start_date))->format('%a');
        $diff_week_count = floor(\Carbon\Carbon::parse($end_date)->diff(\Carbon\Carbon::parse($start_date))->days/7);


        $totalPayable = ($amount + (($amount * $percentage / 100) * $period));
        $monthly_payment = ($totalPayable / $period);
        $weekly_payment = ($totalPayable / ($period * $diff_week_count));
        $daily_payment = ($totalPayable / ($period * $diff_day_count));

        $data = [
            'monthly_payment' => number_format((float)$monthly_payment, 2, '.', ','),
            'weekly_payment' => number_format((float)$weekly_payment, 2, '.', ','),
            'daily_payment' => number_format((float)$daily_payment, 2, '.', ','),
            'month_count' => $period,
            'week_count' => $diff_week_count,
            'day_count' => $diff_day_count,
            'total_payable' => number_format((float)$totalPayable, 2, '.', ',')
        ];

        return $data;
    }
}
