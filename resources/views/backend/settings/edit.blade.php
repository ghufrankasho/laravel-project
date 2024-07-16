@extends('backend.layouts.master')
@section('header')

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('setting.index')}}" class="nav-link">{{__('List Settings')}}</a>
</li>
@endsection
@section( 'content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Edit Setting')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{__('Edit Setting')}}</li>
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
            <h3 class="card-title">{{__('Edit Setting')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ str_replace('http://', 'https://', route('setting.update', $setting->id)) }}" method="post">
            
            @csrf
              @method('patch')
            <div class="card-body">
                <div class="form-row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label>{{__('Title')}}</label>
                        <input type="text" value="{{$setting->title}}" name="title" class="form-control" placeholder="{{__('Enter title')}}">
                    </div>
                    <div class="col-lg-6  col-md-12 mb-3">
                        <label>{{__('Key')}}</label>
                        <input type="text" value="{{$setting->key}}" name="key" disabled class="form-control" placeholder="{{__('Enter Key')}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-12  col-md-12 mb-3">
                        <label>{{__('Type')}}</label>
                        <select name="type" class="form-control">
                            <option value="">{{__('Select type')}}</option>
                                <option value="string" {{$setting->type == 'string' ? 'selected' : ''}}>{{__('string')}}</option>
                                <option value="boolean" {{$setting->type =='boolean' ? 'selected' : ''}}>{{__('boolean')}}</option>
                                <option value="integer" {{$setting->type =='integer' ? 'selected' : ''}}>{{__('integer')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-12  col-md-12 mb-3">
                        <label>{{__('Value Actual')}}</label>
                        <textarea id="value_actual" name="value_actual" class="form-control" placeholder="{{__('Enter Value Actual')}}"> {{ unserialize($setting->value_actual) }} </textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-12  col-md-12 mb-3">
                        <label>{{__('Description')}}</label>
                        <textarea id="description" name="description" class="form-control" placeholder="{{__('Enter Description')}}"> {{$setting->description}} </textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-6  col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" id="is_hidden" name="is_hidden" type="checkbox"
                             {{$setting->is_hidden  == 1 ? 'checked' : ''}} value="1">
                            <label class="form-check-label">{{__('Is Hidden')}}</label>
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
<script>
    $('#description').summernote();
</script>

@endsection
