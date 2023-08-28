

function generatePlayerDetails(player, bigNet, gameId) {
    const container = document.createElement("div");
    console.log('false-1')

    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }

    container.className = "flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative";
    console.log('false-2')

    const leftColumn = document.createElement("div");
    console.log('false-3')
    /* Create left column content based on player data */
    leftColumn.innerHTML = `
    <span title="Ценность героя ${player.net_worth}" class="left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
      font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(${player.net_worth * 0.9 / bigNet})">
    </span>
    <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2" src="https://api.cybersportscore.com/media/game/hero/${gameId}/_59/${player.hero_image}.png" alt="${player.hero_title}" title="${player.hero_title}" loading="lazy">
    <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="${player.nick}">${player.nick}</span>
    <span title="${player.level} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500
      border-2 border-gray-700 hover:border-gray-600 rounded">${player.level}</span>
  `;
    console.log('false-4')
    const rightColumn = document.createElement("div");
    console.log('false-5')
    /* Create right column content based on player data */
    rightColumn.innerHTML = `
    <span title="Ценность героя ${player.net_worth}" class="right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
      font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(${player.net_worth * 0.9 / bigNet})">
    </span>
    <span title="${player.level} Level" class="mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0
      leading-normal cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">${player.level}</span>
    <span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="${player.nick}">${player.nick}</span>
    <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="https://api.cybersportscore.com/media/game/hero/${gameId}/_59/${player.hero_image}.png}" alt="${player.hero_title}" title="${player.hero_title}" loading="lazy">
  `;
    console.log('false-6')
    container.appendChild(leftColumn);
    console.log('false-7')
    container.appendChild(rightColumn);
    console.log('false-8')

    return container;
}

export function details(matchBeta, numGame){


    if(matchBeta.match_games[numGame - 1].match_start != 3) {
        return;
    }

    const teamsData = [matchBeta.match_games[0].match_data.teams.t1, matchBeta.match_games[0].match_data.teams.t2];

    const biggestNet = matchBeta.match_games[numGame - 1].biggest_net;
    const detailsContainer = document.getElementById("detailsContainer");
    teamsData.forEach(team => {
        [team.players].forEach(player => {
            const playerElement = generatePlayerDetails(player, biggestNet, matchBeta.game_id);
            detailsContainer.appendChild(playerElement);
        });
    });
    console.log('true')
}
