@extends('backend.layouts.master');

@section('header')

    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('offer.index') }}" class="nav-link">{{ __('List Offers') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('offer.create') }}" class="btn btn-primary ">{{ __('Create Offer') }}</a>
    </li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List Offers') }}</h3>
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
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('Serial Number') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $item)
                        <tr>
                            
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->price }}</td>
                            
                            <td><img src={{ $item->photo }} alt="offer image" style="max-height:100px;"></td>
                            <td>{{ $item->serial_number }}</td>
                            <td>
                                {{-- {{$item->status}} --}}
                                <input type="checkbox" id="status" class="status" name="toggle"
                                    value="{{ $item->id }}" data-toggle="toggle"
                                    {{ $item->status == 'active' ? 'checked' : '' }} data-on="Active" data-off="Inactive"
                                    data-onstyle="success" data-offstyle="danger">
                                {{-- <input type="checkbox" id="status"> --}}
                            </td>

                            <td>
                                @if ($item->condition == 'offer')
                                    <span class="badge badge-success">{{ $item->condition }}</span>
                                @else
                                    <span class="badge badge-primary">{{ $item->condition }}</span>
                                @endif
                                <a href="{{ route('offer.edit', $item->id) }}" data-toggle="tooltip"
                                    class="float-left btn  btn-outline-warning ml-2" title="edit" data-placement="bottom" style="margin-top: 8px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="float-left ml-2" action="{{ route('offer.destroy', $item->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <a style="" href="#" data-toggle="tooltip" class="del-btn btn  btn-outline-danger mt-2"
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
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('Serial Number') }}</th>
                        <th>{{ __('Status') }}</th>
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
                url: "{{ route('offer.status') }}",
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
                    text: "Once deleted, you will not be able to recover this offer!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your offer has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your offer file is safe!");
                    }
                });
        });
    </script>
@endsection
