@extends('layouts.master')

@section('content')
    <div class="breadcrumb-area breadcrumb-bg-1 pt-50 pb-70 mb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="breadcrumb-title">{{ __('messages.SHOPPING CART') }}</h1>
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-list__item">
                            <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.HOME') }}
                            </a>
                        </li>
                        <li class="breadcrumb-list__item breadcrumb-list__item--active">
                            {{ __('messages.SHOPPING CART') }}
                        </li>
                    </ul>

                    <!--=======  End of breadcrumb list  =======-->

                </div>
            </div>
        </div>
    </div>

    <div class="shopping-cart-area mb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="cart-table-container" id="cart-list">
                        @include('frontend.elements.render.cart-list')
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
