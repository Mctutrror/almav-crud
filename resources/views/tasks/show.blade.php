@extends('layouts.app')

@section('title', 'Detalles de la Tarea')

@section('content')
<div class="container">
    <h1>Detalles de la Tarea</h1>
    <p><strong>ID:</strong> {{ $task->id }}</p>
    <p><strong>Título:</strong> {{ $task->title }}</p>
    <p><strong>Descripción:</strong> {{ $task->description }}</p>
    <p><strong>Estado:</strong> {{ $task->completed ? 'Completada' : 'Pendiente' }}</p>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
