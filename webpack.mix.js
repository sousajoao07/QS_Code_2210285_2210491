const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


// mix
//     .js('resources/js/app.js', 'public/js')
//     //.js('resources/js/bootstrap.js', 'public/js')
//     .js('resources/assets/js/scripts.js', 'public/js')
//     .postCss('resources/assets/css/styles.css', 'public/css')
//     .sass('resources/sass/app.scss', 'public/css');


mix
    .setPublicPath('dist')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/bootstrap', 'public/js')
    .js('resources/assets/js/scripts.js', 'public/js')
    .postCss('resources/assets/css/styles.css', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    // .copy('resources/views/index.blade.php', 'dist/public')
    // .copy('resources/views/login.blade.php', 'dist/public')
    // .copy('routes/api.php', 'dist/public')
    // .copy('public/images/', 'dist/public/images')