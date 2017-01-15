var elixir = require('laravel-elixir');

require('laravel-elixir-imagemin');

elixir.config.css.autoprefix = {
    enabled: true, //default, this is only here so you know how to disable
    options: {
        cascade: true,
        browsers: ['last 2 versions', '> 1%']
    }
};

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
});

elixir(function(mix) {
    mix.styles([
        "normalize.css",
        "font-awesome.min.css",
        "flexboxgrid.css",
        "swiper.min.css"
    ], "public/css/tools.css");
});

elixir(function(mix) {
    mix.scriptsIn("resources/assets/js/Classes", "public/js/Classes.js");
});

elixir(function(mix) {
    mix.scripts([
        "swiper.min.js",
        "mixitup.js",
        "script.js"
    ], "public/js/script.js");
});

elixir(function(mix) {
    mix.scripts("initMap.js", "public/js/map.js");
});

elixir(function(mix) {
    mix.scripts("admin-script.js", "public/js/admin.js");
});

elixir(function(mix) {
   mix.imagemin();
});

// elixir(function(mix) {
//     mix.browserSync({proxy: 'loclayouthost:8000'});
// });
