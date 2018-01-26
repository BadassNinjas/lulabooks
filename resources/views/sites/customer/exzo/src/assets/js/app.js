window._ = require('lodash');
window.Vue = require('vue');
window.VueResource = require('vue-resource');

var PulseLoader = require('vue-spinner/src/PulseLoader.vue');

Vue.use(window.VueResource);

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', System.CSRF);
    next();
});

import entry from './components/RootView.vue';
import router from './config/router.js';

window.Vue = new Vue({
    el: '#app',
    router: router,
    render: h => h(entry),

});
