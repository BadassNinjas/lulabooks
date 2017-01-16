import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import DashboardView from '../components/Dashboard/DashboardView.vue';
import CheckoutView from '../components/Checkout/CheckoutView.vue';

export default new Router({
    mode: 'history',
    scrollBehavior: () => ({
        y: 0
    }),
    routes: [{
            path: '/',
            component: DashboardView
        },
        {
            path: '/checkout',
            component: CheckoutView
        },
        {
            path: '*',
            //redirect: '/'
            component: DashboardView
        }
    ]
});
