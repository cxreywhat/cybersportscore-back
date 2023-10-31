<div class="flex items-col pl-4 w-[45px]">
    <img src="{{asset('/media/icons/games/dota-2-bw.webp')}}" alt="dota-2 icon" loading="lazy" class="opacity-50 w-5 h-5">
</div>

<div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs  md:text-base" >
    <div id="t1-info" class="flex-col-reverse items-end flex" >
        <span class="ml-3 sm:ml-0 items-col-adv text-[9px] font-semibold opacity-90" >
            @if($match->getTeam1()->getGoldAdvantage() > 0 && !$match->getWinner())
                <span class="h-[12px] block rounded border-yellow-300 text-yellow-300 leading-normal" >
                    +{{ $match->getTeam1()->getGoldAdvantage() >= 1000 ?
                        round($match->getTeam1()->getGoldAdvantage() / 1000, 1).'k' :
                         $match->getTeam1()->getGoldAdvantage()  }}
                </span>
            @endif
            @if($match->getTeam1()->getExpAdvantage() > 0 && !$match->getWinner())
                <span class="text-left h-[12px] block sm:ml-0 rounded border-[#1786ED] text-[#1786ED] leading-normal" >
                    +{{ $match->getTeam1()->getExpAdvantage() >= 1000 ?
                        round($match->getTeam1()->getExpAdvantage() / 1000, 1).'k' :
                        $match->getTeam1()->getExpAdvantage() }}
                </span>
            @endif
        </span>
        <span class="text-[10px] sm:text-xs text-gray-300 font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
            {{ $match->getTeam1()->getShortTitle() }}
        </span>
    </div>
</div>
<div id="t1-logo" class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" >
    <img src="{{asset('/media/logo/_30/t'.$match->getTeam1()->id.'.webp')}}" alt="{{  $match->getTeam1()->getTitle() }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" >
</div>
<div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]" >
    <div >
        <div class="flex flex-row items-center justify-center">
            <svg class="opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: rgb(171, 175, 187); height: 1.1em">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" ></path>
            </svg>
            <div id="time-map" class="w-[30px] sm:w-[38px] text-right text-[9px] sm:text-xs leading-normal" >
                <span>
                    {{ sprintf('%02d:%02d', floor( $match->getDuration() / 60),  $match->getDuration() % 60) }}
                </span>
            </div>
        </div>
        <div id="score-match" class="flex flex-row items-center text-base justify-center italic" >
            <span class="leading-normal text-apple text-xs sm:text-sm text-right font-bold pr-1">
                {{ $match->getTeam1()->getScore() }}
            </span>
            :
            <span class="leading-normal text-apple text-xs sm:text-sm text-center font-bold pl-1">
            {{  $match->getTeam2()->getScore() }}
            </span>
        </div>
    </div>
</div>
<div id="t2-logo" class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
    <img src="{{asset('/media/logo/_30/t'.$match->getTeam2()->id.'.webp')}}" alt="{{ $match->getTeam2()->getTitle() }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" >
</div>
<div class="items-col grow w-8 sm:w-10 overflow-visible text-xs  md:text-base" >
    <div id="t2-info" class="flex-col flex" >
        <span class="text-[10px] text-gray-300 sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate" >
            {{$match->getTeam2()->getShortTitle() }}
        </span>

        <span class="ml-3 sm:ml-0 items-col-adv text-[9px] font-semibold opacity-90" >
            @if($match->getTeam2()->getGoldAdvantage() < 0 && !$match->getWinner())
                <span class="h-[12px] block rounded border-yellow-300 text-yellow-300 leading-normal" >
                   +{{ $match->getTeam2()->getGoldAdvantage()  <= -1000 ?
                        round($match->getTeam2()->getGoldAdvantage() / 1000, 1).'k'  :
                         $match->getTeam2()->getGoldAdvantage() }}
                </span>
            @endif
            @if($match->getTeam2()->getExpAdvantage() > 0 && !$match->getWinner())
                <span class="text-left h-[12px] block sm:ml-0 rounded border-[#1786ED] text-[#1786ED] leading-normal" >
                    +{{ $match->getTeam2()->getExpAdvantage() >= 1000 ?
                        round($match->getTeam2()->getExpAdvantage() / 1000, 1).'k' :
                        $match->getTeam2()->getExpAdvantage() }}
                </span>
            @endif
        </span>
    </div>
</div>

<div class="items-col w-[50px] items-center">
    <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4">
        BO{{ $match->getBestOf() }}
    </div>
    <span id="score-games" class="bg-apple text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
        {{ $match->getTeam1()->getMatchScore()}}:{{ $match->getTeam2()->getMatchScore()}}
    </span>
</div>

<style>
    .items-col {
        display: flex;
        height: 100%;
        flex-direction: column;
        justify-content: center;
        border-color: rgb(55 65 81 / var(--tw-border-opacity));
        color: #718096;
    }
</style>
