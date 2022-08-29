<?php

namespace App\Http\Controllers;

use App\Models\activity_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogsController extends Controller
{
    public function index()
    {
        $activityLogs=DB::table('activity_logs')
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

        return $activityLogs;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(activity_logs $activity_logs)
    {
        //
    }

    public function edit(activity_logs $activity_logs)
    {
        //
    }

    public function update(Request $request, activity_logs $activity_logs)
    {
        //
    }

    public function destroy(activity_logs $activity_logs)
    {
        //
    }
}
