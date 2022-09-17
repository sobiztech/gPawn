<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // collector payment report
    public function collectorPaymentReport(Request $request)
    {
        $fromDate = isset($request->from) ? $request->from : date('Y-m-d');
        $toDate = isset($request->to) ? $request->to : date('Y-m-d');
        $loginCollectorEmpId = 1;  //Auth::user()->employee_id;

        $collection = DB::table('payments as p')
                    ->select(
                        'l.invoice_no as loan_invoice_no',
                        'p.invoice_no as payment_invoice_no',
                        'p.amount',
                        'p.date',
                        'p.description'
                    )
                    ->leftJoin('loans as l', 'l.id', 'p.loan_id')
                    ->where('p.emp_id', $loginCollectorEmpId)
                    ->whereDate('p.date', '>=', $fromDate)
                    ->whereDate('p.date', '<=', $toDate)
                    ->get();

        return view('pages.collecter.collectorPaymentViewReport', compact('collection', 'fromDate', 'toDate'));

    }
}
