<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoriesBackEnd = Category::withTranslation()->translatedIn(app()->getLocale());
        if($request->search){
            $searchQuery=$request->search;
            $categoriesBackEnd = $categoriesBackEnd->whereTranslationLike('title', "%$searchQuery%")
            ->orwhereTranslationLike('summary', "%$searchQuery%");
        }
        $categoriesBackEnd=$categoriesBackEnd->paginate(8);
        return view('backend.categories.index', compact('categoriesBackEnd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategory = Category::withTranslation()
            ->translatedIn(app()->getLocale())
            ->where('is_parent', 1)
            ->get();
        return view('backend.categories.create', compact('parentCategory'));
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
                'ordr' => 'required',
                'photo' => 'string|nullable',
                'status' => 'required|in:active,inactive',
                'parent_id' => 'nullable|exists:categories,id',
                'is_parent' => 'sometimes|in:1',
            ]
        );
        //  collect data\
        $data = $request->all();
        $data['is_main'] = isset($data['is_main']) ? 1 : 0;
        // create slug
        $slug = Str::slug($request->input('en.title'));
        // check if the banner slug s existed and in case existed add different slug
        $slugCount = Category::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        // / check the parent id 
        if ($request->is_parent == 1) {
            $data['is_parent'] = 1;
            $data['parent_id'] = null;
        } else {
            $data['is_parent'] = 0;
            $data['parent_id'] = $request->input('parent_id');
        }
        // save data
        $status = Category::create($data);
        if ($status) {
            return redirect()->route('category.index')->with('success', 'Successfully Crated Category');
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
        $category = Category::find($id);
        $translations = $category->getTranslationsArray();
        $parentCategory = Category::withTranslation()
            ->translatedIn(app()->getLocale())
            ->where('is_parent', 1)
            ->get();
        if ($category) {
            return view('backend.categories.edit', compact('translations', 'category', 'parentCategory'));
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
        $category = Category::find($id);
        if ($category) {
            $this->validate(
                $request,
                [
                    'en.title' => 'string|required',
                    'ar.title' => 'string|required',
                    'tr.title' => 'string|required',
                    'en.summary' => 'string|nullable',
                    'ar.summary' => 'string|nullable',
                    'tr.summary' => 'string|nullable',
                    'ordr' => 'required',
                    'photo' => 'string|nullable',
                    'status' => 'required|in:active,inactive',
                    'parent_id' => 'nullable|exists:categories,id',
                    'is_parent' => 'sometimes|in:1',
                ]
            );
            //  collect data
            $data = $request->all();
            $data['is_main'] = isset($data['is_main']) ? 1 : 0;
            // create slug
            $slug = Str::slug($request->input('en.title'));
            // check if the banner slug s existed and in case existed add different slug
            $checkedSlug = Category::where('slug', $slug)->get()->first();
            if (($checkedSlug) and ($checkedSlug->id != $id)) {
                $slug = time() . '-' . $slug;
            }
            $data['slug'] = $slug;

            // / check the parent id 
             // / check the parent id 
             if ($request->is_parent == 1) {
                $data['is_parent'] = 1;
                $data['parent_id'] = null;
            } else {
                $data['is_parent'] = 0;
                $data['parent_id'] = $request->input('parent_id');
            }

            // save data
            $status = $category->fill($data)->save();
            if ($status) {
                return redirect()->route('category.index')->with('success', 'Successfully Updated Category');
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
        $category = Category::find($id);
        $childCategoryId =  Category::where('parent_id', $id)->pluck('id');
        if ($category) {
            $status = $category->delete();
            if ($status) {
                Category::shiftChild($childCategoryId);
            }
            return redirect()->route('category.index')->with('success', 'Successfully Deleted Category');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * CategoryStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CategoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }

    /**
     * getChildByParentId // 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getChildByParentId(Request $request)
    {
        $category = Category::find($request->catID);
        if ($category) {
            // $childId = Category::getChildByParentId($request->catID);
            $translations = Category::withTranslation('title')->translatedIn(app()->getLocale())
                ->where('parent_id', $request->catID)
                ->get();
            if ($translations) {
                return response()->json(['msg' => '', 'status' => true, 'data' => $translations]);
            } else {
                return response()->json(['msg' => '', 'status' => false, 'data' => null]);
            }
        } else {
            return response()->json(['msg' => 'Category not found', 'status' => false, 'data' => null]);
        }
    }
}
