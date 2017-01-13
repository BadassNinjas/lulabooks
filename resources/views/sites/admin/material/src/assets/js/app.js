window._ = require('lodash');
window.Vue = require('vue');
window.VueResource = require('vue-resource');

Vue.use(window.VueResource);

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', System.CSRF);
    next();
});


import Vuetable from 'vuetable-2/src/components/Vuetable.vue';
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination.vue';
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo.vue';

Vue.component('vuetable', Vuetable);
Vue.component('vuetable-pagination', VuetablePagination);
Vue.component('vuetable-pagination-info', VuetablePaginationInfo);

import entry from './components/RootView.vue';
import router from './config/router.js';

window.Vue = new Vue({
    el: '#app',
    router: router,
    render: h => h(entry)
});
