<template>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informacje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <h2>{{ data.type=='flight'?"Lot":"Turysta" }} #{{ data.object.id }}</h2>
                <div v-if="data.type=='flight'">
                    <div class="row text-center font-weight-bold">
                        <div class="col-3">Data i godzina odlotu</div>
                        <div class="col-3">Data i godzina przylotu</div>
                        <div class="col-3">Miejsc</div>
                        <div class="col-3">Cena biletu</div>
                    </div>
                    <div class="row text-center font-weight-light">
                        <div class="col-3">{{ data.object.departure_time }}</div>
                        <div class="col-3">{{ data.object.arrival_time }}</div>
                        <div class="col-3">{{ data.object.seats }}</div>
                        <div class="col-3">${{ data.object.price.toFixed(2) }}</div>
                    </div>
                    <div class="row justify-content-center text-center">
                        <div class="col-3">
                            <button class="btn btn-success" v-on:click="addItemUser(data.object.id)">Dodaj do Lotu</button>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Imię</th>
                                    <th>Nazwisko</th>
                                    <th>E-Mail</th>
                                    <th>Płeć</th>
                                    <th>Kraj</th>
                                    <th>Usuń z Lotu</th>
                                </tr>
                            </thead>
                            <tr v-for="(user, i) in list" :key="i">
                                <td>#{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.lastname }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.sex=='man'?'Mężczyzna':'Kobieta' }}</td>
                                <td>{{ user.country }}</td>
                                <td><button class="btn btn-danger" v-on:click="deleteItemFlight(user.id)">usuń</button></td>
                            </tr>
                        </table>
                        <p class="text-center fluid" v-if="list.length==0">Brak turystów</p>
                    </div>
                </div>
                <div v-if="data.type=='user'">
                    <div class="row text-center font-weight-bold">
                        <div class="col-3">Imię</div>
                        <div class="col-3">Nazwisko</div>
                        <div class="col-3">E-Mail</div>
                        <div class="col-3">Płeć</div>
                    </div>
                    <div class="row text-center font-weight-light">
                        <div class="col-3">{{ data.object.name }}</div>
                        <div class="col-3">{{ data.object.lastname }}</div>
                        <div class="col-3">{{ data.object.email }}</div>
                        <div class="col-3">{{ data.object.sex=='man'?'Mężczyzna':'Kobieta' }}</div>
                    </div>
                    <div class="row text-center font-weight-bold">
                        <div class="col-3">Data urodzenia</div>
                        <div class="col-3">Kraj</div>
                    </div>
                    <div class="row text-center font-weight-light">
                        <div class="col-3">{{ data.object.birth_day }}</div>
                        <div class="col-3">{{ data.object.country }}</div>
                    </div>
                    <div class="row justify-content-center text-center">
                        <div class="col-3">
                            <button class="btn btn-success" v-on:click="addItemFlight(data.object.id)">Dodaj do Lotu</button>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Odlot</th>
                                    <th>Przylot</th>
                                    <th>Miejsca</th>
                                    <th>Cena</th>
                                    <th>Usuń z Lotu</th>
                                </tr>
                            </thead>
                            <tr v-for="(flight, i) in list" :key="i">
                                <td>#{{ flight.id }}</td>
                                <td>{{ flight.departure_time }}</td>
                                <td>{{ flight.arrival_time }}</td>
                                <td>{{ flight.seats }}</td>
                                <td>${{ flight.price.toFixed(2) }}</td>
                                <td><button class="btn btn-danger" v-on:click="deleteItemUser(flight.id)">usuń</button></td>
                            </tr>
                        </table>
                        <p class="text-center fluid" v-if="list.length==0">Brak Lotów</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
import { setTimeout } from 'timers';

    export default {
        mounted(){
            this.modal = $('#editModal');
            this.$root.$on('edit', data => {
                this.data=data;
                this.loadApi();
                this.modal.modal('show');
            });
        },
        methods: {
            loadApi(){
                axios.get(this.data.api+'/'+this.data.object.id)
                    .then(result =>{
                        this.list = result.data;
                    }, error => {
                        alert('An error occured');
                    });
            },
            addItemUser(id){
                let user = prompt("Podaj ID użytkownika (bez '#'):"); //I know it's also a bit ugly, but I don't have much time :/
                let regex = /^\d+$/;
                if(user==null) return;
                if(!regex.test(user)){
                    alert('Musisz podać samą liczbę!');
                    return;
                }
                axios.post('/api/toflight/'+id+'/'+user)
                    .then(result => {
                        if(result.data.status!='success'){
                            alert('Wystąpił błąd!');
                        } else{
                            this.loadApi();
                        }
                    }, error => {
                        if(error.response.status==404){
                            alert("Nie znaleziono użytkownika z takim id");
                        } else if(error.response.status==403){
                            alert("Nie można dodać użytkownika (już dodano albo lot jest pełny)");
                        } else{
                            alert('Wystąpił błąd!');
                        }
                    });
                
            },
            addItemFlight(id){
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
                            this.loadApi();
                        }
                    }, error => {
                        alert('Wystąpił błąd!');
                    });
            },
            deleteItemFlight(id){
                let flight = this.data.object.id;
                axios.post('/api/delfromflight/'+flight+'/'+id)
                    .then(result => {
                        this.loadApi();
                    }, error => {
                        alert('An error occurred');
                    });
            },
            deleteItemUser(flight){
                let id = this.data.object.id;
                axios.post('/api/delfromflight/'+flight+'/'+id)
                    .then(result => {
                        this.loadApi();
                    }, error => {
                        alert('An error occurred');
                    });
            }
        },
        data() {
            return { 
                modal: null,
                data: {
                    object:{
                        id: 0
                    }
                },
                list: {},
            }
        }
    }
</script>