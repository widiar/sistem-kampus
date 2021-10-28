<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <link href="{{ asset('landing-page/img/favicon.png') }}" rel="icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet">

    <link href="{{ asset('landing-page/vendor/toastr/toastr.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatables/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendor/sweetalert2/sweetalert2.min.css') }}">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item{{request()->is('admin/dashboard') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item{{request()->is('admin/jurusan*') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.jurusan.index') }}">
                    <i class="nav-icon fas fa-book"></i>
                    <span>Jurusan</span></a>
            </li>
            <li class="nav-item{{request()->is('admin/konsentrasi*') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.konsentrasi.index') }}">
                    <i class="nav-icon fas fa-book"></i>
                    <span>Konsentrasi</span></a>
            </li>

            <li class="nav-item{{request()->is('admin/mata-kuliah*') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.matakuliah.index') }}">
                    <i class="nav-icon fas fa-book-open"></i>
                    <span>Mata Kuliah</span></a>
            </li>

            <li class="nav-item{{request()->is('admin/mahasiswa*') ? ' active' : '' }}">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#mahasiswaNav">
                    <i class="fas fa-user-check"></i>
                    <span>Verif Mahasiswa</span>
                </a>
                <div id="mahasiswaNav" class="collapse{{request()->is('admin/mahasiswa*') ? ' show' : '' }}"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item{{request()->is('admin/mahasiswa/register*') ? ' active' : '' }}"
                            href="{{ route('admin.mahasiswa') }}">Register</a>
                        <a class="collapse-item{{request()->is('admin/mahasiswa/nilai*') ? ' active' : '' }}"
                            href="{{ route('admin.mahasiswa.nilai') }}">Nilai</a>
                    </div>
                </div>
            </li>

            <li class="nav-item{{request()->is('admin/questions*') ? ' active' : '' }}">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#questionNav">
                    <i class="nav-icon fas fa-question-circle"></i>
                    <span>Questions</span>
                </a>
                <div id="questionNav" class="collapse{{request()->is('admin/questions*') ? ' show' : '' }}"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item{{request()->is('admin/questions/category*') ? ' active' : '' }}"
                            href="{{ route('admin.questions.category') }}">Category</a>
                        <a class="collapse-item{{request()->is('admin/questions') ? ' active' : '' }}"
                            href="{{ route('admin.questions.index') }}">Questions</a>
                    </div>
                </div>
            </li>

            {{-- <li class="nav-item{{request()->is('admin/questions*') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.questions.index') }}">
                    <i class="nav-icon fas fa-question-circle"></i>
                    <span>Questions</span></a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="nav-icon fas fa-user"></i>
                    <span>Logout</span></a>
            </li>

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

                    <h1 class="h3 mb-0 text-gray-800">@yield('title-content')</h1>


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
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    {{-- Data Tables --}}
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('landing-page/vendor/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('admin/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('admin/vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ asset('admin/js/admin.js') }}"></script>

    <script>
        $("#adminTable").dataTable({
            // paging: false,
            // searching: false,
            // columnDefs: [{ orderable: false, targets: 5 }],
        });

        $(function() {
            bsCustomFileInput.init();
        }); 
    </script>

    @yield('script')

</body>

</html>