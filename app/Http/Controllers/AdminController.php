<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Order;
use App\Models\User;
use App\Models\Page;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
  
    public function admin(){
        // count 
        // $blogs = Blog::count();
        $products = Product::count();
        $productItems = Product::withTranslation()->translatedIn(app()->getLocale())->limit(5)->get();
        $categories = Category::count();
        $banners = Banner::count();
        $users = User::count();
        $pages = Page::count();
        $newOrder = Order::where(['status'=>'new'])->count();
        $pendingOrder = Order::where(['status'=>'pending'])->count();
        $canceledOrder = Order::where(['status'=>'canceled'])->count();
        $completedOrder = Order::where(['status'=>'completed'])->count();
        $orders = Order::orderBy('id','DESC')->limit(5)->get();
        return view('backend.index',compact('productItems','products','categories','banners','users','pages','orders','newOrder','pendingOrder','canceledOrder','completedOrder'));
    }
}
