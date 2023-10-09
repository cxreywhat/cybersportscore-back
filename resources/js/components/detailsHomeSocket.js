import {getMap} from "./matches/detailsMap";
import {addChartToHome} from "./matches/detailsChart";
import {clearDetailsContainer, generatePlayerDetails} from "./matches/detailsPlayers";


export function detailsHome(match, biggestNet) {
    const detailsPlayersContainer = document.getElementById('detailsContainer');
    const mapDetailsContainer = document.getElementById('mapDetails')
    console.log(match)
    clearDetailsContainer(detailsPlayersContainer);
    clearDetailsContainer(mapDetailsContainer);

    detailsPlayers(match, biggestNet, detailsPlayersContainer);
    getMap(match.aggregated_events.destroyed_buildings)
    addChartToHome(match.gold, match.events)
}

function detailsPlayers(match, biggestNet, container) {
    if(match.duration <= 0) {
        return;
    }
    const team1 = match.teams[0].players;
    const team2 = match.teams[1].players;

    const playersT1 = Object.values(team1)
        .sort((a, b) =>
            b.net_worth - a.net_worth
        );


    const playersT2 = Object.values(team2)
        .sort((a, b) =>
            b.net_worth - a.net_worth
        );

    const maxLength = Math.max(playersT1.length, playersT2.length);

    for (let i = 0; i < maxLength; i++) {
        let teamElement = generatePlayerDetails(playersT1[i], playersT2[i], biggestNet, match.game_id);
        container.appendChild(teamElement);
    }
}
