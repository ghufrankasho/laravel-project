<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lastblogs = Blog::withTranslation()->translatedIn(app()->getLocale());
        if($request->search){
            $searchQuery=$request->search;
            $lastblogs = $lastblogs->whereTranslationLike('title', "%$searchQuery%")
            ->orwhereTranslationLike('description', "%$searchQuery%");
        }
        $lastblogs=$lastblogs->paginate(8);
        return view('backend.blogs.index', compact('lastblogs'));
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blogs.create');
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
                'tr.summary' => 'string|nullable',
                'photo' => 'required',
                'status' => 'required|in:active,inactive',

            ]
        );
        //  collect data
        $data = $request->all();
        // create slug
        $slug = Str::slug($request->input('en.title'));
        // check if the blog slug s existed and in case existed add different slug
        $slugCount = Blog::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;

        // save data
        $status = Blog::create($data);
        if ($status) {
            return redirect()->route('blog.index')->with('success', 'Successfully Crated Blog');
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
        $blog = Blog::find($id);
        $translations = $blog->getTranslationsArray();
        if ($blog) {
            return view('backend.blogs.edit', compact('blog', 'translations'));
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
        $blog = Blog::find($id);
        if ($blog) {
            $this->validate(
                $request,
                [
                    'en.title' => 'string|required',
                    'ar.title' => 'string|required',
                    'tr.title' => 'string|required',
                    'en.description' => 'string|nullable',
                    'ar.description' => 'string|nullable',
                    'tr.summary' => 'string|nullable',
                    'photo' => 'required',
                    'status' => 'required|in:active,inactive',

                ]
            );

            //  collect data
            $data = $request->all();
            // create slug
            $slug = Str::slug($request->input('en.title'));
            // check if the blog slug s existed and in case existed add different slug
            $checkedSlug = Blog::where('slug', $slug)->get()->first();
            if (($checkedSlug) and ($checkedSlug->id != $id)) {
                $slug = time() . '-' . $slug;
            }

            $data['slug'] = $slug;

            // save data
            $status = $blog->fill($data)->save();
            if ($status) {
                return redirect()->route('blog.index')->with('success', 'Successfully Updated Blog');
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
        $blog = Blog::find($id);
        if ($blog) {
            $blog->delete();
            return redirect()->route('blog.index')->with('success', 'Successfully Deleted Blog');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }


    /**
     * blogStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function blogStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('blogs')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('blogs')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}