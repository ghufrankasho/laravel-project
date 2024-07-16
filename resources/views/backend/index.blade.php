@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $products }}</h3>

                            <p>{{ __('Products') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ url('admin/product') }}" class="small-box-footer">
                            {{ __('More info') }}
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $categories }}</h3>
                            <p>{{ __('Categories') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ url('admin/category') }}" class="small-box-footer">
                            {{ __('More info') }}
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $users }}</h3>

                            <p>{{ __('Users') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ url('admin/user') }}" class="small-box-footer">
                            {{ __('More info') }}
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $banners }}</h3>

                            <p>{{ __('Banners') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ url('admin/banner') }}" class="small-box-footer">
                            {{ __('More info') }}
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                {{-- Orders --}}
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $newOrder }}</h3>

                            <p>{{ __('New Order') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ url('admin/order/new') }}" class="small-box-footer">
                            {{ __('More info') }}
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pendingOrder }}</h3>
                            <p>{{ __('Pending Order') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ url('admin/order/pending') }}" class="small-box-footer">
                            {{ __('More info') }}
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $canceledOrder }}</h3>

                            <p>{{ __('Canceled Order') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ url('admin/order/canceled') }}" class="small-box-footer">
                            {{ __('More info') }}
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $completedOrder }}</h3>

                            <p>{{ __('Completed Order') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ url('admin/order/completed') }}" class="small-box-footer">
                            {{ __('More info') }}
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- ./col -->
                <div class="card col-7">
                    <div class="content-header card-header border-transparent">
                        <h3 class="card-title">{{ __('Latest Orders') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Order ID') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    {{ $order->id }}
                                                </a>
                                            </td>
                                            <td>{{ $order->full_name }}</td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <span class="badge badge-info">
                                                        {{ $order->status }}
                                                    </span>
                                                @elseif($order->status =='new')
                                                    <span class="badge badge-primary">
                                                        {{ $order->status }}
                                                    </span>
                                                @elseif($order->status =='completed')
                                                    <span class="badge badge-success">
                                                        {{ $order->status }}
                                                    </span>
                                                @elseif($order->status =='canceled')
                                                    <span class="badge badge-danger">
                                                        {{ $order->status }}
                                                    </span>
                                                @endIf
                                            </td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                    {{ $order->created_at }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <a href="{{ url('admin/order') }}" class="btn btn-sm btn-secondary float-right">
                            {{ __('View All Orders') }}
                        </a>
                    </div>
                    <!-- /.card-footer -->
                </div>

                <div class="col-1"></div>
                <div class="card col-4">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Recently Added Products') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">

                            @foreach ($productItems as $product)
                                <li class="item">
                                    <div class="product-img">
                                        @if ($product->photo)
                                            <?php $explodePath = explode(',', $product->photo); ?>
                                            <?php if(is_array($explodePath)){?>
                                            <?php $i=1;foreach ($explodePath as $photo) {
                                            if($i<2){?>
                                            <img src="{{ $photo }}" class="img-size-50">
                                            <?php $i++;
                                           }
                                         } ?>
                                            <?php } else { ?>
                                            <img src="{{ $product->photo }}" class="img-size-50">
                                            <?php } ?>
                                        @endif
                                    </div>

                                    <div class="product-info">
                                        <a href="{{ route('product.edit', $product->id) }}" class="product-title">
                                            {{ $product->title }}
                                            <span class="badge badge-info float-right"> {{ $product->price }}</span>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="{{ url('admin/product') }}" class="uppercase">View All Products</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>

        </div><!-- /.container-fluid -->



    </section>
    <!-- /.content -->

@endsection
