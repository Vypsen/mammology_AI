const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/requests.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
