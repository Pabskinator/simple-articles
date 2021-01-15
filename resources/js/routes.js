import Home from './views/Home';
import Login from './auth/Login';
import Register from './auth/Register';
import Article from './views/SingleArticle';
import MyArticles from "./views/MyArticles";
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
            component: Home,
            name: 'Home'
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: '/register',
            component: Register,
            name: 'Register'
        },
        {
            path: '/articles/:id',
            component: Article,
            name: 'Article'
        },
        {
            path: '/my_articles',
            component: MyArticles,
            name: 'MyArticles'
        },
    ]
}
