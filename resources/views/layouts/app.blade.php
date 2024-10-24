<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rifa Rub&Maik</title>


    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset("plugins/select2/dist/css/select2.css")}}">

    <link rel="stylesheet" href="{{asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}">
    <!-- Custom fonts for this template-->
    <link href="{{asset('plugins/vendor/fontawesome-free/css/all.min.css')}} " rel="stylesheet" type="text/css">
    @yield('css')
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <!-- <script src="https://kit.fontawesome.com/b99e675b6e.js"></script> -->



</head>

<body id="page-top">
    @yield('modals')

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-text mx-3">{{ auth()->user()->name }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('rifa.list')}}">
                    <i class="fas fa-fw fa-suitcase"></i>
                    Control de Rifa
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('clientes.list')}}">
                    <i class="fas fa-fw fa-mountain"></i>
                    Clientes</a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            {{-- <li class="nav-item active">
                <a class="nav-link" href="{{route('pagos.list')}}">
                    <i class="fas fa-fw fa-suitcase"></i>
                    Pagos
                </a>
            </li> --}}

            @if(auth()->user()->rol == "S.Administrador")
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('usuarios.list')}}">
                        <i class="fas fa-fw fa-user"></i>
                        Usuarios
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link" href="{{route('ventas.list')}}">
                    <i class="fas fa-fw fa-user"></i>
                    Registro de Ventas
                </a>
            </li>
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


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
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
                <div class="mx-3">
                    <strong>Copyright &copy; 2024-2025 <a href="">
                            <!-- Nombre de la empresa -->
                        </a>.</strong>
                    Todos los derechos reservados.
                    <div class="float-right d-none d-sm-inline-block">
                        <b>

                            <!-- aqui van los desarrolladores -->
                        </b>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('plugins/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/vendor/fontawesome-free/js/all.min.js')}}"> </script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('plugins/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('plugins/js/sb-admin-2.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{asset('plugins/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/js/datatables-spanish.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')

</body>

</html>