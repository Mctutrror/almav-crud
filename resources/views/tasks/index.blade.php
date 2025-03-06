@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Tareas</h1>

    {{-- Mostrar mensajes de éxito o error --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th> {{-- Número incremental en la tabla --}}
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $index => $task)
            <tr>
                <td>{{ $index + 1 }}</td> {{-- Número incremental en la vista --}}
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    <span class="badge {{ $task->completed ? 'bg-success' : 'bg-warning' }}">
                        {{ $task->completed ? 'Completada' : 'Pendiente' }}
                    </span>
                </td>
                <td>
                    {{-- Botón para cambiar el estado de la tarea --}}
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-info btn-sm">
                            {{ $task->completed ? 'Marcar como Pendiente' : 'Marcar como Completada' }}
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta tarea?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
