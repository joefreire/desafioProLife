require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import 'bootstrap/dist/css/bootstrap.min.css';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faFileAlt } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

library.add(faFileAlt)
 
Vue.use(VueRouter)
Vue.use(Vuelidate)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('loading', Loading)

const routes = [
    { path: '/', component: require('./components/HomeComponent.vue').default },
    { path: '/form', component: require('./components/FormComponent.vue').default }
]
  
const router = new VueRouter({
    routes 
})

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
    data: {
        isLoading: false,
        fullPage: true
    }
});
