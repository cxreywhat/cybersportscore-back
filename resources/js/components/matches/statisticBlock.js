export function statisticsPlayersTeam(playersTeam1, gameId, startGame, numTeam) {
    if(startGame != 3) {
        return;
    }

    const tableBody = document.getElementById('stats-team'+ numTeam +'-players');

    let playersTeam = Object.values(playersTeam1);
    playersTeam.sort((a, b) => b.n - a.n);


    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
    }

    playersTeam.forEach(player => {
        const playerRow = document.createElement('tr');
        playerRow.classList.add('border-b', 'last:border-b-0', 'border-gray-700', 'hover:bg-gray-800', 'h-[40px]');

        playerRow.innerHTML = `
            <td class="py-1 px-2">
                <div class="flex flex-row gap-2 items-center">
                    <img class="w-9 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/hero/${gameId}/_59/${ player.hero_id }.png" alt="${ player.hero_title }">
                    <div class="flex-col">
                        <div class="flex text-xs leading-none text-gray-300">
                            ${ player.nick }
                        </div>
                        <a class="text-[10px] leading-none text-gray-500">${ player.hero_title }</a>
                    </div>
                    <span title="${ player.lvl } Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal
                        cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">${ player.lvl }</span>
                </div>
            </td>
            <td class="py-2 px-1 text-gray-400">${ player.k }</td>
            <td class="py-2 px-1 text-gray-400">${ player.d }</td>
            <td class="py-2 px-1 text-gray-400">${ player.a }</td>
            <td class="py-2 pr-4 text-apple text-right">${ player.n }</td>
            <td class="py-2 px-1">
                <div id="items-${ numTeam }" class="flex gap-2 w-[240px]">

                </div>
            </td>
            <td class="py-2 px-1 pr-3 text-gray-300 text-right">${ player.l } (${player.dn })</td>
            <td class="py-2 px-1 pr-3 text-apple text-right">${ player.gpm }</td>
            <td class="py-2 px-1 text-gray-300 pr-3 text-right">${ player.xpm }</td>
            <td class="py-2 px-1 text-gray-300 pr-3 text-right">${ player.heal }</td>
            <td class="py-2 px-1 text-gray-300 pr-3 text-right">${ player.dmg }</td>
            <td class="py-2 px-1 text-gray-300 pr-3 text-right">${ player.tdmg }</td>
            <td class="py-2 px-1 text-gray-300 pr-4 text-right">0</td>
        `;

        tableBody.appendChild(playerRow);

        const itemsDiv = playerRow.querySelector('#items-' + numTeam); // Находим элемент с id="items" внутри playerRow

        player.items.forEach(item => {
            const itemsColumn = document.createElement('div');
            itemsColumn.classList.add('flex', 'gap-0.5');

            const img = document.createElement('img');
            img.classList.add('w-5', 'shadow-md', 'rounded-sm');
            img.src = `https://api.cybersportscore.com/media/game/item/${gameId}/_29/${item.id}.png`;
            img.title = item.title;
            img.alt = item.title;

            itemsColumn.appendChild(img);
            itemsDiv.appendChild(itemsColumn);
        });

        tableBody.appendChild(playerRow);
    });
}

