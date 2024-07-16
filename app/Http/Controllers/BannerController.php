<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = Banner::orderBy('id', 'DESC');
        if($request->search){
            $searchQuery=$request->search;
            $banners = $banners->whereTranslationLike('title', "%$searchQuery%")
            ->orwhereTranslationLike('description', "%$searchQuery%");
        }
        $banners=$banners->paginate(8);
        return view('backend.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
  
        public function create()
        {
            $banners = Banner::orderBy('id', 'DESC')->get();
            $parentCategory = Category::withTranslation()
                ->translatedIn(app()->getLocale())
                ->where('is_parent', 0)
                ->get();
            return view('backend.banners.create', compact('parentCategory','banners'));
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
                'en.summary' => 'string|nullable',
                'ar.summary' => 'string|nullable',
                'tr.summary' => 'string|nullable',
                'photo' => 'required',
               
                'status' => 'required|in:active,inactive',
                'type' => 'required|in:offer,category',


            ]
        );
        //  collect data
        $data = $request->all();
        // create slug
        $slug = Str::slug($request->input('en.title'));
        // check if the banner slug s existed and in case existed add different slug
        $slugCount = Banner::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;

        // save data
        $status = Banner::create($data);
        if ($status) {
            return redirect()->route('banner.index')->with('success', 'Successfully Crated Banner');
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
        $banner = Banner::find($id);
        $parentCategory = Category::withTranslation()
        ->translatedIn(app()->getLocale())
        ->where('is_parent', 0)
        ->get();
        $translations = $banner->getTranslationsArray();
        if ($banner) {
            return view('backend.banners.edit', compact('banner', 'translations','parentCategory'));
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
        $banner = Banner::find($id);
        if ($banner) {
            $this->validate(
                $request,
                [
                    'en.title' => 'string|required',
                    'ar.title' => 'string|required',
                    'tr.title' => 'string|required',
                    'en.summary' => 'string|nullable',
                    'ar.summary' => 'string|nullable',
                    'tr.summary' => 'string|nullable',
                    'photo' => 'required',
                   
                    'status' => 'required|in:active,inactive',
                    'type' => 'required|in:offer,category',

                ]
            );

            //  collect data
            $data = $request->all();
            // create slug
            $slug = Str::slug($request->input('en.title'));
            // check if the banner slug s existed and in case existed add different slug
            $checkedSlug = Banner::where('slug', $slug)->get()->first();
            if (($checkedSlug) and ($checkedSlug->id != $id)) {
                $slug = time() . '-' . $slug;
            }

            $data['slug'] = $slug;

            // save data
            $status = $banner->fill($data)->save();
            if ($status) {
                return redirect()->route('banner.index')->with('success', 'Successfully Updated Banner');
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
        $banner = Banner::find($id);
        if ($banner) {
            $banner->delete();
            return redirect()->route('banner.index')->with('success', 'Successfully Deleted Banner');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }


    /**
     * bannerStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bannerStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('banners')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('banners')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}
