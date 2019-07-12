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
                            <td>{{ user.name }}</td>
                            <td>{{ user.lastname }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.birth_day }}</td>
                            <td>{{ user.sex }}</td>
                            <td>{{ user.country }}</td>
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
        data() {
            return {
                body: 'Temporary Message'
            }
        }
    }
</script>