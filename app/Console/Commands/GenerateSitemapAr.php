<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Tags\Url as TagUrl;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Product;
use Spatie\Sitemap\Sitemap;

class GenerateSitemapAr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generatear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
        ->add(TagUrl::create('/' . app()->getLocale()))
        ->add(TagUrl::create('/' . app()->getLocale() . '/blogs'))
        ->add(TagUrl::create(app()->getLocale() . '/page/about-us'))
        ->add(TagUrl::create(app()->getLocale() . '/shop'))
        ->add(TagUrl::create(app()->getLocale() . '/contact'));


    // get All categories 
    $categories = Category::where(['status' => 'active', 'is_parent' => 1])->get();
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

    // write in sit map
    
    $sitemap->writeToFile(public_path('sitemap-ar.xml'));
    }
}
