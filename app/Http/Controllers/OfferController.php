<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderBy('id', 'DESC')->get();
        return view('backend.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.offers.create');
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
                'en.name' => 'string|required',
                'ar.name' => 'string|required',
                'tr.name' => 'string|required',
                'en.title' => 'string|required',
                'ar.title' => 'string|required',
                'tr.title' => 'string|required',
                'en.summary' => 'string|nullable',
                'ar.summary' => 'string|nullable',
                'tr.summary' => 'string|nullable',
                'photo' => 'required',
                'status' => 'required|in:active,inactive',
                'price' => 'required',
                'serial_number' => 'required',
                'product_number' => 'required',

            ]
        );
        //  collect data
        $data = $request->all();
        // create slug
        $slug = Str::slug($request->input('en.title'));
        // check if the offer slug s existed and in case existed add different slug
        $slugCount = Offer::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;

        // save data
        $status = Offer::create($data);
        if ($status) {
            return redirect()->route('offer.index')->with('success', 'Successfully Crated Offer');
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
        $offer = Offer::find($id);
        $translations = $offer->getTranslationsArray();
        if ($offer) {
            return view('backend.offers.edit', compact('offer', 'translations'));
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
        $offer = Offer::find($id);
        if ($offer) {
            $this->validate(
                $request,
                [
                    
                    'en.name' => 'string|required',
                    'ar.name' => 'string|required',
                    'tr.name' => 'string|required',
                    'en.title' => 'string|required',
                    'ar.title' => 'string|required',
                    'tr.title' => 'string|required',
                    'en.description' => 'string|nullable',
                    'ar.description' => 'string|nullable',
                    'tr.description' => 'string|nullable',
                    'photo' => 'required',
                    'status' => 'required|in:active,inactive',
                    'price' => 'required',
                    'serial_number' => 'required',
                    'product_number' => 'required',
                    

                ]
            );

            //  collect data
            $data = $request->all();
            // create slug
            $slug = Str::slug($request->input('en.title'));
            // check if the offer slug s existed and in case existed add different slug
            $checkedSlug = Offer::where('slug', $slug)->get()->first();
            if (($checkedSlug) and ($checkedSlug->id != $id)) {
                $slug = time() . '-' . $slug;
            }

            $data['slug'] = $slug;

            // save data
            $status = $offer->fill($data)->save();
            if ($status) {
                return redirect()->route('offer.index')->with('success', 'Successfully Updated Offer');
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
        $offer = Offer::find($id);
        if ($offer) {
            $offer->delete();
            return redirect()->route('offer.index')->with('success', 'Successfully Deleted Offer');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }


    /**
     * offerStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function offerStatus(Request $request)
    {
        if ($request->mode) {
            DB::table('offers')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('offers')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}
