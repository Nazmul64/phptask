<template>
    <div>
        <h1>To-Do List</h1>
        <form @submit.prevent="addTodo">
            <input v-model="newTodo.title" placeholder="Title" required>
            <button type="submit">Add To-Do</button>
        </form>
        <ul>
            <li v-for="todo in todos" :key="todo.id">
                <span>{{ todo.title }}</span>
                <button @click="deleteTodo(todo.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            todos: [],
            newTodo: {
                title: ''
            }
        };
    },
    methods: {
        fetchTodos() {
            axios.get('/api/todos')
                .then(response => {
                    this.todos = response.data;
                });
        },
        addTodo() {
            axios.post('/api/todos', this.newTodo)
                .then(() => {
                    this.newTodo.title = '';
                    this.fetchTodos();
                });
        },
        deleteTodo(id) {
            axios.delete(`/api/todos/${id}`)
                .then(() => {
                    this.fetchTodos();
                });
        }
    },
    mounted() {
        this.fetchTodos();
    }
};
</script>
