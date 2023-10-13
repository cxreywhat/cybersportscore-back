<div class="w-full flex flex-col bg-[#212D3D]">
    <div class="flex w-full justify-between text-sm px-3 py-2 min-h-[42px] font-semibold border-b border-gray-700 rounded-t-md border-t border-l border-r cursor-default">
        <div class="flex text-xs items-center">
            <img src="{{asset('/media/logo/_30/t'.$match->getTeam1()->id.'.webp')}}" alt="{{ $match->getTeam1()->id }}icon" class="w-[1.6rem] aspect-[3/2] object-contain mr-2" loading="lazy">
            <span class="green-side" title="{{ $match->getTeam1()->getShortTitle() }}">
                {{ $match->getTeam1()->getShortTitle() }}
            </span>
        </div>
        <div class="flex text-xs items-center justify-end">
            <span class="red-side" title="{{ $match->getTeam2()->getTitle() }}">
                {{  $match->getTeam2()->getShortTitle()}}
            </span>
            <img src="{{asset('/media/logo/_30/t'.$match->getTeam2()->id.'.webp')}}" alt="{{ $match->getTeam2()->id }} icon" class="w-[1.6rem] aspect-[3/2] object-contain ml-2" loading="lazy">
        </div>
    </div>
    <div id="detailsContainer" class="flex relative bg-[#1F2937]">
        <div class="max-w-[50%]" style="min-width: 50%">
            @foreach($match->getTeam1()->getPlayers() as $playerTeam1)
                <div class="flex justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l min-h-[42px] relative">
                    <div class="px-2 flex w-full items-center grow relative max-h-8">
                        @if($isLive && $playerTeam1->matchGamePlayer->netWorth)
                            <span title="Networth {{ $playerTeam1->matchGamePlayer->netWorth }}" class="left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
                            font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="
                            transform: scaleX({{$playerTeam1->matchGamePlayer->netWorth * 0.9 / $biggestNet}})">
                        </span>
                            <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2" src="{{ asset('/media/game/hero/'.$match->getGameId().'/_59/'.$playerTeam1->matchGamePlayer->heroId.'.png') }}"
                                 alt="{{$playerTeam1->matchGamePlayer->heroTitle}}" title="{{$playerTeam1->matchGamePlayer->heroTitle}}" loading="lazy">
                        @else
                            <img src="{{asset('/media/flags/'.$playerTeam1->matchPlayer->countryId.'.svg')}}" alt="Country flag 31" loading="lazy" class="w-4 md:w-5 mr-2">
                        @endif
                        <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="{{ $playerTeam1->matchGamePlayer->nick }}">{{ $playerTeam1->matchGamePlayer->nick }}</span>
                        @if($isLive && $playerTeam1->matchGamePlayer->level)
                            <span title="{{ $playerTeam1->matchGamePlayer->level }} Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500
                        border-2 border-gray-700 hover:border-gray-600 rounded">{{ $playerTeam1->matchGamePlayer->level }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="max-w-[50%]" style="min-width: 50%">
            @foreach($match->getTeam2()->getPlayers() as $playerTeam2)
                <div class="flex text-sm py-1 border-gray-700 border-b last:rounded-b-md border-r min-h-[42px] relative justify-end">
                    <div class="justify-end px-2 flex w-full items-center grow relative max-h-8">
                        @if($isLive && $playerTeam2->matchGamePlayer->netWorth)
                            <span title="Networth {{ $playerTeam2->matchGamePlayer->netWorth }}" class="right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
                            font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="
                            transform: scaleX({{$playerTeam2->matchGamePlayer->netWorth * 0.9 / $biggestNet}})"></span>
                            <span title="{{ $playerTeam2->matchGamePlayer->level }} Level" class="mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0
                            leading-normal cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">{{ $playerTeam2->matchGamePlayer->level }}</span>
                        @endif
                        <span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="Mercury-">{{ $playerTeam2->matchGamePlayer->nick }}</span>
                        @if($isLive && $playerTeam2->matchGamePlayer->netWorth)
                            <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="{{asset('/media/game/hero/'.$match->getGameId().'/_59/'.$playerTeam2->matchGamePlayer->heroId.'.png')}}"
                                 alt="{{$playerTeam2->matchGamePlayer->heroTitle}}" title="{{$playerTeam2->matchGamePlayer->heroTitle}}" loading="lazy">
                        @else
                            <img src="{{asset('/media/flags/'.$playerTeam2->matchPlayer->countryId.'.svg')}}" alt="Country flag 31" loading="lazy" class="w-4 md:w-5 ml-2">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
