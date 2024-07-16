@extends('backend.layouts.master')
@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('product.index') }}" class="nav-link">{{ __('List Products') }}</a>
    </li>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit product') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Edit product') }}</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
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
                <h3 class="card-title">{{ __('Edit product') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ str_replace('http://', 'https://', route('product.update', $product->id)) }}" method="post">
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
                                <textarea id="{{ $locale }}-description" name="{{ $locale }}[description]" class="form-control col-lg-12"
                                    placeholder="{{ __('Enter description') }}">
                                                                {{ $translations[$locale]['description'] }}
                                                            </textarea>
                            </div>
                        @endforeach

                    </div>
                    <div class="form-row">
                        @foreach (config('translatable.locales') as $locale)
                        <div class="col-lg-3 col-md-6 mb-3" style="flex: 0 0 35%; max-width: 33%;">
                            <label>{{ __('Code Of Item') }}</label>
                            ({{ strtoupper($locale) }})
                            <input type="text" id="{{ $locale }}-color" value="{{ $product->color }}" 
                            name="{{ $locale }}[color]"
                                class="form-control" placeholder="{{ __('Enter Code Of Item') }}">
                        </div>
                        @endforeach
                    </div> 
                    
                        <div class="form-row">
                            @foreach (config('translatable.locales') as $locale)
                        <div class="col-lg-3 col-md-6 mb-3" style="flex: 0 0 35%; max-width: 33%;">
                            <label>{{ __('Shipping Area') }}</label>
                            ({{ strtoupper($locale) }})
                            <input type="text"  id="{{ $locale }}-shipping_area" 
                            name="{{ $locale }}[shipping_area]"
                                class="form-control" placeholder="{{ __('Enter Shipping Area') }}" value="{{ $translations[$locale]['shipping_area'] }}">
                                
                        </div>
                        @endforeach

                    </div> 
                   
                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Price') }}</label>
                            <input type="number" value="{{ $product->price }}" step="any" name="price"
                                class="form-control" placeholder="{{ __('Enter Price') }}">
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Old Price') }}</label>
                            <input type="number" value="{{ $product->old_price }}" step="any" name="old_price"
                                class="form-control" placeholder="{{ __('Enter Old Price') }}">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Category') }}</label>
                            <select id="cat_id" name="cat_id" class="form-control">

                                @foreach (\App\Models\Category::where('is_parent', '1')->get() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $product->cat_id ? 'selected=selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Child Category') }}</label>
                            <select id="" name="cat_id" class="form-control">
                                <option value="">{{ __('--Child Category--') }}</option>

                                @foreach (\App\Models\Category::where('is_parent', '0')->get() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $product->cat_id ? 'selected=selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Discount') }}</label>
                            <input type="text" value="{{ $product->discount }}" name="discount" min="0"
                                max="100" class="form-control" placeholder="{{ __('Enter Discount') }}">
                        </div>
                      
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                      
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label for="exampleInputFile">{{ __('Photo') }}</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo"
                                    value="{{ $product->photo }}">
                            </div>
                            @if ($product->photo)
                                <?php $explodePath = explode(',', $product->photo); ?>
                                <?php if(is_array($explodePath)){?>
                                <?php foreach ($explodePath as $photo) {?>
                                <img src="{{ $photo }}" style="width:100px;margin:3px">
                                <?php } ?>
                                <?php } else { ?>
                                <img src="{{ $product->photo }}" style="width:100px">
                                <?php } ?>
                            @endif
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                    </div>
                    {{-- <div class="form-row">
                    <div class="col-lg-12 col-md-12 mb-3">
                        <label>{{__('Summary')}}</label>
                        <textarea id="summary" name="summary" class="form-control" placeholder="{{__('Enter Summary')}}"> {{$product->summary}} </textarea>
                    </div>
                </div> --}}
                    {{-- <div class="form-row">
                    <div class="col-lg-12 col-md-12 mb-3">
                        <label>{{__('Description')}}</label>
                        <textarea id="description" name="description" class="form-control" placeholder="{{__('Enter Description')}}"> {{$product->description}} </textarea>
                    </div>
                </div> --}}
                    {{-- <div class="form-row">
                    <div class="col-lg-6 col-md-6 mb-3">
                        <label>{{__('Stock')}}</label>
                        <input type="number" value="{{$product->stock}}" name="stock" class="form-control" placeholder="{{__('Enter Stock')}}">
                    </div>
                    <div class="col-lg-6 col-md-6 mb-3">
                        <label>{{__('Price')}}</label>
                        <input type="number" value="{{$product->price}}" name="price" class="form-control" placeholder="{{__('Enter Price')}}">
                    </div>
                </div> --}}
                    {{-- <div class="form-row">
                    <div class="col-lg-6 col-md-6 mb-3">
                        <label>{{__('Discount')}}</label>
                        <input type="number" value="{{$product->discount}}" name="discount" min="0" max="100" class="form-control" placeholder="{{__('Enter Discount')}}">
                    </div>
                </div> --}}

                    {{-- <div class="form-row">
                    <div class="col-lg-6  col-md-12 mb-3">
                        <label>{{__('Size')}}</label>
                        <select name="size" class="form-control">
                            <option value="">{{__('--Size--')}}</option>
                            <option value="S" {{$product->size =='S' ? 'selected' : ''}}>{{__('Small')}}</option>
                            <option value="M" {{$product->size =='M' ? 'selected' : ''}}>{{__('Medium')}}</option>
                            <option value="L" {{$product->size =='L' ? 'selected' : ''}}>{{__('Large')}}</option>
                            <option value="XL" {{$product->size =='XL' ? 'selected' : ''}}>{{__('Extra Large')}}</option>
                        </select>
                    </div>
                    <div class="col-lg-6  col-md-12 mb-3">
                        <label>{{__('Conditions')}}</label>
                        <select name="conditions" class="form-control">
                            <option value="">{{__('--Conditions--')}}</option>
                            <option value="new" {{$product->conditions =='new' ? 'selected' : ''}}>{{__('New')}}</option>
                            <option value="popular" {{$product->conditions =='popular' ? 'selected' : ''}}>{{__('Popular')}}</option>
                            <option value="winter" {{$product->conditions =='winter' ? 'selected' : ''}}>{{__('Winter')}}</option>
                        </select>
                    </div>
                </div> --}}
                    {{-- <div class="form-row"> --}}
                    {{-- <div class="col-lg-6  col-md-12 mb-3">
                        <label>{{__('Vendor')}}</label>
                        <select name="vendor_id" class="form-control">
                            <option value="">{{__('--Vendor--')}}</option>
                            @foreach (\App\Models\User::where('role', 'vendor')->get() as $vendor)
                            <option value="{{$vendor->id}}" {{$vendor->id == $product->vendor_id ? 'selected' : ''}}>{{$vendor->full_name}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="form-row">
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Conditions') }}</label>
                            <select name="conditions" class="form-control">
                               <option value="global" {{ $product->conditions == 'global' ? 'selected' : '' }}>
                                    {{ __('Global') }}</option>
                                <option value="new" {{ $product->conditions == 'new' ? 'selected' : '' }}>
                                    {{ __('New') }}</option>
                                <option value="popular" {{ $product->conditions == 'popular' ? 'selected' : '' }}>
                                    {{ __('Sale') }}</option>
                                <option value="featured" {{ $product->conditions == 'featured' ? 'selected' : '' }}>
                                    {{ __('Featured') }}</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                        {{-- <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Product Number') }}</label>
                            <input type="text" value="{{ $product->product_number }}" name="product_number"
                                class="form-control" placeholder="{{ __('Enter Product Number') }}">
                        </div> --}}
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Dimension') }}</label>
                            <input type="text" value="{{ $product->dimension }}" name="dimension"
                                class="form-control" placeholder="{{ __('Enter Dimension') }}">
                        </div>
                       
                        {{-- <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Available') }}</label>
                            <input type="text" value="{{ $product->available }}" name="available"
                                class="form-control" placeholder="{{ __('Enter Available') }}">
                        </div> --}}
                        <div class="col-lg-6  col-md-12 mb-3 ">
                            <label>{{__('Available')}}</label>
                            <select name="available" class="form-control is_parent">
                                <option value="in stock now" {{$product->available =='active' ? 'selected' : ''}}>{{__('in stock now')}}</option>
                                <option value="out stock" {{$product->available =='inactive' ? 'selected' : ''}}>{{__('out stock')}}</option>
                            </select>
                        </div>
                       
                        {{-- <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Shipping Fee') }}</label>
                            <input type="text" value="{{ $product->shipping_fee }}" name="shipping_fee"
                                class="form-control" placeholder="{{ __('Enter Shipping Fee') }}">
                        </div> --}}
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Minimum Quantity') }}</label>
                            <input type="text" value="{{ $product->minimum_quantity }}" name="minimum_quantity"
                                class="form-control" placeholder="{{ __('Enter Minimum Quantity') }}">
                        </div>
                        <div class="col-lg-6  col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" id="is_hot" name="is_hot" type="checkbox"
                                {{ $product->is_hot == 1 ? 'checked' : ''}} value="{{ $product->is_hot}}">
                            <label class="form-check-label">{{ __('Is Hot') }}</label>
                            </div>
                        </div>
                        
                    </div>
                    {{-- </div> --}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
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
        // $('#summary').summernote();
        $('#en-description').summernote();
        $('#ar-description').summernote();
        $('#tr-description').summernote();
        // idden the parent product 
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

        // check if the child parecnt is selected 
        let childCatID = '{{ $product->child_cat_id }}';
        $('#cat_id').on('change', function() {
            let catID = $(this).val();
            if (catID) {
                $.ajax({
                    url: "{{ config('app.url') }}admin/category/" + catID + "/child",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        catID: catID
                    },
                    success: function(response) {
                        var options = "<option value=''>{{ __('--Child Category--') }}</option>";
                        if (response.status) {
                            $('#childCategory').removeClass('d-none');
                            $.each(response.data, function(id, title) {
                                options += "<option value='" + id + "'  " + (childCatID == id ?
                                    'selected' : '') + ">" + title + "</option>";
                            });
                        } else {
                            $('#childCategory').addClass('d-none');
                        }
                        $('#child_cat_id').html(options);
                    }
                })
            }
        });

        if (childCatID) {
            $('#cat_id').change();
        }
    </script>
@endsection
