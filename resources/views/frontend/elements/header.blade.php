<header class="header  header-offcanvas-about  header-sticky">
    <div class="header-bottom pt-md-40 pb-md-40 pt-sm-40 pb-sm-40"
        style="padding-top:0px !important;padding-bottom:0px !important">
        <div class="container wide">
            <div class="header-bottom-container">


                <div class="logo-with-offcanvas d-flex">
                    <div class="offcanvas-about-icon mr-20 d-none d-lg-block" style="margin-top: 3px;">
                        <a href="javascript:void(0)" id="offcanvas-about-icon">
                            <i class="ion-navicon"></i>
                        </a>
                    </div>
                    <div class="logo log">
                        <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                            <img src="{{ asset('frontend/images/SVG/Logo Header 190 x 30-01.svg') }}" class="img-fluid" alt="{{ __('messages.HOME') }}" title="{{ __('messages.HOME') }}"
                                 style="width: 210px;">&nbsp;

                        </a>
                    </div>
                </div>

                <div class="header-bottom-navigation">
                    <div class="site-main-nav d-none d-lg-block">
                        <nav class="site-nav center-menu">
                            <ul>
                                <li class="{{ \Request::segment(2) == '' ? 'active' : '' }}">
                                    <a href="{{ url(app()->getLocale()) }}" rel="alternate"
                                        hreflang="{{ app()->getLocale() }}">
                                        {{ __('messages.HOME') }}
                                    </a>
                                </li>
                                <li class="{{ \Request::segment(3) == 'shop' ? 'active' : '' }}">
                                    <a href="{{ url(app()->getLocale() . '/category/shop') }}" rel="alternate"
                                        hreflang="{{ app()->getLocale() }}">
                                        {{ __('messages.STORE') }}
                                    </a>
                                </li>


                                <li class=" menu-item-has-children {{ \Request::segment(2) == 'services'|| \Request::segment(2) == 'service' ? 'active' : '' }}  ">
                                    <a 
                                        href="{{ url(app()->getLocale() . '/services') }}" rel="alternate"
                                        hreflang="{{ app()->getLocale() }}">
                                        {{ __('messages.SERVICES') }}
                                    </a>
                                    <ul class="sub-menu single-column-menu">
                                        @foreach ($services as $service)
                                            <li class="{{ \Request::segment(2) == '' ? 'active' : '' }}">
                                                <a rel="alternate" hreflang="{{ app()->getLocale() }}"
                                                    href="{{ url(app()->getLocale() . '/service/' . $service->slug) }}">
                                                    {{ $service->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                {{-- <li class="{{ \Request::segment(2) == 'blogs' || \Request::segment(2) == 'blog-detail'   ? 'active' : '' }}">
                                    <a rel="alternate" hreflang="{{ app()->getLocale() }}" 
                                        href="{{ url(app()->getLocale() . '/blogs') }}">
                                        {{ __('messages.BLOGS') }}
                                    </a>
                                </li> --}}
                                <li class="{{ \Request::segment(3) == 'about-us' ? 'active' : '' }}">
                                    <a href="{{ url(app()->getLocale() . '/page/about-us') }}" rel="alternate"
                                        hreflang="{{ app()->getLocale() }}">
                                        {{ __('messages.ABOUT') }}
                                    </a>
                                </li>


                                <li class="{{ \Request::segment(2) == 'contact' ? 'active' : '' }}">
                                    <a href="{{ url(app()->getLocale() . '/contact') }}" rel="alternate"
                                        hreflang="{{ app()->getLocale() }}">
                                        {{ __('messages.CONTACT') }}
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="header-right-container">
                    <div class="header-right-icons d-flex justify-content-end align-items-center h-100">


                        <div class="single-icon wishlist">
                            @php
                                $currentUrl = url()->full(); // Get the current URL
                                $newUrl = $currentUrl;
                                
                                if (app()->getLocale() == 'en') {
                                    $newUrl = str_replace('/en/', '/ar/', $currentUrl);
                                } else {
                                    $newUrl = str_replace('/ar/', '/en/', $currentUrl);
                                }
                                
                                // Remove "/public" from URL if it appears after the domain
                                $newUrl = preg_replace('/^(.*?\/\/.*?\/)public\//', '$1', $newUrl);
                            @endphp
                                @if(\Request::segment(2) == '')
                                <a href="{{ url('/ar') }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                    <img src="{{ asset('frontend/images/SVG/UAE Flage 20 x 20-01.svg') }}"
                                        class="img-fluid" alt="uae flag" width="20px">
                                </a>

                                <a href="{{ url('/en') }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                    <img src="{{ asset('frontend/images/SVG/UK Flage 20 x 20-01.svg') }}" class="img-fluid"
                                        alt="uk flag" width="20px">
                                </a>
                                
                                @else
                            <a href="{{ $newUrl }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                <img src="{{ asset('frontend/images/SVG/UAE Flage 20 x 20-01.svg') }}"
                                    class="img-fluid" alt="uae flag" title="uae flag" width="20px">
                            </a>

                            <a href="{{ $newUrl }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                <img src="{{ asset('frontend/images/SVG/UK Flage 20 x 20-01.svg') }}" class="img-fluid"
                                    alt="uk flag" title="uk flag" width="20px">
                            </a>
                             @endif
                            {{-- <a href="{{ url('/tr') }}"> <img
                                    src="{{ asset('frontend/images/SVG/Turkey Flage 20 x 20-01.svg') }}"
                                    class="img-fluid" alt="" width="20px"></a> --}}
                        </div>
                        <div class="single-icon cart">
                            <a href="javascript:void(0)" id="offcanvas-cart-icon">
                                <div id="header-ajax" style="margin-top: 10px;">
                                    @include('frontend.elements.render.count')
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="site-mobile-navigation d-block d-lg-none">
                <div id="dl-menu" class="dl-menuwrapper site-mobile-nav">
                    <!--Site Mobile Menu Toggle Start-->
                    <button class="dl-trigger hamburger hamburger--spin">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                    <!--Site Mobile Menu Toggle End-->
                    <ul class="dl-menu dl-menu-toggle">
                        <li class="{{ \Request::segment(2) == '' ? 'active' : '' }}">
                            <a href="{{ url(app()->getLocale()) }}" rel="alternate"
                                hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.HOME') }}
                            </a>
                        </li>
                        <li class="{{ \Request::segment(2) == 'shop' ? 'active' : '' }}">
                            <a href="{{ url(app()->getLocale() . '/category/shop') }}" rel="alternate"
                                hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.STORE') }}
                            </a>
                        </li>

                        <li class=""><a  href="#"> {{ __('messages.SERVICES') }}</a>

                            <ul class="dl-submenu">
                                @foreach ($services as $service)
                                    <li class="{{ \Request::segment(2) == '' ? 'active' : '' }}">
                                        <a rel="alternate" hreflang="{{ app()->getLocale() }}"
                                            href="{{ url(app()->getLocale() . '/service/' . $service->slug) }}">
                                            {{ $service->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>


                        </li>

                        {{-- <li class=" menu-item-has-children">
                        <a class="{{ \Request::segment(2) == 'services' ? 'active' : '' }}  " href="{{ url(app()->getLocale() . '/services') }}">
                            {{ __('messages.SERVICES') }}
                        </a>
                        <ul class="sub-menu single-column-menu">
                            @foreach ($services as $service)
                            <li class="{{ \Request::segment(2) == '' ? 'active' : '' }}">
                                <a rel="alternate" hreflang="{{ app()->getLocale() }}"
                                    href="{{ url(app()->getLocale() . '/service/'.$service->slug) }}">
                                    {{ $service->title }}
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    </li> --}}
                        <li class="{{ \Request::segment(3) == 'about-us' ? 'active' : '' }}">
                            <a href="{{ url(app()->getLocale() . '/page/about-us') }}" rel="alternate"
                                hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.ABOUT US') }}
                            </a>
                        </li>



                        <li class="{{ \Request::segment(2) == 'contact' ? 'active' : '' }}">
                            <a href="{{ url(app()->getLocale() . '/contact') }}" rel="alternate"
                                hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.CONTACT US') }}
                            </a>
                        </li>



                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="header-offcanvas about-overlay" id="about-overlay">
    <div class="overlay-close inactive"></div>
    <div class="overlay-content">

        <!--=======  close icon  =======-->


        <span class="close-icon" id="about-close-icon">
            <a href="javascript:void(0)">
                <i class="ti-close"></i>
            </a>
        </span>

        <!--=======  End of close icon  =======-->

        <!--=======  overlay content container  =======-->

        <div class="overlay-content-container d-flex flex-column justify-content-between h-100">
            <!--=======  widget wrapper  =======-->

            <div class="widget-wrapper">
                <!--=======  single widget  =======-->

                <div class="single-widget">
                    <h2 class="widget-title">{{ __('messages.About Us') }}</h2>
                    <p> {{ $aboutUs->description }} </p>
                </div>

                <!--=======  End of single widget  =======-->
            </div>

            <!--=======  End of widget wrapper  =======-->

            <!--=======  contact widget  =======-->

            <div class="contact-widget">
                <p class="email"><a rel="alternate" hreflang="{{ app()->getLocale() }}" href="">{{ isset($settings['email']) ? unserialize($settings['email']) : '' }}</a></p>
                <p class="phone">{{ isset($settings['phone']) ? unserialize($settings['phone']) : '' }}</p>

                <div class="social-icons">
                    <ul>
                        <li><a rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ isset($settings['location']) ? unserialize($settings['location']) : '' }}"
                                data-tippy="Location" data-tippy-inertia="true" data-tippy-animation="shift-away"
                                data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"
                                target="_blank"><img
                                    src="{{ asset('frontend/images/SVG/Location Icon 15 x 15-01.svg') }}"
                                    class="img-fluid" alt="icon" title="icon" width="20px"></i></a></li>
                        <li><a rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ isset($settings['whatsup']) ? unserialize($settings['whatsup']) : '' }}"
                                data-tippy="Whatsup" data-tippy-inertia="true" data-tippy-animation="shift-away"
                                data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"
                                target="_blank"><img
                                    src="{{ asset('frontend/images/SVG/WhatsApp Icon 15 x 15-01.svg') }}"
                                    class="img-fluid" alt="icon" title="icon" width="20px"></i></a></li>
                        <li><a rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ isset($settings['instagram']) ? unserialize($settings['instagram']) : '' }}"
                                data-tippy="Instagram" data-tippy-inertia="true" data-tippy-animation="shift-away"
                                data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"
                                target="_blank"><img
                                    src="{{ asset('frontend/images/SVG/Instagra Icon 15 x 15-01.svg') }}"
                                    class="img-fluid" alt="icon" title="icon" width="20px"></i></a></li>
                        <li><a rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ isset($settings['facebook']) ? unserialize($settings['facebook']) : '' }}"
                                data-tippy="Facebook" data-tippy-inertia="true" data-tippy-animation="shift-away"
                                data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"
                                target="_blank"> <img
                                    src="{{ asset('frontend/images/SVG/Facebook Icon 15 x 15-01.svg') }}"
                                    class="img-fluid" alt="icon" title="icon" width="20px"></i></a></li>
                        <li><a rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ isset($settings['tiktok']) ? unserialize($settings['tiktok']) : '' }}"
                                data-tippy="Tiktok" data-tippy-inertia="true" data-tippy-animation="shift-away"
                                data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"
                                target="_blank"> <img
                                    src="{{ asset('frontend/images/SVG/TikTok Icon 15 x 15-01.svg') }}"
                                    class="img-fluid" alt="icon"  title="icon" width="20px"></i></a></li>

                        <li><a rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ isset($settings['pinterest']) ? unserialize($settings['pinterest']) : '' }}"
                                data-tippy="Pinterest" data-tippy-inertia="true" data-tippy-animation="shift-away"
                                data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"
                                target="_blank"><img
                                    src="{{ asset('frontend/images/SVG/Pinterst Icon 15 x 15-01.svg') }}"
                                    class="img-fluid" alt="icon" title="icon" width="20px"></i></a></li>

                    </ul>
                </div>
            </div>

            <!--=======  End of contact widget  =======-->
        </div>

        <!--=======  End of overlay content container  =======-->
    </div>
</div>
