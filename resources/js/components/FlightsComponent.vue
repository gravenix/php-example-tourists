<template>
    <div class="row justify-content-center">
        <div class="col-12" id="users">
            <div class="card">
                <div class="card-header">{{ title }}</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Czas odlotu</th>
                            <th>Czas Przylotu</th>
                            <th>Miejsca</th>
                            <th>Cena</th>
                        </tr>
                        <tr v-for="flight in flights">
                            <td>{{ flight.departure_time }}</td>
                            <td>{{ flight.arrival_time }}</td>
                            <td>{{ flight.seats }}</td>
                            <td>{{ flight.price }}</td>
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