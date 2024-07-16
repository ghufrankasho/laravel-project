<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::orderBy('key', 'ASC')->get();
        return view('backend.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.languages.create');
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
                'name' => 'string|required',
                'native' => 'required',
                'code' => 'required|unique:languages|regex:/^[a-z]{2,2}$/s',
                'direction' => 'required|in:RTL,LTR',
            ]
        );

        //  collect data
        $data = $request->all();
        // save data
        $status = Language::create($data);
        if ($status) {
            return redirect()->route('language.index')->with('success', 'Successfully Crated Language');
        } else {
            return  back()->with('error', 'Some thing went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::find($id);
        if ($language) {
            return view('backend.languages.edit', compact('language'));
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $language = Language::find($id);
        if ($language) {
            $this->validate(
                $request,
                [
                    'name' => 'string|required',
                    'native' => 'required',
                    'code' => 'required|unique:languages|regex:/^[a-z]{2,2}$/s',
                    'direction' => 'required|in:RTL,LTR',
                ]
            );
            //  collect data
            $data = $request->all();
            // save data
            $status = $language->fill($data)->save();
            if ($status) {
                return redirect()->route('language.index')->with('success', 'Successfully Updated Language');
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
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::find($id);
        if ($language) {
            $status = $language->delete();
            if ($status) {
                return redirect()->route('language.index')->with('success', 'Successfully Deleted Language');
            }
        } 
        return back()->with('error', 'Data Not Found');
    }
}
