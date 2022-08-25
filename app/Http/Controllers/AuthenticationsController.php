<?php

namespace App\Http\Controllers;

use App\Models\authentications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthenticationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authentication=DB::table('authentications')
        ->select('authentications.id', 
        'authentications.permisions', 
        'roles.id AS roleID', 
        'roles.role_name', 
        'roles.description')
        ->join('roles','authentications.role_id', '=', 'roles.id');

        return $authentication;
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
        $id=0;
        $id=$request->id;

        $authentication=new authentications();
        $authentication->role_id=$request->input('role_id');
        $authentication->authentication_keys_id=$request->input('authentication_keys_id');

        if($id)
        {
            $authentication=authentications::find($id);
            $authentication->save();
        }
        else
        {
            $authentication->save();
        }
        return $authentication;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\authentications  $authentications
     * @return \Illuminate\Http\Response
     */
    public function show(authentications $authentications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\authentications  $authentications
     * @return \Illuminate\Http\Response
     */
    public function edit(authentications $authentications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\authentications  $authentications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, authentications $authentications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\authentications  $authentications
     * @return \Illuminate\Http\Response
     */
    public function destroy(authentications $authentications)
    {
        //
    }
}
