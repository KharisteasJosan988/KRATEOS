<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title', 'KRATEOS')</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* Tambahkan gaya CSS untuk header dan sidebar */
        .sb-topnav {
            background-color: #4e73df;
            color: #fff;
        }

        .sb-sidenav {
            background-color: #2e59d9;
        }

        .sb-sidenav-menu {
            border-right: 1px solid #2949a2;
        }

        .sb-sidenav-menu .nav-link {
            color: #ffffff;
            transition: background 0.3s, color 0.3s;
        }

        .sb-sidenav-menu .nav-link:hover {
            background: #2949a2 color: #ffffff;
        }

        .sb-sidenav-menu .nav-link .sb-nav-link-icon {
            color: #ffffff;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark">
        <a class="navbar-brand ps-3 text-monospace fw-bolder ml-5 fs-3" href="{{ route('admin.dashboard') }}">KRATEOS</a>
        <ul class="navbar-nav ms-auto ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                    {{ auth()->user()->email }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('auth.index') }}">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidenav -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-footer" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        @can('admin')
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="{{ route('menu.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-cutlery"></i></div>
                                Menu
                            </a>
                            <a class="nav-link" href="{{ route('gallery.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-image"></i></div>
                                Gallery
                            </a>
                            <a class="nav-link" href="{{ url('/app') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart "></i></div>
                                Kasir Pesanan
                            </a>
                            <a class="nav-link" href="{{ url('/transaksi') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill "></i></div>
                                Transaksi
                            </a>
                        @endcan
                    </div>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">KRATEOS 2024</div>
                        <div>
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="/assets/plugins/toastr/toastr.min.js"></script>
    <script src="/assets/dist/js/adminlte.min.js"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script>
        $(function() {

            @if (session()->has('gagal'))
                toastr.error('{{ Session::get('gagal') }}', 'Error')
            @endif
            @if (session()->has('berhasil'))
                toastr.success('{{ Session::get('berhasil') }}', 'Berhasil')
            @endif
        });
    </script>
    @yield('script')
    @stack('js')
</body>

</html>
