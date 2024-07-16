@extends('layouts.master')

@section('content')
@section('title','Page Not Fpund');
<!--main area-->
<section class="error-404">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="error-logo">
                    <div class="the-logo">
                        <a href="index.html">
                            <img src="{{asset('frontend/images/logo-404.svg')}}" alt="{{__('Page Not Found')}}">
                        </a>
                    </div>
                </div>
                <div class="page-content">
                    <h1>{{__('404')}}</h1>
                    <h2>{{__('Sorry! Page Not Found!')}}</h2>
                    <p>{{__('Oops! The page you are looking for does not exist. Please return to the site’s homepage.')}}</p>
                    
                    <div class="ot-button">
                        <a href="{{url('/')}}" class="octf-btn octf-btn-light no-line">{{__('home')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--main area-->
@endsection