@extends('backend.layouts.master');

@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('product.index') }}" class="nav-link">{{ __('List Products') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('product.create') }}" class="btn btn-primary ">{{ __('Create product') }}</a>
    </li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List Products') }}</h3>
        </div>

        {{-- show  the notifications --}}
        <div class="card-header">
            @include('backend.layouts.notifications')
        </div>

        <!-- /.card-header -->
        <div class="card-body">
        <div class="row">
            @include('backend.layouts.table-search')
        </div>
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ __('S.N.') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Discount') }}</th>
                        {{-- <th>{{__('Size')}}</th> --}}
                        {{-- <th>{{ __('Conditions') }}</th> --}}
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{$item->category->title}}
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if  ($item->photo)
                                    <?php $explodePath = explode(',', $item->photo);?>
                                   
                                    <?php if (is_array($explodePath)): ?>
                                    <?php  ?>
                                  
                                    <?php foreach ($explodePath as $count => $photo): ?>
                                  
                                    <?php
                                    $pathParts = pathinfo($photo);
                                    $thumbnailUrl = $pathParts['dirname'] . '/thumbs/' . $pathParts['basename'];
                                    ?>
                                     @if($count < 4)
                                    <img src= "{{$thumbnailUrl}}" style="width:50px; margin:2px">
                                    @endif
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <?php
                                    $pathParts = pathinfo($item->photo);
                                    $thumbnailUrl = $pathParts['dirname'] . '/thumbs/' . $pathParts['basename'];
                                    ?>
                                    <img src="{{ $thumbnailUrl }}" style="max-height:100px;">
                                    <?php endif; ?>
                                @endif
                            </td>
                            <td>
                                {{ number_format($item->price, 2) }}
                            </td>
                            <td>
                                {{ number_format($item->discount, 2) }} %
                            </td>
                            {{-- <td>
                        {{$item->size}}
                    </td> --}}
                            {{-- <td>
                                @if ($item->conditions == 'new')
                                    <span class="badge badge-success">{{ $item->conditions }}</span>
                                @elseif($item->conditions == 'popular')
                                    <span class="badge badge-warning">{{ __('Sale') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ $item->conditions }}</span>
                                @endif
                            </td> --}}

                            <td>
                                {{-- {{$item->status}} --}}
                                <input type="checkbox" id="status" class="status" name="toggle"
                                    value="{{ $item->id }}" data-toggle="toggle"
                                    {{ $item->status == 'active' ? 'checked' : '' }} data-on="Active" data-off="Inactive"
                                    data-onstyle="success" data-offstyle="danger">
                                {{-- <input type="checkbox" id="status"> --}}
                            </td>
                            <td>
                                <a href="{{ route('properties.index', ['productId' => $item->id]) }}"
                                    class="mx-2 show-product float-left btn  btn-outline-secondary">
                                    <i class='fas fa-balance-scale-right'></i>
                                </a>
                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                    class="show-product float-left btn  btn-outline-secondary" data-placement="bottom"
                                    data-toggle="modal" data-target="#showProduct">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('product.edit', $item->id) }}" data-toggle="tooltip"
                                    class="float-left btn  btn-outline-warning ml-2" title="edit" data-placement="bottom">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form class="float-left" action="{{ route('product.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a style="display:ruby-text" href="#" data-toggle="tooltip"
                                        class="del-btn btn  btn-outline-danger  float-left btn-outline-warning ml-2"
                                        data-id="{{ $item->id }}" title="delete" data-placement="bottom">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>{{ __('S.N.') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Discount') }}</th>
                        {{-- <th>{{__('Size')}}</th> --}}
                        {{-- <th>{{ __('Conditions') }}</th> --}}
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </tfoot>
            </table>
            {{ $products->withQueryString()->links() }}

        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('input[name=toggle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                url: "{{ str_replace('http://', 'https://', secure_url(route('product.status'))) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id
                },
                success: function(response) {
                    if (!response.status) {
                        alert('Please try again');
                    }
                }
            })
        });

        $('.del-btn').on('click', function(e) {
            var form = $(this).closest('form');
            var dataId = $(this).data('id');
            e.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this product!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your product has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your product file is safe!");
                    }
                });
        });

        $('.show-product').on('click', function(e) {
            let productID = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('product.show') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    productID: productID
                },
                success: function(response) {
                    // reset initial value
                    $('.modal .product-title', '.modal .product-description', '.modal .product-price',
                        '.modal .product-discount', '.modal .product-old-price',
                        '.modal .product-category-title', '.modal .product-status',
                        '.modal .product-photo .modal .product-number  .modal .product-dimension').html('');
                    $('.product-title').html(response.data.title);
                    $('.product-description').html(response.data.description);
                    if (response.data.price) {
                        $('.product-price').html(response.data.price + ' AED');
                    }
                    if (response.data.discount) {
                        $('.product-discount').html(response.data.discount + ' % ');
                    }
                    if (response.data.old_price) {
                        $('.product-old-price').html(response.data.old_price);
                    }
                    // $('.product-category-title').html(response.data.cat_id.title);
                    $('.product-status').html(response.data.status);
                    $('.product-conditions').html(response.data.conditions);
                    $('.product-number').html(response.data.product_number);
                    $('.product-dimension').html(response.data.dimension);
                    $('.modal .product-photo').html('');
                    let photos = response.data.photo.split(',');
                    $(photos).each(function(index, value) {
                        $('.product-photo').append(
                            `<img style="margin:10px" src='${value}'  width="100px"/>`);
                    });

                }
            })

        });

        $('.close-modal,.btn-close').on('click', function() {
            $('#showProduct').modal('hide');
        })
    </script>
@endsection

{{-- Modal for show the product detail --}}
<div class="modal fade" id="showProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title product-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <strong>{{ __('Summary') }}</strong>
                <p class="product-summary"></p> --}}
                <strong>{{ __('Description') }}</strong>
                <p class="product-description"></p>
                <div class="row">
                    <div class="col-md-4">
                        <strong>{{ __('Price') }}</strong>
                        <p class="product-price"></p>
                    </div>
                    <div class="col-md-4">
                        <strong>{{ __('Old Price') }}</strong>
                        <p class="product-old-price"></p>
                    </div>
                    <div class="col-md-4">
                        <strong>{{ __('Discount') }}</strong>
                        <p class="product-discount"></p>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-6">
                        <strong>{{ __('Category') }}</strong>
                        <p class="product-category-title"></p>
                    </div> --}}
                    <div class="col-md-6">
                        <strong>{{ __('Status') }}</strong>
                        <p class="product-status"></p>
                    </div>

                    <div class="col-md-6">
                        <strong>{{ __('Size') }}</strong>
                        <p class="product-size"></p>
                    </div>
                    {{-- <div class="col-md-6">
                        <strong>{{ __('Child Category') }}</strong>
                        <p class="product-category-child-title"></p>
                    </div> --}}
                </div>

                {{-- <div class="row">
                    <div class="col-md-6">
                        <strong>{{ __('Brand') }}</strong>
                        <p class="product-brand"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>{{ __('Vendor') }}</strong>
                        <p class="product-vendor"></p>
                    </div>
                </div> --}}

                <div class="row">

                    <div class="col-md-6">
                        <strong>{{ __('Photo') }}</strong>

                        <p class="product-photo"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <strong>{{ __('Product Number') }}</strong>
                        <p class="product-number"></p>
                    </div>


                    <div class="col-md-6">
                        <strong>{{ __('Dimension') }}</strong>
                        <p class="product-dimension"></p>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
