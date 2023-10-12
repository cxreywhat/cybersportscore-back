import { statisticsPlayersTeam } from './components/matches/statisticBlock.js'
import { renderingPicksAndBans } from "./components/matches/picksAndBans.js";
import { details } from "./components/matches/detailsPlayers.js";
import { getMap } from "./components/matches/detailsMap.js";
import { getMainPartInfo } from "./components/matches/mainPart.js";
import { addEventToLogs } from "./components/matches/logsMatch.js";
import { addChart } from "./components/matches/detailsChart.js";
import {updateMatches} from "./components/homeSocket.js";
import {detailsHome} from "./components/detailsHomeSocket.js";
import {changeLanguage} from "./translate.js";

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

$.ajax({
    url: '/api/config',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
        window.Echo = new Echo(data);

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
    },
});


