@php
    $timeMapSeconds = $match_beta->match_games[$num_game - 1]->match_data->duration;
    $timeMap = sprintf('%02d:%02d', floor( $timeMapSeconds / 60),  $timeMapSeconds % 60);
@endphp

<div class="flex items-col pl-4 w-[45px]">
    <img src="/media/icons/games/dota-2-bw.webp" alt="dota-2 icon" loading="lazy" class="opacity-50 w-5 h-5">
</div>

<div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base" >
    <div class="flex-col-reverse items-end flex" >
        <span class="ml-3 sm:ml-0 items-col-adv text-[9px] font-semibold opacity-90" >
            @if(end($match_beta->match_games[$num_game - 1]->match_data->gold) > 0 && $match_beta->is_live)
                <span class="h-[12px] block rounded border-yellow-300 text-yellow-300 leading-normal" >+{{round(end($match_beta->match_games[$num_game - 1]->match_data->gold) / 1000), 1}}k</span>
            @endif
            @if($match_beta->match_games[$num_game - 1]->advantage_exp > 0 && $match_beta->is_live)
                <span class="text-left h-[12px] block sm:ml-0 rounded border-[#1786ED] text-[#1786ED] leading-normal" >+{{round($match_beta->match_games[$num_game - 1]->advantage_exp / 1000, 1)}}k</span>
            @endif
        </span>
        <span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >{{ $preview->getTeam1()->getShortTitle() }}</span>

    </div>
</div>
<div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" >
    <img src="https://api.cybersportscore.com/media/logo/_30/t{{$match_beta->match_games[$num_game - 1]->match_data->teams->t1->tid}}.webp" alt="MIRACLE ESPORT icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" >
</div>
<div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]" >
    <div >
        <div class="flex flex-row items-center justify-center">
            <svg class="opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: rgb(171, 175, 187); height: 1.1em">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" ></path>
            </svg>
            <div class="w-[30px] sm:w-[38px] text-right text-[9px] sm:text-xs leading-normal" >
                <span class="">{{$timeMap}}</span>
            </div>
        </div>
        <div class="flex flex-row items-center text-base justify-center italic" >
            <span class="leading-normal text-apple text-xs sm:text-sm text-right font-bold pr-1">{{$match_beta->match_games[$num_game - 1]->match_data->teams->t1->score}}</span>
            :
            <span class="leading-normal text-apple text-xs sm:text-sm text-center font-bold pl-1">{{$match_beta->match_games[$num_game - 1]->match_data->teams->t2->score}}</span>
        </div>
    </div>
</div>
<div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
    <img src="https://api.cybersportscore.com/media/logo/_30/t{{$match_beta->match_games[$num_game - 1]->match_data->teams->t2->tid}}.webp" alt="Vision icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" >
</div>
<div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base" >
    <div class="flex-col flex" >
        <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate" >{{ $preview->getTeam2()->getShortTitle() }}</span>

        <span class="ml-3 sm:ml-0 items-col-adv text-[9px] font-semibold opacity-90" >
            @if(end($match_beta->match_games[$num_game - 1]->match_data->gold) < 0 && $match_beta->is_live)
                <span class="h-[12px] block rounded border-yellow-300 text-yellow-300 leading-normal" >+{{round(end($match_beta->match_games[$num_game - 1]->match_data->gold) * -1 / 1000), 1}}k</span>
            @endif
            @if($match_beta->match_games[$num_game - 1]->advantage_exp < 0 && $match_beta->is_live)
                <span class="text-left h-[12px] block sm:ml-0 rounded border-[#1786ED] text-[#1786ED] leading-normal" >+{{round($match_beta->match_games[$num_game - 1]->advantage_exp * -1 / 1000, 1)}}k</span>
            @endif
        </span>
    </div>
</div>

<div class="items-col w-[50px] items-center">
    <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4">
        BO{{$match_beta->match->bo}}
    </div>
    <span class="bg-apple text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
        {{ $t1 ? $match_beta->match->t1s : $match_beta->match->t2s  }}:{{ $t1 ? $match_beta->match->t2s : $match_beta->match->t1s }}
    </span>
</div>
