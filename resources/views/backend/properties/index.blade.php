@extends('backend.layouts.master');

@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('product.index') }}" class="nav-link">{{ __('List Products') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('properties.index', ['productId' => \Request::get('productId')]) }}" class="nav-link">
            {{ __('List Properties') }}
        </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('properties.create', ['productId' => \Request::get('productId')]) }}" class="btn btn-primary">
            {{ __('Create Property') }}
        </a>
    </li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List Properties') }}</h3>
        </div>

        {{-- show  the notifications --}}
        <div class="card-header">
            @include('backend.layouts.notifications')
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ __('S.N.') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Value') }}</th>

                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $key => $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->products->title }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->value }}</td>
                            <td>
                                <a href="{{ route('properties.edit', $item->id) }}" data-toggle="tooltip"
                                    class="float-left btn  btn-outline-warning" title="edit" data-placement="bottom">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="float-left ml-2" action="{{ route('properties.destroy', $item->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
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
                    <tr>
                        <th>{{ __('S.N.') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Value') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </tfoot>
            </table>
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
                url: "{{ route('property.status') }}",
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
                    text: "Once deleted, you will not be able to recover it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your properies has been deleted!", {
                            icon: "success",
                        });
                    }
                });
        });
    </script>
@endsection