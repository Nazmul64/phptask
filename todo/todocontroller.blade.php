<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Fetch all todos
    public function index()
    {
        return Todo::all();
    }

    // Store a new todo
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo = Todo::create($request->all());
        return response()->json($todo, 201);
    }

    // Show a specific todo
    public function show(Todo $todo)
    {
        return $todo;
    }

    // Update a specific todo
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);

        $todo->update($request->all());
        return response()->json($todo);
    }

    // Delete a specific todo
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(null, 204);
    }
}
