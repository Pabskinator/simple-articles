import routes from './routes'
import VueRouter from 'vue-router'
import Form from './utilities/Form';

require('./bootstrap');

window.Vue = require('vue').default;
window.Form = Form;

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
