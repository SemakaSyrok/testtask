require('./bootstrap');
import Vue from 'vue';
import Router from 'vue-router'
import Article from './pages/Article';
import Articles from './pages/Articles';
import Index from './pages/Index';

const routes = [
    { path: '/', component: Index},
    { path: '/articles', component: Articles},
    { path: '/articles/:slug', component: Article},
];

const router = new Router({
    routes
})

Vue.use(Router);

console.log(123123)

const app = new Vue({
    router
}).$mount('#app')
