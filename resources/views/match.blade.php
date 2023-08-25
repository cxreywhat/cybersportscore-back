@extends('main')

@php
    $t1 = $match_beta->match_games[$num_game - 1]->match_data->teams->t1->tid === $preview->getTeam1()->id;
    $t2 = $match_beta->match_games[$num_game - 1]->match_data->teams->t2->tid === $preview->getTeam2()->id;
@endphp

@section('content')
    <div class="w-full h-full relative">
    {{--@php
           dd($match_beta);
           dd($preview);
    @endphp--}}
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 relative mb-3">
            <div class="col-span-6 lg:col-span-3 flex justify-between items-center w-full flex-col sm:flex-row">
                <div class="flex my-5 sm:my-0 text-gray-300 font-bold text-[10px] sm:text-xs">
                    <div class="flex flex-col h-full ml-1 bg-gray-100 bg-opacity-60 w-[55px] h-[50px] items-center justify-center rounded-[100%]">
                        <img src="https://api.cybersportscore.com/media/event/_120/e{{ $match_beta->tid }}.webp" title="LNTI" alt="LNTI icon" loading="lazy" class="w-[2.5rem] h-[2.5rem] inline">
                    </div>
                    <span class="flex flex-col ml-4 justify-center">
                        <span class="whitespace-nowrap">{{ $match_beta->match->info->t->t }}</span>
                        <br>
                        <span>$20,000</span>
                    </span>
                </div>
                <div class="flex flex-row align-center md:w-56 md:justify-center sm:justify-end sm:ml-3 flex-wrap">
                    @foreach($match_beta->match_games as $game)
                        <span class="mx-1 sm:mx-2 my-1 sm:mr-0">
                            <form action="{{ route('match-index', ['id' => $match_beta->id]) }}" method="post" style="display: inline;">
                                @csrf
                                <input type="hidden" name="num" value="{{ $game->num }}">
                                <button aria-current="page" href="/{{ $match_beta->id}}?num={{$game->num}}" class="
                                    {{ $num_game == $game->num ? "cursor-default pointer-events-none text-gray-900 bg-apple"
                                    : ($game->num <= $preview->getNum() ? "border border-gray-500 text-gray-500 hover:text-gray-300 hover:border-apple"
                                    : "text-gray-700 border border-1 border-gray-700 cursor-default pointer-events-none") }}
                                    uppercase text-[10px] font-semibold px-2 py-1 rounded sm:text-xs">
                                        {!! $match_beta->is_live && $game->match_data?->is_live != null ? "<span class='animate-pulse inline-flex w-[8px] h-[8px] bg-red-500 border border-gray-400 border-1 rounded-[100%] mr-1'></span>" : ""!!}
                                    <span class="inline-flex">Карта {{$game->num}}</span>
                                </button>
                            </form>
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="col-span-6 lg:col-span-3 flex justify-between items-center">
                <div class="flex flex-row w-full border border-gray-700 h-[55px] rounded-lg shadow-xl bg-[#212D3D] items-center justify-center relative">
                    @include('components.matchesIndex.matchRowMainPart')
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 relative">
            <div class="col-span-6 lg:col-span-3">
                <div class="w-full border border-gray-700 min-h-[250px] sm:min-h-[376px] rounded-lg shadow-xl mb-6 bg-[#212D3D] items-center justify-center relative overflow-hidden">
                    @include('components.matchesShow.streamsBlock')
                </div>
                <div class="w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D] grid grid-cols-12 gap-2 flex">
                    <div class="flex flex-row items-center grow w-full border-r border-gray-700 p-4 col-span-12 sm:col-span-5 order-2 sm:order-1">
                        <div class="w-full flex flex-col-reverse flex-col">
                            @include('components.matchesIndex.matchRowDetailsSummary')
                            @include('components.matchesIndex.matchRowDetailsMapDota2')
                        </div>
                    </div>
                    @include('components.matchesShow.logsBlock')
                </div>
            </div>
            <div class="col-span-6 lg:col-span-3">
                <div class="flex flex-col w-full min-h-[96px] justify-center">
                    @include('components.matchesShow.pickBansBlock')
                </div>
                <div class="flex flex-col w-full border border-gray-700 rounded-lg shadow-xl min-h-[300px] bg-[#212D3D] p-3 mb-6">
                    @include('components.matchesIndex.matchRowDetailsChart')
                </div>
                @include('components.matchesIndex.matchRowDetailsPlayers')
            </div>
            <div class="col-span-6 lg:col-span-6">
                <div class="flex flex-col w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D] overflow-x-hidden">
                    @include('components.matchesShow.statisticBlock')
                </div>
            </div>
            <div class="col-span-6 lg:col-span-6">
                <div class="flex flex-col w-full rounded-lg shadow-xl bg-[#212D3D] overflow-x-hidden">
                    @include('components.matchesShow.matchHistoryBlock')
                </div>
            </div>
        </div>
        <!---->
    </div>
@endsection()

<style lang="scss">

    .items-col-adv span + span {
        margin-left: 0;
    }

    @media (min-width: 640px) {
        .items-col-adv span + span {
            margin-left: 0.25rem;
        }
    }

    @media (min-width: 768px) {
        .items-col-adv span + span {
            margin-left: 0.5rem;
        }
    }

    .items-col {
        display: flex;
        height: 100%;
        flex-direction: column;
        align-items: start;
        justify-content: center;
        border-color: gray;
        color: #555555;
    }
    .items-col-adv span + span {
        margin-left: 0.25rem; /* Добавьте нужные вам значения отступов */
    }

    @media (min-width: 768px) {
        .items-col-adv span + span {
            margin-left: 0.5rem; /* Добавьте нужные вам значения отступов для больших экранов */
        }
    }
</style>
