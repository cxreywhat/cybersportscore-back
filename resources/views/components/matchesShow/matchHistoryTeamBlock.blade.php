@foreach($data as $item)
    @php
        $team1Score = $item->getTeams()[0]->score;
        $team2Score = $item->getTeams()[1]->score;
        $shortTitleTeam2 = $item->getTeams()[1]->shortTitle;
        $date = (new DateTime($item->getDate()))->format('Y-m-d');
    @endphp
    <div class="flex border-b border-gray-700 hover:bg-gray-800 py-1">
        <div class="flex justify-center items-center px-1 w-14">
            @if($team1Score > $team2Score)
                <div class="text-xs font-bold text-apple">
                    {{$team1Score}}-{{$team2Score}}
                </div>
            @elseif($team1Score === $team2Score)
                <div class="text-xs font-bold text-white">
                    {{$team1Score}}-{{$team2Score}}
                </div>
            @else
                <div class="text-xs font-bold text-red-500">
                    {{$team1Score}}-{{$team2Score}}
                </div>
            @endif
        </div>
        <div class="flex grow py-1 gap-2 relative">
            <div class="flex grow flex-1 content-center md:items-center gap-1 md:gap-3 flex-row">
                <span class="px-2 w-14">
                    <img src="{{$item->getTeams()[1]->hasLogo ? asset('/media/logo/_30/t'.$item->getTeams()[1]->id.'.webp') : asset('media/icons/no-icon.svg')}}"
                         alt="{{$item->getTeams()[1]->title}} icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
                </span>
                <span class="text-gray-300 text-[12px]">{{$shortTitleTeam2}}</span>
            </div>
        </div>
        <div class="flex items-center w-[140px] justify-end gap-3 pr-3">
            <div class="text-white text-[12px] w-[80px] text-[#6B7280] leading-4 pr-1">
                {{ $date }}
            </div>
            <span class="px-1">
                <img src="{{ $item->getLogo() ? asset('/media/event/_120/e'.$item->getLogo().'.webp') : asset('media/icons/no-icon.svg')}}"
                     title="{{$item->getTournamentTitle()}}" alt="{{$item->getTournamentTitle()}} icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </span>
        </div>
    </div>
@endforeach
