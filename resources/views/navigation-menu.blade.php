<header class="main-header" style="background: #207cb4">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>
                IOT
            </b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg flex-icon">
            <b>
                <img src="{{ asset('img/iot-avocado.png') }}" width="50" height="50" />
            </b>IOT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{-- <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="user-image"
                            alt="User Image"> --}}
                        @if (Auth::user()->gender == '1')
                            <img src=" {{ asset('img/avatar-man.jpg') }}" class="user-image" alt="User Image">
                        @else
                            <img src=" {{ asset('img/avatar-woman.jpg') }}" class="user-image" alt="User Image">
                        @endif


                        <span class="hidden-xs">{{ Auth::user()->name }}</span>


                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header flex flex-col justify-center items-center">
                            {{-- <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle"
                                alt="User Image"> --}}
                            @if (Auth::user()->gender == '1')
                                <img src=" {{ asset('img/avatar-man.jpg') }}" class="user-image" alt="User Image">
                            @else
                                <img src=" {{ asset('img/avatar-woman.jpg') }}" class="user-image"
                                    alt="User Image">
                            @endif

                            <p>
                                {{ Auth::user()->name }} - Web Developer
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('profile.show') }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                {{-- <a href="#" class="btn btn-default btn-flat">Sign out</a> --}}

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link-signout href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Sign out') }}
                                    </x-dropdown-link-signout>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                {{-- <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> --}}
                @if (Auth::user()->gender == '1')
                    <img src="{{ asset('img/avatar-man.jpg') }}" class="img-circle" alt="User Image">
                @else
                    <img src="{{ asset('img/avatar-woman.jpg') }}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            @role('admin|employee')
                <x-dropdown-link-li :active="request()->routeIs('principal')">
                    <a href="{{ route('principal') }}">
                        <x-svg-dashboard size="20" color="#ffffff" colorline=" #ffffff" /> <span>Dashboard</span>

                    </a>
                </x-dropdown-link-li>

                <x-dropdown-link-li :active="request()->routeIs('productos.index')">
                    <a href="{{ route('productos.index') }}">
                        <x-svg-avocado size="20" color="#ffffff" colorline=" #ffffff" />
                        <span>Producción</span>
                    </a>
                </x-dropdown-link-li>

                <li class="treeview {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Reports</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('reports.abono.*') ? 'active' : '' }}"><a
                                href="{{ route('reports.abono.index') }}"><i class="fa fa-circle-o"></i> Report Abono</a>
                        </li>
                        <li class="{{ request()->routeIs('reports.riego.*') ? 'active' : '' }}"><a
                                href="{{ route('reports.riego.index') }}"><i class="fa fa-circle-o"></i> Report Riego</a>
                        </li>

                    </ul>
                </li>
            @endrole

            @role('admin')
                <x-dropdown-link-li :active="request()->routeIs('persons.index')">
                    <a href="{{ route('persons.index') }}">
                        <x-svg-people size="20" color="#ffffff" colorline=" #ffffff" />
                        <span>Personal</span>
                    </a>
                </x-dropdown-link-li>
            @endrole


            <x-dropdown-link-li :active="request()->routeIs('sensores.index')">
                <a href="{{ route('sensores.index') }}">
                    <x-svg-sensor size="20" color="#ffffff" colorline=" #ffffff" />
                    <span>Sensores</span>
                </a>
            </x-dropdown-link-li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
