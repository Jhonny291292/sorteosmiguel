<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Rifa Rub&Maik</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{asset('plugins/vendor/fontawesome-free/css/all.min.css')}} " rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="{{asset("img/logoRifa.jpeg")}}" type="image/x-icon">
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
         <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    </head>
    <body class="font-sans text-gray-900antialiased">
        
            @yield('content')
        
        <script src="{{asset('plugins/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/vendor/fontawesome-free/js/all.min.js')}}"> </script>
         

        <script>
            $(document).ready(function() {
                const togglePassword = document.querySelector('#togglePassword');
                const passwordInput = document.querySelector('#password');

                $(document).on('click', '#togglePassword', function (e) {
                    // Alternar el tipo de input
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    // Alternar el ícono del ojo
                    if (type === 'password') {
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    } else {
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    }
                });
            });
        </script>
    </body>
</html>
