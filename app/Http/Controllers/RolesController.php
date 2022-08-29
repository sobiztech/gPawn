<?php

namespace App\Http\Controllers;

use App\Models\roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function index()
    {
        $roles=DB::table('roles')
        ->select('roles.id', 
        'roles.role_name', 
        'roles.description')
        ->get();

        return view('pages.role', compact('roles'));
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
                'role_name' => 'unique:roles,role_name'
            ]);

            $role = new roles();

        } else { // update
            $this->validate($request, [
                'role_name' => 'unique:roles,role_name,' .$id
            ]);

            $role = roles::find($id);
        }
        
        try {        
            $role->role_name=$request->input('role_name');
            $role->description=$request->input('description');
            $role->save();

            return redirect()->route('role.index')->with('success', 'Role ....');

        } catch (\Throwable $th) {
            return redirect()->route('role.index')->with('error', 'error ....');
        }
    }

    public function show(roles $roles)
    {
        //
    }

    public function edit(roles $roles)
    {
        //
    }

    public function update(Request $request, roles $roles)
    {
        //
    }

    public function destroy(roles $roles)
    {
        //
    }
}
