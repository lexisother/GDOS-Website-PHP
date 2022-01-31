const mix = require("laravel-mix");

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

mix.sass("resources/sass/app.scss", "public/css")
    .copyDirectory("resources/fonts", "public/fonts")
    .copyDirectory("resources/static", "public/static")
    .copy(
        "resources/images/default-avatar.png",
        "storage/app/public/uploads/avatars/default-avatar.png"
    )
    .sourceMaps();
