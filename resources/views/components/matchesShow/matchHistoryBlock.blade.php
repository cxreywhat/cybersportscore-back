<div class="flex flex-row p-2 rounded-t-lg border-x border-t justify-between items-center border-gray-700">
    <h3 class="text-l font-bold text-[#d1d5db] pl-3 pr-1">
        Последние матчи
    </h3>
</div>
<div class="hidden sm:hidden md:grid border border-gray-700 grid-cols-1 rounded-b-lg md:grid-cols-6 relative">
    <div class="col-span-1 md:col-span-2 border-r border-gray-700 relative">
        <div class="flex justify-center pl-[2.4rem] border-b border-gray-700 bg-gray-700 bg-opacity-40">
            <div class="flex w-28 items-center flex-row-reverse items-center">
                <div class="flex items-center">
                    <span class="px-4">
                        <img src="https://api.cybersportscore.com/media/logo/_30/t{{ $history->matchTitle->team1->logo }}.webp" alt="undefined icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                    </span>
                </div>
                <p class="text-gray-300 text-[12px] leading-4">
                    {{ $history->matchTitle->team1->shortTitle }}
                </p>
            </div>
            <div class="flex justify-center items-center border-x border-gray-700 w-14 md:h-10">
                <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-gray-600 border-1 border w-[28px] h-[28px] border-apple text-apple">
                    VS
                </div>
            </div>
            <div class="flex w-28 items-center">
                <span class="px-4"><img src="https://api.cybersportscore.com/media/logo/_30/t{{ $history->matchTitle->team2->logo }}.webp" alt="undefined icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy"></span>
                <p class="text-gray-300 text-[12px] leading-4">
                    {{ $history->matchTitle->team2->shortTitle }}
                </p>
            </div>
        </div>
        <div class="overflow-y-scroll h-[15.3rem]">
            @foreach($history->commonBlock as $common)
                @php
                    $team1Score = $common->getTeams()[0]->score;
                    $team2Score = $common->getTeams()[1]->score;
                    $date = (new DateTime($common->getDate()))->format('Y-m-d');
                @endphp
                <div class="flex border-b justify-between border-gray-700 hover:bg-gray-800">
                    <div class="flex w-24 items-center pl-4">
                        <div class="flex flex-col">
                            <div class="text-[12px] text-[#6B7280] leading-none">
                                {{ $date }}
                            </div>
                        </div>
                    </div>
                    <div class="flex m-auto justify-center">
                        @if ($team1Score > $team2Score)
                            <div class="text-xs flex pr-4 w-14 items-center">
                                <div class="text-[#98AA28]">WIN</div>
                            </div>
                        @else
                            <div class="flex text-xs text-bold pr-4 w-14 items-center">
                                <div class="text-[#EB5757]">LOSS</div>
                            </div>
                        @endif
                        <div class="flex justify-center items-center border-x border-gray-700 w-14 h-10">
                            <div class="text-xs text-gray-300 font-bold">
                                {{ $team1Score }}-{{ $team2Score }}
                            </div>
                        </div>
                            @if ($team1Score > $team2Score)
                                <div class="flex text-xs text-bold pl-4 w-14 items-center">
                                    <div class="text-[#EB5757]">LOSS</div>
                                </div>
                            @else
                                <div class="text-xs flex pl-4 w-14 items-center">
                                    <div class="text-[#98AA28]">WIN</div>
                                </div>
                            @endif
                    </div>
                    <div class="flex w-14 items-center">
                        <span class="mx-4">
                            <img src="{{ $common->getLogo() ? "https://api.cybersportscore.com/media/event/_120/e".$common->getLogo().".webp" : asset('media/icons/no-icon.svg')}}"
                                 title="Phoenix League" alt="Phoenix League icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-span-1 md:col-span-2 border-r border-gray-700 relative">
        <div class="flex items-center bg-gray-700 bg-opacity-40 border-b border-gray-700 py-2">
            <span class="px-4">
                <img src="https://api.cybersportscore.com/media/logo/_30/t{{ $history->matchTitle->team1->logo }}.webp"
                     alt="undefined icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy"></span><span class="text-gray-300 text-[12px]">
                {{ $history->matchTitle->team1->shortTitle }}
            </span>
        </div>
        <div class="overflow-y-scroll h-[15.3rem]">
            @include('components.matchesShow.matchHistoryTeamBlock', ['data' => $history->team1Block])
        </div>
    </div>

    <div class="col-span-1 md:col-span-2 relative">
        <div class="flex items-center border-b border-gray-700 bg-gray-700 bg-opacity-40 py-2">
            <span class="px-4">
                <img src="https://api.cybersportscore.com/media/logo/_30/t{{ $history->matchTitle->team2->logo }}.webp"
                     alt="undefined icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </span>
            <span class="text-gray-300 text-[12px]">{{ $history->matchTitle->team2->shortTitle }}</span>
        </div>
        <div class="overflow-y-scroll h-[15.3rem] relative">
            @include('components.matchesShow.matchHistoryTeamBlock', ['data' => $history->team2Block])
        </div>
    </div>

</div>
