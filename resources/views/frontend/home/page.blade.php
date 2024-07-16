@extends('layouts.master')

@section('content')
<div class="breadcrumb-area breadcrumb-bg-3 pt-50 pb-70 mb-100" style="margin-left: 0px;margin-right: 0px;">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="breadcrumb-title">{{ $page->name }}</h1>

                <!--=======  breadcrumb list  =======-->

                <ul class="breadcrumb-list">
                    <li class="breadcrumb-list__item">
                        <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                            {{ __('messages.HOME') }}
                        </a>
                    </li>
                    <li class="breadcrumb-list__item breadcrumb-list__item--active">
                        {{ $page->name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="about-page-content mb-100 mb-sm-45">
    <div class="container">

        <div class="row">

            <div class="col-lg-6 mb-md-50 mb-sm-50">
                <!--=======  about page 2 image  =======-->

                <div class="about-page-2-image">
                    {{-- <img src="{{ $page->photo }}" class="img-fluid" alt=""> --}}
                    <img src=" {{ $page->photo }}" class="img-fuild" alt="{{ $page->title }}" title="{{ $page->title }}">
                </div>

                <!--=======  End of about page 2 image  =======-->
            </div>

            <div class="offset-xl-1 col-xl-4 mb-sm-50">
                <div class="">
                    <div class="about-page-text">
                        {!! $page->description !!}
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
@endsection
