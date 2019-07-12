<template>
    <div class="row justify-content-center">
        <div class="col-12" id="users">
            <div class="card">
                <div class="card-header">{{ title }}</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th>E-Mail</th>
                            <th>Data urodzenia</th>
                            <th>Płeć</th>
                            <th>Kraj</th>
                        </tr>
                        <tr v-for="user in users">
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
    import axios from 'axios';

    export default {
        props: ['title'],
        mounted() {
            axios.get('/api/users')
            .then(result=> {
                console.log(result);
                this.users = result.data;
            }, error => {
                alert("An error occurred while loading users!")
            });
        },
        data() {
            return {
                users: {},
            }
        }
    }
</script>