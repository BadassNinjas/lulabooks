import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import DashboardView from '../components/Dashboard/DashboardView.vue';
import CheckoutView from '../components/Checkout/CheckoutView.vue';
import ContactView from '../components/Contact/ContactView.vue';
import ProductsView from '../components/Products/ProductsView.vue';
import SalesRequestView from '../components/SalesRequest/SalesRequest.vue';
import PaymentCompleteView from '../components/Checkout/PaymentComplete.vue';
import FaqView from '../components/Faq/FAQView.vue';
import AboutView from '../components/About/AboutView.vue';

export default new Router({
    mode: 'history',
    scrollBehavior: () => ({
        y: 0
    }),
    routes: [{
            path: '/',
            name: 'Home',
            component: DashboardView
        },
        {
            path: '/checkout',
            name: 'Checkout',
            component: CheckoutView
        },
        {
            path: '/contact',
            name: 'Contact',
            component: ContactView
        },
        {
            path: '/sell',
            name: 'Sale',
            component: SalesRequestView
        },
        {
            path: '/payment',
            name: 'Payment',
            component: PaymentCompleteView
        },
        {
            path: '/products',
            component: ProductsView
        },
        {
            path: '/products/:category_id',
            name: 'Products',
            component: ProductsView
        },
        {
            path: '/faq',
            name: 'FAQ',
            component: FaqView
        },
        {
            path: '/about',
            name: 'About',
            component: AboutView
        },
        {
            path: '*',
            component: DashboardView
        }
    ]
});
