<?php

namespace App\Http\Controllers;

use App\Models\loan_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loanType=DB::table('loan_types')
        ->select('loan_types.id',
        'loan_types.loan_type_name', 
        'loan_types.description');

        return $loanType;
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

        $loanType=new loan_types();
        $loanType->loan_type_name=$request->input('loan_type_name');
        $loanType->description=$request->input('description');

        if($id)
        {
            $loanType=loan_types::find($id);
            $loanType->save();
        }
        else
        {
            $loanType->save();
        }
        return $loanType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\loan_types  $loan_types
     * @return \Illuminate\Http\Response
     */
    public function show(loan_types $loan_types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\loan_types  $loan_types
     * @return \Illuminate\Http\Response
     */
    public function edit(loan_types $loan_types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\loan_types  $loan_types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, loan_types $loan_types)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\loan_types  $loan_types
     * @return \Illuminate\Http\Response
     */
    public function destroy(loan_types $loan_types)
    {
        //
    }
}
