<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! JsonLd::generate() !!}
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="icon" href="{{ asset('frontend/images/SVG/Logo%20News%2030%20x%2030.svg') }}">

@php
    $lang = app()->getLocale() == 'tr' || app()->getLocale() == 'en' ? 'en' : 'ar';
@endphp
<!-- CSS
 ============================================ -->
<!-- Bootstrap CSS -->
<link href="{{ asset('frontend/css/bootstrap-' . $lang . '.min.css') }}" rel="stylesheet">

<!-- FontAwesome CSS -->
<link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Ionicons CSS -->
<link href="{{ asset('frontend/css/ionicons.min.css') }}" rel="stylesheet">

<!-- Themify CSS -->
<link href="{{ asset('frontend/css/themify-icons.css') }}" rel="stylesheet">

<!-- Plugins CSS -->
<link href="{{ asset('frontend/css/plugins-' . $lang . '.css') }}" rel="stylesheet">

<!-- Helper CSS -->
<link href="{{ asset('frontend/css/helper-' . $lang . '.css') }}" rel="stylesheet">

<!-- Main CSS -->
<link href="{{ asset('frontend/css/main-' . $lang . '.css') }}" rel="stylesheet">

{{-- for more data  --}}
<link href="{{ asset('frontend/css/style-' . $lang . '.css') }}" rel="stylesheet">

<!-- Revolution Slider CSS -->
{{-- 
<link href="{{ asset('frontend/css/settings-' . $lang . '.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/navigation-' . $lang . '.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/custom-setting.css') }}" rel="stylesheet"> --}}

<!-- Modernizer JS -->
<script src="{{ asset('frontend/js/vendor/modernizr-2.8.3.min.js') }}"></script>

{{-- install google analytics --}}

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-X1H0PQE91B"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-X1H0PQE91B');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-X1H0PQE91B">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-X1H0PQE91B');
</script>


<style>
    .swal-overlay {
        z-index: 10000000000000 !important
    }

    body.active-body-search-overlay {
        overflow: auto !important
    }

    @media (max-width: 479px) {
        .pagination-lg .custom-pagination {
            --bs-pagination-padding-x: 0.7rem;
            --bs-pagination-padding-y: 0.75rem;
            --bs-pagination-font-size: 1.25rem;
            --bs-pagination-border-radius: 0.5rem;
        }
    }
</style>
