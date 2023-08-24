const mix = require("laravel-mix");
mix.js("resources/js/app.js", "public/js")
    .js("resources/js/components/filterListBox.js", "public/js/components")
    .js("resources/js/helpers/helper.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .css('resources/css/critical.css', 'public/css')
    .sass('resources/css/style.scss', 'public/css');
