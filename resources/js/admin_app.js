/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//my component

Vue.component('users', require('./components/UsersComponent.vue').default);
Vue.component('flights', require('./components/FlightsComponent.vue').default);
Vue.component('user-form', require('./components/UserModalComponent.vue').default);
Vue.component('flight-form', require('./components/FlightModalComponent.vue').default);
Vue.component('edit-form', require('./components/EditModalComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});