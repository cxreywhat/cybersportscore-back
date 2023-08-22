<?php
    $info = json_decode($game->info);
    $gameDate = new DateTime($game->date, new DateTimeZone('UTC'));
    $matchIsLive = $gameDate->getTimestamp() < time();
    $numberGame = $info->map->num;
?>
   <div class="items-row hover:bg-gray-800 border-l-[1px] {{ $matchIsLive ? 'border-red-500 border-l-[4px]' : 'border-gray-700'}}">
        <a href="/{{$game->id}}" class="border-transparent flex flex-row w-full h-full items-center">
            <div class="flex items-col pl-4 w-[45px]">
                <img loading="lazy" class="opacity-50 w-5 h-5" alt="dota-2 icon"
                     src={{asset("media/icons/games/".$info->t->g."-bw.webp")}}>
            </div>
            <span>
                <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-sm">
                    @if($matchIsLive)
                        <div class="font-semibold text-sm text-red-500 leading-4 flex flex-col items-center opacity-90">
                            <span class="hidden md:flex">LIVE</span>
                            <span class="text-[9px] sm:text-xs font-semibold mt-0 md:mt-1 px-1 rounded bg-red-500 text-gray-900" >
                                <span>MAP {{$numberGame}}</span>
                            </span>
                        </div>
                    @else
                        <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col  py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                            <span>Сегодня, 12:00</span>
                        </div>
                    @endif
                </div>
            </span>
            <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base text-end">
                <div class="flex flex-col-reverse md:flex-row md:items-center text-left w-[100%] flex-grow-1">
                    @if($matchIsLive)
                        <span class="mr-3 sm:mr-0 md:mr-8 items-col-adv text-[9px] font-semibold opacity-90">
                            <span class="h-[12px] sm:h-[18px] block sm:inline md:p-1 md:border rounded border-yellow-300 text-yellow-300 leading-normal">
                                +9.1k
                            </span>
                            <span class="text-right h-[12px] sm:h-[18px] block sm:inline md:border md:p-1 rounded border-[#1786ED] text-[#1786ED] leading-normal">
                                +5.7k
                            </span>
                        </span>
                    @endif
                    <span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate">
                        {{ $info->t1->t }}
                    </span>
                </div>
            </div>
            <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
                <div class="flex flex-col items-center mx-auto">
                    <img {{--src={{ "https://api.cybersportscore.com/media/logo/_30/t".$game->t1.".webp" }}--}}
                         src='{{ asset("media/icons/no-icon.svg") }}'
                         alt="{{ $info->t1->t }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                </div>
            </div>
            <div class="flex items-col border-l border-r text-gray-400 justify-center items-center sm:text-sm w-[70px] sm:w-[100px]">
                @if($matchIsLive )
                    <div class="flex flex-row items-center justify-center">
                        <svg class="opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: rgb(171, 175, 187); height: 1.1em;">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="w-[30px] sm:w-[38px] text-right text-[9px] sm:text-xs leading-normal">
                        <span class="">
                            23:26
                        </span>
                        </div>
                    </div>
                    <div class="flex flex-row items-center text-base justify-center italic" >
                        <span class="leading-normal text-apple text-xs sm:text-sm text-right font-bold pr-1" >{{ $info->map->games->{$numberGame}->t1->s }}</span>
                        :
                        <span class="leading-normal text-apple text-xs sm:text-sm text-center font-bold pl-1" >{{$info->map->games->{$numberGame}->t2->s}}</span>
                    </div>
                @else
                    <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple">
                        VS
                    </div>
                @endif
            </div>
            <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
                <div class="flex flex-col items-center mx-auto">
                    <img  {{--src='{{ 'https://api.cybersportscore.com/media/logo/_30/t'.$game->t2.'.webp' }}'--}}
                          src='{{ asset("media/icons/no-icon.svg") }}'
                          alt="{{ $info->t2->t }} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                </div>
            </div>
            <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
                <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    {{ $info->t2->t }}
                </span><!----><!---->
                </div>
            </div>
            <div class="items-col w-[80px] hidden sm:flex items-center">
                <div class="flex flex-col items-center mx-auto">
                    <img src='{{ asset("media/icons/no-icon.svg") }}' title="Miso Soup" alt="Miso Soup icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
                </div>
            </div>
            <div class="items-col w-[50px] items-center">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4 mx-auto ">
                    BO{{$game->bo}}
                </div>
                <span class="{{$matchIsLive ? 'bg-apple' : 'bg-gray-500'}} text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white mx-auto text-center">
                    {{$game->t1s}}:{{$game->t2s}}
                </span>
            </div>
        </a>
        <button class="hover:bg-apple bg-gray-700 text-gray-300 w-[48px] sm:w-[42px] h-full justify-center items-center flex" onclick="toggleMatchDetails()">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd">
                </path>
            </svg>
        </button>
    </div>
@if($matchIsLive)
    @include('components.matchesIndex.matchHomeDetails', ['gameInfo' => $info, 'game' => $game, 'id' => 'matchDetails'])
@endif

<script>
    function toggleMatchDetails() {
        var matchDetails = document.getElementById('matchDetails');
        if (matchDetails.style.display === 'none') {
            matchDetails.style.display = 'flex';
        } else {
            matchDetails.style.display = 'none';
        }
    }
</script>


<style>
    #matchDetails {
        display: none;
    }
    .items-row {
        position: relative;
        display: flex;
        background-color: #192536;
        height: 3.2rem;
        background-color: rgba(55, 65, 81, 0.2);
        color: #718096;
        align-items: center;
        will-change: contents;
    }

    .items-col {
        display: flex;
        height: 100%;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        border-color: #718096;
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







