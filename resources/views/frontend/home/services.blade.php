@extends('layouts.master')

@section('content')
<div class="breadcrumb-area breadcrumb-bg-1 pt-50 pb-70" style="margin-left: 0px;margin-right: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="breadcrumb-title">{{ __('messages.SERVICES') }}</h1>
                <!--=======  breadcrumb list  =======-->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-list__item">
                        <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                            {{ __('messages.HOME') }}
                        </a>
                    </li>
                    <li class="breadcrumb-list__item breadcrumb-list__item--active">{{ __('messages.SERVICES') }}</li>
                </ul>
                <!--=======  End of breadcrumb list  =======-->
            </div>
        </div>
    </div>
</div>

<br/>
<br/>
<br/>
<div class="blog-page-wrapper mb-100">
   <div class="container">
       <div class="row">
           <div class="col-lg-12 order-1">
               <div class="row">
                   @if (isset($services))
                       @foreach ($services as $service)
                           <div class="col-md-12 mb-60">
                               <div class="single-slider-post single-slider-post--list">
                                   <!--=======  image  =======-->

                                   <div class="single-slider-post__image single-slider-post--list__image mb-sm-30">
                                       <a href="{{ url(app()->getLocale() . '/service/'.$service->slug) }}"
                                        rel="alternate" hreflang="{{ app()->getLocale() }}">
                                           <img src="{{ $service->photo }}"
                                               class="img-fluid" alt="{{ $service->title }}" title="{{ $service->title }}">
                                       </a>
                                   </div>

                                   <!--=======  End of image  =======-->

                                   <!--=======  content  =======-->

                                   <div class="single-slider-post__content single-slider-post--list__content">

                                       <h2 class="post-title">
                                           <a href="{{ url(app()->getLocale() . '/service/'.$service->slug) }}"
                                            rel="alternate" hreflang="{{ app()->getLocale() }}">
                                               {{ $service->title }}
                                           </a>
                                       </h2>
                                       <p 
                                           class="card-text">{{ Str::limit( $service->summary, 200) }}
                                           <a href="{{ url(app()->getLocale() . '/service/' . $service->slug) }}" class="blog-readmore-btn"
                                            rel="alternate" hreflang="{{ app()->getLocale() }}">
                                            {{ __('messages.read more') }}
                                        </a>
                                         </a>
                                       </p>
                                      
                                   </div>

                                   <!--=======  End of content  =======-->
                               </div>
                           </div>
                       @endforeach
                   @endif
               </div>

               {{-- <div class="row">
                   <div class="col-lg-12">
                       <!--=======  pagination  =======-->

                       <div class="pagination text-center">
                           <ul>
                               <li class="active"><a href="#">1</a></li>
                               <li><a href="#">2</a></li>
                               <li><a href="#">3</a></li>
                               <li><a href="#">4</a></li>
                               <li><a href="#">NEXT</a></li>
                           </ul>
                       </div>

                       <!--=======  End of pagination  =======-->
                   </div>
               </div> --}}

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
@endsection
