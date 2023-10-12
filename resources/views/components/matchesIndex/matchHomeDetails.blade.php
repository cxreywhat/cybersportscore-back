<div id="detailsPlayers" class="w-full md:w-auto flex flex-1 grow items-start">
    @include('components.matchesIndex.matchRowDetailsPlayers')
</div>
<div class="py-5 md:py-0 flex w-full flex-col md:w-[180px] justify-center items-center px-4">
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
<div id="chartDetails" class="flex md:w-auto flex-1 w-full grow items-center">
    @include('components.matchesIndex.matchRowDetailsChart')
</div>
