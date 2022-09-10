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
        $actvieLoans = DB::table('loans as l')
                        ->selectRaw('
                                    l.id as loan_id, 
                                    l.invoice_no,
                                    l.amount,
                                    l.date,
                                    c.customer_first_name,
                                    c.phone_number
                                ')
                        ->leftJoin('customers as c', 'c.id', 'l.customer_id')
                        ->where('l.loan_status', 0) // not complate
                        ->orderByDesc('l.id')
                        ->get();

        return view('pages.payment.paymentView', compact('actvieLoans'));
    }

    // ajax
    public function viewByLoanInAjax(Request $request)
    {
        $loanId = $request->loanId;
        
        $payment = DB::table('payments as p')
                ->select(
                    'p.invoice_no',
                    'p.date',
                    'p.amount',
                    'p.description',
                    'e.employee_first_name as buyer_name',
                )
                ->leftJoin('employees as e', 'e.id', 'p.emp_id')
                ->where('p.loan_id', $loanId)
                ->get();

        return $payment;
    }

    // public function index()
    // {
    //     $payments=DB::table('payments')
    //     ->select('payments.id',
    //     'payments.date', 
    //     'payments.invoice_no', 
    //     'payments.amount',
    //     'payments.discount', 
    //     'payments.description',
    //     'payments.loan_id',
    //     'payments.payment_type_id',
    //     'payments.emp_id',
    //     'payment_types.id AS pTID', 
    //     'payment_types.payment_type_name',
    //     'loans.id AS lID', 
    //     'loans.date', 
    //     'loans.amount', 
    //     'loans.period', 
    //     'loans.interest',
    //     'loans.loan_end_date',
    //     'loans.customer_id', 
    //     'loans.loan_type_id', 
    //     'loans.emp_id', 
    //     'loans.description', 
    //     'customers.id AS cID', 
    //     'customers.customer_number', 
    //     'customers.customer_first_name', 
    //     'customers.customer_sur_name', 
    //     'employees.id AS eID', 
    //     'employees.employee_number', 
    //     'employees.employee_first_name', 
    //     'employees.employee_sur_name')
    //     ->join('payment_types','payments.payment_type_id', '=', 'payment_types.id')
    //     ->join('loans','payments.loan_id', '=', 'loans.id')
    //     ->join('customers','loans.customer_id', '=', 'customers.id')
    //     ->join('employees','payments.emp_id', '=', 'employees.id')
    //     ->get();

    //     $payment_types = DB::table('payment_types')->get();
    //     $customers = DB::table('customers')->get();

    //     return view('pages.payment', compact('payments', 'payment_types', 'customers'));
    // }

    public function create($id)
    {
        $loan_id = $id;

        $details = DB::table('loans as l')
                ->select(
                    'l.id as loan_id',
                    'l.amount as total_amount',
                    'l.invoice_no',
                    'c.customer_first_name'
                )
                ->leftJoin('customers as c', 'c.id', 'l.customer_id')
                ->where('l.id', $loan_id)
                ->first();

        $total_payble = DB::table('payables')
                ->where('payables.loan_id', $loan_id)
                ->value(DB::raw('IFNULL(SUM(payables.amount),0)'));

        $total_payed = DB::table('payments')
                ->where('payments.loan_id', $loan_id)
                ->value(DB::raw('IFNULL(SUM(payments.amount),0)'));

        $details->total_payble = $total_payble - $total_payed;
        $details->total_payed = $total_payed;

        $payment_types = DB::table('payment_types')->get();


        return view('pages.payment.payment', compact('details', 'payment_types'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create
            $request['invoice_no'] = 'pay-' . rand(0,9) . date('ymdHis');
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
        
        try {        
            $payment->date = $request->input('date');
            $payment->loan_id = $request->input('loan_id');
            $payment->amount = $request->input('amount');
            $payment->payment_type_id = $request->input('payment_type_id');
            $payment->emp_id = 1;  //Auth::user()->employee_id;
            $payment->description = $request->input('description');
            $payment->save();

            return redirect()->route('payment.payable')->with('success', 'Payment ....');

        } catch (\Throwable $th) {
            return redirect()->route('payment.payable')->with('error', 'error ....');
        }

    }


    public function payable()
    {
        $payable = DB::table('loans as l')
            ->selectRaw('
                        l.id as loan_id, 
                        l.invoice_no,
                        l.amount,
                        c.customer_first_name,
                        c.phone_number
                    ')
            ->leftJoin('customers as c', 'c.id', 'l.customer_id')
            ->where('l.loan_status', 0) // not complate
            ->orderByDesc('l.id')
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

            $day = date('Y-m-d', strtotime($lastScheduleRunDate . '+1 day'));
            while ($toDay >= $day) {
                foreach ($notFinishLoans as $key) {
                    $loan_id = $key->loan_id;
                    $schedule_payment_amount = $key->schedule_payment_amount;
                    $pay_type = $key->pay_type;
                    $loan_end_date = $key->loan_end_date;

                    if ($loan_end_date >= $day) { // active loans
                        $thisLoanLastPayable = DB::table('payables')
                            ->where('loan_id', $loan_id)
                            ->orderByDesc('id')
                            ->first('date');

                        $todayScheduleCreate = false;  // assign veriable

                        if ($thisLoanLastPayable) {  // have recode
                            $thisLoanLastPayableDate = $thisLoanLastPayable->date;

                            if ($pay_type == 'Monthly') {
                                $todayMonthNumber = date('Y-m', strtotime($day));
                                $thisLoanLastPayableMonthNumber = date('Y-m', strtotime($thisLoanLastPayableDate));

                                if ($todayMonthNumber > $thisLoanLastPayableMonthNumber) {
                                    $todayScheduleCreate = true;
                                }
                            } elseif ($pay_type == 'Weekly') {
                                $todayWeekNumber = date('Y-W', strtotime($day));
                                $thisLoanLastPayableWeekNumber = date('Y-W', strtotime($thisLoanLastPayableDate));

                                if ($todayWeekNumber > $thisLoanLastPayableWeekNumber) {
                                    $todayScheduleCreate = true;
                                }
                            } else {  // daily 
                                $todayScheduleCreate = true;
                            }
                        } else {  // new loan
                            $todayScheduleCreate = true;
                        }

                        if ($todayScheduleCreate) {  // return TURE value
                            $payable = new Payable();
                            $payable->date = $day;
                            $payable->loan_id = $loan_id;
                            $payable->amount = $schedule_payment_amount;
                            $payable->save();
                        }
                    }
                }

                $lastPayable =  DB::table('payables')->orderByDesc('id')->first('id');
                $ScheduleRun = new ScheduleRun();
                $ScheduleRun->date = $day;
                $ScheduleRun->payable_id = $lastPayable ? $lastPayable->id : null;
                $ScheduleRun->save();

                $day = date('Y-m-d', strtotime($day . '+1 day'));
            }
        }

        return "Run Shedule Scussfuly";
    }
}
