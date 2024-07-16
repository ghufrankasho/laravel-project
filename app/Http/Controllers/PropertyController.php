<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::where(
            ['product_id' => $request->productId]
        )
            ->with(['products'])
            ->orderBy('id', 'DESC')
            ->get();
        return view('backend.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $products = \App\Models\Product::where('id', $request->productId)
            ->orderBy('id', 'DESC')
            ->get()
            ->first();
        return view('backend.properties.create', compact('products'));
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
                'value' => 'nullable',
                'en.name' => 'string|required',
                'ar.name' => 'string|required',
                'product_id' => 'nullable',

            ]
        );

        //  collect data
        $data = $request->all();
        // save data
        $status = Property::create($data);
        if (!$status) {
            return  back()->with('error', 'Some thing went wrong');
        }
        return redirect()->route(
            'properties.index',
            ['productId' => $request->product_id]
        )
            ->with('success', 'Successfully Crated Property');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::where('id', $id)
            ->with(['products'])
            ->get()
            ->first();
        $translations = $property->getTranslationsArray();
        if (!$property) {
            return back()->with('error', 'Data Not Found');
        }

        return view('backend.properties.edit', compact('translations', 'property'));
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
        $property = Property::find($id);
        if (!$property) {
            return back()->with('error', 'Data Not Found');
        }
        $this->validate(
            $request,
            [
                'en.name' => 'string|required',
                'ar.name' => 'string|required',
                'value' => 'nullable',

            ]
        );
        //  collect data
        $data = $request->all();
        // save data
        $status = $property->fill($data)->save();
        if (!$status) {
            return  back()->with('error', 'Some thing went wrong');
        }
        return redirect()->route(
            'properties.index',
            ['productId' => $property->products->id]
        )->with('success', 'Successfully Updated Property');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::find($id);
        if ($property) {
            $property->delete();
            return redirect()->route('properties.index', ['productId' => $property->product_id])
                ->with('success', 'Successfully Deleted Properties');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    public function productStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('products')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('products')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}