var elixir = require('laravel-elixir');
require('laravel-elixir-livereload');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

/*elixir(function(mix) {
    mix.less('app.less');
});*/
elixir(function(mix) {
   mix.styles([
       "app.css",
       "angucomplete-alt.css",
       "submenu.css",
       "sweetalert-master/dist/sweetalert.css",
       "bootstrap-submenu/css/bootstrap-submenu.css"
   ], "public/assets/css");
   mix.scripts([
       "bower_components/jquery/dist/jquery.js", //2.1.4
       "bower_components/jQuery-Mask-Plugin/dist/jquery.mask.js",
       "angular-1.4.0/angular.js",
       "bootstrap/js/bootstrap.js",
       "bootstrap-formhelpers.js",
       "angucomplete-alt-master/angucomplete-alt.js",
       "start.js",
       "angular/filter.js",
       "angular/admin/permission/permission.resetall.js",
       "angular/admin/permission/permission.user.js",
       "angular/admin/permission/permission.group.js",
       "sweetalert-master/dist/sweetalert-dev.js"
   ], "public/assets/js");
//	mix.livereload();
});
