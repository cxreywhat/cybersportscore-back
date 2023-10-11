const mix = require("laravel-mix");
require('dotenv').config();
let webpack = require('webpack');

let dotenvplugin = new webpack.DefinePlugin({
    'process.env': {
        PUSHER_PORT: JSON.stringify(process.env.PUSHER_PORT || '6001'),
        PUSHER_HOST: JSON.stringify(process.env.PUSHER_HOST || 'localhost'),
        PUSHER_CLUSTER: JSON.stringify(process.env.PUSHER_CLUSTER || 'eu'),
        BROADCAST_DRIVER: JSON.stringify(process.env.BROADCAST_DRIVER || 'pusher'),
        PUSHER_APP_KEY: JSON.stringify(process.env.PUSHER_APP_KEY || 'app_key'),
    }
})

mix.webpackConfig({
    plugins: [
        dotenvplugin,
    ]
});

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/matchFilter.js", "public/js")
    .js('resources/js/components/matches/historyBlock.js', 'public/js')
    .js("resources/js/chart.js", "public/js")
    .js("resources/js/translate.js", 'public/js')
    .js("resources/js/helpers/matchRow.js", "public/js/helpers")
    .js("resources/js/helpers/loadAjax.js", "public/js/helpers")
    .js("resources/js/helpers/detailsMap.js", 'public/js/helpers')
    .js("resources/js/components/filterListBox.js", "public/js/components")
    .js('resources/js/websocket.js', 'public/js')
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .css('resources/css/critical.css', 'public/css')
    .sass('resources/css/style.scss', 'public/css');

