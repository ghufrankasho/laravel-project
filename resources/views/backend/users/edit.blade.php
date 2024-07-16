@extends('backend.layouts.master')
@section('header')

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('user.index')}}" class="nav-link">{{__('List Users')}}</a>
</li>
@endsection
@section( 'content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Edit User')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Edit user')}}</li>
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
            <h3 class="card-title">{{__('Edit user')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{str_replace('http://', 'https://', route('user.update', $user->id)) }}" method="post">
            @csrf
            @method('patch')
            
            <div class="card-body">
                <div class="form-row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label>{{__('Full Name')}}</label>
                        <input type="text" value="{{$user->full_name}}" name="full_name" class="form-control" placeholder="{{__('Enter Full Name')}}">
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label>{{__('User Name')}}</label>
                        <input type="text" value="{{$user->user_name}}" name="user_name" class="form-control" placeholder="{{__('Enter User Name')}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label>{{__('Email')}}</label>
                        <input type="text" value="{{$user->email}}" name="email" class="form-control" placeholder="{{__('Enter Email')}}">
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label>{{__('Password')}}</label>
                        <input type="text" value="" name="password" class="form-control" placeholder="{{__('Enter Password')}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-12 col-md-12 mb-3">
                        <label>{{__('Address')}}</label>
                        <input type="text" value="{{$user->address}}" name="address" class="form-control" placeholder="{{__('Enter Address')}}">
                    </div>
                </div>

                <div class="form-row">

                    <div class="col-lg-6  col-md-12 mb-3">
                        <label>{{__('Role')}}</label>
                        <select name="role" class="form-control">
                            <option value="admin" {{$user->role =='admin' ? 'selected' : ''}}>{{__('Admin')}}</option>
                            {{-- <option value="customer" {{$user->role == 'customer' ? 'selected' : ''}}>{{__('Customer')}}</option>
                            <option value="vendor" {{$user->role =='vendor' ? 'selected' : ''}}>{{__('Vendor')}}</option> --}}
                        </select>
                    </div>
                    <div class="col-lg-6  col-md-12 mb-3">
                        <label>{{__('Status')}}</label>
                        <select name="status" class="form-control">
                            <option value="active" {{$user->status =='active' ? 'selected' : ''}}>{{__('Active')}}</option>
                            <option value="inactive" {{$user->status =='inactive' ? 'selected' : ''}}>{{__('Inactive')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-6  col-md-12 mb-3">
                        <label>{{__('Phone')}}</label>
                        <input type="text" value="{{$user->phone}}" name="phone" class="form-control" placeholder="{{__('Enter Phone')}}">
                    </div>
                    <div class="col-lg-6  col-md-12 mb-3">
                        <label for="exampleInputFile">{{__('Photo')}}</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> {{__('Choose')}}
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="photo">
                             @if($user->photo)
                            <img src="{{$user->photo}}" style="width:100px">
                            @endif
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

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
<script src="{{config('app.url')}}vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image', {
        prefix: "{{config('app.app_link_file_manager')}}" 
    });

</script>

@endsection
