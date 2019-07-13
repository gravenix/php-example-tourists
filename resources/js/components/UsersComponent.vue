<template>
    <div class="row justify-content-center">
        <div class="col-12" id="users">
            <div class="card">
                <div class="card-header">{{ title }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Imię</th>
                                <th>Nazwisko</th>
                                <th>E-Mail</th>
                                <th>Data urodzenia</th>
                                <th>Płeć</th>
                                <th>Kraj</th>
                                <th>Usuń</th>
                            </tr>
                        </thead>
                        <tr v-for="user in (users.length>10?10:users.length)" :key="user">
                            <td>{{ users[user-1].name }}</td>
                            <td>{{ users[user-1].lastname }}</td>
                            <td>{{ users[user-1].email }}</td>
                            <td>{{ users[user-1].birth_day }}</td>
                            <td>{{ users[user-1].sex }}</td>
                            <td>{{ users[user-1].country }}</td>
                            <td><button v-on:click="deleteUser(users[user-1].id)">usuń</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
    import axios from 'axios';

    export default {
        props: ['title'],
        mounted() {
            axios.get('/api/users')
                .then(result=> {
                    this.users = result.data;
                }, error => {
                    alert("An error occurred while loading users!")
                });
            this.$root.$on('refreshUsers', () =>{
                this.refreshUsers()
            });
        },
        methods: {
            deleteUser: async function(id){
                await axios.delete('/api/user', {data: {'id': id}});
                this.refreshUsers();
            },
            refreshUsers: function() {
                axios.get('/api/users')
                .then(result=> {
                    this.users = result.data;
                }, error => {
                    alert("An error occurred while loading users!")
                });
            }
        },
        data() {
            return {
                users: {},
            }
        }
    }
</script>