const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]).copy('node_modules/toastr/build/toastr.min.css', 'public/css/toastr.min.css')
.copy('node_modules/toastr/build/toastr.min.js', 'public/js/toastr.min.js')
.copy('node_modules/animate.css/animate.min.css', 'public/css/animate.min.css')
.copy('node_modules/multicoin-address-validator/dist/wallet-address-validator.min.js', 'public/js/wallet-address-validator.min.js');
