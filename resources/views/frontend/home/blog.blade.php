@extends('layouts.master')

@section('content')
    <!--=======  breadcrumb area =======-->

    <div class="breadcrumb-area breadcrumb-bg-1 pt-50 pb-70 mb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="breadcrumb-title">{{ __('messages.BLOGS') }}</h1>

                    <!--=======  breadcrumb list  =======-->

                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-list__item"><a href="{{ url(app()->getLocale()) }}" rel="alternate"
                                hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.HOME') }}
                            </a></li>
                        <li class="breadcrumb-list__item breadcrumb-list__item--active">{{ __('messages.BLOGS') }}</li>
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

    <div class="blog-page-wrapper mb-100 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  blog-post-wrapper  =======-->

                    <div class="row blog-post-wrapper blog-post-wrapper--masonry masonry ">
                        @foreach ($blogs as $blog)
                            <!--=======  single slider post  =======-->
                            <div class="col-lg-4 col-md-6 single-slider-post grid-item mb-40">
                                <!--=======  image  =======-->

                                <div class="single-slider-post__image mb-30">
                                    <a rel="alternate" hreflang="{{ app()->getLocale() }}"
                                        href="{{ url(app()->getLocale() . '/blog-detail/' . $blog->slug) }}">
                                        <img src="{{ $blog->photo }}" class="img-fluid" alt="{{ $blog->title }}"
                                            title="{{ $blog->title }}">
                                    </a>
                                </div>

                                <!--=======  End of image  =======-->

                                <!--=======  content  =======-->

                                <div class="single-slider-post__content">
                                    <div class="post-date">
                                        <i class="ion-android-calendar"></i>
                                        <a rel="alternate" hreflang="{{ app()->getLocale() }}"
                                            href="{{ url(app()->getLocale() . '/blog-detail/' . $blog->slug) }}">
                                            {{ $blog->created_at }}</a>
                                    </div>
									<h2 class="post-title">
										<a href="{{ url(app()->getLocale() . '/blog-detail/' . $blog->slug) }}">
											{!! Str::limit(strip_tags($blog->title), 60) !!}
										</a>
									</h2>
									
                                    <p class="post-excerpt">{!! Str::limit(strip_tags($blog->description), 200) !!}</p>
                                    <a rel="alternate" hreflang="{{ app()->getLocale() }}"
                                        href="{{ url(app()->getLocale() . '/blog-detail/' . $blog->slug) }}"
                                        class="blog-readmore-btn">{{ __('messages.read more') }}</a>
                                </div>

                                <!--=======  End of content  =======-->
                            </div>
                        @endforeach

                        <!--=======  End of single slider post  =======-->
                    </div>

                    <!--=======  End of blog-post-wrapper  =======-->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!--=======  pagination  =======-->

                    <div class=" mt-50">
                        <ul>
                            {{ $blogs->appends($_GET)->links('vendor.pagination.custom') }}
                        </ul>
                    </div>

                    <!--=======  End of pagination  =======-->
                </div>
            </div>

        </div>
    </div>

    <!--=====  End of blog page wrapper  ======-->
@endsection
{{-- @section('scripts')
<script >

	var grid = document.querySelector('.masonry');
	var msnry;
	
	imagesLoaded(grid, function () {
		// init Isotope after all images have loaded
		msnry = new Masonry(grid, {
			// options
			originLeft: false
		});
	});
			
					
			
			if (jQuery(window).width() > 767) {

			jQuery('.vc_masonry_media_grid .vc_pageable-slide-wrapper').masonry({

			isOriginLeft: false,

			})};
	
			</script>
@endsection --}}
