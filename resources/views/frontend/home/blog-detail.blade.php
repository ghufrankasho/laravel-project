@extends('layouts.master')

@section('content')
	<!--=======  breadcrumb area =======-->

<div class="breadcrumb-area breadcrumb-bg-1 pt-50 pb-70 mb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="breadcrumb-title">{{ __('messages.Blog') }}</h1>

					<!--=======  breadcrumb list  =======-->

					<ul class="breadcrumb-list">
						<li class="breadcrumb-list__item">
							<a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
								{{ __('messages.HOME') }}
							</a>
						</li>
						<li class="breadcrumb-list__item "><a rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ url(app()->getLocale() . '/blogs') }}">{{ __('messages.BLOGS') }}</a></li>
						<li class="breadcrumb-list__item breadcrumb-list__item--active"> {{ $blogDetail->title }}</li>
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
			
				<div class="col-lg-12 order-1 mb-md-70 mb-sm-70">
					<div class="row">

						<div class="col-md-12 mb-40">
							<div class="single-slider-post single-slider-post--sticky pb-60">
								<!--=======  image  =======-->

								<div class="single-slider-post__image single-slider-post--sticky__image mb-30">
									<img src="{{ $blogDetail->photo }}" class="img-fluid jesc" alt="{{ $blogDetail->title }}" title="{{ $blogDetail->title }}">
								</div>

								<!--=======  End of image  =======-->

								<!--=======  content  =======-->

								<div class="single-slider-post__content single-slider-post--sticky__content">


									<div class="single-blog-post-section">
										{{ $blogDetail->created_at }}
										<h3 class="mb-30">{{ $blogDetail->title }}</h3>
										<p class="mb-30">{!! $blogDetail->description!!} </p>

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

@endsection
