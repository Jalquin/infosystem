<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="InfoSystem">
    <meta name="author" content="Jakub Cerveny">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IS - @yield('title')</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
@yield('css')

<!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-globe-europe"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Info System</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>{{ __('Přehled') }}</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Komponenty IS') }}
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('jobs.index') }}">
                <i class="fas fa-hammer"></i>
                <span>{{ __('Zakázky') }}</span>
            </a>
        </li>

        <!-- Nav Item - Address book -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAddressBook"
               aria-expanded="false" aria-controls="collapseAddressBook">
                <i class="fas fa-users"></i>
                <span>Adresář</span>
            </a>
            <div id="collapseAddressBook" class="collapse" aria-labelledby="headingDepot"
                 data-parent="#accordionSidebar"
                 style="">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Adresář:</h6>
                    <a class="collapse-item" href="{{route('companies.index')}}">
                        <i class="fas fa-industry"></i>
                        <span>Firmy</span>
                    </a>
                    <a class="collapse-item" href="{{route('people.index')}}">
                        <i class="fas fa-user-friends"></i>
                        <span>Osoby</span>
                    </a>
                    <a class="collapse-item" href="{{route('addresses.index')}}">
                        <i class="fas fa-address-card"></i>
                        <span>Adresy</span>
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Depot -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('items.index') }}">
                <i class="fas fa-warehouse"></i>
                <span>{{ __('Sklad') }}</span>
            </a>
        </li>

    @if(Auth::user()->admin == 1)
        <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Nastavení') }}
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-user-cog"></i>
                    <span>{{ __('Uživatelé') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
                   aria-expanded="false" aria-controls="collapseSettings">
                    <i class="fas fa-cogs"></i>
                    <span>Nastavení komponent</span>
                </a>
                <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings"
                     data-parent="#accordionSidebar"
                     style="">

                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- Nav Item - Depot management -->
                        <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseDepot"
                           aria-expanded="false" aria-controls="collapseDepot">
                            <i class="fas fa-cog"></i>
                            <i class="fas fa-warehouse"></i>
                            <span>Nastavení skladu</span>
                        </a>

                        <!-- Nav Item - Job management -->
                        <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseJob"
                           aria-expanded="false" aria-controls="collapseJob">
                            <i class="fas fa-cog"></i>
                            <i class="fas fa-hammer"></i>
                            <span>Nastavení zakázek</span>
                        </a>

                        <!-- Nav Item - Person management -->
                        <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapsePerson"
                           aria-expanded="false" aria-controls="collapsePerson">
                            <i class="fas fa-cog"></i>
                            <i class="fas fa-user-friends"></i>
                            <span>Nastavení osob</span>
                        </a>

                        <!-- Nav Item - Address management -->
                        <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseAddress"
                           aria-expanded="false" aria-controls="collapseAddress">
                            <i class="fas fa-cog"></i>
                            <i class="fas fa-address-card"></i>
                            <span>Nastavení adres</span>
                        </a>
                    </div>
                </div>
                <div id="collapseDepot" class="collapse" aria-labelledby="headingDepotSettings"
                     data-parent="#accordionSidebar"
                     style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Nastavení skladu:</h6>
                        <a class="collapse-item" href="{{route('categories.index')}}">Kategorie</a>
                        <a class="collapse-item" href="{{route('positions.index')}}">Umístění</a>
                    </div>
                </div>
                <div id="collapseJob" class="collapse" aria-labelledby="headingJobSettings"
                     data-parent="#accordionSidebar"
                     style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Nastavení zakázek:</h6>
                        <a class="collapse-item" href="{{route('statuses.index')}}">Statusy</a>
                    </div>
                </div>
                <div id="collapsePerson" class="collapse" aria-labelledby="headingPersonSettings"
                     data-parent="#accordionSidebar"
                     style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Nastavení osob:</h6>
                        <a class="collapse-item" href="{{route('roles.index')}}">Role</a>
                    </div>
                </div>
                <div id="collapseAddress" class="collapse" aria-labelledby="headingAddressSettings"
                     data-parent="#accordionSidebar"
                     style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Nastavení adres:</h6>
                        <a class="collapse-item" href="{{route('address_types.index')}}">Typy adres</a>
                    </div>
                </div>
            </li>
    @endif

    <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <span class="navbar-text">
                    <span id="time"></span><br><span id="date"></span>
                </span>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        @auth
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span
                                class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                        data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                        @endauth

                        @guest
                            <a class="btn btn-primary btn-icon-split"
                               href="{{ route('login') }}">
                                <span class="icon text-white-50">
                                    <i class="fas fa-sign-in-alt"></i>
                                </span>
                                <span class="text">Přihlásit se</span>
                            </a>
                            <a class="btn btn-secondary btn-icon-split"
                               href="{{ route('register') }}">
                                <span class="icon text-white-50">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <span class="text">Registrovat</span>
                            </a>
                    @endguest

                    <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm mr-2 text-gray-400"></i>
                                {{ __('Profil') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm mr-2 text-gray-400"></i>
                                {{ __('Odhlásit se') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Jakub Červený 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Odhlásit?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pro odhlášení zvolte možnost "Odhlásit se".</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Zrušit') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Odhlásit se') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script>
    window.setInterval(ut, 1000);

    function ut() {
        const d = new Date();
        document.getElementById("time").innerHTML = d.toLocaleTimeString();
        document.getElementById("date").innerHTML = d.toLocaleDateString();
    }
</script>
@stack('scripts')

</body>
</html>
