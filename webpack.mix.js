const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

mix
    // Copy image directories FIRST
    .copyDirectory('resources/assets/img', 'public/img')
    .copyDirectory('resources/assets/less/img', 'public/img')

    // Compile LESS to CSS with options
    .less('resources/assets/less/totem.less', 'public/css/app.css')

    // Compile JavaScript with Webpack
    .js('resources/assets/js/app.js', 'public/js')

    // Enable Vue support (if you're using Vue)
    .vue();

// Disable versioning for now to avoid file path issues
// if (mix.inProduction()) {
//   mix.version();
// }

// Optional: Disable mix-manifest.json if you don't need it
// mix.options({
//   manifest: false
// });
