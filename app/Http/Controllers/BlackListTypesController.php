<?php

namespace App\Http\Controllers;

use App\Models\black_list_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlackListTypesController extends Controller
{
    public function index()
    {
        $blackListTypes=DB::table('black_list_types')
        ->select('black_list_types.id', 
        'black_list_types.black_list_type_name', 
        'black_list_types.description')
        ->get();

        return view('pages.blacklisttype', compact('blackListTypes'));
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
                'black_list_type_name' => 'unique:black_list_types,black_list_type_name'
            ]);

            $blackListType = new black_list_types();

        } else { // update
            $this->validate($request, [
                'black_list_type_name' => 'unique:black_list_types,black_list_type_name,' .$id
            ]);

            $blackListType = black_list_types::find($id);
        }
        
        try {        
            $blackListType->black_list_type_name=$request->input('black_list_type_name');
            $blackListType->description=$request->input('description');
            $blackListType->save();

            return redirect()->route('blacklisttype.index')->with('success', 'Black List Type ....');

        } catch (\Throwable $th) {
            return redirect()->route('blacklisttype.index')->with('error', 'error ....');
        }
    }

    public function show(black_list_types $black_list_types)
    {
        //
    }

    public function edit(black_list_types $black_list_types)
    {
        //
    }

    public function update(Request $request, black_list_types $black_list_types)
    {
        //
    }

    public function destroy(black_list_types $black_list_types)
    {
        //
    }
}
