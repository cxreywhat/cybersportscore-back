<div>
    <div class="flex flex-col md:flex-row items-center p-2
    rounded-t-md border-x border-t border-gray-700 bg-[#212D3D]">

        <h3 class="text-sm font-semibold text-gray-600 grow pl-3 w-full pb-2 md:pb-0 ">
            {{-- $t('labels.matches')--}}
        </h3>

        <div class="flex flex-col md:flex-row w-full">
            @include('components.common.filterListBox')
        </div>
    </div>

    {{--@if(isMounted)--}}
    <div class="[showLoader ? 'min-h-[785px] border-l border-r border-t' : '',
        'relative overflow-hidden border-b rounded-b-md border-gray-700 shadow-xl']">

        @if(count($items) > 0)
            @foreach($items as $item)
                <div class="border-gray-700 border-x border-t justify-between">
                    @include('components.matchesIndex.matchRow', ['game' => $item])
                </div>
            @endforeach
        @endif

    </div>

    <div class="mt-5">
        @include('components.common.pagination')
    </div>
    {{--@endif--}}

</div>

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
            @apply flex h-full flex-col items-start justify-center border-gray-700 text-gray-500;
        }
        .items-col-adv span + span {
            @apply ml-1 md:ml-2;
        }

        .details-container {
            @apply relative min-h-[285px] w-full;
            background:
                linear-gradient(180deg,
                    rgba(214, 214, 214, 0.06) 0%,
                    rgba(217, 217, 217, 0.03) 100%);
        }
    }
</style>
