<?php

namespace App\Http\Controllers;

use App\Models\black_lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlackListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blackList=DB::table('black_lists')
        ->select('customers.id', 
        'customers.customer_number', 
        'customers.customer_first_name', 
        'customers.customer_sur_name', 
        'customers.customer_type_id', 
        'customers.nic',
        'black_list_types.id AS bLTypeID', 
        'black_list_types.black_list_type_name')
        ->join('customers','black_lists.customer_id','=','customers.id')
        ->join('black_list_types','black_lists.black_list_type_id','=','black_list_types.id');

        return $blackList;
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

        $blackList=new black_lists();
        $blackList->customer_id=$request->input('customer_id');
        $blackList->black_list_type_id=$request->input('black_list_type_id');

        if($id)
        {
            $blackList=black_lists::find($id);
            $blackList->save();
        }
        else
        {
            $blackList->save();
        }

        return $blackList;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\black_lists  $black_lists
     * @return \Illuminate\Http\Response
     */
    public function show(black_lists $black_lists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\black_lists  $black_lists
     * @return \Illuminate\Http\Response
     */
    public function edit(black_lists $black_lists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\black_lists  $black_lists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, black_lists $black_lists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\black_lists  $black_lists
     * @return \Illuminate\Http\Response
     */
    public function destroy(black_lists $black_lists)
    {
        //
    }
}
