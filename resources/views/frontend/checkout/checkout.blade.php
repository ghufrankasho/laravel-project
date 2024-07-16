@extends('layouts.master')

@section('content')
    <div class="breadcrumb-area breadcrumb-bg-1 pt-50 pb-70 mb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="breadcrumb-title"> {{ __('messages.CHECKOUT') }}</h1>
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-list__item">
                            <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.HOME') }}
                            </a>
                        </li>
                        <li class="breadcrumb-list__item breadcrumb-list__item--active">
                            {{ __('messages.CHECKOUT') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-page-area mb-130">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div Class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="lezada-form">
                        <!-- Checkout Form s-->
                        <form action="{{ route('checkout.store', app()->getLocale()) }}" class="checkout-form"
                            method="POST">
                            <div class="row row-40">
                                <div class="col-lg-7 mb-20">
                                    @csrf
                                    <!-- Billing Address -->
                                    <div id="billing-form" class="mb-40">
                                        <h4 class="checkout-title">{{ __('messages.BILLING ADDRESS') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6 col-12 mb-20">
                                                <label>{{ __('messages.FIRST NAME*') }}</label>
                                                <input type="text" name="first_name" placeholder="{{ __('messages.FIRST NAME*') }}"
                                                    value="{{ old('first_name') }}">
                                            </div>
                                            <div class="col-md-6 col-12 mb-20">
                                                <label>{{ __('messages.LAST NAME*') }}</label>
                                                <input type="text" name="last_name" placeholder="{{ __('messages.LAST NAME*') }}"
                                                    value="{{ old('last_name') }}">
                                            </div>

                                            <div class="col-md-6 col-12 mb-20">
                                                <label>{{ __('messages.EMAIL ADDRESS*') }}</label>
                                                <input type="email" required name="email"
                                                    placeholder="{{ __('messages.EMAIL ADDRESS*') }}"
                                                    value="{{ old('email') }}">
                                            </div>

                                            <div class="col-md-6 col-12 mb-20">
                                                <label>{{ __('messages.PHONE NUMBER') }}</label>
                                                <input type="text" required name="mobile_number"
                                                    placeholder="{{ __('messages.PHONE NUMBER') }}"
                                                    value="{{ old('mobile_number') }}">
                                            </div>


                                            <div class="col-12 mb-20">
                                                <label>{{ __('messages.ADDRESS') }}</label>
                                                <input type="text" required name="address"
                                                    placeholder="{{ __('messages.ADDRESS') }}" value="{{ old('address') }}">
                                            </div>

                                            <div class="col-md-6 col-12 mb-20">
                                                <label>{{ __('messages.COUNTRY*') }}</label>
                                                <input type="text" required name="country"
                                                    placeholder="{{ __('messages.COUNTRY*') }}" value="{{ old('country') }}">
                                            </div>

                                            <div class="col-md-6 col-12 mb-20">
                                                <label>{{ __('messages.TOWN/CITY*') }}</label>
                                                <input type="text" required name="city"
                                                    placeholder="{{ __('messages.TOWN/CITY*') }}" value="{{ old('city') }}">
                                            </div>

                                            <!--<div class="col-md-6 col-12 mb-20">-->
                                            <!--    <label>{{ __('messages.STATE*') }}</label>-->
                                            <!--    <input type="text" required name="state" placeholder="{{ __('messages.STATE*') }}"-->
                                            <!--        value="{{ old('State') }}">-->
                                            <!--</div>-->

                                            <!--<div class="col-md-6 col-12 mb-20">-->
                                            <!--    <label>{{ __('messages.ZIP CODE*') }}</label>-->
                                            <!--    <input type="text" required name="zip_code"-->
                                            <!--        placeholder="{{ __('messages.ZIP CODE*') }}" value="{{ old('zip_code') }}">-->
                                            <!--</div>-->
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-5">
                                    <div class="row">
                                        <!-- Cart Total -->
                                        <div class="col-12 mb-60">
                                            <h4 class="checkout-title">{{ __('messages.CART TOTALS') }}</h4>
                                            @include('frontend.elements.render.checkout-cart-total')
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
