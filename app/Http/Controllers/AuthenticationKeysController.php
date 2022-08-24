<?php

namespace App\Http\Controllers;

use App\Models\authentication_keys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthenticationKeysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authenticationKey=DB::table('authentication_keys')
        ->select('authentication_keys.id', 
        'authentication_keys.authentication_key_name', 
        'authentication_keys.route', 
        'authentication_keys.description');

        return $authenticationKey;
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
        
        $authenticationKey=new authentication_keys();
        $authenticationKey->authentication_key_name=$request->input('authentication_key_name');
        $authenticationKey->route=$request->input('route');
        $authenticationKey->description=$request->input('description');

        if($id)
        {
            $authenticationKey=authentication_keys::find($id);
            $authenticationKey->save();
        }
        else
        {
            $authenticationKey->save();
        }
        return $authenticationKey;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\authentication_keys  $authentication_keys
     * @return \Illuminate\Http\Response
     */
    public function show(authentication_keys $authentication_keys)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\authentication_keys  $authentication_keys
     * @return \Illuminate\Http\Response
     */
    public function edit(authentication_keys $authentication_keys)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\authentication_keys  $authentication_keys
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, authentication_keys $authentication_keys)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\authentication_keys  $authentication_keys
     * @return \Illuminate\Http\Response
     */
    public function destroy(authentication_keys $authentication_keys)
    {
        //
    }
}
