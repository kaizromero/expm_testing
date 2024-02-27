<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ExpM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      
    {{-- startbootstrap template start --}}
    <!-- Custom fonts for this template-->
    <link href="{{ asset('plugin/startbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/app.js') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  

    <!-- Custom styles for this template-->
    <link href="{{ asset('plugin/startbootstrap/css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- startbootstrap template end --}}

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('plugin/startbootstrap/vendor/jquery/jquery.min.js') }}"></script>

    {{-- <script src="{{ asset('plugin/startbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    <!-- Core plugin JavaScript-->
    {{-- <script src="{{ asset('plugin/startbootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script> --}}

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('plugin/startbootstrap/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('plugin/startbootstrap/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugin/startbootstrap/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    
    @yield('style')
    
</head>


<body id="page-top">

     <!-- Page Wrapper -->
     <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
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

                    <!-- Topbar Search -->
                    <formclass="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </formclass=>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        @include('layouts.navbar')

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
                        <span>Copyright &copy; Expense Manager 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    @include('layouts.javascript')

    @yield('javascript')

    
</body>
</html>
