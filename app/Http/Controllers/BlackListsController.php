<?php

namespace App\Http\Controllers;

use App\Models\black_lists;
use App\Models\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlackListsController extends Controller
{
    public function index()
    {
        $blackLists=DB::table('black_lists')
        ->select('black_lists.customer_id',
        'black_lists.black_list_type_id',
        'customers.id', 
        'customers.customer_number', 
        'customers.customer_first_name', 
        'customers.customer_sur_name', 
        'customers.nic', 
        'customers.customer_type_id', 
        'black_list_types.id AS bLTypeID', 
        'black_list_types.black_list_type_name')
        ->join('customers','black_lists.customer_id','=','customers.id')
        ->join('black_list_types','black_lists.black_list_type_id','=','black_list_types.id')
        ->get();

        $blackListTypes = DB::table('black_list_types')
        ->select('id', 'black_list_type_name')
        ->get();

        $customers = DB::table('customers')
        ->select('id', 'customer_number', 'customer_first_name', 'customer_sur_name', 'phone_number', )
        ->get();

        return view('pages.blacklist',compact('blackLists', 'blackListTypes', 'customers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // return $request;
        $id = $request->id;
        $cusID = $request->customer_id;
        $blackListTypeID = $request->black_list_type_id;

        if ($id == 0) { // create
            $this->validate($request, [
                'customer_id' => 'unique:black_lists,customer_id'
            ]);

            $blackList = new black_lists();

        } else { // update
            $this->validate($request, [
                'customer_id' => 'unique:black_lists,customer_id,' .$id
            ]);

            $blackList = black_lists::find($id);
        }
        
        try {        
            $blackList->customer_id=$cusID;
            $blackList->black_list_type_id=$blackListTypeID;
            $blackList->save();

            // $black_lists_ID=$blackList->$id;
            $customer = customers::find($cusID);
            $customer->black_list_type_id = $blackListTypeID;
            $customer->save();


            return redirect()->route('blacklist.index')->with('success', 'Black List ....');

        } catch (\Throwable $th) {
            return redirect()->route('blacklist.index')->with('error', 'error ....');
        }
    }

    public function show(black_lists $black_lists)
    {
        //
    }

    public function edit(black_lists $black_lists)
    {
        //
    }

    public function update(Request $request, black_lists $black_lists)
    {
        //
    }

    public function delete(Request $request)
    {
        return view("HIIII") ;
        $id=$request->id;
        $blackList = black_lists::find($id);
        $blackList->delete();
    }
}
