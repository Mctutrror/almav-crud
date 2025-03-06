@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registro de Usuario</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
</div>
@endsection
