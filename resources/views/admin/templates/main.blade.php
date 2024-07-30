<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Employee Management </title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Print js-->
    <link href="{{ asset('sb-admin/css/print.min.css') }}" rel="stylesheet">

    {{-- SweetAlert2  --}}
    <link rel="stylesheet" href="{{ asset('sb-admin/vendor/sweetalert2/package/dist/sweetalert2.min.css') }}">    

    <!-- CSS dataTables -->
    <link rel="stylesheet" href="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}">
    
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('sb-admin/vendor/select2/package/dist/css/select2.min.css') }}">

    @yield('styles')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.components.sb-sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.components.sb-topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('admin.components.sb-footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


 

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Print js-->
    <script src="{{ asset('sb-admin/js/print.min.js') }}"></script>

    <!-- Input Mask-->
    <script src="{{ asset('sb-admin/vendor/input-mask/jquery.inputmask.bundle.min.js') }}"></script>

    {{-- Datatable  --}}
    <script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    
    
    {{-- SweetAlert2  --}}
    <script src="{{ asset('sb-admin/vendor/sweetalert2/package/dist/sweetalert2.all.min.js') }}"></script>

     {{-- Select2  --}}
     <script src="{{ asset('sb-admin/vendor/select2/package/dist/js/select2.min.js') }}"></script>



    @yield('scripts')

</body>

</html>
