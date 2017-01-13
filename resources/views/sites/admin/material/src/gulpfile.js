const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir(mix => {
    mix.webpack('./assets/js/app.js', './assets/js/compiled/app.js');

    mix.styles([
        './assets/css/animate.min.css',
        './assets/css/material-design-iconic-font.min.css',
        './assets/css/font-awesome.min.css',
        './assets/css/jquery.mCustomScrollbar.min.css',
        './assets/css/palette.css',
        './assets/css/app.min.1.css',
        './assets/css/app.min.2.css',
        './assets/css/sweet-alert.css',
        './assets/css/vueditor.min.css',
    ], '../../../../../../public/css/admin.min.css');

    mix.scripts([
        './assets/js/plugins/jquery.min.js',
        './assets/js/plugins/bootstrap.min.js',
        './assets/js/plugins/jquery.mCustomScrollbar.concat.min.js',
        './assets/js/plugins/waves.min.js',
        './assets/js/plugins/bootstrap-growl.min.js',
        './assets/js/plugins/autosize.min.js',
        './assets/js/plugins/jquery.placeholder.min.js',
        './assets/js/plugins/functions.js',
        './assets/js/plugins/actions.js',
        './assets/js/plugins/demo.js',
        './assets/js/plugins/jquery.nestable.js',
        './assets/js/plugins/sweet-alert.min.js',
        './assets/js/compiled/app.js',
    ], '../../../../../../public/js/admin.min.js');
});
