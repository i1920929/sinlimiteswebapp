@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <div class="hamburger-menu" onclick="toggleMenu()">
        &#9776;
    </div>
    <div class="container">

        <div class="left-section">
            <div class="logo">
                <img src="{{ asset('img/LOGO-DATATHON.png') }}" alt="Sin Límites">
            </div>
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="remember">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Recuérdame</label>
                </div>

                <button type="submit" class="login-button">LOGIN</button>
                <a href="{{ route('register') }}" class="create-account-button">CREAR CUENTA</a>
            </form>
        </div>

        <div class="right-section">
            <nav class="navbar">
                <a href="#" class="menu-item">INICIO</a>
                <a href="#" class="menu-item">EMPLEABILIDAD</a>
                <a href="#" class="menu-item">ASESORÍA</a>
                <a href="{{ route('login') }}" class="menu-login">LOGIN</a>
            </nav>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>
@endsection
