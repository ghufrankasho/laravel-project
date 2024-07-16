@extends('layouts.master')

@section('content')
<div class="breadcrumb-area breadcrumb-bg-1 pt-50 pb-70 mb-100">
   <div class="container">
         <div class="row">
            <div class="col-lg-12">
                  <h1 class="breadcrumb-title">{{ $service->title }}</h1>

               <!--=======  breadcrumb list  =======-->

               <ul class="breadcrumb-list">
                  <li class="breadcrumb-list__item">
                     <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                     {{ __('messages.HOME') }}
                  </a>
               </li>
                  <li class="breadcrumb-list__item breadcrumb-list__item--active">{{ $service->title }}</li>
               </ul>

               <!--=======  End of breadcrumb list  =======-->

            </div>
         </div>
      </div>
</div>

<!--=======  End of breadcrumb area =======-->

<!--=============================================
=            blog page wrapper         =
=============================================-->

<div class="blog-page-wrapper mb-100">
   <div class="container">
      <div class="row">
         <div class="col-lg-3 order-2 d-none">
            <!--=======  page sidebar  =======-->
            <div class="page-sidebar">
               <!--=======  single sidebar widget  =======-->
               <div class="single-sidebar-widget mb-40">
                  <!--=======  search widget  =======-->
                  <div class="search-widget">
                     <form action="#">
                        <input type="search" placeholder="Search products ...">
                        <button type="button"><i class="ion-android-search"></i></button>
                     </form>
                  </div>
                  <!--=======  End of search widget  =======-->
               </div>
               <!--=======  End of single sidebarwidget  =======-->
               <!--=======  single sidebar widget  =======-->
               <div class="single-sidebar-widget mb-40">
                   <!--=======  widget post wrapper  =======-->
                   <div class="widget-post-wrapper">
                      <!--=======  single widget post  =======-->
                      <div class="single-widget-post">
                         <div class="image">
                            <img src="assets/images/blog/post-thumbnail-6-100x120.png" class="img-fluid" alt="{{ $service->title }}" title="{{ $service->title }}">
                         </div>
                         <div class="content">
                            <h3 class="widget-post-title"><a href="#">Go Your Own Way</a></h3>
                            <p class="widget-post-date">June 5, 2022</p>
                         </div>
                      </div>
                      <!--=======  End of single widget post  =======-->
                   </div>
                </div>
                <!--=======  single sidebar widget  =======-->
                <div class="single-sidebar-widget mb-40">
                   <!--=======  blog sidebar banner  =======-->
                   <div class="blog-sidebar-banner">
                      <img src="assets/images/banners/ADS-blog.png" class="img-fluid" alt="{{ $service->title }}" title="{{ $service->title }}">
                   </div>
                   <!--=======  End of blog sidebar banner  =======-->
                </div>
                <!--=======  End of single sidebar widget  =======-->
             </div>
             <!--=======  End of page sidebar  =======-->
          </div>
          <div class="col-lg-12 order-1 mb-md-70 mb-sm-70">
             <div class="row">
                <div class="col-md-12 mb-40">
                   <div class="single-slider-post single-slider-post--sticky pb-60">
                      <!--=======  image  =======-->
                      <div class="single-slider-post__image single-slider-post--sticky__image mb-30">
                         <img src="{{ $service->photo }}" class="img-fluid" alt="{{ $service->title }}" title="{{ $service->title }}">
                      </div>
                      <!--=======  End of image  =======-->
                   
                      <div class="single-slider-post__content single-slider-post--sticky__content">
                         <!--=======  post category  =======-->
                         <h2 class="post-title"><a href="#">{{ $service->title }}</a></h2>
                         <!--=======  End of post category  =======-->
                         <!--=======  single blog post section  =======-->
                         <div class="single-blog-post-section">
                            <p class="mb-30">{{ $service->summary }}</p>
                         </div>
                         <!--=======  End of single blog post section  =======-->
                      </div>
                      <!--=======  End of content  =======-->
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <h3 class="stay" style="margin-bottom: 30px;text-align: center;">
   {{ __('messages.STAY CONNECTED WITH US') }}</h3>
<div class="shop-product__buttons les mb-43" style="text-align: center;">

   <a href="{{ isset($settings['whatsup']) ? unserialize($settings['whatsup']) : '' }}"
   rel="alternate" hreflang="{{ app()->getLocale() }}"
       class="  "
       style=" padding: 10px 0px;font-size: 18px;">{{ __('messages.For any inquiries click here') }}
       <i class="fa fa-whatsapp"></i>
   </a>
</div>
<!--=====  End of blog page wrapper  ======-->
@endsection
