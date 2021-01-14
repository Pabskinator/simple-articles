import Home from './views/Home';
import Login from './auth/Login';
import Register from './auth/Register';
import NotFound from './components/NotFound';

export default {
    mode: 'history',
    linkActiveClass: 'active',

    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Home
        },
        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            component: Register
        },
    ]
}
