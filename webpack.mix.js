const mix = require("laravel-mix");
let webpack = require('webpack');

require('dotenv').config();

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/matchFilter.js", "public/js")
    .js("resources/js/chart.js", "public/js")
    .js("resources/js/translate.js", "public/js")
    .js("resources/js/components/matches/historyBlock.js", "public/js")
    .js("resources/js/websocket.js", "public/js")
    .js("resources/js/helpers/matchRow.js", "public/js/helpers")
    .js("resources/js/helpers/detailsMap.js", "public/js/helpers")
    .js("resources/js/i18n/timeZone.js", 'public/js/i18n')
    .js("resources/js/i18n/language.js", 'public/js/i18n')
    .js("resources/js/components/filterListBox.js", "public/js/components")
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .css('resources/css/critical.css', 'public/css')
    .sass('resources/css/style.scss', 'public/css')

