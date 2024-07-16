<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $backendBrands = Brand::orderBy('id', 'DESC');
        if($request->search){
            $searchQuery=$request->search;
            $backendBrands = $backendBrands->whereTranslationLike('title', "%$searchQuery%")
            ->orwhereTranslationLike('description', "%$searchQuery%");
        }
        $backendBrands=$backendBrands->paginate(8);
        return view('backend.brands.index', compact('backendBrands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brands.create');
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
                'en.title' => 'string|required',
                'ar.title' => 'string|required',
                'tr.title' => 'string|required',
                'en.description' => 'string|nullable',
                'ar.description' => 'string|nullable',
                'tr.description' => 'string|nullable',
                'path' => 'string|required',
                'status' => 'nullable|in:active,inactive',
                'models' => 'nullable|in:album,partner',
                'type' => 'nullable|in:file,photo',
            ]
        );
        //  collect data
        $data = $request->all();

        $status = Brand::create($data);
        if ($status) {
            return redirect()->route('brand.index')->with('success', 'Successfully Updated Brands');
        } else {
            return  back()->with('error', 'Some thing went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::where('id', $id)->get()->first();
        $translations = $brand->getTranslationsArray();

        if ($brand) {
            return view('backend.brands.edit', compact('brand','translations'));
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand =  Brand::where('id', $id)->get()->first();
        
        if ($brand) {
            $this->validate(
                $request,
                [
                    'en.title' => 'string|required',
                    'ar.title' => 'string|required',
                    'tr.title' => 'string|required',
                    'en.description' => 'string|nullable',
                    'ar.description' => 'string|nullable',
                    'tr.description' => 'string|nullable',
                    'path' => 'string|required',
                    'status' => 'nullable|in:active,inactive',
                    'models' => 'nullable|in:album,partner',
                    'type' => 'nullable|in:file,photo',
                ]
            );
            //  collect data
            $data = $request->all();
            // save data
            $status = $brand->fill($data)->save();
            if ($status) {
                return redirect()->route('brand.index')->with('success', 'Successfully Updated Brands');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $brand->delete();
            return redirect()->route('brand.index')->with('success', 'Successfully Updated Brands');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }



    /**
     * BrandStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function BrandStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('brands')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('brands')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}
