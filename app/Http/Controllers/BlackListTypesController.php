<?php

namespace App\Http\Controllers;

use App\Models\black_list_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlackListTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blackListType=DB::table('black_list_types')
        ->select('black_list_types.id', 
        'black_list_types.black_list_type_name', 
        'black_list_types.description');

        return $blackListType;
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

        $blackListType=new black_list_types();
        $blackListType->black_list_type_name=$request->input('black_list_type_name');
        $blackListType->description=$request->input('description');

        if($id)
        {
            $blackListType=black_list_types::find($id);
            $blackListType->save();
        }
        else
        {
            $blackListType->save();
        }

        return $blackListType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\black_list_types  $black_list_types
     * @return \Illuminate\Http\Response
     */
    public function show(black_list_types $black_list_types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\black_list_types  $black_list_types
     * @return \Illuminate\Http\Response
     */
    public function edit(black_list_types $black_list_types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\black_list_types  $black_list_types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, black_list_types $black_list_types)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\black_list_types  $black_list_types
     * @return \Illuminate\Http\Response
     */
    public function destroy(black_list_types $black_list_types)
    {
        //
    }
}
