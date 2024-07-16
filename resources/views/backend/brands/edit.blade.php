@extends('backend.layouts.master')
@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('brand.index') }}" class="nav-link">{{ __('List Albums') }}</a>
    </li>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Album') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Edit Album') }}</li>
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
                <h3 class="card-title">{{ __('Edit Album') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{str_replace('http://', 'https://', route('brand.update', $brand->id)) }}" method="post">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-row">
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
                                <textarea id="{{ $locale }}-description" name="{{ $locale }}[description]"
                                    class="form-control col-lg-12" placeholder="{{ __('Enter Description') }}">
                                                {{ old($locale . '.description') }}
                                                {{ $translations[$locale]['description'] }}
                                </textarea>
                            </div>

                        @endforeach
                    </div>
                    <div class="form-row">

                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $brand->status == 'active' ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="inactive" {{ $brand->status == 'inactive' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Models') }}</label>
                            <select name="models" class="form-control">
                                <option value="album" {{ $brand->models == 'album' ? 'selected' : '' }}>
                                    {{ __('Album') }}</option>
                                <option value="partner" {{ $brand->models == 'partner' ? 'selected' : '' }}>
                                    {{ __('Partner') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-6  col-md-12 mb-3">
                            {{-- print the label depends on type --}}
                            <label for="exampleInputFile">{{ $brand->type }}</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                                    </a>
                                </span>
                                <input id="thumbnail" value="{{ $brand->path }}" class="form-control" type="text"
                                    name="path">
                            </div>
                            @if ($brand->type == 'photo')
                                <?php $explodePath = explode(',', $brand->path); ?>
                                <?php if(is_array($explodePath)){?>
                                <?php foreach ($explodePath as $photo) {?>
                                <img src="{{ $photo }}" style="width:100px;margin:3px">
                                <?php } ?>
                                <?php } ?>
                            @else
                            <a href="{{$brand->path}}">{{$brand->title}}</a>
                            @endif
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                          
                        </div>
                    </div>

                    <input class="form-control" value="{{ $brand->type }}" type="hidden" name="type">
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
        let fileType = "{{ $brand->type }}"
        $('#lfm').filemanager(fileType, {
            prefix: "{{ config('app.app_link_file_manager') }}"
        });
        $('#en-description').summernote();
        $('#ar-description').summernote();
        $('#tr-description').summernote();
    </script>
@endsection
