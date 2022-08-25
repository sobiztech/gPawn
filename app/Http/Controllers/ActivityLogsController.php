<?php

namespace App\Http\Controllers;

use App\Models\activity_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityLog=DB::table('activity_logs')
        ->select('activity_logs.id', 
        'activity_logs.date', 
        'activity_logs.action',
        'users.id AS uID',
        'employees.id AS eID', 
        'employees.employee_number', 
        'employees.employee_first_name', 
        'employees.employee_sur_name')
        ->join('users','activity_logs.user_id', '=', 'users.id')
        ->join('employees','activity_logs.employee_id', '=', 'employees.id');

        return $activityLog;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\activity_logs  $activity_logs
     * @return \Illuminate\Http\Response
     */
    public function show(activity_logs $activity_logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\activity_logs  $activity_logs
     * @return \Illuminate\Http\Response
     */
    public function edit(activity_logs $activity_logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\activity_logs  $activity_logs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, activity_logs $activity_logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\activity_logs  $activity_logs
     * @return \Illuminate\Http\Response
     */
    public function destroy(activity_logs $activity_logs)
    {
        //
    }
}
