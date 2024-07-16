@extends('backend.layouts.master')
@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('product.index') }}" class="nav-link">{{ __('List Products') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('properties.index', ['productId' => $property->products->id]) }}" class="nav-link">
            {{ __('List Properties') }} 
        </a>
    </li>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Property') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ __('Edit Property') }}</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-12">
                @if ($errors->any())
                    <div Class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div><!-- /.container-fluid -->

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit Property') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('properties.update', $property->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-row">
                        <!-- Name -->
                        @foreach (config('translatable.locales') as $locale)
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label for="name_{{ $locale }}">
                                    {{ __('Name') }}
                                    ({{ strtoupper($locale) }})
                                </label>
                                <input type="text" value="{{ $translations[$locale]['name'] }}"
                                    name="{{ $locale }}[name]" class="form-control"
                                    placeholder="{{ __('Enter name') }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label>{{ __('Value') }}</label>
                            <input type="number" value="{{ $property->value }}" name="value" class="form-control"
                                placeholder="{{ __('Enter Value') }}">
                        </div>


                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Product') }}</label>
                            <select id="product_id" name="product_id" class="form-control">
                                <option value="{{ $property->products->id }}">
                                    {{ $property->products->title }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ config('app.url') }}vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image', {
            prefix: "{{ config('app.app_link_file_manager') }}"
        });
        $('#en-description').summernote();
        $('#ar-description').summernote();
    </script>
@endsection
