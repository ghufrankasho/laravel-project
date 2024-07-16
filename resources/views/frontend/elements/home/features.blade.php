{{-- <style>
    @media only screen and (max-width: 767px) {
        .shop-product__buttons {
            ;
        }
    }
</style> --}}
<div class="shop-page-wrapper">
    @if (isset($mainCategories) && count($mainCategories) > 0)
        <div class="section-title section-title--one text-center" style="margin-top: 60px;">
            <h1 style="color:#777777"> {{ $mainCategories[0]->title }} </h1>

        </div>
    @endif


    <div class="shop-page-header" style="">
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

    <!--=======  End of shop page header  =======-->

    <!--=============================================
    =            shop advance filter area         =
    =============================================-->



    <div class="shop-page-content mt-100 mb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    {{-- <form action="{{ route('shop.filter', app()->getLocale()) }}" method="POST"> --}}
                    @csrf
                    <div class="page-sidebar">
                        {{-- <div class="single-sidebar-widget mb-40">
                                <form class="search-form" action="{{ route('search', app()->getLocale()) }}"
                                    method="POST">
                                    <div class="search-widget">
                                        <input name="q" type="search"
                                            placeholder="{{ __('messages.Search products ...') }}">
                                        <button type="submit" class="search"><i
                                                class="ion-android-search"></i></button>
                                    </div>
                                </form>
                            </div> --}}


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
                                @if (isset($mainCategories) && count($mainCategories) > 0)
                                    @foreach ($mainCategories as $item)
                                        <li>

                                            <a href="{{ url(app()->getLocale() . '/shop?category=' . $item->slug) }}"
                                                rel="alternate" hreflang="{{ app()->getLocale() }}">
                                                {{ $item->title }} </a>
                                            <span class="quantity">{{ count($item->products) }} </span>

                                        </li>
                                    @endforeach
                                @endif

                                {{-- @foreach ($unMainCategories as $item)
                                    <li>

                                        <a href="{{ url(app()->getLocale() . '/shop?category=' . $item->slug) }}">{{ $item->title }} 
                                        </a>
                                        <span class="quantity">{{ count($item->products) }} </span>
                                    </li>
                                @endforeach --}}
                            </ul>
                        </div>




                    </div>
                    </form>

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

                @if (isset($mainCategories) && count($mainCategories) > 0)
                    <div class="col-lg-9 order-1 order-lg-2 mb-md-80 mb-sm-80">

                        <div class="row product-isotope shop-product-wrap four-column">
                            <?php
							foreach ($mainCategories[0]->homeproducts as $product) {?>

                            <div class="col-6 col-lg-3 col-md-6 col-sm-6 mb-45">
                                <div class="single-product">
                                    <!--=======  single product image  =======-->
                                    <div class="single-product__image">
                                        <a class="image-wrap"
                                            href="{{ url(app()->getLocale() . '/product/' . $product->slug) }}"
                                            rel="alternate" hreflang="{{ app()->getLocale() }}">
                                            @if ($product->photo !== '')
                                                <?php $explodePath = explode(',', $product->photo); ?>
                                                <?php if(is_array($explodePath)){?>
                                                <?php $x=1; foreach ($explodePath as $photo) {
                                                   $separateImages = explode('/',  $photo);
                                                   $image_name='https://www.alsahabapp.com/public/thumbs-medium/'.$product->id.'/'.end($separateImages);
                                                                    if($x < 3){?>
                                                <img rel="preload" data-src="{{$image_name}}" class="lazy img-fluid" alt="{{ $product->title }}" title="{{ $product->title }}" >
                                                <?php $x++;
                                                                    }
                                                                } ?>
                                                <?php }?>
                                            @endif

                                            {{-- <img src="assets/images/products/furniture-4-2-600x800.jpg"
                                                                class="img-fluid" alt=""> --}}
                                        </a>


                                        <div class="single-product__floating-badges">
                                            @if ($product->discount)
                                                <span class="onsale">{{ $product->discount }}%</span>
                                            @endif
                                            @if ($product->is_hot)
                                                <span class="hot">hot</span>
                                            @endif
                                        </div>
                                        <div class="single-product__floating-icons">
                                            <span class="quickview">
                                                <a class="cd-trigger" href="#qv-1-{{ $product->id }}"
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
                                                    {{ $product->title }}
                                                </a>
                                            </h3>
                                            @if ($product->dimension)
                                                <label class="n-1" style="font-size: 15px">
                                                    {{ $product->dimension }}
                                                </label>
                                            @endif

                                            <a style="font-size:13px" href="#"
                                                data-quantity="{{ $product->category->starts_from ? $product->category->starts_from : $product->minimum_quantity }}"
                                                data-product-id="{{ $product->id }}" class="request-order"
                                                data-price="{{ $product->price }}"
                                                id="add-to-cart-{{ $product->id }}">{{ __('messages.WHATSAPP QUOTE') }}
                                            </a>


                                        </div>



                                        <div class="price">
                                            @if ($product->old_price)
                                                <span style="font-size:15px" class="main-price discounted">
                                                    {{ $product->old_price . __('messages.AED ') }}

                                                </span>
                                            @endif
                                            @if ($product->price)
                                                <span class="discounted-price"
                                                    style="text-decoration:none;font-size:15px">
                                                    {{ $product->price . __('messages.AED ') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="qv-1-{{ $product->id }}" class="cd-quick-view">
                                <div class="cd-slider-wrapper">
                                    <ul class="cd-slider">
                                        @if ($product->photo !== '')
                                            <?php $explodePath = explode(',', $product->photo); ?>
                                            <?php if(is_array($explodePath)){?>
                                            <?php $i=1; foreach ($explodePath as $photo) {?>
                                            <?php if($i ==1){?>
                                            <li class="selected">
                                                <img data-src="{{ $photo }}" alt="{{ $product->title }}" title="{{ $product->title }}">
                                            </li>
                                            <?php  } else {?>
                                            <li>
                                                <img data-src="{{ $photo }}" alt="{{ $product->title }}" title="{{ $product->title }}">
                                            </li>
                                            <?php  } ?>
                                            <?php $i++;} ?>
                                            <?php }?>
                                        @endif

                                    </ul> <!-- cd-slider -->
                                    <div class="single-product__floating-badges">
                                        @if ($product->discount)
                                            <span class="onsale">{{ $product->discount }}%</span>
                                        @endif
                                        @if ($product->is_hot)
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

                                    <h2 class="item-title">{{ $product->title }}</h2>

                                    <div class="price">
                                        @if ($product->old_price)
                                            <span style="font-size:16px" class="main-price discounted">
                                                {{ $product->old_price . __('messages.AED ') }}

                                            </span>
                                        @endif
                                        @if ($product->price)
                                            <span class="discounted-price "
                                                data-original-price="{{ $product->price }}"
                                                style="text-decoration:none;font-size:16px">
                                                {{ $product->price }}
                                            </span>
                                            <span class="show-price d-none">{{ $product->price }}</span>
                                            <span
                                                style="font-size: 18px;color: #d3122a !important;">{{ __('messages.AED ') }}
                                            </span>
                                        @endif
                                    </div>

                                    <table>

                                        <div class="row des">
                                            <div class="col-lg-12 col-md-6 col-sm-6">
                                                <ul style="list-style: disc;margin-right: 12px;" class="ml-14">
                                                    @if ($product->price)
                                                        <li>
                                                            <p class="my-1">
                                                                <span
                                                                    class="black">{{ __('messages.Piece Price :') }}
                                                                </span><span
                                                                    class="font-light">{{ $product->price }}</span>
                                                            </p>
                                                        </li>
                                                    @endif

                                                    @if ($product->minimum_quantity)
                                                        <li>
                                                            <p class="my-1">
                                                                <span
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
                                                            <p class="my-1"><span
                                                                    class="black">{{ __('messages.Description :') }}
                                                                </span>
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
                                                                    class="font-light">{{ $product->color }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($product->available)
                                                        <li>
                                                            <p class="my-1">
                                                                <span
                                                                    class="black">{{ __('messages.Stock :') }}</span><span
                                                                    class="font-light">
                                                                    {{ $product->available }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                    @if ($product->shipping_area)
                                                        <li>
                                                            <p class="my-1">
                                                                <span
                                                                    class="black">{{ __('messages.Shipping Area :') }}</span><span
                                                                    class="font-light">
                                                                    {{ $product->shipping_area }}</span>
                                                            </p>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </table>

                                    {{-- <span class="quickview-title">{{ __('messages.QUANTITY') }}</span> --}}
                                    <span class="quickview-title">{{ __('messages.Quantity :') }}</span>
                                    <div class="pro-qty d-inline-block mb-40">
                                        <a href="#" class="dec qty-btn"
                                            data-product-id="{{ $product->id }}">-</a>

                                        @if ($product->category->starts_from)
                                            <input type="text" class="get-quanitiy-{{ $product->id }}"
                                                min="{{ $product->category->starts_from }}"
                                                data-price="{{ $product->price }}"
                                                value="{{ $product->category->starts_from }}" readonly>
                                        @else
                                            <input type="text" class="get-quanitiy-{{ $product->id }}"
                                                min="{{ $product->minimum_quantity }}"
                                                data-price="{{ $product->price }}"
                                                value="{{ $product->minimum_quantity }}" readonly>
                                        @endif
                                        <a href="#" class="inc qty-btn"
                                            data-product-id="{{ $product->id }}">+</a>
                                    </div>
                                    <div class="rows d-block-ruby">
                                        <div class="shop-product__buttons mb-40">
                                            {{-- <a class="active lezada-button lezada-button--medium  add-to-cart add-to-cart-btn-{{ $product->id }}"
                                                id="add-to-cart-{{ $product->id }}"
                                                data-product-id="{{ $product->id }}" 
                                               
                                                data-quantity="1">{{ __('messages.ADD TO CART') }}</a> --}}

                                        </div>

                                        <div class="shop-product__buttons mb-40">
                                            <a href="#"
                                                class="lezada-button lezada-button--medium request-order"
                                                data-quantity="{{ $product->category->starts_from ? $product->category->starts_from : $product->minimum_quantity }}"
                                                data-product-id="{{ $product->id }}"
                                                id="add-to-cart-{{ $product->id }}"
                                                data-price="{{ $product->price }}"
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
                            <?php } ?>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center mt-30">
                                <a class="lezada-button lezada-button--medium lezada-button--icon--left star"
                                    href="{{ url(app()->getLocale() . '/shop?category=' . $mainCategories[0]->slug) }}"
                                    rel="alternate" hreflang="{{ app()->getLocale() }}">
                                    <i class="ion-android-add"></i> {{ __('messages.MORE') }}
                                </a>
                            </div>
                        </div>

                    </div>
                @endif


            </div>
        </div>
    </div>
</div>

</div>


<!--=====  End of quick view  ======-->
