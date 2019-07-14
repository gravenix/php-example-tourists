<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="modal-title">Informacje o Mnie</h2>
                    </div>
                    <div class="card-body">
                        <div class="row text-center font-weight-bold">
                            <div class="col-4">Imię</div>
                            <div class="col-4">Nazwisko</div>
                            <div class="col-4">E-Mail</div>
                        </div>
                        <div class="row text-center font-weight-light">
                            <div class="col-4">{{ person.name }}</div>
                            <div class="col-4">{{ person.lastname }}</div>
                            <div class="col-4">{{ person.email }}</div>
                        </div>
                        <div class="row text-center font-weight-bold">
                            <div class="col-4">Płeć</div>
                            <div class="col-4">Data urodzenia</div>
                            <div class="col-4">Kraj</div>
                        </div>
                        <div class="row text-center font-weight-light">
                            <div class="col-4">{{ person.sex=='man'?'Mężczyzna':'Kobieta' }}</div>
                            <div class="col-4">{{ person.birth_day }}</div>
                            <div class="col-4">{{ person.country }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="modal-title">Moje loty</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Odlot</th>
                                    <th>Przylot</th>
                                    <th>Miejsca</th>
                                    <th>Cena</th>
                                </tr>
                            </thead>
                            <tr v-for="(flight, i) in flights" :key="i">
                                <td>#{{ flight.id }}</td>
                                <td>{{ flight.departure_time }}</td>
                                <td>{{ flight.arrival_time }}</td>
                                <td>{{ flight.seats }}</td>
                                <td>${{ flight.price.toFixed(2) }}</td>
                            </tr>
                        </table>
                        <p class="text-center fluid" v-if="flights.length==0">Brak Lotów</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted(){
            axios.get('/api/user/getflights')
                .then(result => {
                    this.flights = result.data;
                }, error => {
                    alert(error.message);
                })
            axios.get('/api/user')
                .then(result => {
                    this.person = result.data;
                }, error => {
                    alert(error.message);
                })
        },
        data() {
            return { 
                person: {},
                flights: [],
            }
        }
    }
</script>