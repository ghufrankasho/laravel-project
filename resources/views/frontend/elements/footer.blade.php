{{--<style>
    .fontawesomesvg {width: 1em;
      height: 1em;
      vertical-align: -.125em;
      margin-left: -10px;
    }
  </style>--}}
<div class="footer footer--three " id="footer" style="background-color:#F4F4F5 !important">
    <br/>
    <br/>
    <br/>
    <div class="container wide">
        <div class="row">
            {{-- Logo --}}
            <div class="col footer-single-widget order-last order-md-first">
                <div class="logo">
                    <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                        <img src="{{ asset('frontend/images/SVG/Logo Footer 103 x 100-01.svg') }}" class="img-fluid" alt="{{ __('messages.HOME') }}" title="{{ __('messages.HOME') }}" style="height:150px">
                    </a>

                </div>
            
                        
                    
            
    
                <!--<div class="copyright-text">-->
                <!--	<p> © 2021 RUSH PERFUMERY. <span>{{__('messages.ALL RIGHTS RESERVED')}}</span></p>-->
                <!--</div>-->
            </div>
            <div class="col footer-single-widget">
                <!--=======  single widget  =======-->
                <h5 class="widget-title">{{__('messages.SITEMAP')}}</h5>

                <!--=======  footer navigation container  =======-->

                <div class="footer-nav-container"style="margin-bottom: -50px;">
                    <nav>
                        <ul class="sub-menu single-column-menu single-column-has-children">
                            <li>
                                <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                    {{__('messages.HOME')}}
                                </a>
                            </li>
                            <li> <a href="{{ url(app()->getLocale() . '/category/shop') }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.STORE') }}
                            </a></li>
                        
                            <li >
                                <a href="{{ url(app()->getLocale() . '/services') }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                    {{ __('messages.SERVICES') }}
                                </a>
                            
                            </li>
                            
                    
                        </ul>
                    </nav>
                </div>
            </div>
        
            <div class="col footer-single-widget">
                <!--=======  single widget  =======-->
                <h5 class="widget-title"> </h5>
                <br/>

                <!--=======  footer navigation container  =======-->

                <div class="footer-nav-container">
                    <nav>
                        <ul>
                            <li> <a href="{{ url(app()->getLocale() . '/contact') }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                {{__('messages.CONTACT')}}
                            </a></li>
                        
                            <li><a href="{{ url(app()->getLocale().'/blogs') }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.BLOGS') }}
                            </a></li>
                            
                        
                            <li >
                                <a href="{{ url(app()->getLocale() . '/page/terms-conditions') }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                    {{ __('messages.TERMS & CONDITIONS') }}
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!--=======  End of footer navigation container  =======-->

                <!--=======  single widget  =======-->
            </div>
            <div class="col footer-single-widget mob-1" style="margin-bottom: -14px;">
                <!--=======  single widget  =======-->
                <h5 class="widget-title">{{__('messages.FOLLOW US ON')}}</h5>

                <!--=======  footer navigation container  =======-->

                <div class="footer-nav-container">
                    <nav>
                        <ul class="sub-menu single-column-menu single-column-has-children">
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['location']) ? unserialize($settings['location']) : '' }}"><img src="{{ asset('frontend/images/SVG/Location Icon 15 x 15-01.svg') }}" class="img-fluid le-1" alt="{{ __('messages.LOCATION') }}" title="{{ __('messages.LOCATION') }}" width="20px"> {{__('messages.LOCATION')}} </a></li>
                            <li><a  rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['whatsup']) ? unserialize($settings['whatsup']) : '' }}"> <img src="{{ asset('frontend/images/SVG/WhatsApp Icon 15 x 15-01.svg') }}" class="img-fluid" alt="{{ __('messages.WHATSAPP') }}" title="{{ __('messages.WHATSAPP') }}" width="20px"> {{__('messages.WHATSAPP')}}</a></li>
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['instagram']) ? unserialize($settings['instagram']) : '' }}"><img src="{{ asset('frontend/images/SVG/Instagra Icon 15 x 15-01.svg') }}" class="img-fluid le-2" alt="{{ __('messages.INSTAGRAM') }}" title="{{ __('messages.INSTAGRAM') }}" width="20px"> {{__('messages.INSTAGRAM')}}</a></li>

                        </ul>
                    </nav>
                </div>
            </div>
		{{-- <div class="col footer-single-widget">
                <!--=======  single widget  =======-->
                <h5 class="widget-title">{{ __('messages.FOLLOW US ON') }}</h5>

                <!--=======  footer navigation container  =======-->

                <div class="footer-nav-container footer-social-links">
                    <nav>
                        <ul>
                            <li><a href=""><img src="{{ asset('frontend/images/SVG/Location Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px"> {{__('messages.LOCATION')}} </a></li>
                            <li><a href="{{ isset($settings['whatsup']) ? unserialize($settings['whatsup']) : '' }}"> <img src="{{ asset('frontend/images/SVG/WhatsApp Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px"> {{__('messages.WHATSAPP')}}</a></li>
                            <li><a href="{{ isset($settings['instagram']) ? unserialize($settings['instagram']) : '' }}"><img src="{{ asset('frontend/images/SVG/Instagra Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px"> {{__('messages.INSTAGRAM')}}</a></li>
                            
                        </ul>
                    </nav>
                </div>

                <!--=======  End of footer navigation container  =======-->


                <!--=======  single widget  =======-->
            </div> --}}
            {{-- <div class="col footer-single-widget">
                <!--=======  single widget  =======-->
                <h5 class="widget-title"></h5>

                <!--=======  footer navigation container  =======-->

                <div class="footer-nav-container">
                    <nav>
                        <ul class="sub-menu single-column-menu single-column-has-children">
                            
                            <li><a href="{{ isset($settings['facebook']) ? unserialize($settings['facebook']) : '' }}"><img src="{{ asset('frontend/images/SVG/Facebook Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px"> {{__('messages.FACEBOOK')}} </a></li>
                            <li><a href="{{ isset($settings['tiktok']) ? unserialize($settings['tiktok']) : '' }}"><img src="{{ asset('frontend/images/SVG/TikTok Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px"> {{__('messages.TIKTOK')}} </a></li>
                            <li><a href="{{ isset($settings['pinterest']) ? unserialize($settings['pinterest']) : '' }}"><img src="{{ asset('frontend/images/SVG/Pinterst Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px"> {{__('messages.PINTERIST')}}</a></li>
                                       
                                  
                        </ul>
                    </nav>
                </div>
            </div> --}}

            <div class="col footer-single-widget mob-1">
                <!--=======  single widget  =======-->
                <h5 class="widget-title"> </h5>
                <br/>

                <!--=======  footer navigation container  =======-->

                <div class="footer-nav-container">
                    <nav>
                        <ul>
                           
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['facebook']) ? unserialize($settings['facebook']) : '' }}"><img src="{{ asset('frontend/images/SVG/Facebook Icon 15 x 15-01.svg') }}" class="img-fluid " alt="{{ __('messages.FACEBOOK') }}" title="{{ __('messages.FACEBOOK') }} " width="20px"> {{__('messages.FACEBOOK')}} </a></li>
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['tiktok']) ? unserialize($settings['tiktok']) : '' }}"><img src="{{ asset('frontend/images/SVG/TikTok Icon 15 x 15-01.svg') }}" class="img-fluid le-3" alt="{{ __('messages.TIKTOK') }}" title="{{ __('messages.TIKTOK') }} " width="20px">     {{__('messages.TIKTOK')}} </a></li>
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['pinterest']) ? unserialize($settings['pinterest']) : '' }}"><img src="{{ asset('frontend/images/SVG/Pinterst Icon 15 x 15-01.svg') }}" class="img-fluid le-4" alt="{{ __('messages.PINTERIST') }}" title="{{ __('messages.PINTERIST') }} " width="20px"> {{__('messages.PINTERIST')}}</a></li>

                         
                        </ul>
                    </nav>
                </div>

                <!--=======  End of footer navigation container  =======-->

                <!--=======  single widget  =======-->
            </div>
            {{-- <div class="col footer-single-widget">
                <!--=======  single widget  =======-->
               

                <!--=======  footer navigation container  =======-->

                <div class="footer-nav-container footer-social-links"  style="margin-top: 45px;">
                    <nav>
                        <ul>
                            <li><a href="{{ isset($settings['facebook']) ? unserialize($settings['facebook']) : '' }}"><img src="{{ asset('frontend/images/SVG/Facebook Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px"> {{__('messages.FACEBOOK')}} </a></li>
                            <li><a href="{{ isset($settings['tiktok']) ? unserialize($settings['tiktok']) : '' }}"><img src="{{ asset('frontend/images/SVG/TikTok Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px">
                                {{__('messages.TIKTOK')}} </a></li>
                            <li><a href="{{ isset($settings['pinterest']) ? unserialize($settings['pinterest']) : '' }}"><img src="{{ asset('frontend/images/SVG/Pinterst Icon 15 x 15-01.svg') }}" class="img-fluid" alt="" width="20px"> {{__('messages.PINTERIST')}}</a></li>
                            
                        </ul>
                    </nav>
                </div>

                <!--=======  End of footer navigation container  =======-->


                <!--=======  single widget  =======-->
            </div> --}}
            <div class="col footer-single-widget mob" >
                <!--=======  single widget  =======-->
                <h5 class="widget-title">{{__('messages.FOLLOW US ON')}}</h5>
            
                <!--=======  footer navigation container  =======-->
            
                <div class="footer-nav-container ">
                    <nav>
                        <ul class="sub-menu single-column-menu single-column-has-children" style="display: block ruby;">
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['location']) ? unserialize($settings['location']) : '' }}"><img src="{{ asset('frontend/images/SVG/Location Icon 15 x 15-01.svg') }}" class="img-fluid le-1" alt="{{ __('messages.LOCATION') }}" title="{{ __('messages.LOCATION') }} " width="32px">  </a></li>
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['whatsup']) ? unserialize($settings['whatsup']) : '' }}"> <img src="{{ asset('frontend/images/SVG/WhatsApp Icon 15 x 15-01.svg') }}" class="img-fluid" alt="{{ __('messages.WHATSAPP') }}" title="{{ __('messages.WHATSAPP') }} " width="32px"> </a></li>
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['instagram']) ? unserialize($settings['instagram']) : '' }}"><img src="{{ asset('frontend/images/SVG/Instagra Icon 15 x 15-01.svg') }}" class="img-fluid le-2" alt="{{ __('messages.INSTAGRAM') }}" title="{{ __('messages.INSTAGRAM') }} " width="32px"> </a></li>
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['facebook']) ? unserialize($settings['facebook']) : '' }}"><img src="{{ asset('frontend/images/SVG/Facebook Icon 15 x 15-01.svg') }}" class="img-fluid " alt="{{ __('messages.FACEBOOK') }}" title="{{ __('messages.FACEBOOK') }} " width="32px"></a></li>
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['tiktok']) ? unserialize($settings['tiktok']) : '' }}"><img src="{{ asset('frontend/images/SVG/TikTok Icon 15 x 15-01.svg') }}" class="img-fluid le-3" alt="{{ __('messages.TIKTOK') }}" title="{{ __('messages.TIKTOK') }} " width="32px"> </a></li>
                            <li><a rel="alternate" hreflang="{{app()->getLocale()}}" href="{{ isset($settings['pinterest']) ? unserialize($settings['pinterest']) : '' }}"><img src="{{ asset('frontend/images/SVG/Pinterst Icon 15 x 15-01.svg') }}" class="img-fluid le-4" alt="{{ __('messages.PINTERIST') }}" title="{{ __('messages.PINTERIST') }} " width="32px"></a></li>
            

                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>
<br/>

<div class="copyright-text mb-91 foot-1 text-center">
    {{ __('messages.COPYRIGHT RESERVED ... AL SAHABA PRINTING PRESS - 2023') }}
</div>

<div class="copyright-text mb-91 foot-2 text-center">
    {{ __('messages.COPYRIGHT RESERVED') }}<br />
    {{ __('messages.AL SAHABA PRINTING PRESS - 2023') }}
</div>
<br/>