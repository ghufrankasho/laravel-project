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
                    <h1>{{ __('Create product') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Create product') }}</li>
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
                <h3 class="card-title">{{ __('Create product') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{str_replace('http://', 'https://', secure_url(route('product.store'))) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-row">
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
                                    {{ __('Description') }}
                                    ({{ strtoupper($locale) }})
                                </label>
                                <textarea id="{{ $locale }}-description" name="{{ $locale }}[description]" class="form-control col-lg-12"
                                    placeholder="{{ __('Enter description') }}">
                                                {{ old($locale . '.description') }}
                                            </textarea>
                            </div>
                        @endforeach

                    </div>
                    <div class="form-row">
                        @foreach (config('translatable.locales') as $locale)
                            <div class=" col-lg-3 col-md-6 mb-3" style="flex: 0 0 35%; max-width: 33%;">
                                <label>{{ __('Code Of Item') }}
                                    ({{ strtoupper($locale) }})
                                </label>

                                <input type="text" value="{{ old($locale . '.color') }}"
                                    name="{{ $locale }}[color]" class="form-control"
                                    placeholder="{{ __('Enter Code Of Item') }}">
                            </div>
                        @endforeach

                    </div>
                    <div class="form-row">
                        @foreach (config('translatable.locales') as $locale)
                            <div class="col-lg-3 col-md-6 mb-3" style="flex: 0 0 35%; max-width: 33%;">
                                <label>{{ __('Shipping Area') }}
                                    ({{ strtoupper($locale) }})
                                </label>
                                <input type="text" value="{{ old($locale . '.shipping_area') }}"
                                    name="{{ $locale }}[shipping_area]" class="form-control"
                                    placeholder="{{ __('Enter Shipping Area') }}">
                            </div>
                        @endforeach

                    </div>

                    {{-- <div class="form-row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label>{{ __('Summary') }}</label>
                            <textarea id="summary" name="summary" class="form-control"
                                placeholder="{{ __('Enter Summary') }}"> {{ old('summary') }} </textarea>
                        </div>
                    </div> --}}
                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Price') }}</label>
                            <input type="number" value="{{ old('price') }}" step="any" name="price"
                                class="form-control" placeholder="{{ __('Enter Price') }}">
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Old Price') }}</label>
                            <input type="number" value="{{ old('old_price') }}" step="any" name="old_price"
                                class="form-control" placeholder="{{ __('Enter Old Price') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Category') }}</label>
                            <select id="cat_id" name="cat_id" class="form-control">
                                <option value="">{{ __('--Category--') }}</option>
                                @foreach (\App\Models\Category::where('is_parent', '0')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Discount') }}</label>
                            <input type="number" value="{{ old('discount') }}" name="discount" min="0"
                                max="100" class="form-control" placeholder="{{ __('Enter Discount') }}">
                        </div>
                        {{-- <div class="col-lg-6  col-md-12 mb-3 d-none" id="childCategory">
                            <label>{{ __('Child Category') }}</label>
                            <select id="child_cat_id" name="child_cat_id" class="form-control">
                                <option value="">{{ __('--Child Category--') }}</option>
                            </select>
                        </div> --}}
                    </div>

                    <div class="form-row">
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
                    </div>
                    {{-- <div class="form-row">
                        <div class="col-lg-6  col-md-12 mb-3">
                            <label>{{ __('Conditions') }}</label>
                            <select name="conditions" class="form-control">
                                <option value="global" {{ old('conditions') == 'global' ? 'selected' : '' }}>{{ __('Global') }}</option>
                                <option value="new" {{ old('conditions') == 'new' ? 'selected' : '' }}>{{ __('New') }}
                                </option>
                                <option value="popular" {{ old('conditions') == 'popular' ? 'selected' : '' }}>
                                    {{ __('Sale') }}</option>
                                <option value="featured" {{ old('conditions') == 'featured' ? 'selected' : '' }}>
                                    {{ __('Featured') }}</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                        {{-- <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Product Number') }}</label>
                            <input type="text" value="{{ old('product_number') }}"   name="product_number" class="form-control"
                                placeholder="{{ __('Enter Product Number') }}">
                        </div> --}}
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Dimension') }}</label>
                            <input type="text" value="{{ old('dimension') }}" name="dimension" class="form-control"
                                placeholder="{{ __('Enter Dimension') }}">
                        </div>

                        {{-- <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Available') }}</label>
                            <input type="text" value="{{ old('available') }}"  name="available" class="form-control"
                                placeholder="{{ __('Enter Available') }}">
                        </div> --}}
                        <div class="col-lg-6  col-md-12 mb-3 ">
                            <label>{{ __('Available') }}</label>
                            <select name="available" class="form-control is_parent">
                                <option value="in stock now" {{ old('in stock now') == 'active' ? 'selected' : '' }}>
                                    {{ __('in stock now') }}</option>
                                <option value="out stock" {{ old('out stock') == 'inactive' ? 'selected' : '' }}>
                                    {{ __('out stock') }}</option>
                            </select>
                        </div>

                        {{-- <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Shipping Fee') }}</label>
                            <input type="text" value="{{ old('shipping_fee') }}"  name="shipping_fee" class="form-control"
                                placeholder="{{ __('Enter Shipping Fee') }}">
                        </div> --}}
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label>{{ __('Minimum Quantity') }}</label>
                            <input type="number" value="{{ old('minimum_quantity') }}" name="minimum_quantity"
                                class="form-control" placeholder="{{ __('Enter Minimum Quantity') }}">
                        </div>
                        <div class="col-lg-6  col-md-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" id="is_hot" name="is_hot" type="checkbox" checked
                                    value="1">
                                <label class="form-check-label">{{ __('Is Hot') }}</label>
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
        $('#lfm').filemanager('image', {
            prefix: "{{ config('app.app_link_file_manager') }}"
        });
        // $('#summary').summernote();
        // $('#description').summernote();
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

        // $('#cat_id').on('change', function() {
        //     let catID = $(this).val();
        //     if (catID) {
        //         $.ajax({
        //             url: "{{ config('app.url') }}admin/category/" + catID + "/child",
        //             type: 'POST',
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //                 catID: catID
        //             },
        //             success: function(response) {
        //                 var options = "<option value=''>{{ __('--Child Category--') }}</option>";
        //                 if (response.status) {
        //                     $('#childCategory').removeClass('d-none');
        //                     $.each(response.data, function(key, value) {
        //                         options += "<option value='" + value.id + "'>" + value.title +
        //                             "</option>";
        //                     });
        //                 } else {
        //                     $('#childCategory').addClass('d-none');
        //                 }
        //                 $('#child_cat_id').html(options);
        //             }
        //         })
        //     }
        // });
    </script>
     <script>
        var PAPERBAG = ["PAPER BAG", "أكياس كرتون", "PAPER BAG"];
        var FOODBOX = ["FOOD BOX", "بوكسات طعام", "FOOD BOX"];
        var SWEETBOX = ["SWEET BOX", "بوكسات حلويات", "SWEET BOX"];
        var CLOTHESBOX = ["CLOTHES BOX", "بوكسات ملابس", "CLOTHES BOX"];
        var PRODUCTSBOX = ["PRODUCTS BOX", "بوكسات منتجات", "PRODUCTS BOX"];
        var LEATHERBOX = ["LEATHER BOX", "بوكسات جلد", "LEATHER BOX"];
        var ACRYLICBOX = ["ACRYLIC BOX", "بوكسات اكرليك", "ACRYLIC BOX"];
        var THANKSCARD = ["THANKS CARD", "بطاقات شكر", "THANKS CARD"];
        var LABEL = ["LABEL", "ليبل", "LABEL"];
        var RIBBON = ["RIBBON", "ريبون", "RIBBON"];
        var TAG = ["TAG", "تاغ", "TAG"];
        var LARGEBOXES = ["LARGE BOXES", "بوكسات كبيرة", "LARGE BOXES"];
        var STICKER = ["STICKER", "ستيكر", "STICKER"];
        var STAMP = ["STAMP", "أختام", "STAMP"];
        var PAPERCUP = ["PAPER CUP", "أكواب ورقية", "PAPER CUP"];
        var shoppingArea = ["UAE & Gulf Countries", "الإمارات ودول الخليج", "UAE & Gulf Countries"]
        var descriptionArea = ["Paper 180 gsm", " ورق 180 غرام", " Paper 180 gsm"]
        var minimumQuantity = ["100","100","100","100","100","5","10","100","1000","1","100","100","50","1","100"]

        $('#cat_id').on('change', function() {
            let catText = $(this).find('option:selected').text().trim();
            var newStr = catText.replace(/\s/g, "");
            //  title 
            var enInput = $('input[name="en[title]"]');
            var arInput = $('input[name="ar[title]"]');
            var trInput = $('input[name="tr[title]"]');
            // shopping area 
            var enshippingArea = $('input[name="en[shipping_area]"]').val(shoppingArea[0]);
            var arshippingArea = $('input[name="ar[shipping_area]"]').val(shoppingArea[1]);
            var trshippingArea = $('input[name="tr[shipping_area]"]').val(shoppingArea[2]);
            
            // desciption area 
            var enDescriptionArea = $('textarea[name="en[description]"]').summernote('code',descriptionArea[0]);
            var arDescriptionArea = $('textarea[name="ar[description]"]').summernote('code',descriptionArea[1]);
            var trDescriptionArea = $('textarea[name="tr[description]"]').summernote('code',descriptionArea[2]);
          
            // var minimum quantity 
            var minimumQuantityInput = $('input[name="minimum_quantity"]');
          
            var categoryArray;
            switch (newStr) {
                case "PAPERBAG":
                    categoryArray = PAPERBAG;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[0]);
                    break;
                case "FOODBOX":
                    categoryArray = FOODBOX;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[1]);
                    break;
                case "SWEETBOX":
                    categoryArray = SWEETBOX;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[2]);
                    break;
                case "CLOTHESBOX":
                    categoryArray = CLOTHESBOX;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[3]);
                    break;
                case "PRODUCTSBOX":
                    categoryArray = PRODUCTSBOX;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[4]);
                    break;
                case "LEATHERBOX":
                    categoryArray = LEATHERBOX;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[5]);
                    break;
                case "ACRYLICBOX":
                    categoryArray = ACRYLICBOX;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[6]);
                    break;
                case "THANKSCARD":
                    categoryArray = THANKSCARD;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[7]);
                    break;
                case "LABEL":
                    categoryArray = LABEL;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[8]);
                    break;
                case "RIBBON":
                    categoryArray = RIBBON;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[9]);
                    break;
                case "TAG":
                    categoryArray = TAG;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[10]);
                    break;
                case "LARGEBOXES":
                    categoryArray = LARGEBOXES;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[11]);
                    break;
                case "STICKER":
                    categoryArray = STICKER;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[12]);
                    break;
                case "STAMP":
                    categoryArray = STAMP;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[13]);
                    break;
                case "PAPERCUP":
                    categoryArray = PAPERCUP;
                    enInput.val(categoryArray[0]);
                    arInput.val(categoryArray[1]);
                    trInput.val(categoryArray[2]);
                    minimumQuantityInput.val(minimumQuantity[14]);
                    break;
                default:
                    categoryArray = [];
                    enInput.val('');
                    arInput.val('');
                    trInput.val('');
                    $('input[name="en[shipping_area]"]').val('');
                    $('input[name="ar[shipping_area]"]').val('');
                    $('input[name="tr[shipping_area]"]').val('');
                    minimumQuantityInput.val('');

            }
        });
    </script>
@endsection
