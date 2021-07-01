<template>
    <app-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Tasks
            </h2>
        </template>
        <div class="container">
            <div class="row" style="padding-top:2%;">
                <div class="col-md-12" style="marign:0 auto;">
                    <div class="card">
                        <div class="card-body">
                            <form @submit="addTask">
                                <div class="row">
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" v-model="name" placeholder="task" required />
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" required v-model="user_id" @change="onChange($event)">
                                            <option v-for="item in users" :key="item.id" :value="item.id">{{  item.name  }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div v-for="task in tasks" :key="task.id">
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-check-inline">
                                            <label class="form-check-label" v-if="task.status == 0">
                                                <input type="checkbox" class="form-check-input" @change="updateTask(task.id)" />
                                            </label>
                                            <label class="form-check-label" v-else>
                                                <input type="checkbox" class="form-check-input" @change="updateTask(task.id)" checked />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <h5 v-if="task.status == 0">{{ task.name }}</h5>
                                        <h5 v-else style="text-decoration-line: line-through;">{{ task.name }}</h5>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-dark" @click="deleteTask(task.id)">X</button>
                                    </div>
                                </div>    
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import axios from 'axios'
    import AppLayout from '@/Layouts/AppLayout'

    export default {

        components: {
            AppLayout,
        },

        data() {
            return {
                name: '',
                user_id:'',
                users:[],
                tasks:[],
            }
        },

        mounted () {
            axios.get('todos')
            .then(res =>{
                this.users = res.data.users,
                this.tasks = res.data.tasks
            })
        },

        methods: {
            onChange(event) {
                this.user_id = event.target.value;
            },
            addTask(event) {
                event.preventDefault();
                axios.post('todos',{
                    name:this.name,
                    user_id:this.user_id
                }).then(res =>{
                    this.tasks = res.data.tasks
                    this.name = "";
                    this.user_id = "";
                })
            },
            updateTask(task_id) {
                axios.put(`/todos/${task_id}`)
                .then(res =>{
                    this.tasks = res.data.tasks
                })
            },
            deleteTask(task_id) {
                axios.delete(`/todos/${task_id}`)
                .then(res =>{
                    this.tasks = res.data.tasks
                    this.name = "";
                    this.user_id = "";
                })
            }
        },
    }
</script>
