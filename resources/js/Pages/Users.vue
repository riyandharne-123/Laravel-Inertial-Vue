<template>
    <app-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Users List
            </h2>
        </template>
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Task Count</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in users" :key="item.id">
                    <td>{{ item.name }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.task_count }}</td>
                </tr>
                </tbody>
            </table>
        </div> 
        </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: ['users'],
    components: {
        AppLayout,
    },
    data() {
        return {
           
        }
    },
}
</script>
