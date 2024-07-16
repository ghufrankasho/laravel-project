@extends('backend.layouts.master');

@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('discounts.index') }}" class="nav-link">{{ __('List Copuns') }}</a>
    </li>
    @if (is_null(Auth::user()->store_id))
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('discounts.create') }}" class="btn btn-primary ">{{ __('Create Copun') }}</a>
        </li>
    @endif
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List Copuns') }}</h3>
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
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Value') }}</th>
                        {{-- <th>{{ __('Period') }}</th> --}}
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Code') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($discounts as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->value }}</td>
                            {{-- <td>{{ $item->period }}</td> --}}
                            <td><span class="badge badge-primary">{{ $item->type == 'fixed'  ? 'Fixed Price' : 'Percent %' }}</span></td>
                            <td>{{ $item->code }}</td>
                            <td>
                                {{-- {{$item->status}} --}}
                                <input type="checkbox" id="status" class="status" name="toggle"
                                    value="{{ $item->id }}" data-toggle="toggle"
                                    {{ $item->status == 'active' ? 'checked' : '' }} data-on="Active" data-off="Inactive"
                                    data-onstyle="success" data-offstyle="danger">
                                {{-- <input type="checkbox" id="status"> --}}
                            </td>
                            <td>
                                @if (is_null(Auth::user()->store_id))
                                    <a href="{{ route('discounts.edit', $item->id) }}" data-toggle="tooltip"
                                        class="float-left btn  btn-outline-warning" title="edit" data-placement="bottom">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="float-left ml-2" action="{{ route('discounts.destroy', $item->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="#" data-toggle="tooltip" class="del-btn btn  btn-outline-danger"
                                            data-id="{{ $item->id }}" title="delete" data-placement="bottom">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>{{ __('S.N.') }}</th>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('Full Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </tfoot>
            </table>
            {{ $discounts->withQueryString()->links() }}

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
                url: "{{ str_replace('http://', 'https://', secure_url(route('discounts.status'))) }}",
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
                    text: "Once deleted, you will not be able to recover this stores!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your stores has been deleted!", {
                            icon: "success",
                        });
                    }
                });
        });
    </script>
@endsection
