<script>
    import axios from 'axios';

    export default {
        methods: {
            addflight: function(){
                var data = {
                    departure_time: document.getElementById('dt').value+' '+document.getElementById('dt2').value,
                    arrival_time: document.getElementById('at').value+' '+document.getElementById('at2').value,
                    seats: document.getElementById('seats').value,
                    price: document.getElementById('price').value,
                }
                $('.add-button').attr("disabled", true); //wyłącz przycisk
                axios.post('/api/flight', data)
                    .then(result => {
                        //success
                        $('#addflightModal').modal('hide');
                        $('.add-button').attr("disabled", false); //enable for future use
                        //TODO reloading
                        this.$root.$emit('refreshFlights');
                    }, error => {
                        //false
                        $('.add-button').attr("disabled", false); //enable for future use
                        alert("An error occurred");
                    });
            },
        },
        data() {
            return { }
        }
    }
</script>