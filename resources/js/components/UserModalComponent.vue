<script>
    import axios from 'axios';

    export default {
        methods: {
            adduser: function(){
                var data = {
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById('password-confirm').value,
                    name: document.getElementById('name').value,
                    lastname: document.getElementById('lastname').value,
                    sex: document.getElementById('male').checked?'man':'woman',
                    country: document.getElementById('country').value,
                    birth_day: document.getElementById('birthday').value,
                }
                if(!(data.password==data.password_confirmation)){
                    alert("Podane hasła nie zgadzają się");
                    return;
                }
                $('.add-button').attr("disabled", true); //wyłącz przycisk
                axios.post('/api/user', data)
                    .then(result => {
                        //success
                        $('#adduserModal').modal('hide');
                        $('.add-button').attr("disabled", false); //enable for future use
                        //TODO reloading
                        this.$root.$emit('refreshUsers');
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