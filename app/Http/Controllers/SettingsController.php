<?php

namespace App\Http\Controllers;

use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {
        $settings=DB::table('settings')
        ->select('settings.id',
        'settings.key_name', 
        'settings.key_value', 
        'settings.description')
        ->get();

        return view('pages.setting',compact('settings'));
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
                'key_name' => 'unique:settings,key_name'
            ]);

            $setting = new settings();

        } else { // update
            $this->validate($request, [
                'key_name' => 'unique:settings,key_name,' .$id
            ]);

            $setting = settings::find($id);
        }
        
        try {        
            $setting->key_name=$request->input('key_name');
            $setting->key_value=$request->input('key_value');
            $setting->description=$request->input('description');
            $setting->save();

            return redirect()->route('setting.index')->with('success', 'Setting ....');

        } catch (\Throwable $th) {
            return redirect()->route('setting.index')->with('error', 'error ....');
        }
    }

    public function show(settings $settings)
    {
        //
    }

    public function edit(settings $settings)
    {
        //
    }

    public function update(Request $request, settings $settings)
    {
        //
    }

    public function destroy(settings $settings)
    {
        //
    }
}
