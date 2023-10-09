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
import { statisticsPlayersTeam } from './components/matches/statisticBlock.js'
import { renderingPicksAndBans } from "./components/matches/picksAndBans.js";
import { details } from "./components/matches/detailsPlayers.js";
import { getMap } from "./components/matches/detailsMap.js";
import { getSummary } from "./components/matches/detailsSummary.js";
import { getMainPartInfo } from "./components/matches/mainPart.js";
import { addEventToLogs } from "./components/matches/logsMatch";
import { addChart } from "./components/matches/detailsChart";
import {changeLanguage} from "./translate";
import {updateMatches} from "./components/homeSocket";
import {detailsHome} from "./components/detailsHomeSocket";

window.Pusher = require('pusher-js');


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'app-key',
    wsHost: '127.0.0.1',
    cluster: 'eu',
    wsPort: '6001',
    wssPort: '6001',
    forceTLS: false,
    encrypted: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
    activityTimeout: 50000000
});

window.Echo.channel('live-data')
    .listen('MatchDataUpdate', (e) => {
        const selectedLang = document.getElementById('selected-lang')
        const match = e.updatedData.match;
        const isLive = match.is_live;
        const hasBansAndPicks = {
            hasBans: e.updatedData.hasBans,
            hasPicks: e.updatedData.hasPicks
        }
        const biggestNetWorth = e.updatedData.biggestNet;
        const heroes = e.updatedData.heroes;

        statisticsPlayersTeam(match.teams[0].players, match.game_id, isLive, 1);
        statisticsPlayersTeam(match.teams[1].players, match.game_id, isLive, 2);
        renderingPicksAndBans(match.teams[0], match.game_id, hasBansAndPicks, 1);
        renderingPicksAndBans(match.teams[1], match.game_id, hasBansAndPicks, 2);
        details(match, biggestNetWorth);
        getMap(match.aggregated_events, match.game_id);
        getMainPartInfo(match);
        addEventToLogs(match, heroes);
        addChart(match.gold, match.events)
        changeLanguage(selectedLang.value)
    });

window.Echo.channel('live-data-home')
    .listen('HomeUpdate', (e) => {
        const matches = e.updatedData.matches;

        updateMatches(matches)
    });


window.Echo.channel('live-data-details')
    .listen('HomeDetailsUpdate', (e) => {
        const match = e.updatedData.match;
        const biggestNet = e.updatedData.biggestNet;

        detailsHome(match, biggestNet)
    });




