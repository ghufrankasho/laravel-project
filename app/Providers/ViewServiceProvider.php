<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Service;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            // $blogs = Blog::where(['status' => 'active'])->get();
            //$categories = Category::where(['status' => 'active', 'is_parent' => 1])->get();
            $settings = Setting::pluck('value_actual', 'key');
            $services = Service::where(['status' => 'active', 'is_parent' => 0])->get();
            // $categories = Category::where(['status' => 'active', 'is_parent' => 0])->get();
             $aboutUs = Page::where(['status' => 'active', 'slug' => 'about-us'])->withTranslation()->translatedIn(app()->getLocale())->orderBy('id', 'ASC')->get()->first();
            // $scentsHome = Product::where(['status' => 'active', 'cat_id' => 2])->withTranslation()->translatedIn(app()->getLocale())->orderBy('id', 'ASC')->get();
            // $featuredProducts = Product::where(['status' => 'active', 'conditions' => 'featured'])->get();
            // $newProducts = Product::where(['status' => 'active', 'conditions' => 'new'])->get();
            // $popularProducts = Product::where(['status' => 'active', 'conditions' => 'popular'])->get();
            // $brands = Brand::where(['status' => 'active'])->get();
            // $view->with('categories', $categories)->
            $view->with('settings', $settings)->with('services', $services)
                  ->with('aboutUs',$aboutUs)
                // ->with('scentsHome',$scentsHome)
                // ->with('featuredProducts',$featuredProducts)
                // ->with('newProducts',$newProducts)
                // ->with('popularProducts',$popularProducts)
                // ->with('brands',$brands)
                // ->with('blogs',$blogs)

            ;
        });
    }
}
