@extends('backend.layouts.master');

@section('header')

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('user.index')}}" class="nav-link">{{__('List Users')}}</a>
</li>
<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('user.create')}}" class="btn btn-primary ">{{__('Create user')}}</a>
</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{__('List Users')}}</h3>
    </div>

    {{-- show  the notifications  --}}
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
                    <th>{{__('S.N.')}}</th>
                    <th>{{__('Photo')}}</th>
                    <th>{{__('Full Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Role')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td><img src={{$item->photo}} alt="user image" style="max-height:100px;"></td>
                    <td>{{$item->full_name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->role}}</td>
                    <td>
                        {{-- {{$item->status}} --}}
                        <input type="checkbox" id="status" class="status" name="toggle" value="{{$item->id}}" data-toggle="toggle" {{ $item->status =='active' ? 'checked' : ''}} data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                        {{-- <input type="checkbox" id="status"> --}}
                    </td>
                    <td>
                        <a href="{{route('user.edit',$item->id)}}" data-toggle="tooltip" class="float-left btn  btn-outline-warning ml-2" title="edit" data-placement="bottom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form class="float-left ml-2" action="{{route('user.destroy',$item->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <a href="#" data-toggle="tooltip" class="del-btn btn  btn-outline-danger" data-id="{{$item->id}}" title="delete" data-placement="bottom">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </form>
                    </td>

                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>{{__('S.N.')}}</th>
                    <th>{{__('Photo')}}</th>
                    <th>{{__('Full Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Role')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Actions')}}</th>

                </tr>
            </tfoot>
        </table>
        {{ $users->withQueryString()->links() }}

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
            url: "{{ str_replace('http://', 'https://', secure_url(route('user.status'))) }}"
            , type: 'POST'
            , data: {
                _token: '{{csrf_token()}}'
                , mode: mode
                , id: id
            }
            , success: function(response) {
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
                title: "Are you sure?"
                , text: "Once deleted, you will not be able to recover this user!"
                , icon: "warning"
                , buttons: true
                , dangerMode: true
            , })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Your user has been deleted!", {
                        icon: "success"
                    , });
                } else {
                    swal("Your user file is safe!");
                }
            });
    });

</script>
@endsection
