<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allSettings = Setting::orderBy('key', 'ASC');
        if($request->search){
            $searchQuery=$request->search;
            $allSettings = $allSettings->where('title',"like" ,"%$searchQuery%")
            ->orwhere('key','like', "%$searchQuery%")
            ->orwhere('value_actual','like', "%$searchQuery%");
        }
        $allSettings = $allSettings->paginate(10);
        return view('backend.settings.index',compact('allSettings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'string|required',
                'key' => 'unique:settings|regex:/^[0-9a-zA-Z_-]*$/',
                'type' => 'required|in:boolean,integer,string'
            ]
        );

        //  collect data
        $data = $request->all();
        if($data['type'] == 'integer' && !is_numeric($data['value_actual'])) {   
            return  back()->with('error', 'please input valid integer');
        }
        $data['value_actual'] = serialize($data['value_actual']);
        $data['value_default'] = $data['value_actual'];
        $data['is_hidden'] = $request->input('is_hidden')  ?  1 : 0;
        // save data
        $status = Setting::create($data);
        if ($status) {
            return redirect()->route('setting.index')->with('success', 'Successfully Crated Setting');
        } else {
            return  back()->with('error', 'Some thing went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            return view('backend.settings.edit', compact('setting'));
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            $this->validate(
                $request,
                [
                    'title' => 'string|required',
                    //'key' => 'regex:/^[0-9a-zA-Z_-]*$/',
                    'type' => 'required|in:boolean,integer,string'
                ]
            );
            //  collect data
            $data = $request->all();
            if($data['type'] == 'integer' && !is_numeric($data['value_actual'])) {   
                return  back()->with('error', 'please input valid integer');
            }
            $data['value_actual'] = serialize($data['value_actual']);
            $data['is_hidden'] = $request->input('is_hidden')  ?  1 : 0;
            // save data
            $status = $setting->fill($data)->save();
            if ($status) {
                return redirect()->route('setting.index')->with('success', 'Successfully Updated Setting');
            } else {
                return  back()->with('error', 'Some thing went wrong');
            }
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            $status = $setting->delete();
            if ($status) {
                return redirect()->route('setting.index')->with('success', 'Successfully Deleted Setting');
            }
        } 
        return back()->with('error', 'Data Not Found');
    }
}
