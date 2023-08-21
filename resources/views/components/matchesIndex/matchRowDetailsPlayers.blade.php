<div class="w-full flex flex-col bg-[#212D3D]">
    <div class="flex w-full justify-between text-sm px-3 py-2 min-h-[42px] font-semibold border-b border-gray-700 rounded-t-md border-t border-l border-r cursor-default">
        <div class="flex text-xs items-center">
            <img src="https://api.cybersportscore.com/media/logo/_30/t{{ $preview->getTeam1()->id }}.webp" alt="{{ $preview->getTeam1()->getTitle() }}icon" class="w-[1.6rem] aspect-[3/2] object-contain mr-2" loading="lazy">
            <span class="green-side" title="{{ $preview->getTeam1()->getTitle() }}">{{ $preview->getTeam1()->getShortTitle() }}</span>
        </div>
        <div class="flex text-xs items-center justify-end">
            <span class="red-side" title="{{ $preview->getTeam2()->getTitle() }}">{{ $preview->getTeam2()->getShortTitle() }}</span>
            <img src="https://api.cybersportscore.com/media/logo/_30/t{{ $preview->getTeam2()->id }}.webp" alt="{{ $preview->getTeam2()->getTitle() }} icon" class="w-[1.6rem] aspect-[3/2] object-contain ml-2" loading="lazy">
        </div>
    </div>
    @php
        $i = 0;
        $maxNetWorthPlayer = 0;
        $maxNetWorth = 0;
        $mergedArray = $preview->getTeam1()->getPlayers() + $preview->getTeam2()->getPlayers();
        foreach ($mergedArray as $element) {
            $netWorth = $element->matchGamePlayer->netWorth;
            if ($netWorth > $maxNetWorth) {
                $maxNetWorth = $netWorth;
            }
        }
    @endphp
    <div class="flex flex-col relative bg-[#1F2937]">
        @foreach($preview->getTeam1()->getPlayers() as $playerTeam1)
            @php
                $key = array_keys($preview->getTeam2()->getPlayers());
                $playerTeam2 = $preview->getTeam2()->getPlayers()[$key[$i]];
                $i++;
                $netWorthScalePlayerT1 = $playerTeam1->matchGamePlayer->netWorth * 0.9 / $maxNetWorth;
                $netWorthScalePlayerT2 = $playerTeam2->matchGamePlayer->netWorth * 0.9 / $maxNetWorth;
            @endphp

            <div class="flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative">
                <div class="px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                    <span title="Ценность героя {{ $playerTeam1->matchGamePlayer->netWorth }}" class="left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
                        font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX({{$netWorthScalePlayerT1}})"></span>
                    <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2" src="https://api.cybersportscore.com/media/game/hero/{{$gameId}}/_59/{{$playerTeam1->matchGamePlayer->heroId}}.png"
                         alt="{{$playerTeam1->matchGamePlayer->heroTitle}}" title="{{$playerTeam1->matchGamePlayer->heroTitle}}" loading="lazy">
                    <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="{{ $playerTeam1->matchGamePlayer->nick }}">{{ $playerTeam1->matchGamePlayer->nick }}</span>
                    <span title="{{ $playerTeam1->matchGamePlayer->level }} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500
                    border-2 border-gray-700 hover:border-gray-600 rounded">{{ $playerTeam1->matchGamePlayer->level }}</span>
                </div>

                <div class="justify-end px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                    <span title="Ценность героя {{ $playerTeam2->matchGamePlayer->netWorth }}" class="right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
                        font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX({{$netWorthScalePlayerT2}})"></span>
                    <span title="{{ $playerTeam2->matchGamePlayer->level }} Level" class="mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0
                        leading-normal cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">{{ $playerTeam2->matchGamePlayer->level }}</span>
                    <span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="Mercury-">{{ $playerTeam2->matchGamePlayer->nick }}</span>
                    <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="https://api.cybersportscore.com/media/game/hero/{{$gameId}}/_59/{{$playerTeam2->matchGamePlayer->heroId}}.png"
                         alt="{{$playerTeam2->matchGamePlayer->heroTitle}}" title="{{$playerTeam2->matchGamePlayer->heroTitle}}" loading="lazy">
                </div>

            </div>
        @endforeach
    </div>
</div>
