<div class="items-row hover:bg-gray-800 border-l-[4px] {{ $itemDate->getTimestamp() < time() ? 'border-red-500'  : 'border-transparent'}}">
    <a class="ajax-match-block {{$info?->map?->match_start != "0" ? 'cursor-pointer' : 'cursor-default' }} flex flex-row w-full h-full items-center "
       {{ $info?->map?->match_start == "1" ? "href=/$item->id" : '' }} data-id="{{ $item->id }}" >
        <div class="flex items-col pl-4 w-[45px]">
            <img loading="lazy" class="opacity-50 w-5 h-5" alt="dota-2 icon" src={{asset("media/icons/games/".$info->t->g."-bw.webp")}}>
        </div>
        <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col items-start p-0 sm:px-3 py-3 text-sm">

            @if($itemDate?->getTimestamp() < time() && intval($info?->map?->match_start) >= 1)
                <div class="font-semibold text-sm text-red-500 leading-4 flex flex-col items-center opacity-90">
                    <span class="hidden md:flex">LIVE</span>
                    <span class="text-[9px] sm:text-xs font-semibold mt-0 md:mt-1 px-1 rounded bg-red-500 text-gray-900" >
                        <span>{{'MAP '.$info?->map?->num }}</span>
                    </span>
                </div>
            @else
                <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col  py-3  leading-[1rem] text-[9px] sm:text-xs">
                    <span id="date-match-{{$item->id}}" class="text-gray-400 sm:text-gray-300 sm:text-xs" data-time-match="{{ $itemDate->getTimestamp() }}">
                    </span>
                </div>
            @endif
        </div>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="md:items-center flex-col-reverse items-end md:flex-row  flex">
                <span class="text-[10px] sm:text-xs text-gray-300 font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    {{ $info->t1->t }}
                </span>
            </div>
        </div>
        <div class="w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="{{ asset("/media/logo/_30/t".$item->t1.".webp")}}"
                     alt="{{ $info->t1->t }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            @if($info->bb !== null && !intval($info?->map?->match_start) == "1")
                <div class="flex flex-col items-center justify-content" onclick="window.location.href=`/go?to=bb&k1&m={{ $item->id }}&lang=en`">
                    <div class="md:py-1">
                        <img width="35px" loading="lazy" src={{ asset("/media/odds/small/bb.png") }} alt="bb">
                    </div>
                    <div class="text-[9px] leading-[1rem] sm:text-xs text-gray-300 font-extrabold">
                        {{ $info->bb->{$item->t1} }} - {{ $info->bb->{$item->t2} }}
                    </div>
                </div>
            @elseif($itemDate?->getTimestamp() < time() && intval($info?->map?->match_start) == "1")
                <div class="flex flex-row items-center justify-center">
                    <svg class="opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: rgb(171, 175, 187); height: 1.1em;">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="w-[30px] sm:w-[38px] text-right text-[9px] sm:text-xs leading-normal">
                    <span id='time-game' class="">
                        {{ sprintf('%02d:%02d', floor( $info->map->games->{ $info->map->num }->d / 60),  $info->map->games->{ $info->map->num }->d % 60) }}
                    </span>
                    </div>
                </div>
                <div class="flex flex-row items-center text-base justify-center italic" >
                    <span class="leading-normal text-apple text-xs sm:text-sm text-right font-bold pr-1" >{{ $info->map->games->{$info->map->num}->t1->s }}</span>
                    :
                    <span class="leading-normal text-apple text-xs sm:text-sm text-center font-bold pl-1" >{{$info->map->games->{$info->map->num}->t2->s}}</span>
                </div>

            @else
                <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple">
                    VS
                </div>
            @endif
        </div>
        <div class="w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src='{{ asset('/media/logo/_30/t'.$item->t2.'.webp') }}'
                      alt="{{ $info->t2->t }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs  md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold text-gray-300 ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    {{ $info->t2->t }}
                </span>
            </div>
        </div>
        <div class="w-[80px] hidden sm:flex items-center ">
            <div class="flex flex-col items-center mx-auto">
                <img src='{{ asset('/media/event/_30/e'.$item->tournament_id.'.webp') }}' title="{{$item->tournament_title}}" alt="{{$item->tournament_title}} icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center">
            <div class="flex font-semibold  flex-col text-xs text-gray-300 leading-4 mx-auto ">
                BO{{$item->bo}}
            </div>
            <span class="{{$itemDate?->getTimestamp() < time() && intval($info?->map?->match_start) == "1" ? 'bg-apple' : 'bg-gray-500'}} text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white mx-auto text-center">
                {{$item->t1s}}:{{$item->t2s}}
            </span>
        </div>
    </a>
    <button id="matchDetailsButton-{{$item->id}}" class="{{$itemDate?->getTimestamp() < time() && $info?->map?->match_start !== "" ? 'hover:bg-apple bg-gray-700 text-gray-300 cursor-pointer' : 'text-gray-700 cursor-default'}}  w-[46px] sm:w-[42px] h-full justify-center items-center flex">
        <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd">
            </path>
        </svg>
    </button>
</div>
@if($itemDate?->getTimestamp() < time())
    <div id='matchDetails-{{ $item->id }}' class="min-h-[285px] flex-col md:flex-row p-4 details-container" style="display: none;"></div>
    <script src="{{ asset('js/helpers/detailsMap.js') }}" type="module"></script>
    <script src="{{ asset('js/matchFilter.js') }}" type="module"></script>
@endif
<style>

    .items-col {
        display: flex;
        height: 100%;
        flex-direction: column;
        justify-content: center;
        border-color: rgb(55 65 81 / var(--tw-border-opacity));
        color: #718096;
    }

    .items-col-adv span + span {
        margin-left: 0.25rem;
    }

    @media (min-width: 768px) {
        .items-col-adv span + span {
            margin-left: 0.5rem;
        }
    }
</style>







