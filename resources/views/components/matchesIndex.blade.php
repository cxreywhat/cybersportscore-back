<div class="flex flex-col md:flex-row items-center p-2 rounded-t-md border-x border-t border-b border-gray-700 bg-[#212D3D]">
    <h3 class="text-sm font-semibold text-gray-600 grow pl-3 w-full pb-2 md:pb-0" data-translate="labels.matches">
        Матчи
    </h3>
    <div id="filterListBox" class="flex flex-col md:flex-row ">
        @include('components.common.filterListBox')
    </div>
</div>
<div id="loader-match" class='min-h-[785px] border-l border-r border-t relative overflow-hidden border-b rounded-b-md border-gray-700 shadow-xl' style="display: none">
    @include('components.common.loader')
</div>
<div id="matches" class="{{count($items) === 0 ? 'min-h-[785px] border-l border-r '
    : ''}} relative overflow-hidden border-gray-700 shadow-xl">

    @if(count($items) > 0)
        @foreach($items as $item)
            @if($item->info != null )
             <div id="match" class="border-gray-700 border-x border-b justify-between"
                  data-game="{{ $item->game_id == 582 ? '582' : '313' }}"
                  data-tournament="{{ $item->tournament_id}}"
                  data-teams="[{{ $item->t1 }}, {{ $item->t2 }}]"
                  data-match-id="{{ $item->id }}"
                  data-matchStart="{{json_decode($item->info)->map->match_start ?? ''}}">
                @include('components.matchesIndex.matchRow', [
                    'info' => json_decode($item->info),
                    'itemDate' => new DateTime($item->date, new DateTimeZone('UTC')),
                ])
            </div>
            @endif
        @endforeach
    @else
        <div class="flex border-l border-t border-r min-h-[785px] relative justify-center items-center
            overflow-hidden rounded-b-md border-gray-700 text-gray-600 text-xl
            bg-[#212D3D]" data-translate="state.no_matches">
            Нету будущих матчей с такими параметрами
        </div>
    @endif


</div>

<div class="mt-5 ">
    @include('components.common.pagination')
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="{{asset('js/helpers/matchRow.js')}}"></script>
<style lang="scss">
    @layer components {
        .items-col-adv span + span {
            @apply ml-0 sm:ml-1 md:ml-2;
        }
        .items-row {
            @apply relative flex bg-[#192536] h-[3.2rem] bg-gray-700 bg-opacity-20 text-gray-500 items-center;
            will-change: contents;
        }
        .items-col {
            @apply flex h-full flex-col justify-center border-gray-700 text-gray-500;
        }
        .items-col-adv span + span {
            @apply ml-1 md:ml-2;
        }

        .details-container {
            position: relative;
            min-height: 285px;
            width: 100%;

            background:
                linear-gradient(180deg,
                rgba(214, 214, 214, 0.06) 0%,
                rgba(217, 217, 217, 0.03) 100%);
        }
    }
</style>
