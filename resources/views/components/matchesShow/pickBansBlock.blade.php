<div class="flex flex-col w-full">
    <div class="flex flex-col sm:flex-row w-full items-center justify-center mb-3 sm:my-2">
        <div class="my-1 sm:my-0 px-5 sm:px-0 flex flex-row grow justify-center sm:justify-end w-full sm:w-[50%] order-2 sm:order-1">
            @foreach($match_beta->match_games[$num_game - 1]->match_data->teams->t1->picks as $pick)
                <span class="max-w-[50px] sm:w-11 mx-[3px] flex flex-row rounded-md overflow-hidden border border-gray-600 border-1 box-border shadow-xl hover:transform hover:scale-150 hover:z-[2] transition">
                    <img class="transform scale-110" src="https://api.cybersportscore.com/media/game/hero/{{ $match_beta->game_id }}/_59/{{ $pick->id }}.png" title="{{$pick->title}}" alt="{{$pick->title}}">
                </span>
            @endforeach
        </div>
        <div class="my-2 sm:my-0 flex flex-col text-xs text-gray-600 mx-[12px] order-1 sm:order-2">
            PICKS
        </div>
        <div class="my-1 sm:my-0 px-5 sm:px-0 flex flex-row grow justify-center sm:justify-start w-full sm:w-[50%] order-3 sm:order-3">
            @foreach($match_beta->match_games[$num_game - 1]->match_data->teams->t2->picks as $pick)
                <span class="max-w-[50px] sm:w-11 mx-[3px] flex flex-row rounded-md overflow-hidden border border-gray-600 border-1 box-border shadow-xl hover:transform hover:scale-150 hover:z-[2] transition">
                    <img class="transform scale-110" src="https://api.cybersportscore.com/media/game/hero/{{ $match_beta->game_id }}/_59/{{ $pick->id }}.png" title="{{$pick->title}}" alt="{{$pick->title}}">
                </span>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col sm:flex-row w-full items-center justify-center mb-6 sm:my-2">
        <div class="my-1 sm:my-0 px-5 sm:px-0 flex flex-row grow justify-center sm:justify-end w-full sm:w-[50%] order-2 sm:order-1">
            @foreach($match_beta->match_games[$num_game - 1]->match_data->teams->t1->bans as $ban)
                <span class="max-w-[40px] sm:w-7 mx-[3px] flex flex-row rounded-sm overflow-hidden border border-gray-600 border-1 box-border shadow-xl hover:transform hover:scale-[2] hover:z-[2] transition">
                    <img class="transform scale-110 grayscale hover:grayscale-0" src="https://api.cybersportscore.com/media/game/hero/{{ $match_beta->game_id }}/_59/{{ $ban->id }}.png" title="{{ $ban->title }}" alt="{{ $ban->title }}">
                </span>
            @endforeach
        </div>
        <div class="my-2 sm:my-0 flex flex-col text-xs text-gray-600 mx-[12px] order-1 sm:order-2">
            BANS
        </div>
        <div class="my-1 sm:my-0 px-5 sm:px-0 flex flex-row grow justify-center sm:justify-start w-full sm:w-[50%] order-3 sm:order-3">
            @foreach($match_beta->match_games[$num_game - 1]->match_data->teams->t2->bans as $ban)
                <span class="max-w-[40px] sm:w-7 mx-[3px] flex flex-row rounded-sm overflow-hidden border border-gray-600 border-1 box-border shadow-xl hover:transform hover:scale-[2] hover:z-[2] transition">
                    <img class="transform scale-110 grayscale hover:grayscale-0" src="https://api.cybersportscore.com/media/game/hero/{{ $match_beta->game_id }}/_59/{{ $ban->id }}.png" title="{{ $ban->title }}" alt="{{ $ban->title }}">
                </span>
            @endforeach
        </div>
    </div>
</div>

