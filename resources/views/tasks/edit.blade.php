@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<div class="container">
    <h1>Editar Tarea</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="completed" class="form-label">Estado</label>
            <select name="completed" class="form-control">
                <option value="0" {{ !$task->completed ? 'selected' : '' }}>Pendiente</option>
                <option value="1" {{ $task->completed ? 'selected' : '' }}>Completada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
