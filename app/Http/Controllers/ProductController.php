<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'DESC');
        if($request->search){
            $searchQuery=$request->search;
            $products = $products->whereTranslationLike('title', "%$searchQuery%")
            ->orwhereHas('category', function ($query) use ($searchQuery){
                $query->whereTranslationLike('title', "%$searchQuery%");
           });
                }
        $products=$products->paginate(10);
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.products.create');
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
                'photo' => 'required',
                'en.title' => 'string|required',
                'ar.title' => 'string|required',
                'tr.title' => 'string|required',
                // 'stock' => 'nullable|numeric',
                // 'price' => 'nullable|numeric',
                // 'discount' => 'nullable|numeric',
                // 'conditions' => 'required|in:new,popular,featured,global',
                'child_cat_id' => 'nullable|exists:categories,id',
                'cat_id' => 'required|exists:categories,id',
                // 'size' => 'nullable',
                'status' => 'nullable|in:active,inactive'
            ]
        );

        //  collect data
        $data = $request->all();
        $data['is_hot'] = isset($data['is_hot']) ? 1 : 0;
        // create slug
        $slug = Str::slug($request->input('en.title'));
        // check if the banner slug s existed and in case existed add different slug
        $slugCount = Product::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $data['offer_price'] = ($request->price - ($request->price * $request->discount) / 100);
        // save data
        $status = Product::create($data);
        if ($status) {
 
            return redirect()->route('product.index')->with('success', 'Successfully Crated Product');
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
    public function show(Request $request)
    {
  
        $product = Product::find($request->productID);
        // die();
        if ($product) {
//             $category = Category::withTranslation()->translatedIn(app()->getLocale())
//             ->with(['category']);
// print_r($category);
// die();  

            // $parentId = App\Models\Category::withTranslation()->translatedIn(app()->getLocale())->where('id', $item->parent_id)->get()->first()
            // $product->child_cat_id = Category::where('id', $product->child_cat_id)->value('title');
            return response()->json(['msg' => '', 'status' => true, 'data' => $product]);
        } else {
            return response()->json(['msg' => '', 'status' => false, 'data' => null]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $translations = $product->getTranslationsArray();
        if ($product) {
            return view('backend.products.edit', compact('product', 'translations'));
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
        $product = Product::find($id);
        if ($product) {
            $this->validate(
                $request,
                [
                    'photo' => 'required',
                    'en.title' => 'string|required',
                    'ar.title' => 'string|required',
                    'tr.title' => 'string|required',
                    // 'stock' => 'nullable|numeric',
                    // 'price' => 'nullable|numeric',
                    // 'discount' => 'nullable|numeric',
                    // 'conditions' => 'required|in:new,popular,featured,global',
                    'child_cat_id' => 'nullable|exists:categories,id',
                    'cat_id' => 'required|exists:categories,id',
                    // 'size' => 'nullable',
                    'status' => 'nullable|in:active,inactive'
                ]
            );

            //  collect data
            $data = $request->all();
            $data['is_hot'] = isset($data['is_hot']) ? 1 : 0;
            // create slug
            $slug = Str::slug($request->input('en.title'));
            // check if the banner slug s existed and in case existed add different slug
            $checkedSlug = Product::where('slug', $slug)->get()->first();
            if (($checkedSlug) and ($checkedSlug->id != $id)) {
                $slug = time() . '-' . $slug;
            }
            $data['slug'] = $slug;
            $data['offer_price'] = ($request->price - ($request->price * $request->discount) / 100);

            // save data
            $status = $product->fill($data)->save();
            if ($status) {
                return redirect()->route('product.index')->with('success', 'Successfully Updated Product');
            } else {
                return  back()->with('error', 'Some thing went wrong');
            }
        } else {
            return  back()->with('error', 'Some thing went wrong');
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
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Successfully Deleted Product');
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
