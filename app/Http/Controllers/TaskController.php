<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Exception;

class TaskController extends Controller
// Clases heredadas - En python sería class TaskController(Controller):
{
    public function __construct()
    {
        $this->middleware('auth'); // Protege todas las rutas
    }

    public function index()
    {
        // Obtiene solo las tareas del usuario autenticado
        $tasks = Auth::user()->tasks()->latest()->get() ?? collect(); // Evita errores si no hay tareas
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            Auth::user()->tasks()->create($request->only(['title', 'description']));
            return redirect()->route('tasks.index')->with('success', '✅ Tarea creada correctamente.');
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', '⚠️ Error al crear la tarea: ' . $e->getMessage());
        }
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $task->update($request->only(['title', 'description']));
            return redirect()->route('tasks.index')->with('success', '✅ Tarea actualizada correctamente.');
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', '⚠️ Error al actualizar la tarea: ' . $e->getMessage());
        }
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        try {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', '✅ Tarea eliminada correctamente.');
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', '⚠️ Error al eliminar la tarea: ' . $e->getMessage());
        }
    }

    public function toggle(Task $task)
{
    $this->authorize('update', $task);

    try {
        // Cambiar el estado de la tarea
        $task->completed = !$task->completed;

        // Cambiar el título de la tarea según su estado
        if ($task->completed) {
            $task->title = '[Completada] ' . $task->title;
        } else {
            $task->title = str_replace('[Completada] ', '', $task->title);
        }

        // Guardar los cambios
        $task->save();

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->back()->with('success', '✅ Estado de la tarea actualizado.');
    } catch (Exception $e) {
        return redirect()->back()->with('error', '⚠️ Error al cambiar el estado: ' . $e->getMessage());
    }
}
}
