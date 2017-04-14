
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router'; //provides routing functionality for a SPA
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 //import components!
 import Dashboard from './components/Dashboard.vue'
 import { store } from './store/store'
 // create the router!
 const router = new VueRouter({
 	mode: 'history',
 	linkActiveClass: 'active',
 	routes: [
 		{ path: '/', component: require('./components/ContactList.vue') },
 		{ path: '/contacts/new', component: require('./components/ContactCreate.vue') },
 		{ path: '/contacts/edit', component: require('./components/ContactEdit.vue') }
 	]
 })
const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
    	Dashboard
    }
});
