@extends('layouts.master')

@section('content')
    <div class="breadcrumb-area breadcrumb-bg-3 pt-50 pb-70 ">
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
                        <li class="breadcrumb-list__item breadcrumb-list__item--active">{{ __('messages.PRODUCTS') }}</li>
                    </ul>

                    <!--=======  End of breadcrumb list  =======-->

                </div>
            </div>
        </div>
    </div>
    <div class="shop-page-wrapper">



        <div class="shop-page-header lef" style="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-12 col-md-2">
                        <div class="filter-icons">
                            <div class="single-icon grid-icons">
                                <a data-target="five-column" href="javascript:void(0)">
                                    <i class="ti-layout-grid4-alt"></i>
                                </a>
                                <a data-target="four-column" class="active" href="javascript:void(0)">
                                    <i class="ti-layout-grid3-alt"></i>
                                </a>
                                <a data-target="three-column" href="javascript:void(0)">
                                    <i class="ti-layout-grid2-alt"></i>
                                </a>
                                {{-- <a data-target="list" href="javascript:void(0)">
                                    <i class="ti-view-list"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="shop-page-content mt-100 mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <form action="{{ route('shop.filter', app()->getLocale()) }}" method="POST">
                            @csrf
                            <div class="page-sidebar">


                                {{-- @if (count($categories) > 0) --}}
                                <div class="single-sidebar-widget mb-40">
                                    <h2 class="single-sidebar-widget--title">
                                        {{ __('messages.CATEGORIES') }}
                                    </h2>
                                    <ul class="single-sidebar-widget--list single-sidebar-widget--list--category">
                                        @php
                                            if (!empty($_GET['category'])) {
                                                $filterCategory = explode(',', $_GET['category']);
                                            }
                                        @endphp
                                        @foreach ($categories as $item)
                                            <li>
                                                <input @if (!empty($filterCategory) && in_array($item->slug, $filterCategory)) checked @endif type="checkbox"
                                                    id="{{ $item->slug }}" name="category[]" onchange="this.form.submit()"
                                                    value="{{ $item->slug }}" />
                                                <a href="#"
                                                    onclick="event.preventDefault(); this.parentNode.getElementsByTagName('input')[0].click();">
                                                    {{ $item->title }}
                                                </a>
                                                <span class="quantity">{{ count($item->products) }} </span>
                                            </li>
                                        @endforeach
                                        {{-- @foreach ($unMaincategories as $item)
                                                <li>
                                                    <input @if (!empty($filterCategory) && in_array($item->slug, $filterCategory)) checked @endif type="checkbox"
                                                        id="{{ $item->slug }}" name="category[]"
                                                        onchange="this.form.submit()" value="{{ $item->slug }}" />
                                                    <a href="#">{{ $item->title }} </a>
                                                    <span class="quantity">{{ count($item->products) }} </span>
                                                </li>
                                            @endforeach --}}



                                    </ul>
                                </div>
                                {{-- @endif --}}



                            </div>
                        </form>
                    </div>
                    <div class="col-lg-9 order-1 order-lg-2 mb-md-80 mb-sm-80">

                        <div class="row product-isotope shop-product-wrap four-column">
                            <?php
                            if (count($products) > 0) {
                                foreach ($products as $item) {?>
                            <div class="col-6 col-lg-3 col-md-6 col-sm-6 mb-45">
                                <div class="single-product">
                                    <!--=======  single product image  =======-->
                                    <div class="single-product__image">
                                        <a class="image-wrap"
                                            href="{{ url(app()->getLocale() . '/product/' . $item->slug) }}"
                                            rel="alternate" hreflang="{{ app()->getLocale() }}">
                                            @if ($item->photo)
                                                <?php $explodePath = explode(',', $item->photo); ?>
                                                <?php if(is_array($explodePath)){?>
                                                <?php $x=1; foreach ($explodePath as $photo) {
                                                                if($x < 3){?>
                                                <img src="{{ $photo }}" class="img-fluid" alt="{{ $item->title }}" title="{{ $item->title }}">
                                                <?php $x++;
                                                                }
                                                            } ?>
                                                <?php }?>
                                            @endif
                                            {{-- <img src="assets/images/products/furniture-4-2-600x800.jpg"
                                                            class="img-fluid" alt=""> --}}
                                        </a>
                                        <div class="single-product__floating-badges">
                                            @if ($item->discount)
                                                <span class="onsale">{{ $item->discount }}%</span>
                                            @endif
                                            @if ($item->is_hot)
                                                <span class="hot">hot</span>
                                            @endif
                                        </div>
                                        <div class="single-product__floating-icons">
                                            <span class="quickview">
                                                <a class="cd-trigger" href="#pr-{{ $item->id }}"
                                                    data-tippy="Quick View" data-tippy-inertia="true"
                                                    data-tippy-animation="shift-away" data-tippy-delay="50"
                                                    data-tippy-arrow="true" data-tippy-theme="sharpborder"
                                                    data-tippy-placement="left">
                                                    <i class="ion-ios-search-strong"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="single-product__content">
                                        <div class="title">
                                            <h3>
                                                <a href="{{ url(app()->getLocale() . '/product/' . $item->slug) }}"
                                                    rel="alternate" hreflang="{{ app()->getLocale() }}">
                                                    {{ $item->title }}
                                                </a>
                                            </h3>

                                            @if ($item->dimension)
                                                <label class="n-1" style="font-size: 15px">
                                                    {{ $item->dimension }}
                                                </label>
                                            @endif

                                            <a style="font-size:13px" href="#"
                                                data-quantity="1"
                                                data-product-id="{{ $item->id }}" class="request-order"
                                                data-price="{{ $item->price }}"
                                                id="add-to-cart-{{ $item->id }}">{{ __('messages.WHATSAPP QUOTE') }}
                                            </a>
                                        </div>

                                        <div class="price">
                                            @if ($item->old_price)
                                                <span style="font-size:15px" class="main-price discounted">
                                                    {{ $item->old_price . __('messages.AED ') }}

                                                </span>
                                            @endif
                                            @if ($item->price)
                                                <span class="discounted-price" style="text-decoration:none;font-size:15px">
                                                    {{ $item->price . __('messages.AED ') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="pr-{{ $item->id }}" class="cd-quick-view">
                                <div class="cd-slider-wrapper">
                                    <ul class="cd-slider">
                                        @if ($item->photo)
                                            <?php $explodePath = explode(',', $item->photo); ?>
                                            <?php if(is_array($explodePath)){?>
                                            <?php $i=1; foreach ($explodePath as $photo) {?>
                                            <?php if($i ==1){?>
                                            <li class="selected">
                                                <img src="{{ $photo }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                                            </li>
                                            <?php  } else {?>
                                            <li>
                                                <img src="{{ $photo }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                                            </li>
                                            <?php  } ?>
                                            <?php $i++;} ?>
                                            <?php }?>
                                        @endif

                                    </ul> <!-- cd-slider -->
                                    <div class="single-product__floating-badges">
                                        @if ($item->discount)
                                            <span class="onsale">{{ $item->discount }}%</span>
                                        @endif
                                        @if ($item->is_hot)
                                            <span class="hot">hot</span>
                                        @endif
                                    </div>

                                    <ul class="cd-slider-pagination">
                                        <?php if(is_array($explodePath)){?>
                                        <?php $j=0; foreach ($explodePath as $photo) {?>
                                        <?php if($j ==0){?>
                                        <li class="active">
                                            <a href="#{{ $j }}">{{ $j++ }}</a>
                                        </li>
                                        <?php  } else {?>
                                        <li>
                                            <a href="#{{ $j }}">{{ $j++ }}</a>
                                        </li>
                                        <?php  } ?>
                                        <?php $j++;} ?>
                                        <?php }?>

                                    </ul> <!-- cd-slider-pagination -->

                                    <ul class="cd-slider-navigation">
                                        <li><a class="cd-prev" href="#0">{{ __('Prev') }}</a></li>
                                        <li><a class="cd-next" href="#0">{{ __('Next') }}</a></li>
                                    </ul> <!-- cd-slider-navigation -->
                                </div> <!-- cd-slider-wrapper -->

                                <div class="lezada-item-info cd-item-info ps-scroll">

                                    <h2 class="item-title">{{ $item->title }}</h2>
                                    <div class="price">

                                        <div class="price">
                                            @if ($item->old_price)
                                                <span style="font-size:16px" class="main-price discounted">
                                                    {{ $item->old_price . __('messages.AED ') }}
                                                </span>
                                            @endif
                                            @if ($item->price)
                                                <span class="discounted-price"
                                                    style="text-decoration:none;font-size:16px">
                                                    {{ $item->price }}
                                                </span>
                                                <span
                                                    style="font-size: 18px;color: #d3122a;">{{ __('messages.AED ') }}</span>
                                                    <span class="show-price d-none">{{ $item->price }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <table>

                                        <div class="row des ">
                                            <div class="col-lg-12 col-md-6 col-sm-6">
                                                <ul style="list-style: disc;margin-right: 12px;" class="ml-14">
                                                    @if ($item->price)
                                                        <li>
                                                            <p class="my-1">
                                                                <span class="black">{{ __('messages.Piece Price :') }}
                                                                </span><span class="font-light">{{ $item->price }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($item->minimum_quantity)
                                                        <li>
                                                            <p class="my-1"><span
                                                                    class="black">{{ __('messages.Minimum Quantity :') }}
                                                                </span><span
                                                                    class="font-light">{{ $item->minimum_quantity }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($item->dimension)
                                                        <li>
                                                            <p class="my-1"><span
                                                                    class="black">{{ __('messages.Size :') }}
                                                                </span> <label class="n-1"
                                                                style="font-size: 16px;color: #777777;">
                                                                {{ $item->dimension }}
                                                            </label>
                                                            </p>
                                                        </li>
                                                    @endif

                                                    @if ($item->description)
                                                        <li>
                                                            <p class="my-1">
                                                                <span
                                                                    class="black">{{ __('messages.Description :') }}</span>
                                                                <span class="font-light">
                                                                    {{-- {!! $item->description!!} --}}
                                                                    {{ str_replace('<br>', "\n", strip_tags($item->description)) }}
                                                                </span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($item->color)
                                                        <li>
                                                            <p class="my-1"><span
                                                                    class="black">{{ __('messages.Code Of Item :') }}
                                                                </span><span class="font-light">{{ $item->color }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($item->available)
                                                        <li>
                                                            <p class="my-1">
                                                                <span
                                                                    class="black">{{ __('messages.Stock :') }}</span><span
                                                                    class="font-light"> {{ $item->available }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($item->shipping_area)
                                                        <li>
                                                            <p class="my-1">
                                                                <span
                                                                    class="black">{{ __('messages.Shipping Area :') }}</span><span
                                                                    class="font-light"> {{ $item->shipping_area }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </table>
                                    <span class="quickview-title">{{ __('messages.Quantity :') }}</span>
                                    <div class="pro-qty d-inline-block mb-40">
                                        <a href="#" class="dec qty-btn"
                                            data-product-id="{{ $item->id }}">-</a>
                                        @if ($item->category->starts_from)
                                            <input type="text" class="get-quanitiy-{{ $item->id }}"
                                                min="{{ $item->category->starts_from }}"
                                                data-price="{{ $item->price }}"
                                                value="{{ $item->category->starts_from }}" readonly>
                                        @else
                                            <input type="text" class="get-quanitiy-{{ $item->id }}"
                                                min="{{ $item->minimum_quantity }}" data-price="{{ $item->price }}"
                                                value="{{ $item->minimum_quantity }}" readonly>
                                        @endif

                                        <a href="#" class="inc qty-btn"
                                            data-product-id="{{ $item->id }}">+</a>
                                    </div>
                                    <div class="rows d-block-ruby">
                                        <div class="shop-product__buttons mb-40">
                                            {{-- <a class="active lezada-button lezada-button--medium  add-to-cart"
                                                id="add-to-cart-{{ $item->id }}"
                                                data-product-id="{{ $item->id }}"
                                                data-quantity="{{ $item->category->starts_from ? $item->category->starts_from : $item->minimum_quantity }}">{{ __('messages.ADD TO CART') }}</a> --}}

                                        </div>

                                        <div class="shop-product__buttons mb-40">
                                            <a href="#" class="lezada-button lezada-button--medium  request-order"
                                                data-quantity="{{ $item->category->starts_from ? $item->category->starts_from : $item->minimum_quantity }}"
                                                data-product-id="{{ $item->id }}"
                                                id="add-to-cart-{{ $item->id }}" data-price="{{ $item->price }}"
                                                style="">{{ __('messages.WHATSAPP QUOTE') }} <i
                                                    class="fa fa-whatsapp"></i>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- <div class="quick-view-other-info">
                                                    <table>
                                                        <tr class="single-info">
                                                            <td class="quickview-title">Share on: </td>
                                                            <td class="quickview-value">
                                                                <ul class="quickview-social-icons">
                                                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div> --}}
                                </div> <!-- cd-item-info -->
                                <a href="#0" class="cd-close">{{ __('Close') }}</a>
                            </div>
                            <?php }


                            } else {?>
                            <p>{{ __('messages.There are no products') }}</p>
                            <?php } ?>
                        </div>
                        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}
                        {{-- <div class="row">
                            <div class="col-lg-12 text-center mt-30">
                                <a class="lezada-button lezada-button--medium lezada-button--icon--left" href="#"><i
                                        class="ion-android-add"></i> MORE
                                </a>
                            </div>
                        </div> --}}


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
@endsection
