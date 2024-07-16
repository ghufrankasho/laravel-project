
@extends('backend.layouts.master');

@section('header')

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('setting.index')}}" class="nav-link">{{__('List Settings')}}</a>
</li>
<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('setting.create')}}" class="btn btn-primary ">{{__('Create Setting')}}</a>
</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{__('List Settings')}}</h3>
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
                    <th>{{__('Title')}}</th>
                    <th>{{__('key')}}</th>                   
                    <th>{{__('Value Actual')}}</th>                    
                    {{-- <th>{{__('Is Hidden')}}</th> --}}
                    <th>{{__('Actions')}}</th>  
                </tr>
            </thead>
            <tbody>
                @foreach($allSettings as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->key}}</td>
                    <td style="width:60px;">{{unserialize($item->value_actual)}}</td>
                    {{-- <td>
                        {{$item->is_hidden === 1 ? 'Yes' : 'No'}}
                    </td> --}}
                    <td style="display: flex !important;">
                        <a href="{{route('setting.edit',$item->id)}}" data-toggle="tooltip" class="float-left btn  btn-outline-warning" title="edit" data-placement="bottom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form class="float-left ml-2" action="{{route('setting.destroy',$item->id)}}" method="post">
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
                    <th>{{__('Title')}}</th>
                    <th>{{__('key')}}</th>                   
                    <th>{{__('Value Actual')}}</th>                    
                    <th>{{__('Actions')}}</th>
                </tr>
            </tfoot>
        </table>
        {{ $allSettings->withQueryString()->links() }}

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
                title: "Are you sure?"
                , text: "Once deleted, you will not be able to recover this Setting!"
                , icon: "warning"
                , buttons: true
                , dangerMode: true
            , })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Your Setting has been deleted!", {
                        icon: "success"
                    , });
                } else {
                    swal("Your Setting file is safe!");
                }
            });
    });
</script>
@endsection
