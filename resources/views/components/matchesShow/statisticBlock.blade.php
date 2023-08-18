<div class="overflow-x-auto relative">
    <table class="w-full table-fixed text-xs text-left">
        <thead class="text-xs uppercase text-gray-500 border-b border-t border-gray-700 bg-gray-700 bg-opacity-40">
        <tr>
            <th class="py-1 px-2 w-[200px]">
                <div class="flex items-center gap-2">
                    <img src="https://api.cybersportscore.com/media/logo/_30/t{{$preview->getTeam1()->id}}.webp" alt="{{ $preview->getTeam1()->getTitle() }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                    <p class="green-side flex text-right text-[13px] leading-4 truncate">
                        {{ $preview->getTeam1()->getTitle() }}
                    </p>
                </div>
            </th>
            <th class="py-2 px-1 w-[30px]">K</th>
            <th class="py-2 px-1 w-[30px]">D</th>
            <th class="py-2 px-1 w-[30px]">A</th>
            <th class="py-2 px-1 w-[65px] text-apple pr-4 text-right">NET</th>
            <th class="py-2 px-1 w-[250px]">Items</th>
            <th class="py-2 px-1 pr-3 w-[80px] text-right">LH/DN</th>
            <th class="py-2 px-1 pr-3 w-[65px] text-right text-apple">GPM</th>
            <th class="py-2 px-1 w-[65px] pr-3 text-right">XPM</th>
            <th class="py-2 px-1 w-[65px] pr-3 text-right">Heal</th>
            <th class="py-2 px-1 w-[65px] pr-3 text-right">DMG</th>
            <th class="py-2 px-1 w-[65px] pr-3 text-right">BLD</th>
            <th class="py-2 px-1 w-[65px] pr-4 text-right">TKN</th>
        </tr>
        </thead>
        <tbody>
        @foreach($preview->getTeam1()->getPlayers() as $player)
            <tr class="border-b last:border-b-0 border-gray-700 hover:bg-gray-800 h-[40px]">
                <td class="py-1 px-2">
                    <div class="flex flex-row gap-2 items-center">
                        <img class="w-9 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/hero/{{$gameId}}/_59/{{ $player->matchGamePlayer->heroId }}.png" alt="{{ $player->matchGamePlayer->heroTitle }}"><!---->
                        <div class="flex-col">
                            <div class="flex text-xs leading-none text-gray-300">
                                {{ $player->matchGamePlayer->nick }}
                            </div>
                            <a class="text-[10px] leading-none text-gray-500">{{ $player->matchGamePlayer->heroTitle }}</a>
                        </div>
                        <span title="{{ $player->matchGamePlayer->level }} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal
                            cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">{{ $player->matchGamePlayer->level }}</span>
                    </div>
                </td>
                <td class="py-2 px-1 text-gray-400">{{ $player->matchGamePlayer->getKills() }}</td>
                <td class="py-2 px-1 text-gray-400">{{ $player->matchGamePlayer->getDeaths() }}</td>
                <td class="py-2 px-1 text-gray-400">{{ $player->matchGamePlayer->getAssists() }}</td>
                <td class="py-2 pr-4 text-apple text-right">{{ $player->matchGamePlayer->netWorth }}</td>
                <td class="py-2 px-1">
                    <div class="flex gap-2 w-[240px]">
                        @foreach($player->matchGamePlayer->items as $item)
                            <div class="flex gap-0.5">
                                <img class="w-5 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/item/{{ $gameId }}/_29/{{ $item["id"] }}.png" title="{{ $item["title"] }}" alt="{{ $item["title"] }}">
                            </div>
                        @endforeach
                    </div>
                </td>
                <td class="py-2 px-1 pr-3 text-gray-300 text-right">{{ $player->matchGamePlayer->getLastHits() }} ({{ $player->matchGamePlayer->getDenies() }})</td>
                <td class="py-2 px-1 pr-3 text-apple text-right">{{ $player->matchGamePlayer->gpm }}</td>
                <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $player->matchGamePlayer->xpm }}</td>
                <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $player->matchGamePlayer->getHeal() }}</td>
                <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $player->matchGamePlayer->getDamage() }}</td>
                <td class="py-2 px-1 text-gray-300 pr-3 text-right"></td>
                <td class="py-2 px-1 text-gray-300 pr-4 text-right">{{ $player->matchGamePlayer->getDamageTaken()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="w-full table-fixed text-xs text-left">
        <thead class="text-xs uppercase text-gray-500 border-b border-t border-gray-700 bg-gray-700 bg-opacity-40">
            <tr>
                <th class="py-1 px-2 w-[200px]">
                    <div class="flex items-center gap-2">
                        <img src="https://api.cybersportscore.com/media/logo/_30/t{{$preview->getTeam2()->id}}.webp" alt="{{ $preview->getTeam1()->getTitle() }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                        <p class="red-side flex text-right text-[13px] leading-4 truncate">
                            {{ $preview->getTeam2()->getTitle() }}
                        </p>
                    </div>
                </th>
                <th class="py-2 px-1 w-[30px]">K</th>
                <th class="py-2 px-1 w-[30px]">D</th>
                <th class="py-2 px-1 w-[30px]">A</th>
                <th class="py-2 px-1 w-[65px] text-apple pr-4 text-right">NET</th>
                <th class="py-2 px-1 w-[250px]">Items</th>
                <th class="py-2 px-1 pr-3 w-[80px] text-right">LH/DN</th>
                <th class="py-2 px-1 pr-3 w-[65px] text-right text-apple">GPM</th>
                <!---->
                <th class="py-2 px-1 w-[65px] pr-3 text-right">XPM</th>
                <th class="py-2 px-1 w-[65px] pr-3 text-right">Heal</th>
                <th class="py-2 px-1 w-[65px] pr-3 text-right">DMG</th>
                <th class="py-2 px-1 w-[65px] pr-3 text-right">BLD</th>
                <th class="py-2 px-1 w-[65px] pr-4 text-right">TKN</th>
            </tr>
        </thead>
        <tbody>
        @foreach($preview->getTeam1()->getPlayers() as $player)
            <tr class="border-b last:border-b-0 border-gray-700 hover:bg-gray-800 h-[40px]">
                <td class="py-1 px-2">
                    <div class="flex flex-row gap-2 items-center">
                        <img class="w-9 shadow-md rounded-sm"  src="https://api.cybersportscore.com/media/game/hero/{{$gameId}}/_59/{{ $player->matchGamePlayer->heroId }}.png" alt="{{ $player->matchGamePlayer->heroTitle }}"><!---->
                        <div class="flex-col">
                            <div class="flex text-xs leading-none text-gray-300">
                                {{ $player->matchGamePlayer->nick }}
                            </div>
                            <a class="text-[10px] leading-none text-gray-500">{{ $player->matchGamePlayer->heroTitle }}</a>
                        </div>
                        <span title="{{ $player->matchGamePlayer->level }} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500
                            border-2 border-gray-700 hover:border-gray-600 rounded">{{ $player->matchGamePlayer->level }}</span>
                    </div>
                </td>
                <td class="py-2 px-1 text-gray-400">{{ $player->matchGamePlayer->getKills() }}</td>
                <td class="py-2 px-1 text-gray-400">{{ $player->matchGamePlayer->getDeaths() }}</td>
                <td class="py-2 px-1 text-gray-400">{{ $player->matchGamePlayer->getAssists() }}</td>
                <td class="py-2 pr-4 text-apple text-right">{{ $player->matchGamePlayer->netWorth }}</td>
                <td class="py-2 px-1">
                    <div class="flex gap-2 w-[240px]">
                        @foreach($player->matchGamePlayer->items as $item)
                            <div class="flex gap-0.5">
                                <img class="w-5 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/item/{{ $gameId }}/_29/{{ $item["id"] }}.png" title="{{ $item["title"] }}" alt="{{ $item["title"] }}">
                            </div>
                        @endforeach
                    </div>
                </td>
                <td class="py-2 px-1 pr-3 text-gray-300 text-right">{{ $player->matchGamePlayer->getLastHits() }} ({{ $player->matchGamePlayer->getDenies() }})</td>
                <td class="py-2 px-1 pr-3 text-apple text-right">{{ $player->matchGamePlayer->gpm }}</td>
                <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $player->matchGamePlayer->xpm }}</td>
                <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $player->matchGamePlayer->getHeal() }}</td>
                <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $player->matchGamePlayer->getDamage() }}</td>
                <td class="py-2 px-1 text-gray-300 pr-3 text-right"></td>
                <td class="py-2 px-1 text-gray-300 pr-4 text-right">{{ $player->matchGamePlayer->getDamageTaken()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
