import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import { statisticsPlayersTeam } from './components/matches/statisticBlock'
import { renderingPicksAndBans } from "./components/matches/picksAndBans";
import { details } from "./components/matches/detailsPlayers";

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'app-key',
    wsHost: '127.0.0.1',
    cluster: 'eu',
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    encrypted: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
    activityTimeout: 5000000
});


// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.PUSHER_APP_KEY,
//     wsHost: process.env.PUSHER_HOST,
//     wsPort: process.env.PUSHER_PORT,
//     wssPort: process.env.PUSHER_PORT,
//     forceTLS: false,
//     encrypted: true,
//     disableStats: true,
//     enabledTransports: ['ws', 'wss'],
// });

window.Echo.channel('live-data')
    .listen('MatchDataUpdate', (e) => {
        let matchBeta = e.updatedData.match_beta;
        let numGame = e.updatedData.num_game;
        let matchStart = matchBeta.match_games[numGame- 1].match_start;
        let preview = e.updatedData.preview;

        statisticsPlayersTeam(matchBeta.match_games[numGame - 1].match_data.teams.t1.players, matchBeta.game_id, matchStart, 1);
        statisticsPlayersTeam(matchBeta.match_games[numGame - 1].match_data.teams.t2.players, matchBeta.game_id, matchStart, 2);

        renderingPicksAndBans(matchBeta.match_games[numGame - 1].match_data.teams.t1, matchBeta.game_id, matchStart, 1)
        renderingPicksAndBans(matchBeta.match_games[numGame - 1].match_data.teams.t2, matchBeta.game_id, matchStart, 2)

        details(matchBeta, numGame);

    });

