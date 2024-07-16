<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\Brand;
use App\Mail\contactMail;
use App\Models\Offer;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url as TagUrl;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Service;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{

    public function __construct()
    {
        $this->settings =  Setting::pluck('value_actual', 'key');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $categories = Category::where(['status' => 'active', 'is_parent' => 0 ])->with('products','banners')->orderBy('id', 'ASC')->get();

        $banners = Banner::where(['status' => 'active'])->get();
        $mainCategories = Category::where(['status' => 'active', 'is_parent' => 0 ])->with('products')->orderBy('ordr', 'ASC')->get();
        // $unMainCategories = Category::where(['status' => 'active', 'is_parent' => 0 , 'is_main' => 0])->with('products')->orderBy('ordr', 'ASC')->get();

        $featuredProducts = Product::where(['status' => 'active', 'conditions' => 'featured'])->with(['properties'])->get();
        $products = Product::where(['status' => 'active' , 'cat_id'=> 17])->paginate(12);
        $popularProducts = Product::where(['status' => 'active', 'conditions' => 'popular'])->with(['properties'])->get();

        $galleries = Brand::where(['status' => 'active', 'models' => 'album'])->get();
        // get all offers
        $offers = Offer::where(['status' => 'active'])->get();
        
        // $products= Product::where('categories.is_main', '=', true)
        // ->join('categories', 'categories.id', '=', 'products.cat_id')
        // ->get();
        // return dd($products);
        // 
        // Generate SEO 
        SEOMeta::setTitle(str_replace("It's Over 9000!", '', unserialize($this->settings[app()->getLocale() . '_site_name'])));
        SEOMeta::setDescription($this->settings[app()->getLocale() . '_site_description']);
        SEOMeta::setCanonical(URL('/' . app()->getLocale()));

        OpenGraph::setDescription($this->settings[app()->getLocale() . '_site_description']);
        SEOMeta::setTitle(str_replace("It's Over 9000!", '', unserialize($this->settings[app()->getLocale() . '_site_name'])));
        OpenGraph::setUrl(URL('/' . app()->getLocale()));
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        SEOMeta::setTitle(str_replace("It's Over 9000!", '', unserialize($this->settings[app()->getLocale() . '_site_name'])));

        SEOMeta::setTitle(str_replace("It's Over 9000!", '', unserialize($this->settings[app()->getLocale() . '_site_name'])));
        SEOMeta::setTitle(str_replace("It's Over 9000!", '', unserialize($this->settings[app()->getLocale() . '_site_name'])));

        SEOMeta::setTitle(str_replace("It's Over 9000!", '', unserialize($this->settings[app()->getLocale() . '_site_name'])));
        JsonLd::setDescription($this->settings[app()->getLocale() . '_site_description']);
        JsonLd::addImage(asset('frontend/images/logo.png'));

        return view('frontend.home.index', compact('banners','products', 'categories','mainCategories','featuredProducts',  'popularProducts', 'galleries', 'offers'));
    }

    public function search(Request $request)
    {

        $query = $request->input('q');

        $products = Product::where(['status' => 'active'])->withTranslation()
            ->translatedIn(app()->getLocale())
            ->whereTranslationLike('title',  '%' . $query . '%')
            ->whereTranslationLike('description',  '%' . $query . '%')

            ->orderBy('id', 'DESC')
            ->paginate(12);

        return view('frontend.product.shop', compact('products'));
    }

    public function shop(Request $request)
    {
        $q = '';
        // Need To Develop , remove condition
        $product  = Product::query();

        if (!empty($_GET['sortBy'])) {
            $sort = $_GET['sortBy'];
            switch ($sort) {
                case "priceAsc":
                    $column = "price";
                    $sortDirection = "ASC";
                    break;
                case "priceDesc":
                    $column = "price";
                    $sortDirection = "DESC";
                    break;
                default:
                    $column = "id";
                    $sortDirection = "DESC";
            }
        } else {
            $column = "id";
            $sortDirection = "ASC";
        }


        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $catIds  = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $product->whereIn('cat_id', $catIds)->orderBy($column, $sortDirection)->paginate(12);
        } else {
            //$products = Product::where(['status' => 'active'])->orderBy($column, $sortDirection)->paginate(8);
            $products = Product::where(['status' => 'active'])->orderBy($column, $sortDirection)->paginate(12);
        }
        $categories = Category::where(['status' => 'active', 'is_parent' => 0])->with('products')->orderBy('ordr', 'ASC')->get();
        // $unMaincategories = Category::where(['status' => 'active', 'is_parent' => 0 , 'is_main' => 0])->with('products')->orderBy('id', 'DESC')->get();

        // Generate SEO
        SEOMeta::setTitle(__('messages.SHOP'));
        SEOMeta::setDescription(__('messages.SHOP'));
        SEOMeta::setCanonical(URL('/'));

        OpenGraph::setDescription(__('messages.SHOP'));
        OpenGraph::setTitle(__('messages.SHOP'));
        OpenGraph::setUrl(URL('/'));
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(__('messages.SHOP'));
        TwitterCard::setSite(__('messages.SHOP'));

        JsonLd::setTitle((__('messages.SHOP')));
        JsonLd::setDescription(__('messages.SHOP'));
        JsonLd::addImage(asset('frontend/images/logo.png'));

        return view('frontend.product.shop', compact('products', 'categories'));
    }

    public function shopFilter(Request $request)
    {
        $data = $request->all();
        $catUrl  = '';
        $sortByUrl = '';
        $search = '';

        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy=' . $data['sortBy'];
        }

        if (!empty($data['q'])) {
            $search .= '&q=' . $data['q'];
        }

        return redirect()->route('shop', ['locale' => app()->getLocale(), $search . $catUrl . $sortByUrl]);
    }
    /**
     * Display a Category
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request, $slug)
    {
        // dd($request->slug);
        $subCategories = [];
        // get category 
        $category =  Category::where(['status' => 'active', 'slug' => $request->slug])->first();
        // get subCategories in case request == shop
        if ($request->slug == 'shop') {
            $subCategories = Category::where(['status' => 'active', 'is_parent' => 0])->orderBy('id', 'ASC')->get();
           
        }

        // generate tittle 
        // Generate SEO 
        if ($request->slug == 'shop') {
            SEOMeta::setTitle(__('messages.SHOP').' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
            SEOMeta::setDescription(__('messages.SHOP'));
            SEOMeta::setCanonical(\URL::current());

            OpenGraph::setTitle(__('messages.SHOP') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
            OpenGraph::setDescription(__('messages.SHOP'));
            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('type', 'website');
            OpenGraph::addProperty('locale', app()->getLocale());
            OpenGraph::addProperty('content', app()->getLocale());
            OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));


            TwitterCard::setTitle(__('messages.SHOP') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
            TwitterCard::setSite(__('messages.SHOP') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

            JsonLd::setTitle(__('messages.SHOP') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
            JsonLd::setDescription(__('messages.SHOP'));
            JsonLd::addImage(asset('frontend/images/logo.png'));
        } else {
            SEOMeta::setTitle($category->title.' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
            SEOMeta::setDescription($category->title);
            SEOMeta::setCanonical(\URL::current());

            OpenGraph::setTitle($category->title.' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
            OpenGraph::setDescription($category->title);
            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('type', 'website');
            OpenGraph::addProperty('locale', app()->getLocale());
            OpenGraph::addProperty('content', app()->getLocale());
            OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));


            TwitterCard::setTitle($category->title.' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
            TwitterCard::setSite($category->title.' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

            JsonLd::setTitle($category->title.' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
            JsonLd::setDescription($category->title);
            JsonLd::addImage(asset('frontend/images/logo.png'));
        }


        // get products for current category
        if($category->id){
           $products = Product::where(['status' => 'active', 'cat_id' => $category->id])->get();
        }
        $mainCategories = Category::where(['status' => 'active', 'is_parent' => 0 ])->with('products')->orderBy('ordr', 'ASC')->get();
        // $unMainCategories = Category::where(['status' => 'active', 'is_parent' => 0 , 'is_main' => 0])->with('products')->orderBy('id', 'DESC')->get();

        $banners = Banner::where(['status' => 'active'])->get();

        if ($category) {
            // $products = Product::where(['status' => 'active', 'cat_id' => $category->id])->orderBy($column, $sortDirection)->paginate(1);
            return view('frontend.home.category', compact('mainCategories','banners','subCategories', 'category', 'products'));
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Display a product
     *
     * @return \Illuminate\Http\Response
     */
    public function product(Request $request)
    {

        $banners = Banner::where(['status' => 'active'])->get();
        $product = Product::withTranslation()->translatedIn(app()->getLocale())->with(['relatedProducts', 'properties', 'category'])->where(['status' => 'active', 'slug' => $request->slug])->get()->first();

        if (!$product) {
            return back()->with('error', 'Data Not Found');
        }
        // Generate SEO 
        SEOMeta::setTitle($product->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription($product->description);
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setTitle($product->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setDescription($product->description);
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));


        TwitterCard::setTitle($product->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite($product->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle($product->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription($product->description);
        JsonLd::addImage(asset('frontend/images/logo.png'));

        return view('frontend.home.product', compact('product', 'banners'));
    }

    public function blogs(Request $request)
    {

        $blogs = Blog::withTranslation()->orderby('created_at','desc')->translatedIn(app()->getLocale())->where(['status' => 'active'])->paginate(9);
        if (!$blogs) {
            return back()->with('error', 'Data Not Found');
        }

        // Generate SEO 
        SEOMeta::setTitle(__('messages.BLOGS') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription(__('messages.BLOGS') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setDescription(__('messages.BLOGS') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setTitle(__('messages.BLOGS') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));

        TwitterCard::setTitle(__('messages.BLOGS') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite(__('messages.BLOGS') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle((__('messages.BLOGS')) . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription(__('messages.BLOGS') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::addImage(asset('frontend/images/logo.png'));
        JsonLd::addImage(asset('frontend/images/logo.png'));
        // print_r($blogs);
        // die();
        return view('frontend.home.blog', compact('blogs'));
    }


    public function blogDetail(Request $request)
    {
        //  get the  first blog depends on request 
        $blogDetail = Blog::withTranslation()->translatedIn(app()->getLocale())->where(['status' => 'active', 'slug' => $request->slug])->get()->first();
        if (!$blogDetail) {

            return back()->with('error', 'Data Not Found');
        }
        //Generate SEO 
        SEOMeta::setTitle($blogDetail->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription($blogDetail->description);
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setTitle($blogDetail->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setDescription($blogDetail->description);
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));


        TwitterCard::setTitle($blogDetail->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite($blogDetail->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle($blogDetail->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription($blogDetail->description);
        JsonLd::addImage(asset('frontend/images/logo.png'));
        // get all blogs 
        $blogs = Blog::withTranslation()->translatedIn(app()->getLocale())->where(['status' => 'active'])->get();
        // dd($blogs);
        // die();
        //  dd($blogDetail);   
        return view('frontend.home.blog-detail', compact('blogDetail', 'blogs'));
    }


    /**
     * Display a page
     *
     * @return \Illuminate\Http\Response
     */
    public function page(Request $request)
    {
        $page = Page::withTranslation()->translatedIn(app()->getLocale())->where(['status' => 'active', 'slug' => $request->slug])->get()->first();

        if (!$page) {
            return back()->with('error', 'Data Not Found');
        }
        // Generate SEO 
        SEOMeta::setTitle($page->name . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription($page->description);
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setDescription($page->name . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setTitle($page->description);
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));

        TwitterCard::setTitle($page->name . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite($page->name . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle($page->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription($page->description);
        JsonLd::addImage(asset('frontend/images/logo.png'));

        return view('frontend.home.page')->with('page', $page);
    }

    /**
     * Display a page contact us
     *
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'customerName' => 'required',
                'customerEmail' => 'required|email',
                'contactSubject' => 'required',
                'contactMessage' => 'required',
            ]);
            $to = 'info@alsahabapp.com';
            if (Mail::to($to)->send(new contactMail($request))) {
                return redirect()->back()->with('successSend', 'IT WORKS!');
                // return redirect()->route('/', ['locale' => app()->getLocale()])->with('successSend', 'IT WORKS!');
            }
        }
        // Generate SEO 
        SEOMeta::setTitle(__('messages.CONTACT US') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription(__('messages.CONTACT US') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setDescription(__('messages.CONTACT US') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setTitle(__('messages.CONTACT US') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));

        TwitterCard::setTitle(__('messages.CONTACT US') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite(__('messages.CONTACT US') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle((__('messages.CONTACT US')) . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription(__('messages.CONTACT US') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::addImage(asset('frontend/images/logo.png'));

        return view('frontend.home.contact');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProduct(Request $request)
    {
        $product = Product::find($request->productID);
        if (!$product) {
            return response()->json(['msg' => '', 'status' => false, 'data' => null]);
        }
        $product->cat_id = Category::withTranslation()->translatedIn(app()->getLocale())->where('id', $product->cat_id)->get()->first();
        return response()->json(['msg' => '', 'status' => true, 'data' => $product]);
    }


    public function siteMap()
    {
        \App::setLocale('ar');
    
        // Check if sitemap.xml file exists and delete it if it does
        $sitemapFilePath = public_path('sitemap-ar.xml');
        if (file_exists($sitemapFilePath)) {
            unlink($sitemapFilePath);
        }
    
        $sitemap = Sitemap::create()
            ->add(TagUrl::create('/' . app()->getLocale()))
            ->add(TagUrl::create('/' . app()->getLocale() . '/blogs'))
            ->add(TagUrl::create(app()->getLocale() . '/page/about-us'))
            ->add(TagUrl::create(app()->getLocale() . '/shop'))
            ->add(TagUrl::create(app()->getLocale() . '/contact'));
    
        // get All categories 
        $categories = Category::where(['status' => 'active'])->get();
        foreach ($categories as $category) {
            $sitemap->add(TagUrl::create(app()->getLocale() . "/shop?category={$category->slug}"));
        }
    
        // get all products
        $products = Product::where(['status' => 'active'])->get();
        foreach ($products as $product) {
            $sitemap->add(TagUrl::create(app()->getLocale() . "/product/{$product->slug}"));
        }
    
        $blogs = Blog::where(['status' => 'active'])->get();
        foreach ($blogs as $blog) {
            $sitemap->add(TagUrl::create(app()->getLocale() . "/blog-detail/{$blog->slug}"));
        }
    
        // Write to sitemap.xml file
        $sitemap->writeToFile($sitemapFilePath);
        // $sitemap->writeToFile(public_path('sitemap-ar.xml'));
    }


    /**
     * siteMap
     *
     * 
     * @return file contains site map
     */
    public function generateThumbnails()
    {
        ini_set('max_execution_time', 30000);
        // get all products
        $products = Product::where(['status' => 'active'])->select('photo', 'id')->paginate(30);
       
        for ($i = 0; $i < count($products); $i++) {
            // if (!File::exists(public_path('/thumbs-small/' . $products[$i]->id))) {
                $explodeImages = explode(',', $products[$i]->photo);
                for ($j = 0; $j < count($explodeImages); $j++) {

                    $tempLink[$j] = str_replace('https://alsahabapp.com/public/', '', $explodeImages[$j]);
                    $tempLink[$j] =  strstr($explodeImages[$j], 'storage/photos/');
                    $separateImages = explode('/',  $tempLink[$j]);
                    
                    $imgSmall = Image::make(public_path($tempLink[$j]))->encode('png', 90)->resize(null, 150, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    if (!File::exists(public_path('/thumbs-small/' . $products[$i]->id))) {
                        File::makeDirectory(public_path('/thumbs-small/' . $products[$i]->id),0777,true);
                    }
                    $path = public_path('/thumbs-small/' . $products[$i]->id);
                    $filename =  end($separateImages);
                    $imgSmall->save($path . '/' . $filename);


                    $imageMedium = Image::make(public_path($tempLink[$j]))->encode('png', 90)->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    if (!File::exists(public_path('/thumbs-medium/' . $products[$i]->id))) {
                        File::makeDirectory(public_path('/thumbs-medium/' . $products[$i]->id),0777,true);
                    }
                    $path = public_path('/thumbs-medium/' . $products[$i]->id);
                    $filename =  end($separateImages);
                    $imageMedium->save($path  . '/' . $filename);


                    $imageLarge = Image::make(public_path($tempLink[$j]))->encode('png', 90)->resize(null, 700, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    if (!File::exists(public_path('/thumbs-large/' . $products[$i]->id))) {
                        File::makeDirectory(public_path('/thumbs-large/' . $products[$i]->id),0777,true);
                    }
                    $path = public_path('/thumbs-large/' . $products[$i]->id);
                    $filename =  end($separateImages);
                    $imageLarge->save($path  . '/' . $filename);
                // }
            }
        }
    }

    public function generateBannerImage()
    {
            ini_set('max_execution_time', 300);
            // get all banners
            $banners = Banner::where(['status' => 'active'])->select('photo', 'id')->paginate(6);
            
            foreach($banners as $key=>$banner){
                if (!File::exists(public_path('/thumbs-banner/' . $banner->id))) {
                    File::makeDirectory(public_path('/thumbs-banner/' . $banner->id),0777,true);
                }
                $tempLink =  strstr($banner->photo, 'storage/photos/');
                $separateImages = explode('/',  $tempLink);
                
                $imgSmall = Image::make($tempLink)->encode('png', 90)->resize(565, 434.6, function ($constraint) {
                //    $constraint->aspectRatio();
                });
           
                $path = public_path('/thumbs-banner/' . $banner->id);
                $filename =  end($separateImages);
                $imgSmall->save($path . '/' . $filename);
            }
      
            
        
    }

 /**
     * Display a page
     *
     * @return \Illuminate\Http\Response
     */
    public function services(Request $request)
    {
        $services = Service::withTranslation()->translatedIn(app()->getLocale())->where(['status' => 'active'])->get()->first();

        if (!$services) {
            return back()->with('error', 'Data Not Found');
        }
        // Generate SEO 
        SEOMeta::setTitle($services->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription($services->description);
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setDescription($services->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setTitle($services->description);
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));

        TwitterCard::setTitle($services->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite($services->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle($services->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription($services->description);
        JsonLd::addImage(asset('frontend/images/logo.png'));

        return view('frontend.home.services')->with('services', $services);
    }

    /**
     * Display a page
     *
     * @return \Illuminate\Http\Response
     */
    public function service(Request $request)
    {
        $service = Service::withTranslation()->translatedIn(app()->getLocale())->where(['status' => 'active', 'slug' => $request->slug])->get()->first();

        if (!$service) {
            return back()->with('error', 'Data Not Found');
        }
        // Generate SEO 
        SEOMeta::setTitle($service->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription($service->description);
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setDescription($service->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setTitle($service->description);
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));

        TwitterCard::setTitle($service->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite($service->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle($service->title . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription($service->description);
        JsonLd::addImage(asset('frontend/images/logo.png'));

        return view('frontend.home.service')->with('service', $service);
    }
}