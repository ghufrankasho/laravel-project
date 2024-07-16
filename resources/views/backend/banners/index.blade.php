@extends('backend.layouts.master');

@section('header')

    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('banner.index') }}" class="nav-link">{{ __('List Banners') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('banner.create') }}" class="btn btn-primary ">{{ __('Create Banner') }}</a>
    </li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List Banners') }}</h3>
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
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('type') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{!! $item->description !!}</td>
                            <td><img src={{ $item->photo }} alt="banner image" style="max-height:100px;"></td>
                            <td>
                                @if ($item->type == 'banner')
                                    <span class="badge badge-success">{{ $item->type }}</span>
                                @else
                                    <span class="badge badge-primary">{{ $item->type }}</span>
                                @endif
                            </td>
                            <td>
                                {{-- {{$item->status}} --}}
                                <input type="checkbox" id="status" class="status" name="toggle"
                                    value="{{ $item->id }}" data-toggle="toggle"
                                    {{ $item->status == 'active' ? 'checked' : '' }} data-on="Active" data-off="Inactive"
                                    data-onstyle="success" data-offstyle="danger">
                                {{-- <input type="checkbox" id="status"> --}}
                            </td>
                            <td>
                                <a href="{{ route('banner.edit', $item->id) }}" data-toggle="tooltip"
                                    class="float-left btn  btn-outline-warning ml-2" title="edit" data-placement="bottom"  style="margin-top: 8px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="float-left ml-2" style="margin-left: 7px;" action="{{ route('banner.destroy', $item->id) }}"
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
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('type') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </tfoot>
            </table>
            {{ $banners->withQueryString()->links() }}

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
                url: "{{ str_replace('http://', 'https://', secure_url(route('banner.status'))) }}",
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
                    text: "Once deleted, you will not be able to recover this banner!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your banner has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your banner file is safe!");
                    }
                });
        });
    </script>
    
@endsection
