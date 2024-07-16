<div class="section-title-container mb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  section title  =======-->

                <div class="section-title section-title--one text-center">
                </div>

                <!--=======  End of section title  =======-->
            </div>
        </div>
    </div>
</div>
<div class="product-category-container mb-40 mb-md-40 mb-sm-40">
    <div class="container wide">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  product category wrapper  =======-->

                <div class="lezada-slick-slider product-category-slider wow fadeInUp"
                    data-slick-setting='{
							"slidesToShow": 3,
							"arrows": true,
							"autoplay": true,
							"autoplaySpeed": 1000,
							"speed": 1000,
							"prevArrow": {"buttonClass": "slick-{{ app()->getLocale() == 'en' ? 'prev' : 'next' }}", "iconClass": "ion-ios-arrow-thin-left" },
							"nextArrow": {"buttonClass": "slick-{{ app()->getLocale() == 'en' ? 'next' : 'prev' }}", "iconClass": "ion-ios-arrow-thin-right" }
						}'
                    data-slick-responsive='[
							{"breakpoint":1501, "settings": {"slidesToShow": 3} },
							{"breakpoint":1199, "settings": {"slidesToShow": 3} },
							{"breakpoint":991, "settings": {"slidesToShow": 2, "arrows": false} },
							{"breakpoint":767, "settings": {"slidesToShow": 1, "arrows": false} },
							{"breakpoint":575, "settings": {"slidesToShow": 1, "arrows": false} },
							{"breakpoint":479, "settings": {"slidesToShow": 1, "arrows": false} }
						]'>
                    @foreach ($banners as $item)
                        <div class="col">
                            <!--=======  single category  =======-->

                            <div class="single-category single-category--two">
                                <!--=======  single category image  =======-->
                                @php
                                            // $separateImages = explode('/',  $item->photo);
                                            // $image_name=end($separateImages);
                                            // $image_name='https://alsahabapp.com/thumbs-banner/'.$item->id.'/'.end($separateImages);
                                            $image_name = $item->photo;

                                @endphp
                                @if ($item->type == 'category')
                                    <a href="{{ url(app()->getLocale() . '/shop?category=' . $item->slug) }}"
                                        rel="alternate" hreflang="{{ app()->getLocale() }}">
                                        <img rel="preload"   data-src='{{$image_name}}' class="lazy img-fluid"  alt="{{ $item->title }}" title="{{ $item->title }}"></a>
                                @elseif($item->type == 'offer')
                                    <a
                                        href="{{ isset($settings['whatsup']) ? unserialize($settings['whatsup']) . '?text=Hi , I need this offer ' . $item->description : '' }}"
                                        rel="alternate" hreflang="{{ app()->getLocale() }}">
                                        <img rel="preload"   data-src='{{$image_name}}' class="lazy img-fluid"  alt="{{ $item->title }}" title="{{ $item->title }}"></a>
                                @endif
                                <div class="single-category__content single-category__content--two mt-25">
                                    <div class="title">
                                        @if ($item->type == 'category')
                                            <a href="{{ url(app()->getLocale() . '/shop?category=' . $item->slug) }}"
                                                rel="alternate" hreflang="{{ app()->getLocale() }}">
                                                {{ $item->title }}
                                            </a>
                                        @elseif($item->type == 'offer')
                                            <a href="{{ isset($settings['whatsup']) ? unserialize($settings['whatsup']) . '?text=Hi , I need this offer ' . $item->description : '' }}"
                                                rel="alternate" hreflang="{{ app()->getLocale() }}">
                                                {{ $item->title }}
                                            </a>
                                        @endif
                                    </div>
                                    @if (app()->getLocale() == 'ar')
                                        @if ($item->type == 'category')
                                            <p class="product-count">صنف </p>
                                        @elseif($item->type == 'offer')
                                            <p class="product-count"> عرض </p>
                                        @endif
                                    @endif
                                    @if (app()->getLocale() == 'en')
                                        <p class="product-count">
                                            @if ($item->type == 'category')
                                                @php
                                                    $category = App\Models\Category::where('slug', $item->slug)->first();
                                                    $productCount = $category ? count($category->products) : 0;
                                                @endphp
                                                {{ $productCount }}
                                            @else
                                                {{ $item->type }}
                                            @endif
                                        </p>
                                    @endif

                                    @if (app()->getLocale() == 'tr')
                                        @if ($item->type == 'category')
                                            <p class="product-count">kategori </p>
                                        @elseif($item->type == 'offer')
                                            <p class="product-count"> teklif </p>
                                        @endif
                                    @endif
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                <!--=======  End of product category wrapper  =======-->
            </div>
        </div>
    </div>
</div>

@if (app()->getLocale() == 'en' || app()->getLocale() == 'tr')
    @if ($banners->where('type', 'offer')->where('description', '!=', '')->where('description', '!=', '<br>')->count() > 0)
        <marquee direction="left" class="hot-news">
            @foreach ($banners as $banner)
                @if ($banner->type == 'offer')
                    @if ($banner->description)
                        <span class="hot-news-description">
                            <img src="{{ asset('frontend/images/SVG/Logo News 30 x 30.svg') }}" alt="Logo"  title="Logo"
                                class="hot-news-logo">
                            <?php
                            $str = " $banner->description ";
                            echo trim($str, '<br>');
                            ?>

                        </span>
                    @endif
                @endif
            @endforeach


        </marquee>

    @endif
@endif


@if (app()->getLocale() == 'ar')
    @if ($banners->where('type', 'offer')->where('description', '!=', '')->where('description', '!=', '<br>')->count() > 0)
        <marquee direction="right" class="hot-news">
            @foreach ($banners as $banner)
                @if ($banner->type == 'offer')
                    <span class="hot-news-description">
                        <?php
                        $str = str_replace('<br>', ' ', $banner->description);
                        echo trim($str);
                        ?>
                        <img src="{{ asset('frontend/images/SVG/Logo News 30 x 30.svg') }}" alt="Logo" title="Logo"
                            class="hot-news-logo">
                    </span>
                @endif
            @endforeach
        </marquee>
    @endif
@endif
