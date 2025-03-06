@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Iniciar Sesión</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Ingresar</button>
    </form>

    <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
</div>
@endsection
