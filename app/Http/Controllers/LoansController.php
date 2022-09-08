<?php

namespace App\Http\Controllers;

use App\Models\loans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoansController extends Controller
{

    public function index()
    {
        $loan = DB::table('loans as l')
                ->select(
                    'l.*', 
                    'c.customer_first_name',
                    'c.phone_number'
                )
                ->leftJoin('customers as c', 'c.id', 'l.customer_id')
                ->where('l.loan_status', 0) // not complate
                ->orderByDesc('l.id')
                ->get();

        return view('pages.loan.index', compact('loan'));
    }


    public function create()
    {

        $customers = DB::table('customers')
            ->select(
                'customers.id',
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


        $getExtaData = $this->getLoanPaymentDetailAjax($request);
        $total_payable = str_replace(',', '', $getExtaData['total_payable']);
        $monthly_payment = str_replace(',', '', $getExtaData['monthly_payment']);
        $weekly_payment = str_replace(',', '', $getExtaData['weekly_payment']);
        $daily_payment = str_replace(',', '', $getExtaData['daily_payment']);
        $end_date = $getExtaData['end_date'];

        if ($request->input('payment_type') == 'Monthly') {
            $schedule_payment_amount = $monthly_payment;
        } elseif ($request->input('payment_type') == 'Weekly') {
            $schedule_payment_amount = $weekly_payment;
        } else {
            $schedule_payment_amount = $daily_payment;
        }

        // id
        $id = $request->id;


        if ($id == null) {
            $loan = new loans();
        } else {
            $loan = loans::find($id);
        }

        try {

            $loan->date = $request->input('date');
            $loan->customer_id = $request->input('customer_id');
            $loan->amount = $request->input('amount');
            $loan->period = $request->input('period');
            $loan->interest = $request->input('percentage');
            $loan->total_payable = $total_payable;
            $loan->loan_type_id = $request->input('loan_type_id');
            $loan->pay_type = $request->input('payment_type');
            $loan->schedule_payment_amount = $schedule_payment_amount;
            $loan->loan_end_date = $end_date;
            $loan->emp_id = 1;  //Auth::user()->employee_id;
            $loan->description = $request->input('description');
            $loan->save();

            return redirect()->route('loan.index')->with('success', 'loan ....');
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

        $end_date = date('Y-m-d', strtotime($start_date . '+' . $period . 'month'));

        $diff_day_count =  \Carbon\Carbon::parse($end_date)->diff(\Carbon\Carbon::parse($start_date))->format('%a');

        $startYear = (int)date("Y", strtotime($start_date));
        $endYear = (int)date("Y", strtotime($end_date));
        $startWeekNumber = (int)date("W", strtotime($start_date));
        $endWeekNumber = (int)date("W", strtotime($end_date));
        if (($startYear == $endYear) && ($endWeekNumber > $startWeekNumber)) {
            $diff_week_count = $endWeekNumber - $startWeekNumber;

        } elseif (($startYear == $endYear) && ($startWeekNumber > $endWeekNumber)) {
            $year = date("Y", strtotime($start_date));
            $YearMaxWeekNumber = (int)max(date("W", strtotime($year ."-12-27")), date("W", strtotime($year ."-12-29")), date("W", strtotime($year ."-12-31")));

            $diff_week_count = ($YearMaxWeekNumber - $startWeekNumber + $endWeekNumber);

        } else {
            $yearDiff = ($endYear - $startYear);
            $totalYearsWeekNumbers = 0;
            for ($i=0; $i < $yearDiff; $i++) { 
                $year = date("Y", strtotime($start_date . '+' . $i . 'year'));
                $YearMaxWeekNumber = (int)max(date("W", strtotime($year ."-12-27")), date("W", strtotime($year ."-12-29")), date("W", strtotime($year ."-12-31")));
                $totalYearsWeekNumbers += $YearMaxWeekNumber;
            }

            $diff_week_count = ($totalYearsWeekNumbers - $startWeekNumber + $endWeekNumber);
        }
        


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
            'total_payable' => number_format((float)$totalPayable, 2, '.', ','),
            'end_date' => $end_date
        ];

        return $data;
    }
}
