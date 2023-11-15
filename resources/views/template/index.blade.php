<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('styles.css')}}" />
        <link rel="shortcut icon" href="{{asset('image/instagram.png')}}"  type="image/x-icon"/>
        <link rel="stylesheet" href="{{asset('fontawesome-6.4.2/css/all.min.css')}}" />
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('fontawesome-6.4.2/js/all.min.js')}}"></script>
        <script src="{{asset('scripts.js')}}"></script>
    </head>
    <body class="sb-nav-fixed">

    <!-- Navbar atas -->
        @include('template/navbar_atas')

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            @include('template/navbar_kiri')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 pt-4">

                        @include('template/pesan_kilat')
                        <!-- Diisi oleh file apapun -->
                        @yield('konten')

                        <div class="row">

                        </div>
                    </div>
                </main>
                @include('template/footer')
            </div>
        </div>
    </body>

</html>
