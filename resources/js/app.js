/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('users', require('./components/UsersComponent.vue').default);
Vue.component('flights', require('./components/FlightsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
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
            axios.post('/api/user', data)
            .then(result => {
                //success
                console.log(result);
            }, error => {
                //false
                alert("An error occurred");
            });
        },
    }
});
