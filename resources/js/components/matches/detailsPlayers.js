function generatePlayerDetails(player, player2, bigNet, gameId) {
    const details = document.createElement('div');
    details.className = "flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative";
    details.innerHTML = `
        <div class='px-2 flex w-full items-center grow max-w-[50%] relative max-h-8'>
            <span title='Ценность героя ${player.n}' class='left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
              font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding' style='transform: scaleX(${player.n * 0.9 / bigNet})'>
            </span>
            <img class='max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2' src='https://api.cybersportscore.com/media/game/hero/${gameId}/_59/${player.hero_id}.png' alt='${player.hero_title}' title='${player.hero_title}' loading='lazy'>
            <span class='text-gray-300 text-xs cursor-default leading-normal md:truncate' title='${player.nick}'>${player.nick}</span>
            <span title='${player.lvl} Level' class='ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500
              border-2 border-gray-700 hover:border-gray-600 rounded'>${player.lvl}</span>
        </div>
        <div class='justify-end px-2 flex w-full items-center grow max-w-[50%] relative max-h-8'>
            <span title='Ценность героя ${player2.n}' class='right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
              font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding' style='transform: scaleX(${player2.n * 0.9 / bigNet})'>
            </span>
            <span title='${player2.lvl} Level' class='mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0
              leading-normal cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded'>${player2.lvl}</span>
            <span class='text-gray-300 text-xs cursor-default text-right md:truncate' title="${player2.nick}">${player2.nick}</span>
            <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="https://api.cybersportscore.com/media/game/hero/${gameId}/_59/${player2.hero_id}.png" alt="${player2.hero_title}" title="${player2.hero_title}" loading="lazy">
        </div>`
    return details;
}

export function details(matchBeta, numGame){
    if(matchBeta.match_games[numGame - 1].match_start != 3) {
        return;
    }
    const playersT1 = Object.values(matchBeta.match_games[numGame - 1].match_data.teams.t1.players)
        .sort((a, b) => b.n - a.n);
    const playersT2 = Object.values(matchBeta.match_games[numGame - 1].match_data.teams.t2.players)
        .sort((a, b) => b.n - a.n);

    const maxLength = Math.max(playersT1.length, playersT2.length);
    const biggestNet = matchBeta.match_games[numGame - 1].biggest_net;
    const detailsContainer = document.getElementById("detailsContainer");
    clearDetailsContainer(detailsContainer)

    for (let i = 0; i < maxLength; i++) {
        let teamElement = generatePlayerDetails(playersT1[i], playersT2[i], biggestNet, matchBeta.game_id);
        detailsContainer.appendChild(teamElement);
    }
}

function clearDetailsContainer(container) {
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }
}
