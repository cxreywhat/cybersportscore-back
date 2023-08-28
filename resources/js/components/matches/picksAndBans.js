export function renderingPicksAndBans(teams, gameId, matchStart, numTeam)
{
    if(matchStart < 2) {
        return
    }

    picksTeam(teams.picks, gameId, numTeam);
    bansTeam(teams.bans, gameId, numTeam);
}

function picksTeam(picks, gameId, numTeam) {
    const div = document.getElementById('t' + numTeam + '-picks');

    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }

    picks.forEach(pick => {
        const picksRow = document.createElement('span');
        picksRow.classList.add('max-w-[50px]', 'sm:w-11', 'mx-[3px]', 'flex', 'flex-row', 'rounded-md', 'overflow-hidden', 'border', 'border-gray-600', 'border-1', 'box-border', 'shadow-xl', 'hover:transform', 'hover:scale-150', 'hover:z-[2]', 'transition');

        picksRow.innerHTML =
            `
                <img class="transform scale-110" src="https://api.cybersportscore.com/media/game/hero/${gameId}/_59/${ pick.id }.png" title="${pick.title}" alt="${pick.title}">
            `;

        div.appendChild(picksRow);
    });
}


function bansTeam(bans, gameId, numTeam) {
    const div = document.getElementById('t' + numTeam + '-bans');

    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }

    bans.forEach(ban => {
        const bansRow = document.createElement('span');
        bansRow.classList.add('max-w-[40px]', 'sm:w-7', 'mx-[3px]', 'flex', 'flex-row', 'rounded-sm', 'overflow-hidden', 'border', 'border-gray-600', 'border-1', 'box-border', 'shadow-xl', 'hover:transform', 'hover:scale-[2]', 'hover:z-[2]', 'transition');

        bansRow.innerHTML =
            `
                <img class="transform scale-110 grayscale hover:grayscale-0" src="https://api.cybersportscore.com/media/game/hero/${gameId}/_59/${ ban.id }.png" title="${ban.title}" alt="${ban.title}">
            `;

        div.appendChild(bansRow);
    });
}




