@extends('backend.layouts.master')
@section('header')

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('page.index')}}" class="nav-link">{{__('List Pages')}}</a>
</li>
@endsection
@section( 'content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Edit Page')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{__('Edit Page')}}</li>
                </ol>
            </div>
        </div>
        <div class="col-md-12">
            @if($errors->any())
            <div Class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li> {{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div><!-- /.container-fluid -->

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{__('Edit Page')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{str_replace('http://', 'https://', route('page.update', $page->id)) }}" method="post">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-row">
                    @foreach (config('translatable.locales') as $locale)
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="title_{{ $locale }}">{{__('Title')}}({{ strtoupper($locale) }})</label>
                            <input type="text" value="{{ $translations[$locale]['name'] }}" name="{{$locale}}[name]" class="form-control" placeholder="{{__('Enter title')}}">
                        </div>
                        
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="description_{{ $locale }}">{{__('Description')}}({{ strtoupper($locale) }})</label>
                            <textarea id="{{ $locale }}-description" name="{{$locale}}[description]" class="form-control" placeholder="{{__('Enter Description')}}"> 
                                {{ old($locale . '.description') }}
                                {{ $translations[$locale]['description'] }}
                            </textarea>
                        </div>
                 
                    @endforeach
                    <div class="col-lg-6  col-md-12 mb-3">
                        <label for="exampleInputFile">{{__('Photo')}}</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> {{__('Choose')}}
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$page->photo}}">
                            @if($page->photo)
                            <img src="{{$page->photo}}" style="width:100px">
                            @endif
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    <div class="col-lg-6  col-md-12 mb-3">
                        <label>{{ __('Status') }}</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ $page->status == 'active' ? 'selected' : '' }}>
                                {{ __('Active') }}</option>
                            <option value="inactive" {{ $page->status == 'inactive' ? 'selected' : '' }}>
                                {{ __('Inactive') }}</option>
                        </select>
                    </div>
                </div>
                
                {{-- <div class="form-row">
                    <div class="col-lg-6  col-md-12 mb-3">
                        <div class="icheck-primary">
                            <input type="checkbox" id="is_master" name="is_master" {{$page->is_master == 1 ? 'checked' : ''}} value="1">
                            <label for="is_master">
                                {{ __('Is Master') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-6  col-md-12 mb-3 parent">
                        <div class="icheck-primary">
                            <input type="checkbox" id="in_main_menu" name="in_main_menu" {{$page->in_main_menu == 1 ? 'checked' : ''}} value="1">
                            <label for="in_main_menu">
                                {{ __('In Main Menu') }}
                            </label>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="form-row">
                    <div class="col-lg-6  col-md-12 mb-3">
                        <div class="icheck-primary">
                            <input type="checkbox" id="in_side_menu" name="in_side_menu" {{$page->in_side_menu == 1 ? 'checked' : ''}} value="1">
                            <label for="in_side_menu">
                                {{ __('In Side Menu') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-6  col-md-12 mb-3 parent">
                        <div class="icheck-primary">
                            <input type="checkbox" id="in_bottom_menue" name="in_bottom_menu " {{$page->in_bottom_menu  == 1 ? 'checked' : ''}} value="1">
                            <label for="in_bottom_menu ">
                                {{ __('In Bottom Menu') }}
                            </label>
                        </div>
                    </div>
                </div> --}}
              
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
        prefix: "{{config('app.app_link_file_manager')}}" 
    });
    $('#en-description').summernote();
    $('#ar-description').summernote();
    $('#tr-description').summernote();
</script>

@endsection
