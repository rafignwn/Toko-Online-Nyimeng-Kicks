<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nyimeng Kicks - Store</title>
    <link rel="shortcut icon" href="{{ asset('img/logoAdress.png') }}" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('icon/font-awesome-4.7.0/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('img/logobaru.png') }}" alt="Logo Toko" width="150">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <?php 
                                $pesanan = App\Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
                                if(!empty($pesanan)){
                                    $notif = App\Detailpesanan::where('pesanan_id', $pesanan->id)->count();
                                }
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('check-out') }}"><span class="badge badge-pill badge-danger">@if (!empty($notif)) {{$notif}} @endif</span><h3 class="d-inline"><i class="fa fa-shopping-cart"></i></h3></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('profile') }}">Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ url('riwayat-pembayaran') }}">History Pembayaran
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.0.js') }}"></script>
    @if (!empty(session('pesan_berhasil')))
        <script>
            var pesan = '{{ session('pesan_berhasil') }}';
            Swal.fire({
                title : 'Berhasil',
                text : pesan,
                icon : 'success',
                confirmButtonColor : '#007BFF'
            });
        </script>
    @endif

    @if (!empty(session('pesan_gagal')))
        <script>
            var pesan = '{{ session('pesan_gagal') }}';
            Swal.fire({
                title : 'Gagal',
                text : pesan,
                icon : 'error',
                confirmButtonColor : '#007BFF'
            });
        </script>
    @endif

    <script>
        // konfirmasi saat ingin menghapus pesanan
        $('#tombol-hapus').on('click', function(e){
            e.preventDefault();

            const id = $(this).data('id');
            Swal.fire({
                title : 'Apakah anda yakin?',
                text : 'Pesanan anda akan dihapus dari keranjang',
                icon : 'warning',
                showCancelButton : true,
                confirmButtonColor : '#3085d6',
                cancelButtonColor : '#d33',
                confirmButtonText : 'Hapus Pesanan!'
            }).then((result) => {
                if (result.value){
                    $('#form-hapus-pesanan-' + id).submit();
                }
            });
        });

        // konfirmasi saat ingin check-out
        $('#tombol-check-out').on('click', function(e){
            e.preventDefault();

            const href = $(this).attr('href');
            Swal.fire({
                title : 'Apakah anda yakin?',
                text : 'Pesanan akan di lanjutkan ke proses pembayaran',
                icon : 'warning',
                showCancelButton : true,
                confirmButtonColor : '#3085d6',
                cancelButtonColor : '#d33',
                confirmButtonText : 'Check-Out'
            }).then((result) => {
                if (result.value){
                    document.location.href = href;
                }
            });
        });
    </script>
</body>
</html>
