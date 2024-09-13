<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <h1>To-Do List</h1>
        <form id="todoForm">
            <input type="text" id="title" placeholder="Title" required>
            <button type="submit">Add To-Do</button>
        </form>
        <ul id="todoList"></ul>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const todoList = document.getElementById('todoList');
            const todoForm = document.getElementById('todoForm');
            const titleInput = document.getElementById('title');

            // Fetch and display todos
            function fetchTodos() {
                fetch('/api/todos')
                    .then(response => response.json())
                    .then(todos => {
                        todoList.innerHTML = todos.map(todo => `
                            <li>
                                <span>${todo.title}</span>
                                <button onclick="deleteTodo(${todo.id})">Delete</button>
                            </li>
                        `).join('');
                    });
            }

            // Add a new todo
            todoForm.addEventListener('submit', function(event) {
                event.preventDefault();
                fetch('/api/todos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ title: titleInput.value })
                }).then(() => {
                    titleInput.value = '';
                    fetchTodos();
                });
            });

            // Delete a todo
            window.deleteTodo = function(id) {
                fetch(`/api/todos/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(() => fetchTodos());
            };

            fetchTodos();
        });
    </script>
</body>
</html>
