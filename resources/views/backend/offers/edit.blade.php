@extends('backend.layouts.master')
@section('header')

    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('offer.index') }}" class="nav-link">{{ __('List Offers') }}</a>
    </li>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Offer') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ __('Edit Offer') }}</li>
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
                <h3 class="card-title">{{ __('Edit Offer') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('offer.update', $offer->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-row">
                        <!-- Name -->
                        @foreach (config('translatable.locales') as $locale)
                        <div class="col-lg-9 col-md-12 mb-3">
                            <label for="name_{{ $locale }}">
                                {{ __('Name') }}
                                ({{ strtoupper($locale) }})
                            </label>
                            <input type="text" value="{{ old($locale . '.name') }}"
                                name="{{ $locale }}[name]" class="form-control"
                                placeholder="{{ __('Enter name') }}">
                        </div>
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
                            <label for="exampleInputFile">{{ __('Photo') }}</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo"
                                    value="{{ $offer->photo }}">
                            </div>
                            @if ($offer->photo)
                                <img src="{{ $offer->photo }}" class="mt-2" width="100px;">
                            @endif
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $offer->status == 'active' ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="inactive" {{ $offer->status == 'inactive' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-6  col-md-12 mb-3">
                            <div class="input number">
                                <label class="col-lg-12  col-md-12 mb-3 control-label" for="price">Price</label>
                                <input type="number" name="price" class="form-control" style="width:83.3333%;margin-bottom:10px" placeholder="Price" id="price" value="1299">
                            </div>
                            <div class="input text">
                                <label class="col-lg-12  col-md-12 mb-3 control-label" for="serial-number">serial_number</label>
                                <input type="text" name="serial_number" class="form-control" style="width:83.3333%;margin-bottom:10px" placeholder="serial Number" id="serial-number" value="10" maxlength="11">
                            </div>
                            <div class="input number">
                                <label class="col-lg-12  col-md-12 mb-3 control-label" for="product-number">Product Number</label>
                                <input type="number" name="product_number" class="form-control" style="width:83.3333%;margin-bottom:10px" placeholder="Product Number" required="required" id="product-number" value="10">
                            </div>
                            </div>
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
    </script>

@endsection
