@extends('main')

@section('content')
    <div class="w-full h-full relative">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 relative mb-3">
            <div class="col-span-6 lg:col-span-3 flex justify-between items-center w-full flex-col sm:flex-row">
                <div class="flex my-5 sm:my-0 text-gray-300 font-bold text-[10px] sm:text-xs">
                    <div class="flex flex-col ml-1 bg-gray-100 bg-opacity-60 w-[55px] h-[50px] items-center justify-center rounded-[100%]">
                        <img src="{{ asset('media/event/_120/e'.$match->getTournament()->id.'.webp')}}" title="{{ $match->getTournament()->title }}"
                             alt="{{ $match->getTournament()->title }} icon" loading="lazy" class="w-[2.8rem] h-[2.8rem] inline">
                    </div>
                    <span class="flex flex-col ml-4 justify-center">
                        <span class="whitespace-nowrap">{{ $match->getTournament()->title }}</span>
                        <br>
                        <span>${{number_format($match->getTournament()->prize) }}</span>
                    </span>
                </div>
                <div class="flex flex-row align-center md:w-56 md:justify-center sm:justify-end sm:ml-3 flex-wrap">
                    @for ($numMap = 1; $numMap <= $match->getBestOf(); $numMap++)
                        <span class="mx-2 sm:mx-2 my-2 sm:mr-0">
                            <a aria-current="page" href="/{{$match_id}}?num={{$numMap}}" class="ajax-match-info
                                {{ $match->getNum() == $numMap ? "cursor-default pointer-events-none text-gray-900 bg-apple"
                                : ($numMap <= $match->getLiveNum() ? "border border-gray-500 text-gray-500 hover:text-gray-300 hover:border-apple"
                                : "text-gray-700 border border-1 border-gray-700 cursor-default pointer-events-none") }}
                                uppercase text-[10px] font-semibold px-2 py-1 rounded sm:text-xs">
                                    {!! $numMap == $match->getLiveNum() && !$match->getWinner() ? "<span class='animate-pulse inline-flex w-[8px] h-[8px] bg-red-500 border border-gray-400 border-1 rounded-[100%] mr-1'></span>" : "" !!}
                                <span class="inline-flex" >
                                    <span data-translate="labels.map">Map</span>
                                    &nbsp;
                                    <span> {{ $numMap }}</span>
                                </span>
                            </a>
                        </span>
                    @endfor
                </div>
            </div>
            <div class="col-span-6 lg:col-span-3 flex justify-between items-center">
                <div id="mainPart" class="flex flex-row w-full border border-gray-700 h-[55px] rounded-lg shadow-xl bg-[#212D3D] items-center justify-center relative">
                    @include('components.matchesIndex.matchRowMainPart')
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 relative">
            <div class="col-span-6 lg:col-span-3">
                <div class="w-full border border-gray-700 min-h-[250px] sm:min-h-[376px] rounded-lg shadow-xl mb-6 bg-[#212D3D] items-center justify-center relative overflow-hidden">
                    @include('components.matchesShow.streamsBlock')
                </div>
                <div class="w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D]  grid-cols-12 gap-2 flex ">
                    <div class="flex flex-row items-center grow w-full border-r border-gray-700 p-4 col-span-12 sm:col-span-5 order-2 sm:order-1"
                        style="max-width: 224px; max-height: 272px">
                        <div id="map" class="w-full flex flex-col-reverse ">
                            @include('components.matchesIndex.matchRowDetailsSummary', [
                                'fb' => $match->getAggregatedEvents()->getFirstBlood(),
                                'f10k' => $match->getAggregatedEvents()->getFirst10Kills(),
                                'ftd' => $match->getAggregatedEvents()->getFirstTowerDestroy(),
                                'feck' => $match->getAggregatedEvents()->getFirstEliteCreepKill()
                            ])
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
    </div>
@endsection()

@section('scripts')
    <script src="{{ asset('js/historyBlock.js') }}"></script>
    <script src='{{ asset('js/chart.js') }}'></script>
    <script src="{{ asset('js/matchFilter.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        $(document).ready(function() {
            const id = window.location.pathname.split('?')[0];
            $.ajax({
                url: '/api/matches' + id + '/history',
                method: 'GET',
                dataType: 'html',
                success: function (response) {
                    const histories = JSON.parse(response).data;
                    window.historyMatchesBlock(histories);
                },
                error: function (xhr) {
                    console.log(xhr.statusText);
                },
            });
        });

    </script>
@endsection

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

    .items-col-adv span + span {
        margin-left: 0.25rem;
    }

    @media (min-width: 768px) {
        .items-col-adv span + span {
            margin-left: 0.5rem;
        }
    }
</style>
