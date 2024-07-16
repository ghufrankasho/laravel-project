@extends('backend.layouts.master')
@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('discounts.index') }}" class="nav-link">{{ __('List Copuns') }}</a>
    </li>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Create Copun') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Create Copun') }}</li>
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
                <h3 class="card-title">{{ __('Create Copuns') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{str_replace('http://', 'https://', secure_url(route('discounts.store'))) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label>{{ __('Name') }}</label>
                            <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                placeholder="{{ __('Enter Name') }}">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label>{{ __('Value') }}</label>
                            <input type="number" value="{{ old('value') }}" name="value" class="form-control"
                                placeholder="{{ __('Enter Value') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- <div class="col-lg-6 col-md-12 mb-3">
                            <label>{{ __('Period') }}</label>
                            <input type="datetime-local" value="{{ old('period') }}" name="period" class="form-control"
                                placeholder="{{ __('Enter Period') }}">
                        </div> --}}
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Type') }}</label>
                            <select id="type" name="type" class="form-control">
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>
                                    {{ __('Fixed Price') }}
                                </option>
                                <option value="rate" {{ old('type') == 'rate' ? 'selected' : '' }}>{{ __('Percent %') }}
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label>{{ __('Code') }}</label>
                            <input type="text" value="{{ old('code') }}" name="code" class="form-control"
                                placeholder="{{ __('Enter Code') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Permission') }}</label>
                            <select id="store_id" name="store_id" class="form-control">
                                <option value="">{{ __('All') }}</option>
                                <!-- @foreach (\App\Models\Store::whereNotNull('id')->get() as $store)
    <option value="{{ $store->id }}">{{ $store->title }}</option>
    @endforeach -->
                            </select>
                        </div> --}}
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


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
