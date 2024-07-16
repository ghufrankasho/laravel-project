@extends('backend.layouts.master');

@section('header')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('service.index') }}" class="nav-link">{{ __('List Services') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('service.create') }}" class="btn btn-primary ">{{ __('Create service') }}</a>
    </li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List Services') }}</h3>
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
                        {{-- <th>{{ __('Photo') }}</th> --}}
                        <th>{{ __('Is parent') }}</th>
                        <th>{{ __('Parents') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($categoryServices as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            {{-- <td><img src={{ $item->photo }} alt="service image" style="max-height:100px;"></td> --}}
                            <td>
                                {{ $item->is_parent === 1 ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                @if (!$item->is_parent)
                                    @php
                                        $parentId = App\Models\Service::withTranslation()
                                            ->translatedIn(app()->getLocale())
                                            ->where('id', $item->parent_id)
                                            ->get()
                                            ->first();
                                    @endphp
                                    {{ $parentId->title }}
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
                                <a href="{{ route('service.edit', $item->id) }}" data-toggle="tooltip"
                                    class="float-left btn  btn-outline-warning" title="edit" data-placement="bottom">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="float-left ml-2" action="{{ route('service.destroy', $item->id) }}"
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
                        {{-- <th>{{ __('Photo') }}</th> --}}
                        <th>{{ __('Is parent') }}</th>
                        <th>{{ __('Parents') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                </tfoot>
            </table>
            {{ $categoryServices->withQueryString()->links() }}

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
                url: "{{ str_replace('http://', 'https://', secure_url(route('service.status'))) }}",
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
                    text: "Once deleted, you will not be able to recover this service!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your service has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your service file is safe!");
                    }
                });
        });
    </script>
@endsection
