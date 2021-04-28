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

mix
  .js("resources/js/app.js", "public/js")
  .sass("resources/sass/app.scss", "public/css");

mix
  .styles(
    [
      "public/website/css/bootstrap.min.css",
      "public/website/css/font-awesome.min.css",
      "public/website/css/ionicons.min.css",
      "public/website/css/helper.css",
      "public/website/css/plugins.css",
      "public/website/css/style.css"
    ],
    "public/css/visitor.css"
  )
  .scripts(
    [
      "public/website/js/vendor/jquery-1.12.4.min.js",
      "public/website/js/vendor/modernizr-2.8.3.min.js",
      "public/website/js/popper.min.js",
      "public/website/js/bootstrap.min.js",
      "public/website/js/plugins.js",
      "public/website/js/main.js",
    ],
    "public/js/visitor.js"
  );
