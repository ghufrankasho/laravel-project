@extends('backend.layouts.master')
@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('banner.index') }}" class="nav-link">{{ __('List Banners') }}</a>
    </li>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Banner') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ __('Edit Banner') }}</li>
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
                <h3 class="card-title">{{ __('Edit Banner') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{str_replace('http://', 'https://', route('banner.update', $banner->id))  }}" method="post">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-row">
                        <!-- Name -->
                        @foreach (config('translatable.locales') as $locale)
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label for="title_{{ $locale }}">
                                    {{ __('Title') }}
                                    ({{ strtoupper($locale) }})
                                </label>
                                <input type="text" value="{{ $translations[$locale]['title'] }}"
                                    name="{{ $locale }}[title]" class="form-control"
                                    placeholder="{{ __('Enter title') }}">
                            </div>
                            <div class="col-lg-6  col-md-12 mb-3">
                                <label>
                                    {{ __('Description') }}
                                    ({{ strtoupper($locale) }})
                                </label>
                                <textarea id="{{ $locale }}-description" name="{{ $locale }}[description]" class="form-control col-lg-12"
                                    placeholder="{{ __('Enter Description') }}">
                                                {{ old($locale . '.description') }}
                                                {{ $translations[$locale]['description'] }}
                                            </textarea>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label for="exampleInputFile">{{ __('Photo') }}</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo"
                                    value="{{ $banner->photo }}">
                            </div>
                            @if ($banner->photo)
                                <img src="{{ $banner->photo }}" class="mt-2" width="100px;">
                            @endif
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $banner->status == 'active' ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="inactive" {{ $banner->status == 'inactive' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col-lg-6  col-md-12 mb-3 ">
                            <label>{{ __('Type') }}</label>
                            <select name="type" class="form-control select-type">
                                <option value="category" {{ $banner->type == 'category' ? 'selected' : '' }}>
                                    {{ __('Category') }}
                                </option>
                                <option value="offer" {{ $banner->type == 'offer' ? 'selected' : '' }}>
                                    {{ __('Offer') }}
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-6  col-md-12 mb-3 parent">
                            <label>{{ __('Category') }}</label>
                            <select id="cat_id" name="cat_id" class="form-control">
                                {{-- <option value="">{{ __('Select Parent') }}</option> --}}
                                @foreach (\App\Models\Category::where('is_parent', '0')->get() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $banner->cat_id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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
        $('#tr-description').summernote();
        let ChoosedType =  "{{$banner->type == 'category' ? 'category' :'offer'}}"
        // hidden the parent category 
        $('.parent').css('display', ChoosedType  == 'category' ?   'block' : 'none');
        // if the parent set true ==> hide the parent id list
        $('.select-type').on('change', function() {
            let getValue = $(this).val();
            if (getValue == 'category') {
                $('.parent').css('display', 'block');
            } else {
                $('.parent').css('display', 'none');
            }
        });

        $('.is_parent').on('change', function() {
            let getValue = $(this).val();
            if (getValue == 'category') {
                $('.parent').css('display', 'block');
            } else {
                $('.parent').css('display', 'none');
            }
        });
    </script>
@endsection
