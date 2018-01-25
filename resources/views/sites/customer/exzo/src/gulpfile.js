const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir(mix => {
    mix.webpack('./assets/js/app.js', './assets/js/compiled/app.js');

    mix.styles([
        './assets/css/bootstrap.min.css',
        './assets/css/bootstrap.extension.css',
        './assets/css/style.css',
        './assets/css/swiper.css',
        './assets/css/sumoselect.css',
        './assets/css/font-awesome.min.css',
    ], '../../../../../../public/css/customer.min.css');

    mix.scripts([
        './assets/js/plugins/jquery-2.2.4.min.js',
        './assets/js/plugins/global.js',
        './assets/js/plugins/jquery.sumoselect.min.js',
        './assets/js/compiled/app.js',
        './assets/js/plugins/isotope.pkgd.min.js',
        './assets/js/plugins/jquery-ui.min.js',
        './assets/js/plugins/jquery.throttle.js',
        './assets/js/plugins/jquery.knob.js',
    ], '../../../../../../public/js/customer.min.js');
});
