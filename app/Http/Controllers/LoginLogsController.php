<?php

namespace App\Http\Controllers;

use App\Models\login_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityLog=DB::table('login_logs')
        ->select('login_logs.id', 
        'login_logs.date', 
        'login_logs.status',
        'users.id AS uID',
        'employees.id AS eID', 
        'employees.employee_number', 
        'employees.employee_first_name', 
        'employees.employee_sur_name')
        ->join('users','login_logs.user_id', '=', 'users.id')
        ->join('employees','login_logs.employee_id', '=', 'employees.id');

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
     * @param  \App\Models\login_logs  $login_logs
     * @return \Illuminate\Http\Response
     */
    public function show(login_logs $login_logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\login_logs  $login_logs
     * @return \Illuminate\Http\Response
     */
    public function edit(login_logs $login_logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\login_logs  $login_logs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, login_logs $login_logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\login_logs  $login_logs
     * @return \Illuminate\Http\Response
     */
    public function destroy(login_logs $login_logs)
    {
        //
    }
}
