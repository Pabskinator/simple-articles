import routes from './routes'
import VueRouter from 'vue-router'

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
