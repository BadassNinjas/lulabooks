import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import DashboardView from '../components/Dashboard/DashboardView.vue';
import CategoryView from '../components/CategoryManager/CategoryView.vue';
import ProductView from '../components/Product/ProductView.vue';
import LoginView from '../components/Login/LoginView.vue';

var base_path = '/admin/';

export default new Router({
    mode: 'history',
    scrollBehavior: () => ({
        y: 0
    }),
    base: '/admin/',
    routes: [{
            path: '/',
            component: DashboardView
        },
        {
            path: '/login',
            component: LoginView
        },
        {
            path: '/product-manager',
            component: ProductView
        },
        {
            path: '/category-manager',
            component: CategoryView
        },
        {
            path: '*',
            //redirect: '/'
            component: DashboardView
        }
    ]
});
