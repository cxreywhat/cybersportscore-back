@php
    $playersTeam1 = (array) $match_beta->match_games[$num_game - 1]->match_data->teams->t1->players;
    $playersTeam2 = (array) $match_beta->match_games[$num_game - 1]->match_data->teams->t2->players;

    usort($playersTeam1, function ($a, $b) {
        return $b->n - $a->n;
    });

    usort($playersTeam2, function ($a, $b) {
        return $b->n - $a->n;
    });
@endphp

<div class="overflow-x-auto relative">
    <table class="w-full table-fixed text-xs text-left">
        <thead class="text-xs uppercase text-gray-500 border-b border-t border-gray-700 bg-gray-700 bg-opacity-40">
        <tr>
            <th class="py-1 px-2 w-[200px]">
                <div class="flex items-center gap-2">
                    <img src="https://api.cybersportscore.com/media/logo/_30/t{{$match_beta->match_games[$num_game - 1]->match_data->teams->t1->tid}}.webp" alt="{{ $preview->getTeam1()->getShortTitle()}} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                    <p class="green-side flex text-right text-[13px] leading-4 truncate">
                        {{ $preview->getTeam1()->getShortTitle() }}
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
        <tbody id="stats-team1-players">
            @if(intval($match_beta->match_games[$num_game - 1]->match_start) == 3)
                    @foreach($playersTeam1 as $playerT1)
                        <tr class="border-b last:border-b-0 border-gray-700 hover:bg-gray-800 h-[40px]">
                            <td class="py-1 px-2">
                                <div class="flex flex-row gap-2 items-center">
                                    <img class="w-9 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/hero/{{$match_beta->game_id}}/_59/{{ $playerT1->hero_id }}.png" alt="{{ $playerT1->hero_title }}"><!---->
                                    <div class="flex-col">
                                        <div class="flex text-xs leading-none text-gray-300">
                                            {{ $playerT1->nick }}
                                        </div>
                                        <a class="text-[10px] leading-none text-gray-500">{{ $playerT1->hero_title }}</a>
                                    </div>
                                    <span title="{{ $playerT1->lvl }} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal
                                        cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">{{ $playerT1->lvl }}</span>
                                </div>
                            </td>
                            <td class="py-2 px-1 text-gray-400">{{ $playerT1->k }}</td>
                            <td class="py-2 px-1 text-gray-400">{{ $playerT1->d }}</td>
                            <td class="py-2 px-1 text-gray-400">{{ $playerT1->a }}</td>
                            <td class="py-2 pr-4 text-apple text-right">{{ $playerT1->n }}</td>
                            <td class="py-2 px-1">
                                <div id="items" class="flex gap-2 w-[240px]">
                                    @foreach($playerT1->items as $item)
                                        <div class="flex gap-0.5">
                                            <img class="w-5 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/item/{{ $match_beta->game_id }}/_29/{{ $item->id }}.png" title="{{ $item->title }}" alt="{{ $item->title }}">
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-2 px-1 pr-3 text-gray-300 text-right">{{ $playerT1->l }} ({{ $playerT1->dn }})</td>
                            <td class="py-2 px-1 pr-3 text-apple text-right">{{ $playerT1->gpm }}</td>
                            <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $playerT1->xpm }}</td>
                            <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $playerT1->heal }}</td>
                            <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $playerT1->dmg }}</td>
                            <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $playerT1->tdmg}}</td>
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
                        <img src="https://api.cybersportscore.com/media/logo/_30/t{{$match_beta->match_games[$num_game - 1]->match_data->teams->t2->tid}}.webp" alt="{{ $preview->getTeam2()->getShortTitle() }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                        <p class="red-side flex text-right text-[13px] leading-4 truncate">
                            {{ $preview->getTeam2()->getShortTitle() }}
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
        <tbody id="stats-team2-players">
            @if(intval($match_beta->match_games[$num_game - 1]->match_start) == 3)
                @foreach($playersTeam2 as $playerT2)
                    <tr class="border-b last:border-b-0 border-gray-700 hover:bg-gray-800 h-[40px]">
                        <td class="py-1 px-2">
                            <div class="flex flex-row gap-2 items-center">
                                <img class="w-9 shadow-md rounded-sm"  src="https://api.cybersportscore.com/media/game/hero/{{$match_beta->game_id}}/_59/{{ $playerT2->hero_id }}.png" alt="{{ $playerT2->hero_title }}"><!---->
                                <div class="flex-col">
                                    <div class="flex text-xs leading-none text-gray-300">
                                        {{ $playerT2->nick }}
                                    </div>
                                    <a class="text-[10px] leading-none text-gray-500">{{ $playerT2->hero_title }}</a>
                                </div>
                                <span title="{{ $playerT2->lvl }} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500
                                    border-2 border-gray-700 hover:border-gray-600 rounded">{{ $playerT2->lvl }}</span>
                            </div>
                        </td>
                        <td class="py-2 px-1 text-gray-400">{{ $playerT2->k }}</td>
                        <td class="py-2 px-1 text-gray-400">{{ $playerT2->d }}</td>
                        <td class="py-2 px-1 text-gray-400">{{ $playerT2->a }}</td>
                        <td class="py-2 pr-4 text-apple text-right">{{ $playerT2->n }}</td>
                        <td class="py-2 px-1">
                            <div id="items-2" class="flex gap-2 w-[240px]">
                                @foreach($playerT2->items as $item)
                                    <div class="flex gap-0.5">
                                        <img class="w-5 shadow-md rounded-sm" src="https://api.cybersportscore.com/media/game/item/{{ $match_beta->game_id }}/_29/{{ $item->id }}.png" title="{{ $item->title }}" alt="{{ $item->title }}">
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="py-2 px-1 pr-3 text-gray-300 text-right">{{ $playerT2->l }} ({{ $playerT2->dn }})</td>
                        <td class="py-2 px-1 pr-3 text-apple text-right">{{ $playerT2->gpm }}</td>
                        <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $playerT2->xpm }}</td>
                        <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $playerT2->heal }}</td>
                        <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $playerT2->dmg }}</td>
                        <td class="py-2 px-1 text-gray-300 pr-3 text-right">{{ $playerT2->tdmg }}</td>
                        <td class="py-2 px-1 text-gray-300 pr-4 text-right">0</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<script src={{ asset('js/components/matches/statisticBlock.js') }}></script>
