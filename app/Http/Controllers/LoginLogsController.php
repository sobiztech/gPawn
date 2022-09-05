<?php

namespace App\Http\Controllers;

use App\Models\login_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginLogsController extends Controller
{
    public function index()
    {
        $loginLogs=DB::table('login_logs')
        ->select('login_logs.id', 
        'login_logs.date', 
        'login_logs.status',
        'login_logs.emp_id',
        'employees.id AS eID', 
        'employees.employee_number', 
        'employees.employee_first_name', 
        'employees.employee_sur_name')
        ->join('employees','login_logs.emp_id', '=', 'employees.id');

        return $loginLogs;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(login_logs $login_logs)
    {
        //
    }

    public function edit(login_logs $login_logs)
    {
        //
    }

    public function update(Request $request, login_logs $login_logs)
    {
        //
    }

    public function destroy(login_logs $login_logs)
    {
        //
    }
}
