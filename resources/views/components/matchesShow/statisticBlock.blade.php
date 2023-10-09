<div class="overflow-x-auto relative">
    <table class="w-full table-fixed text-xs text-left">
        <thead class="text-xs uppercase text-gray-500 border-b border-t border-gray-700 bg-gray-700 bg-opacity-40">
        <tr>
            <th class="py-1 px-2 w-[200px]">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('/media/logo/_30/t'.$match->getTeam1()->id.'.webp')}}"
                         alt="{{ $match->getTeam1()->getShortTitle()}} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                    <p class="green-side flex text-right text-[13px] leading-4 truncate">
                        {{ $match->getTeam1()->getShortTitle() }}
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
            {!!  $match->getGameId() == 582 ? '<th class="py-2 px-1 w-[65px] pr-3 text-right">XPM</th>' : '<th class="py-2 px-1 w-[65px] pr-3 text-right text-apple">WARD</th>'!!}
            <th class="py-2 px-1 w-[65px] pr-3 text-right">Heal</th>
            <th class="py-2 px-1 w-[65px] pr-3 text-right">DMG</th>
            <th class="py-2 px-1 w-[65px] pr-3 text-right">BLD</th>
            <th class="py-2 px-1 w-[65px] pr-4 text-right">TKN</th>
        </tr>
        </thead>
        <tbody id="stats-team1-players">
            @if($match->getDuration() > 0)
                    @foreach($match->getTeam1()->getPlayers() as $playerT1)
                        <tr class="border-b last:border-b-0 border-gray-700 hover:bg-gray-800 h-[40px]">
                            <td class="py-1 px-2">
                                <div class="flex flex-row gap-2 items-center">
                                    <img class="w-9 shadow-md rounded-sm" src="{{asset('/media/game/hero/'.$match->getGameId().'/_59/'.$playerT1->matchGamePlayer->heroId.'.png')}}"
                                         alt="{{ $playerT1->matchGamePlayer->heroTitle }}">
                                    <div class="flex-col">
                                        <div class="flex text-xs leading-none text-gray-300">
                                            {{ $playerT1->matchGamePlayer->nick }}
                                        </div>
                                        <a class="text-[10px] leading-none text-gray-500">{{ $playerT1->matchGamePlayer->heroTitle }}</a>
                                    </div>
                                    <span title="{{ $playerT1->matchGamePlayer->level }} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal
                                        cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">{{ $playerT1->matchGamePlayer->level }}</span>
                                </div>
                            </td>
                            <td class="py-2 px-1 text-gray-400">{{ $playerT1->matchGamePlayer->getKills() }}</td>
                            <td class="py-2 px-1 text-gray-400">{{ $playerT1->matchGamePlayer->getDeaths() }}</td>
                            <td class="py-2 px-1 text-gray-400">{{ $playerT1->matchGamePlayer->getAssists() }}</td>
                            <td class="py-2 pr-4 text-apple text-right">{{ number_format($playerT1->matchGamePlayer->netWorth) }}</td>
                            <td class="py-2 px-1">
                                <div id="items" class="flex gap-2 w-[240px]">
                                    @foreach($playerT1->matchGamePlayer->items as $item)
                                        <div class="flex gap-0.5">
                                            <img class="w-5 shadow-md rounded-sm" src="{{asset('/media/game/item/'.$match->getGameId().'/'.$match->getGameId() == 582 ? '_29' : '_21'.'/'.$item["id"].'.png')}}"
                                                 title="{{ $item["title"] }}" alt="{{ $item["title"] }}">
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-2 px-1 pr-3 text-gray-300 text-right">{{ number_format($playerT1->matchGamePlayer->getLastHits()) }}
                                {{ $match->getGameId() == 582 ? '('.$playerT1->matchGamePlayer->getDenies().')': "" }}</td>
                            <td class="py-2 px-1 pr-3 text-apple text-right">{{ number_format($playerT1->matchGamePlayer->gpm) }}</td>
                            <td class="py-2 px-1 pr-3 text-right {{$match->getGameId() == 582 ? 'text-gray-300' : 'text-apple'}}">
                                {{ $match->getGameId() == 582 ? number_format($playerT1->matchGamePlayer->xpm) : '0/0' }}
                            </td>
                            <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ number_format($playerT1->matchGamePlayer->getHeal()) }}</td>
                            <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ number_format($playerT1->matchGamePlayer->getDamage()) }}</td>
                            <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ number_format($playerT1->matchGamePlayer->getDamageTaken()) }}</td>
                            <td class="py-2 px-1 text-gray-300 pr-4 text-right">0</td>
                        </tr>
                    @endforeach
            @endif
        </tbody>
    </table>
    <table class="w-full table-fixed text-xs text-left">
        <thead class="text-xs uppercase text-gray-500 border-b border-t border-gray-700 bg-gray-700 bg-opacity-40">
            <tr>
                <th class="py-1 px-2 w-[200px]">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('/media/logo/_30/t'.$match->getTeam2()->id.'.webp')}}"
                             alt="{{ $match->getTeam2()->getShortTitle() }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                        <p class="red-side flex text-right text-[13px] leading-4 truncate">
                            {{ $match->getTeam2()->getShortTitle() }}
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
                {!!  $match->getGameId() == 582 ? '<th class="py-2 px-1 w-[65px] pr-3 text-right">XPM</th>' : '<th class="py-2 px-1 w-[65px] pr-3 text-right text-apple">WARD</th>'!!}
                <th class="py-2 px-1 w-[65px] pr-3 text-right">Heal</th>
                <th class="py-2 px-1 w-[65px] pr-3 text-right">DMG</th>
                <th class="py-2 px-1 w-[65px] pr-3 text-right">BLD</th>
                <th class="py-2 px-1 w-[65px] pr-4 text-right">TKN</th>
            </tr>
        </thead>
        <tbody id="stats-team2-players">
            @if($match->getDuration() > 0)
                @foreach($match->getTeam2()->getPlayers() as $playerT2)
                    <tr class="border-b last:border-b-0 border-gray-700 hover:bg-gray-800 h-[40px]">
                        <td class="py-1 px-2">
                            <div class="flex flex-row gap-2 items-center">
                                <img class="w-9 shadow-md rounded-sm"  src="{{asset('/media/game/hero/'.$match->getGameId().'/_59/'.$playerT2->matchGamePlayer->heroId.'.png')}}"
                                     alt="{{ $playerT2->matchGamePlayer->heroTitle }}"><!---->
                                <div class="flex-col">
                                    <div class="flex text-xs leading-none text-gray-300">
                                        {{ $playerT2->matchGamePlayer->nick }}
                                    </div>
                                    <a class="text-[10px] leading-none text-gray-500">{{ $playerT2->matchGamePlayer->heroTitle }}</a>
                                </div>
                                <span title="{{ $playerT2->matchGamePlayer->level }} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500
                                    border-2 border-gray-700 hover:border-gray-600 rounded">{{ $playerT2->matchGamePlayer->level }}</span>
                            </div>
                        </td>
                        <td class="py-2 px-1 text-gray-400">{{ $playerT2->matchGamePlayer->getKills() }}</td>
                        <td class="py-2 px-1 text-gray-400">{{ $playerT2->matchGamePlayer->getDeaths() }}</td>
                        <td class="py-2 px-1 text-gray-400">{{ $playerT2->matchGamePlayer->getAssists() }}</td>
                        <td class="py-2 pr-4 text-apple text-right">{{ number_format($playerT2->matchGamePlayer->netWorth) }}</td>
                        <td class="py-2 px-1">
                            <div id="items-2" class="flex gap-2 w-[240px]">
                                @foreach($playerT2->matchGamePlayer->items as $item)
                                    <div class="flex gap-0.5">
                                        <img class="w-5 shadow-md rounded-sm" src="{{asset('/media/game/item/'.$match->getGameId().'/'.$match->getGameId() == 582 ? '_29' : '_21'.'/'.$item["id"].'.png')}}"
                                             title="{{ $item["title"] }}" alt="{{ $item["title"] }}">
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="py-2 px-1 pr-3 text-gray-300 text-right">{{ number_format($playerT2->matchGamePlayer->getLastHits())}}
                            {{ $match->getGameId() == 582 ? '('.$playerT2->matchGamePlayer->getDenies().')': "" }}</td>
                        <td class="py-2 px-1 pr-3 text-apple text-right">{{number_format($playerT2->matchGamePlayer->gpm)}} </td>
                        <td class="py-2 px-1 pr-3 text-right {{$match->getGameId() == 582 ? 'text-gray-300' : 'text-apple'}}">
                            {{ $match->getGameId() == 582 ? number_format($playerT2->matchGamePlayer->xpm) : '0/0' }}
                        </td>
                        <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ number_format($playerT2->matchGamePlayer->getHeal()) }}</td>
                        <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ number_format($playerT2->matchGamePlayer->getDamage()) }}</td>
                        <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ number_format($playerT2->matchGamePlayer->getDamageTaken())}}</td>
                        <td class="py-2 px-1 text-gray-300 pr-4 text-right">0</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
