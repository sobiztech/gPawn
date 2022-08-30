<?php

namespace App\Http\Controllers;

use App\Models\schedule_runs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleRunsController extends Controller
{
    public function index()
    {
        $sheduleRuns=DB::table('schedule_runs')
        ->select('schedule_runs.id',
        'schedule_runs.date', 
        'schedule_runs.payable_id',
        'payables.id AS pID', 
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
        ->join('loans','payables.loan_id', '=', 'loans.id')
        ->get();

        return $sheduleRuns;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $scheduleruns=new schedule_runs();
        $scheduleruns->date=$request->input('date');
        $scheduleruns->payable_id=$request->input('payable_id');
        $scheduleruns->save();

        return $scheduleruns;
    }

    public function show(schedule_runs $schedule_runs)
    {
        //
    }

    public function edit(schedule_runs $schedule_runs)
    {
        //
    }

    public function update(Request $request, schedule_runs $schedule_runs)
    {
        //
    }

    public function destroy(schedule_runs $schedule_runs)
    {
        //
    }
}
