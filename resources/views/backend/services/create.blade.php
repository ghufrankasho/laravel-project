@extends('backend.layouts.master')
@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('service.index') }}" class="nav-link">{{ __('List Services') }}</a>
    </li>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Create service') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ __('Create service') }}</li>
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
                <h3 class="card-title">{{ __('Create service') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{str_replace('http://', 'https://', secure_url(route('service.store'))) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <!-- Name -->
                        @foreach (config('translatable.locales') as $locale)
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label for="title_{{ $locale }}">
                                    {{ __('Title') }}
                                    ({{ strtoupper($locale) }})
                                </label>
                                <input type="text" value="{{ old($locale . '.title') }}"
                                    name="{{ $locale }}[title]" class="form-control"
                                    placeholder="{{ __('Enter title') }}">
                            </div>
                            <div class="col-lg-6  col-md-12 mb-3">
                                <label>
                                    {{ __('Summary') }}
                                    ({{ strtoupper($locale) }})
                                </label>
                                <textarea id="{{ $locale }}-summary" name="{{ $locale }}[summary]" class="form-control col-lg-12"
                                    placeholder="{{ __('Enter Summary') }}">
                                    {{ old($locale . '[summary]') }}
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
                                    value="{{ old('photo') }}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                      
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                    {{ __('Active') }}
                                </option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6  col-md-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" id="is_parent" name="is_parent" type="checkbox" checked
                                    value="1">
                                <label class="form-check-label">{{ __('Is Parent') }}</label>
                            </div>
                        </div>
                        <div class="col-lg-6  col-md-12 mb-3 parent">
                            <label>{{ __('Parent service') }}</label>
                            <select name="parent_id" id="parentId" class="form-control">
                                <option value="">{{ __('Select Parent') }}</option>
                                @foreach ($parentService as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('parent_id') == $service->parent_id ? 'selected' : '' }}>
                                        {{ $service->title }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
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
        $('#parentId').val('');
        $('#lfm').filemanager('image', {
            prefix: "{{ config('app.app_link_file_manager') }}"
        });
        $('#en-summary').summernote();
        $('#ar-summary').summernote();
        $('#tr-summary').summernote();

        // idden the parent service 
        $('.parent').css('display', 'none');
        // if the parent set true ==> hide the parent id list
        $('#is_parent').on('change', function() {
            let isChecked = $(this).prop('checked');
            if (isChecked) {
                $('.parent').css('display', 'none');
            } else {
                $('.parent').css('display', 'block');
            }
        });
    </script>
@endsection
