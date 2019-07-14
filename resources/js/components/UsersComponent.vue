<template>
    <div class="row justify-content-center">
        <div class="col-12" id="users">
            <div class="card">
                <div class="card-header">{{ title }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Imię</th>
                                <th>Nazwisko</th>
                                <th>E-Mail</th>
                                <th>Data urodzenia</th>
                                <th>Płeć</th>
                                <th>Kraj</th>
                                <th>Dodaj do Lotu</th>
                                <th>Usuń</th>
                            </tr>
                        </thead>
                        <tr v-for="user in userItem" :key="user">
                            <td>#{{ users[calcUserId(user)].id }}</td>
                            <td>{{ users[calcUserId(user)].name }}</td>
                            <td>{{ users[calcUserId(user)].lastname }}</td>
                            <td>{{ users[calcUserId(user)].email }}</td>
                            <td>{{ users[calcUserId(user)].birth_day }}</td>
                            <td>{{ users[calcUserId(user)].sex=='man'?'mężczyzna':'kobieta' }}</td>
                            <td>{{ users[calcUserId(user)].country }}</td>
                            <td><button v-on:click="addToFlightModal(users[calcUserId(user)].id)">dodaj</button></td>
                            <td><button v-on:click="deleteUser(users[calcUserId(user)].id)">usuń</button></td>
                        </tr>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item" v-bind:class="{disabled: (page==1)}" >
                                <a class="page-link" v-on:click="setPage(page-1)" >Poprzednia</a>
                            </li>
                            <li class="page-item" v-bind:class="{active: (page==index)}" v-for="index in pagesCount" :key="index">
                                <a class="page-link" v-on:click="setPage(index)" >{{ index }}</a>
                            </li>
                            <li class="page-item" v-bind:class="{disabled: (page==pagesCount.length)}" >
                                <a class="page-link" v-on:click="setPage(page+1)" >Następna</a>
                            </li>
                        </ul>
                    </nav>
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
                this.refreshUsers();
            });
        },
        computed: {
            pagesCount: function(){
                let tmp = Math.ceil(this.users.length/10);
                let r = Array();
                for(let i=1; i<=tmp; i++)
                    r.push(i);
                return r;
            },
            userItem: function(){
                if(this.users.length<=10){
                    return this.users.length;
                } 
                let tmp = Math.min(this.users.length-10*(this.page-1), 10);
                let r = Array();
                for(let i=1; i<=tmp; i++)
                    r.push(i);
                return r;
            }
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
            },
            setPage: function(index){
                this.page=index;
            },
            calcUserId: function(user){
                return (this.page-1)*10+(user-1);
            },
            addToFlightModal: function(id){
                let flight = prompt("Podaj ID lotu (bez '#'):"); //I know it's a bit ugly, but I don't have much time 
                let regex = /^\d+$/;
                if(flight==null) return;
                if(!regex.test(flight)){
                    alert('Musisz podać samą liczbę!');
                    return;
                }
                axios.post('/api/toflight/'+flight+'/'+id)
                    .then(result => {
                        if(result.data.status!='success'){
                            alert('Wystąpił błąd!');
                        } else{
                            alert('Dodano!');
                        }
                    }, error => {
                        alert('Wystąpił błąd!');
                    });
            }
        },
        data() {
            return {
                users: {},
                page: 1,
            }
        }
    }
</script>