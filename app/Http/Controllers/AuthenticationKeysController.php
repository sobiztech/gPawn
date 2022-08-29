<?php

namespace App\Http\Controllers;

use App\Models\authentication_keys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthenticationKeysController extends Controller
{
    public function index()
    {
        $authenticationKeys=DB::table('authentication_keys')
        ->select('authentication_keys.id', 
        'authentication_keys.authentication_key_name', 
        'authentication_keys.route', 
        'authentication_keys.description')
        ->get();

        return view('pages.authenticationkey',compact('authenticationKeys'));
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
                'authentication_key_name' => 'unique:authentication_keys,authentication_key_name',
                'route' => 'unique:authentication_keys,route'
            ]);

            $authenticationKey = new authentication_keys();

        } else { // update
            $this->validate($request, [
                'authentication_key_name' => 'unique:authentication_keys,authentication_key_name,' .$id,
                'route' => 'unique:authentication_keys,route,' .$id
            ]);

            $authenticationKey = authentication_keys::find($id);
        }
        
        try {        
            $authenticationKey->authentication_key_name=$request->input('authentication_key_name');
            $authenticationKey->route=$request->input('route');
            $authenticationKey->description=$request->input('description');
            $authenticationKey->save();

            return redirect()->route('authenticationkey.index')->with('success', 'Authentication Key ....');

        } catch (\Throwable $th) {
            return redirect()->route('authenticationkey.index')->with('error', 'error ....');
        }
    }

    public function show(authentication_keys $authentication_keys)
    {
        //
    }

    public function edit(authentication_keys $authentication_keys)
    {
        //
    }

    public function update(Request $request, authentication_keys $authentication_keys)
    {
        //
    }

    public function destroy(authentication_keys $authentication_keys)
    {
        //
    }
}
