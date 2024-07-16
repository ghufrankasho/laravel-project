@extends('layouts.master')

@section('content')
    {{-- @include('frontend.elements.home.slider') --}}
    {{-- <br />
    <br />
    <br />
    <br /> --}}

    <div class="breadcrumb-area breadcrumb-bg-1 pt-50 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="breadcrumb-title">{{ __('messages.SHOP') }}</h1>

                    <!--=======  breadcrumb list  =======-->

                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-list__item">
                            <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.HOME') }}
                            </a>
                        </li>
                        <li class="breadcrumb-list__item">
                            <a href="{{ url(app()->getLocale() . '/shop') }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.SHOP') }}
                            </a>
                        </li>
                        <li class="breadcrumb-list__item breadcrumb-list__item--active">
                            {{ $product->title }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="shop-page-wrapper mt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-product">
                        <div class="row pb-100">
                            <div class="col-lg-6 mb-md-70 mb-sm-70">
                                <div class="shop-product__big-image-gallery-wrapper mb-30">
                                    <div
                                        class="single-product__floating-badges single-product__floating-badges--shop-product">
                                    </div>
                                    <div class="shop-product-rightside-icons">
                                        {{-- <span class="wishlist-icon">
                                            <a href="#" data-tippy="Add to wishlist" data-tippy-placement="left"
                                                data-tippy-inertia="true" data-tippy-animation="shift-away"
                                                data-tippy-delay="50" data-tippy-arrow="true"
                                                data-tippy-theme="sharpborder"><i
                                                    class="ion-android-favorite-outline"></i></a>
                                        </span> --}}
                                        <span class="enlarge-icon">
                                            <a class="btn-zoom-popup" href="#" data-tippy="Click to enlarge"
                                                data-tippy-placement="left" data-tippy-inertia="true"
                                                data-tippy-animation="shift-away" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                                <i class="ion-android-expand"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <div class="shop-product__big-image-gallery-slider"
                                        data-direction="{{ app()->getLocale() }}">
                                        @if ($product->photo)
                                            <?php $explodePath = explode(',', $product->photo); ?>
                                            <?php if(is_array($explodePath)){?>
                                            <?php foreach ($explodePath as $photo) {?>
                                            <div class="single-image">
                                                <img src="{{ $photo }}" class="img-fluid" alt="{{ $product->title }}" title="{{ $product->title }}">
                                            </div>
                                            <?php  } ?>
                                            <?php }?>
                                        @endif
                                    </div>
                                    <div class="single-product__floating-badges">
                                        @if ($product->discount)
                                            <span class="onsale">{{ $product->discount }}%</span>
                                        @endif
                                        @if ($product->is_hot)
                                            <span class="hot">hot</span>
                                        @endif
                                    </div>
                                </div>



                                <div class="shop-product__small-image-gallery-wrapper">

                                    <div class="shop-product__small-image-gallery-slider"
                                        data-direction="{{ app()->getLocale() }}">

                                        @if ($product->photo)
                                            <?php $explodePath = explode(',', $product->photo); ?>
                                            <?php if(is_array($explodePath)){?>
                                            <?php foreach ($explodePath as $photo) {?>
                                            <div class="single-image">
                                                <img src="{{ $photo }}" class="img-fluid" alt="{{ $product->title }}" title="{{ $product->title }}">
                                            </div>
                                            <?php  } ?>
                                            <?php }?>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-6">
                                <!--=======  shop product description  =======-->

                                <div class="shop-product__description">
                                    <!--=======  shop product rating  =======-->
                                    {{-- <div class="shop-product__rating mb-15">
                                        <span class="product-rating">
                                            <i class="active ion-android-star"></i>
                                            <i class="active ion-android-star"></i>
                                            <i class="active ion-android-star"></i>
                                            <i class="active ion-android-star"></i>
                                            <i class="ion-android-star-outline"></i>
                                        </span>

                                        <span class="review-link ml-20">
                                            <a href="#">(3 customer reviews)</a>
                                        </span>
                                    </div> --}}

                                    <!--=======  End of shop product rating  =======-->

                                    <!--=======  shop product title  =======-->

                                    <div class="shop-product__title mb-15">
                                        <h2>{{ $product->title }}</h2>
                                    </div>

                                    <div class="shop-product__price mb-30">
                                        @if ($product->old_price)
                                            <span class="main-price discounted">
                                                {{ $product->old_price . __('messages.AED ') }}</span>
                                        @endif
                                        @if ($product->price)
                                            <span class="discounted-price">
                                                {{ $product->price }}
                                            </span>
                                            <span style="font-size: 18px;color: #d3122a;">{{ __('messages.AED ') }}</span>
                                            <span class="show-price d-none">{{ $product->price }}</span>
                                        @endif

                                    </div>


                                    <!--=======  End of shop product price  =======-->

                                    <!--=======  shop product short description  =======-->

                                    <table>

                                        <div class="row des soft">
                                            <div class="col-lg-12 col-md-6 col-sm-6" style="">
                                                <ul style="list-style: disc;" class="ml-14">
                                                    @if ($product->price)
                                                        <li>
                                                            <p class="my-1">
                                                                <span class="black">{{ __('messages.Piece Price :') }}
                                                                </span>
                                                                <span
                                                                    class="font-light">{{ $product->price }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($product->minimum_quantity)
                                                        <li>
                                                            <p class="my-1"><span
                                                                    class="black">{{ __('messages.Minimum Quantity :') }}
                                                                </span><span
                                                                    class="font-light">{{ $product->minimum_quantity }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($product->dimension)
                                                        <li>
                                                            <p class="my-1"><span
                                                                    class="black">{{ __('messages.Size :') }}
                                                                </span> <label class="n-1"
                                                                style="font-size: 16px;color: #777777;">
                                                                {{ $product->dimension }}
                                                            </label>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($product->description)
                                                        <li>
                                                            <p class="my-1">
                                                                <span
                                                                    class="black">{{ __('messages.Description :') }}</span>
                                                                <span class="font-light">
                                                                    {{-- {!! $product->description !!} --}}
                                                                    {{ str_replace('<br>', "\n", strip_tags($product->description)) }}
                                                                </span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($product->color)
                                                        <li>
                                                            <p class="my-1"><span
                                                                    class="black">{{ __('messages.Code Of Item :') }}
                                                                </span><span
                                                                    class="font-light">{{ $product->color }}</span></p>
                                                        </li>
                                                    @endif
                                                    @if ($product->available)
                                                        <li>
                                                            <p class="my-1">
                                                                <span class="black">{{ __('messages.Stock :') }}
                                                                </span><span
                                                                    class="font-light">{{ $product->available }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($product->shipping_area)
                                                        <li>
                                                            <p class="my-1">
                                                                <span class="black">{{ __('messages.Shipping Area :') }}
                                                                </span> <span class="font-light">
                                                                    {{ $product->shipping_area }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </table>
                                    <span class=" quickview-title">{{ __('messages.Quantity :') }}</span>
                                    <div class="pro-qty d-inline-block mb-40">
                                        <a href="#" class="dec qty-btn" data-product-id="{{ $product->id }}">-</a>
                                        @if ($product->category->starts_from)
                                            <input type="text" class="get-quanitiy-{{ $product->id }}"
                                                min="{{ $product->category->starts_from }}"
                                                data-price="{{ $product->price }}"
                                                value="{{ $product->category->starts_from }}" readonly>
                                        @else
                                            <input type="text" class="get-quanitiy-{{ $product->id }}"
                                                min="{{ $product->minimum_quantity }}" data-price="{{ $product->price }}"
                                                value="{{ $product->minimum_quantity }}" readonly>
                                        @endif

                                        <a href="#" class="inc qty-btn" data-product-id="{{ $product->id }}">+</a>
                                    </div>
                                    <div class="rows d-block-ruby">
                                        <div class="shop-product__buttons mb-40">
                                            {{-- <a class="active lezada-button lezada-button--medium  add-to-cart"
                                                id="add-to-cart-{{ $product->id }}"
                                                data-product-id="{{ $product->id }}"
                                                data-quantity="{{ $product->category->starts_from ? $product->category->starts_from : $product->minimum_quantity }}">{{ __('messages.ADD TO CART') }}</a> --}}

                                        </div>

                                        <div class=" fast mb-40">
                                            <a href="#" class="lezada-button lezada-button--medium request-order "
                                                data-quantity="{{ $product->category->starts_from ? $product->category->starts_from : $product->minimum_quantity }}"
                                                data-product-id="{{ $product->id }}"
                                                id="add-to-cart-{{ $product->id }}" data-price="{{ $product->price }}"
                                                style="">{{ __('messages.WHATSAPP QUOTE') }} <i
                                                    class="fa fa-whatsapp"></i>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($product->relatedProducts) > 0)
                        <div class="single-sidebar-widget mb-40">
                            {{-- <h2 class="single-sidebar-widget--title">{{ __('messages.Related Products') }}</h2> --}}

                            <!--=======  widget product wrapper  =======-->
                            <div class="product-widget-slider-container mb-100">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6 mb-md-70 mb-sm-70">
                                            <!--=======  single product widget slider container  =======-->

                                            <div class="single-product-widget-slider-container">
                                                <h3 class="widget-slider-title" id="append-arrow-1">
                                                    {{ __('messages.Related Products') }}</h3>

                                                <!--=======  single product widget slider  =======-->

                                                <div class="lezada-slick-slider single-product-widget-slider"
                                                    data-slick-setting='{
                                                    "slidesToShow": 3,
                                                    "slidesToScroll": 1,
                                                    "rows": 3,
                                                    "arrows": true,
                                                    "autoplay": true,
                                                    "speed": 1000,
                                                    "appendArrows": "#append-arrow-1",
                                                    @if (app()->getLocale() == 'en')
                                                    "prevArrow": {"buttonClass": "slick-prev", "iconClass": "ti-angle-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}" },
                                                    "nextArrow": {"buttonClass": "slick-next", "iconClass": "ti-angle-{{ app()->getLocale() == 'en' ? 'right' : 'left' }}" }
                                                   @else
                                                   "prevArrow": {"buttonClass": "slick-prev", "iconClass": "ti-angle-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}" },
                                                   "nextArrow": {"buttonClass": "slick-next", "iconClass": "ti-angle-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}" }

                                                   @endif
                                                }'
                                                    data-slick-responsive='[
                                                    {"breakpoint":1501, "settings": {"slidesToShow": 1} },
                                                    {"breakpoint":1199, "settings": {"slidesToShow": 1} },
                                                    {"breakpoint":991, "settings": {"slidesToShow": 1,"slidesToScroll": 1} },
                                                    {"breakpoint":767, "settings": {"slidesToShow": 1, "slidesToScroll": 1} },
                                                    {"breakpoint":575, "settings": {"slidesToShow": 1, "slidesToScroll": 1} },
                                                    {"breakpoint":479, "settings": {"slidesToShow": 1, "slidesToScroll": 1} }
                                                ]'>
                                                    @foreach ($product->relatedProducts as $item)
                                                        @if ($item->id != $product->id)
                                                            <!--=======  single widget product  =======-->
                                                            <div class="single-widget-product-wrapper">
                                                                <div class="single-widget-product">
                                                                    <!--=======  image  =======-->

                                                                    <div class="single-widget-product__image">
                                                                        <a rel="alternate" hreflang="{{ app()->getLocale() }}"
                                                                            href="{{ url(app()->getLocale() . '/product/' . $item->slug) }}">
                                                                            @if ($item->photo)
                                                                                <?php $explodePath = explode(',', $item->photo); ?>
                                                                                <?php if(is_array($explodePath)){?>
                                                                                <?php $x=2; foreach ($explodePath as $photo) {
                                                                                    if($x < 3){?>
                                                                                <img src="{{ $photo }}"
                                                                                    alt="{{ $item->title }}" title="{{ $item->title }}">
                                                                                <?php $x++;
                                                                                    }
                                                                                } ?>
                                                                                <?php }?>
                                                                            @endif
                                                                        </a>

                                                                    </div>

                                                                    <!--=======  End of image  =======-->

                                                                    <!--=======  content  =======-->

                                                                    <div class="single-widget-product__content">

                                                                        <div class="single-widget-product__content__top">
                                                                            <h3 class="product-title"><a rel="alternate" hreflang="{{ app()->getLocale() }}"
                                                                                    href="{{ url(app()->getLocale() . '/product/' . $item->slug) }}">{{ $item->title }}</a>
                                                                            </h3>
                                                                            <div class="price">

                                                                                @if ($item->old_price)
                                                                                    <span class="main-price discounted">
                                                                                        {{ $item->old_price . __('messages.AED ') }}</span>
                                                                                @endif
                                                                                @if ($item->price)
                                                                                    <span class="discounted-price">
                                                                                        {{ $item->price . __('messages.AED ') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div>
                                                                                @if ($item->dimension)
                                                                                    <label class="n-1"
                                                                                        style="font-size: 16px">
                                                                                        {{ $item->dimension }}
                                                                                    </label>
                                                                                @endif
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <!--=======  End of content  =======-->
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach


                                                </div>

                                                <!--=======  End of single product widget slider  =======-->
                                            </div>

                                            <!--=======  End of single product widget slider container =======-->
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!--=======  End of widget product wrapper  =======-->
                        </div>
                    @endif
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
                </div>
            </div>

        </div>
    </div>
@endsection
