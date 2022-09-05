<?php

namespace App\Http\Controllers;

use App\Models\loan_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanTypesController extends Controller
{
    public function index()
    {
        $loanTypes=DB::table('loan_types')
        ->select('loan_types.id',
        'loan_types.loan_type_name', 
        'loan_types.description')
        ->get();

        return view('pages.loantype', compact('loanTypes'));
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
                'loan_type_name' => 'unique:loan_types,loan_type_name'
            ]);

            $loanType = new loan_types();

        } else { // update
            $this->validate($request, [
                'loan_type_name' => 'unique:loan_types,loan_type_name,' .$id
            ]);

            $loanType = loan_types::find($id);
        }
        
        try {        
            $loanType->loan_type_name=$request->input('loan_type_name');
            $loanType->description=$request->input('description');
            $loanType->save();

            return redirect()->route('loantype.index')->with('success', 'Loan Type ....');

        } catch (\Throwable $th) {
            return redirect()->route('loantype.index')->with('error', 'error ....');
        }
    }

    public function show(loan_types $loan_types)
    {
        //
    }

    public function edit(loan_types $loan_types)
    {
        //
    }

    public function update(Request $request, loan_types $loan_types)
    {
        //
    }

    public function destroy(loan_types $loan_types)
    {
        //
    }
}
