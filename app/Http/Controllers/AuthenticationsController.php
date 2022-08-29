<?php

namespace App\Http\Controllers;

use App\Models\authentications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthenticationsController extends Controller
{
    public function index()
    {
        $authentications=DB::table('authentications')
        ->select('authentications.id', 
        'authentications.permisions', 
        'authentications.role_id', 
        'roles.id AS roleID', 
        'roles.role_name', 
        'roles.description')
        ->join('roles','authentications.role_id', '=', 'roles.id')
        ->get();

        $roles = DB::table('roles')->select('id', 'role_name')->get();

        return view('pages.authentication',compact('authentications', 'roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create
            $this->validate($request, [
                'role_id' => 'unique:authentications,role_id'
            ]);

            $authentication = new authentications();

        } else { // update
            $this->validate($request, [
                'role_id' => 'unique:authentications,role_id,' .$id
            ]);

            $authentication = authentications::find($id);
        }
        
        try {        
            $authentication->role_id=$request->input('role_id');
            $authentication->authentication_keys_id=$request->input('authentication_keys_id');
            $authentication->save();

            return redirect()->route('authenticationkey.index')->with('success', 'Authentication Key ....');

        } catch (\Throwable $th) {
            return redirect()->route('authenticationkey.index')->with('error', 'error ....');
        }
    }

    public function show(authentications $authentications)
    {
        //
    }

    public function edit(authentications $authentications)
    {
        //
    }

    public function update(Request $request, authentications $authentications)
    {
        //
    }

    public function destroy(authentications $authentications)
    {
        //
    }
}
