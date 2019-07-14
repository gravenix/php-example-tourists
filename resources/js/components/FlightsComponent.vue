<template>
    <div class="row justify-content-center">
        <div class="col-12" id="flights">
            <div class="card">
                <div class="card-header">{{ title }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Czas odlotu</th>
                                <th>Czas Przylotu</th>
                                <th>Miejsca</th>
                                <th>Cena</th>
                            </tr>
                        </thead>
                        <tr v-for="flight in flightItem" :key="flight">
                            <td>{{ flights[calcFlightId(flight)].departure_time }}</td>
                            <td>{{ flights[calcFlightId(flight)].arrival_time }}</td>
                            <td>{{ flights[calcFlightId(flight)].seats }}</td>
                            <td>{{ flights[calcFlightId(flight)].price }}</td>
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
    export default {
        props: ['title'],
        mounted() {
            axios.get('/api/flights')
            .then(result=> {
                this.flights = result.data;
            }, error => {
                alert("An error occurred while loading flights!")
            });
            this.$root.$on('refreshFlights', () =>{
                this.refreshFlights();
            });
        },
        computed: {
            pagesCount: function(){
                let tmp = Math.ceil(this.flights.length/10);
                let r = Array();
                for(let i=1; i<=tmp; i++)
                    r.push(i);
                return r;
            },
            flightItem: function(){
                if(this.flights.length<=10){
                    return this.flights.length;
                } 
                let tmp = Math.min(this.flights.length-10*(this.page-1), 10);
                let r = Array();
                for(let i=1; i<=tmp; i++)
                    r.push(i);
                return r;
            }
        },
        methods: {
            setPage: function(index){
                this.page=index;
            },
            calcFlightId: function(flight){
                return (this.page-1)*10+(flight-1);
            },
            refreshFlights: function() {
                axios.get('/api/flights')
                    .then(result=> {
                        this.flights = result.data;
                    }, error => {
                        alert("An error occurred while loading users!")
                    });
            },
        },
        data() {
            return {
                flights: {},
                page: 1,
            }
        }
    }
</script>