const mix = require("laravel-mix");
mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .js("resources/js/components/filterListBox.js", "public/js/components");
