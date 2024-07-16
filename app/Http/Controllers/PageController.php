<?php

namespace App\Http\Controllers;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pages = Page::withTranslation()->translatedIn(app()->getLocale())->orderBy('id', 'ASC');
        if($request->search){
            $searchQuery=$request->search;
            $pages = $pages->whereTranslationLike('name', "%$searchQuery%")
            ->orwhereTranslationLike('description', "%$searchQuery%");
        }
                $pages=$pages->paginate(8);

        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create');
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
                'tr.name' => 'string|required'
            ]
        );

        //  collect data
        $data = $request->all();
        // create slug
        $slug = Str::slug($request->input('en.name'));
        // check if the banner slug s existed and in case existed add different slug
        $slugCount = Page::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $data['is_master'] = $request->input('is_master')  ?  1 : 0;
        $data['in_main_menu'] = $request->input('in_main_menu')  ?  1 : 0;
        $data['in_side_menu'] = $request->input('in_side_menu')  ?  1 : 0;
        $data['in_bottom_menu'] = $request->input('in_bottom_menu')  ?  1 : 0;
        // save data
        $status = Page::create($data);
        if ($status) {
            return redirect()->route('page.index')->with('success', 'Successfully Crated Page');
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
        $page = Page::find($id);
        $translations = $page->getTranslationsArray();
        if ($page) {
            return view('backend.pages.edit', compact('translations','page'));
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
        $page = Page::find($id);
        if ($page) {
            $this->validate(
                $request,
                [
                    'en.name' => 'string|required',
                    'ar.name' => 'string|required',
                    'tr.name' => 'string|required'
                   
                ]
            );
            //  collect data
            $data = $request->all();

            // create slug
            $slug = Str::slug($request->input('en.name'));
            // check if the banner slug s existed and in case existed add different slug
            $checkedSlug = Page::where('slug', $slug)->get()->first();
            if (($checkedSlug) and ($checkedSlug->id != $id)) {
                $slug = time() . '-' . $slug;
            }
            

            $data['slug'] = $slug;
            // / check the master and main page:
            $data['is_master'] = $request->input('is_master')  ?  1 : 0;
            $data['in_main_menu'] = $request->input('in_main_menu')  ?  1 : 0;
            $data['in_side_menu'] = $request->input('in_side_menu')  ?  1 : 0;
            $data['in_bottom_menu'] = $request->input('in_bottom_menu')  ?  1 : 0;
            // save data
            $status = $page->fill($data)->save();
            if ($status) {
                return redirect()->route('page.index')->with('success', 'Successfully Updated Page');
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
        $page = Page::find($id);
        if ($page) {
            $status = $page->delete();
            if ($status) {
                return redirect()->route('page.index')->with('success', 'Successfully Deleted Page');
            } 
        } 
        return back()->with('error', 'Data Not Found');
    }

    /**
     * pageStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pageStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('pages')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('pages')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}
