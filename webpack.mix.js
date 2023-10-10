const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/matchFilter.js", "public/js")
    .js('resources/js/components/matches/historyBlock.js', 'public/js')
    .js("resources/js/chart.js", "public/js")
    .js("resources/js/translate.js", 'public/js')
    .js("resources/js/helpers/matchRow.js", "public/js/helpers")
    .js("resources/js/helpers/loadAjax.js", "public/js/helpers")
    .js("resources/js/helpers/detailsMap.js", 'public/js/helpers')
    .js("resources/js/components/filterListBox.js", "public/js/components")
    .js('resources/js/components/pagination.js', 'public/js/components')
    .js('resources/js/websocket.js', 'public/js')
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .css('resources/css/critical.css', 'public/css')
    .sass('resources/css/style.scss', 'public/css');
