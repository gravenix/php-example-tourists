<template>
    <div class="row justify-content-center">
        <div class="col-12" id="users">
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
                        <tr v-for="flight in (flights.length>10?10:flights.length)" :key="flight">
                            <td>{{ flights[flight-1].departure_time }}</td>
                            <td>{{ flights[flight-1].arrival_time }}</td>
                            <td>{{ flights[flight-1].seats }}</td>
                            <td>{{ flights[flight-1].price }}</td>
                        </tr>
                    </table>
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
                alert("An error occurred while loading users!")
            });
        },
        data() {
            return {
                flights: {}
            }
        }
    }
</script>