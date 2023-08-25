function statisticsPlayersTeam1(playersTeam1) {
    const tableBody = document.getElementById('stats-team1-players'); // Замените на ID вашего tbody


    playersTeam1.sort((a, b) => b.n - a.n);

    playersTeam1.forEach(playerT1 => {
        const playerRow = document.createElement('tr');
        playerRow.classList.add('border-b', 'last:border-b-0', 'border-gray-700', 'hover:bg-gray-800', 'h-[40px]');

        playerRow.innerHTML = `
            <td class="py-1 px-2">
                <div class="flex flex-row gap-2 items-center">
                    <img class="w-9 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/hero/{{$match_beta.game_id}/_59/${playerT1.hero_id }.png" alt="${playerT1.hero_title }">
                    <div class="flex-col">
                        <div class="flex text-xs leading-none text-gray-300">
                            ${playerT1.nick }
                        </div>
                        <a class="text-[10px] leading-none text-gray-500">${playerT1.hero_title }</a>
                    </div>
                    <span title="${playerT1.lvl } Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal
                        cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">${playerT1.lvl }</span>
                </div>
            </td>
            <td class="py-2 px-1 text-gray-400">${playerT1.k }</td>
            <td class="py-2 px-1 text-gray-400">${playerT1.d }</td>
            <td class="py-2 px-1 text-gray-400">${playerT1.a }</td>
            <td class="py-2 pr-4 text-apple text-right">${playerT1.n }</td>
            <td class="py-2 px-1">
                <div class="flex gap-2 w-[240px]">
                    @foreach($playerT1.items as $item)
                        <div class="flex gap-0.5">
                            <img class="w-5 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/item/${match_beta.game_id }/_29/${item.id }.png" title="${item.title }" alt="${item.title }">
                        </div>
                    @endforeach
                </div>
            </td>
            <td class="py-2 px-1 pr-3 text-gray-300 text-right">${playerT1.l } (${playerT1.dn })</td>
            <td class="py-2 px-1 pr-3 text-apple text-right">${playerT1.gpm }</td>
            <td class="py-2 px-1 text-gray-300 pr-3 text-right">${playerT1.xpm }</td>
            <td class="py-2 px-1 text-gray-300 pr-3 text-right">${playerT1.heal }</td>
            <td class="py-2 px-1 text-gray-300 pr-3 text-right">${playerT1.dmg }</td>
            <td class="py-2 px-1 text-gray-300 pr-3 text-right">${playerT1.tdmg}</td>
            <td class="py-2 px-1 text-gray-300 pr-4 text-right">0</td>
        `;

        tableBody.appendChild(playerRow);
    });
}
