<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoryServices = Service::withTranslation()->translatedIn(app()->getLocale());
        if($request->search){
            $searchQuery=$request->search;
            $categoryServices = $categoryServices->whereTranslationLike('title', "%$searchQuery%")
            ->orwhereHas('parent', function ($query) use ($searchQuery){
                $query->whereTranslationLike('title', "%$searchQuery%");
           });
                }
        $categoryServices=$categoryServices->paginate(10);
        return view('backend.services.index', compact('categoryServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentService = Service::withTranslation()
        ->translatedIn(app()->getLocale())
        ->where('is_parent', 1)
        ->get();
        return view('backend.services.create', compact('parentService'));
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
                'photo' =>  'string|nullable',
                'status' => 'required|in:active,inactive',
                'parent_id' => 'nullable|exists:services,id',
                'is_parent' => 'sometimes|in:1',
            ]
        );
        //  collect data\
        $data = $request->all();
        // create slug
        $slug = Str::slug($request->input('en.title'));
        // check if the banner slug s existed and in case existed add different slug
        $slugCount = Service::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $data['is_parent'] = $request->input('parent_id')  ?  0 : 1;
        // save data
        $status = Service::create($data);
        if ($status) {
            return redirect()
            ->route('service.index')
            ->with('success', 'Successfully Crated Service');
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
        $service = Service::find($id);
        $translations = $service->getTranslationsArray();
        $parentService = Service::where('is_parent', 1)->get();
        if ($service) {
            return view('backend.services.edit', compact('translations','service', 'parentService'));
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
        $service = Service::find($id);
        if ($service) {
            $this->validate(
                $request,
                [
                    'en.title' => 'string|required',
                    'ar.title' => 'string|required',
                     'tr.title' => 'string|required',
                    'en.summary' => 'string|nullable',
                    'ar.summary' => 'string|nullable',
                    'tr.summary' => 'string|nullable',
                    'photo' => 'string|nullable',
                    'status' => 'required|in:active,inactive',
                    'parent_id' => 'nullable|exists:services,id',
                    'is_parent' => 'sometimes|in:1',
                ]
            );
            //  collect data
            $data = $request->all();

            // create slug
            $slug = Str::slug($request->input('en.title'));
            // check if the banner slug s existed and in case existed add different slug
            $checkedSlug = Service::where('slug', $slug)->get()->first();
            if (($checkedSlug) and ($checkedSlug->id != $id)) {
                $slug = time() . '-' . $slug;
            }
            $data['slug'] = $slug;

            // / check the parent id 
        
            $data['is_parent'] = $request->input('parent_id')  ?  0 : 1;
            if ($request->is_parent == 1) {
                $data['parent_id'] = null;
            } else {
                $data['parent_id'] = $request->input('parent_id');
            }

            // save data
            $status = $service->fill($data)->save();
            if ($status) {
                return redirect()->route('service.index')->with('success', 'Successfully Updated Service');
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
        $service = Service::find($id);
        $childServiceId =  Service::where('parent_id', $id)->pluck('id');
        if ($service) {
            $status = $service->delete();
            if ($status) {
                Service::shiftChild($childServiceId);
            }
            return redirect()->route('service.index')->with('success', 'Successfully Deleted Service');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * ServiceStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('services')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('services')->where('id', $request->id)->update(['status' => 'inactive']);
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
        $service = Service::find($request->catID);
        if ($service) {
            // $childId = Service::getChildByParentId($request->catID);
            $translations = Service::withTranslation('title')->translatedIn(app()->getLocale())
            ->where('parent_id',$request->catID)
            ->get();
            if ($translations) {
                return response()->json(['msg' => '', 'status' => true, 'data' => $translations]);
            } else {
                return response()->json(['msg' => '', 'status' => false, 'data' => null]);
            }
        } else {
            return response()->json(['msg' => 'Service not found', 'status' => false, 'data' => null]);
        }
    }
}
