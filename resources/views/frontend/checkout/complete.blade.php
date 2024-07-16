@extends('layouts.master')

@section('content')
    <div class="breadcrumb-area breadcrumb-bg-1 pt-50 pb-70 mb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="breadcrumb-title"> {{ __('messages.SUCCESS ORDER') }}</h1>
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-list__item">
                            <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                                {{ __('messages.HOME') }}
                            </a>
                        </li>
                        <li class="breadcrumb-list__item breadcrumb-list__item--active">
                            {{ __('messages.ORDER ID IS PR# ') .$order->id}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-page-area mb-130">
        <div class="container text-center">
            <div class="row">
                <div class="col-12">
              
                    <div class="lezada-form">
                       <h1>{{__('messages.YOUR ORDER ID IS PR# ').$order->id}} </h1>
                       <p class="subtitle">
                           {{__('messages.YOUR ORDER HAS BEEN CREATED SUCCESSFULLY , YOU WILL RECEIVE EMAIL IN DETAIL ,THANK YOU')}}
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
