@extends('backend.layouts.master');

@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">{{ __('List') }} {{ Request::segment(3) }} {{ 'Orders' }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="btn btn-primary ">{{ __('Create order') }}</a>
    </li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List Orders') }}</h3>
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
                        <th>{{ __('Full Name') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->full_name }}</td>
                            <td>
                                @if ($item->status == 'pending')
                                    <span class="badge badge-info">
                                        {{ $item->status }}
                                    </span>
                                @elseif($item->status == 'new')
                                    <span class="badge badge-primary">
                                        {{ $item->status }}
                                    </span>
                                @elseif($item->status == 'completed')
                                    <span class="badge badge-success">
                                        {{ $item->status }}
                                    </span>
                                @elseif($item->status == 'canceled')
                                    <span class="badge badge-danger">
                                        {{ $item->status }}
                                    </span>
                                @endIf
                            </td>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                    class="order-details float-left btn  btn-outline-secondary" data-placement="bottom"
                                    data-toggle="modal" data-target="#orderDetails">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form class="float-left  ml-2" action="{{ route('order.destroy', $item->id) }}"
                                    method="post">
                                    @csrf
                                    <a href="#" data-toggle="tooltip" class="del-btn btn  btn-outline-danger"
                                        data-id="{{ $item->id }}" title="delete" data-placement="bottom">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <th>{{ __('S.N.') }}</th>
                    <th>{{ __('Full Name') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tfoot>
            </table>
            {{ $orders->withQueryString()->links() }}

        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.del-btn').on('click', function(e) {
            var form = $(this).closest('form');
            var dataId = $(this).data('id');
            e.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this order!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your order has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your order file is safe!");
                    }
                });
        });

        $('.order-details').on('click', function(e) {

            $('.modal .full-name', '.modal .mobile-number', '.modal .email', '.modal .country', '.modal .state',
                '.modal .city', '.modal .full-address', '.modal .total-amount', '.modal .status').html('');
            let orderId = $(this).attr('data-id');
            let url = "{{ route('order.detail') }}";
            path = url.replace("http://", "https://");
            $.ajax({
                url: path,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    orderId: orderId
                },
                success: function(response) {
                    $('.full-name').html(response.data.full_name);
                    $('.order-number').html('Order Number ' + response.data.id);
                    $('.mobile-number').html(response.data.mobile_number);
                    $('.email').html(response.data.email);
                    $('.country').html(response.data.country);
                    $('.state').html(response.data.state);
                    $('.city').html(response.data.city);
                    $('.full-address').html(response.data.address);
                    $('.total-amount').html(response.data.total_amount);
                    $('.copuns').html(response.data.sub_total);
                    $('.status').html(response.data.status);
                    $('.order-status').val(response.data.status);
                    $('.order-status').attr('data-id', response.data.id);
                    $('.order-detail').html('');

                    response.data.products.forEach(function(item) {
                        let photos = item.photo.split(',');
                        $('.order-detail').append(`<tr>
                            <td><img width="50" src="${photos[0]}"/></td>
                            <td>${item.title}</td>
                            <td>${item.pivot.quantity}</td>
                            <td>${item.pivot.price}</td>
                        </tr>`);
                    });
                }
            })

        });

        $('.close-modal,.btn-close').on('click', function() {
            $('#orderDetails').modal('hide');
        })

        $('.order-status').change(function() {
            var status = $(this).val();
            var id = $(this).attr('data-id');
            let url = "{{ route('order.status') }}";
            path = url.replace("http://", "https://");
            $.ajax({
                url: path,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    id: id
                },
                success: function(response) {
                    if (response.status) {
                        alert('The Order Has Been Updated Succefully');
                        window.location = window.location.href;
                    }
                }
            })
        });
    </script>
@endsection

{{-- Modal for show the product detail --}}
<div class="modal fade" id="orderDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title order-number"></h5>
                <select class="order-status">
                    <option value="new">{{ __('New') }}</option>
                    <option value="pending">{{ __('Pending') }}</option>
                    <option value="canceled">{{ __('Canceled') }}</option>
                    <option value="completed">{{ __('Completed') }}</option>
                </select>
            </div>
            <div class="modal-body">
                <strong>{{ __('Full Name') }}</strong>
                <p class="full-name"></p>
                <strong>{{ __('User Detail') }}</strong>
                <div class="row">
                    <div class="col-md-6">
                        <p>{{ __('Mobile Number') }}</p>
                        <p class="mobile-number"></p>
                    </div>
                    <div class="col-md-6">
                        <p>{{ __('Email') }}</p>
                        <p class="email"></p>
                    </div>
                </div>
                <strong>{{ __('Address Detail') }}</strong>
                <div class="row">
                    <div class="col-md-4">
                        <p>{{ __('Country') }}</p>
                        <p class="country"></p>
                    </div>
                    <div class="col-md-4">
                        <p>{{ __('State') }}</p>
                        <p class="state"></p>
                    </div>
                    <div class="col-md-4">
                        <p>{{ __('City') }}</p>
                        <p class="city"></p>
                    </div>
                    <strong class="col-md-12">{{ __('Full Address') }}</strong>
                    <p class="full-address"></p>

                </div>
                <strong>{{ __('Order Detail') }}</strong>
                <div class="row">
                    <div class="col-md-3">
                        <p>{{ __('Total Amount') }}</p>
                        <p class="total-amount"></p>
                    </div>
                    <div class="col-md-3">
                        <p>{{ __('Copuns') }}</p>
                        <p class="copuns"></p>
                    </div>
                    <div class="col-md-3">
                        <p>{{ __('Status') }}</p>
                        <p class="status"></p>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Photo') }}</th>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Price') }}</th>
                        </tr>
                    </thead>
                    <tbody class="order-detail">
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
