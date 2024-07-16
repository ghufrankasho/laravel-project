<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('backend/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Alsahappa Printing</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
                <a href="{{ route('logout', app()->getLocale()) }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    class="d-block">Logout</a>
                <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item @if(request()->is('admin')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashbaord
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin') }}" class="nav-link @if(request()->is('admin')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Dashbaord</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item @if(request()->is('admin/setting*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/setting*')) active @endif">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            {{ __('Setting Managment') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('setting.index') }}" class="nav-link @if(request()->is('admin/setting')||request()->is('admin/setting/*/edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Settings') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.create') }}" class="nav-link @if(request()->is('admin/setting/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add New Setting') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('admin/user*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/user*')) active @endif">
                        <i class="nav-icon fas  fa-user"></i>
                        <p>
                            {{ __('Users Managment') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link @if(request()->is('admin/user/*/edit')||request()->is('admin/user')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> {{ __('All Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.create') }}" class="nav-link @if(request()->is('admin/user/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add User') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if(request()->is('admin/banner*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/banner*')) active @endif">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            {{ __('Banner Managment') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('banner.index') }}" class="nav-link @if(request()->is('admin/banner')||request()->is('admin/banner/*/edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Banners') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('banner.create') }}" class="nav-link @if(request()->is('admin/banner/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Banner') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('admin/blog*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/blog*')) active @endif">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            {{ __('Blogs Managment') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('blog.index') }}" class="nav-link @if(request()->is('admin/blog/*/edit')||request()->is('admin/blog')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Blogs') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog.create') }}" class="nav-link @if(request()->is('admin/blog/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Blog') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('admin/category*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/category*')) active @endif">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            <p>{{ __('Categories Managment') }}</p>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link @if(request()->is('admin/category')||request()->is('admin/category/*/edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Categories') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.create') }}" class="nav-link @if(request()->is('admin/category/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Category') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('admin/product*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/product*')) active @endif">
                        <i class="nav-icon fas  fa-briefcase"></i>
                        <p>
                            {{ __('Products Managment') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link @if(request()->is('admin/product')||request()->is('admin/product/*/edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> {{ __('All Products') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}" class="nav-link @if(request()->is('admin/product/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add product') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('admin/page*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/page*')) active @endif">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            {{ __('Page Managment') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('page.index') }}" class="nav-link @if(request()->is('admin/page')||request()->is('admin/page/*/edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Pages') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('page.create') }}" class="nav-link @if(request()->is('admin/page/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Page') }}</p>
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="nav-item @if(request()->is('admin/order*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/order*')) active @endif">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            {{ __(' Cart Managment') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/order/new') }}" class="nav-link @if(request()->is('admin/order/new')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> {{ __(' New Order') }} </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/order/pending') }}" class="nav-link @if(request()->is('admin/order/pending')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> {{ __(' Pending Order') }} </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/order/canceled') }}" class="nav-link @if(request()->is('admin/order/canceled')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> {{ __(' Canceled Order') }} </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/order/completed') }}" class="nav-link @if(request()->is('admin/order/completed')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> {{ __(' Complete Order') }} </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('admin/brand*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/brand*')) active @endif">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            <p>{{ __('Albums Managment') }}</p>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('brand.index') }}" class="nav-link @if(request()->is('admin/brand/*/edit')||request()->is('admin/brand')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All albums') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('brand.create') }}" class="nav-link @if(request()->is('admin/brand/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add album') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- upload Brochore --}}
                            <a href="{{ route('brand.create') . '?type=file' }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Brochore') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('admin/service*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/service*')) active @endif">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            <p>{{ __('services Managment') }}</p>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('service.index') }}" class="nav-link @if(request()->is('admin/service/*/edit')||request()->is('admin/service')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All services') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('service.create') }}" class="nav-link @if(request()->is('admin/service/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add service') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if(request()->is('admin/discounts*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->is('admin/discounts*')) active @endif">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>
                            <p>{{ __('Coupons Managment') }}</p>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('discounts.index') }}" class="nav-link @if(request()->is('admin/discounts/*/edit')||request()->is('admin/discounts')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Copuns') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('discounts.create') }}" class="nav-link @if(request()->is('admin/discounts/create')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Copun') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>
                            <p>{{ __('Offers Managment') }}</p>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('offer.index') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Offers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('offer.create') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Offer') }}</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
