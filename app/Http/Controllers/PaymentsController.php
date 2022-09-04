<?php

namespace App\Http\Controllers;

use App\Models\Payable;
use App\Models\payments;
use App\Models\ScheduleRun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    
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

    
    public function create()
    {
        //
    }

    
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

    public function payable()
    {
        $payable = DB::table('loans as l')
                    ->selectRaw('
                        l.id as loan_id, 
                        l.amount,
                        c.customer_first_name,
                        c.phone_number
                    ')
                    ->leftJoin('customers as c', 'c.id', 'l.customer_id')
                    ->where('l.loan_status', 0) // not complate
                    ->get();

        foreach ($payable as $key) {
            $loan_id = $key->loan_id;

            $total_payble = DB::table('payables')
                        ->where('payables.loan_id', $loan_id)
                        ->value(DB::raw('IFNULL(SUM(payables.amount),0)'));

            $total_payed = DB::table('payments')
                        ->where('payments.loan_id', $loan_id)
                        ->value(DB::raw('IFNULL(SUM(payments.amount),0)'));

            $key->total_payble = $total_payble;
            $key->total_payed = $total_payed;
            $key->till_balance_amount = $total_payble - $total_payed;
        }

        return view('pages.payment.payable', compact('payable'));

    }

    public function schedule()
    {
        
        // get last schedule run date
        $lastScheduleRun = DB::table('schedule_runs')->orderByDesc('id')->first('date');
        $lastScheduleRunDate = $lastScheduleRun ? $lastScheduleRun->date : date('Y-m-d', strtotime(now() . '-1 day'));

        $toDay = date('Y-m-d'); // today

        if ($toDay > $lastScheduleRunDate) { // today till not run shedule 
           
            $notFinishLoans = DB::table('loans as l')
                            ->select(
                                'l.id as loan_id',
                                'l.schedule_payment_amount',
                                'l.pay_type',
                                'l.loan_end_date'
                            )
                            ->where('l.loan_status', 0) // not complate
                            ->get();

            foreach ($notFinishLoans as $key) {
                $loan_id = $key->loan_id;
                $schedule_payment_amount = $key->schedule_payment_amount;
                $pay_type = $key->pay_type;
                $loan_end_date = $key->loan_end_date;

                if ($loan_end_date >= $toDay) { // active loans
                    $thisLoanLastPayable = DB::table('payables')
                                        ->where('loan_id', $loan_id)
                                        ->orderByDesc('id')
                                        ->first('date');

                    $todayScheduleCreate = false;  // assign veriable

                    if ($thisLoanLastPayable) {  // have recode
                        $thisLoanLastPayableDate = $thisLoanLastPayable->date;

                        if ($pay_type == 'Monthly') { 
                            $todayMonthNumber = date('m', strtotime($toDay));
                            $thisLoanLastPayableMonthNumber = date('m', strtotime($thisLoanLastPayableDate));

                            if ($todayMonthNumber > $thisLoanLastPayableMonthNumber) {
                                $todayScheduleCreate = true;
                            }
                        } elseif ($pay_type == 'Weekly') {
                            $todayWeekNumber = date('W', strtotime($toDay));
                            $thisLoanLastPayableWeekNumber = date('W', strtotime($thisLoanLastPayableDate));

                            if ($todayWeekNumber > $thisLoanLastPayableWeekNumber) {
                                $todayScheduleCreate = true;
                            }
                        } else {  // daily 
                            $todayScheduleCreate = true;
                        }

                    } else {
                        $todayScheduleCreate = true;
                    }

                    if ($todayScheduleCreate) {  // returen TURE value
                        $payable = new Payable();
                        $payable->date = $toDay;
                        $payable->loan_id = $loan_id;
                        $payable->amount = $schedule_payment_amount;
                        $payable->save();
                    }
                    
                }
            }

            $lastPayable =  DB::table('payables')->orderByDesc('id')->first('id');
            $ScheduleRun = new ScheduleRun();
            $ScheduleRun->date = $toDay;
            $ScheduleRun->payable_id = $lastPayable ? $lastPayable->id : null;
            $ScheduleRun->save();

        }

        return "Run Shedule Scussfuly";

    }

}
