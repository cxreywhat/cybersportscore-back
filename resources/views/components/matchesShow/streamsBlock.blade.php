<div class="flex flex-row border-b border-gray-700 w-full h-[65px] self-start overflow-x-auto shadow shadow-md relative">
    @foreach($streams as $index => $stream)
        <button data-index="{{$index}}" title=" {{ $stream->status != "" ? $stream->status : $stream->title }}" class="border-b border-b-apple bg-gray-700 cursor-default flex flex-row min-w-[252px] w-[252px] text-gray-200 border-b border-b-[5px] group box-content">
            <img class="w-[65px] h-full transition opacity-80 group-hover:opacity-100" src="https://api.cybersportscore.com/media/streams/_50/s{{$stream->id}}.png">
            <div class="p-3 basis-full h-full truncate text-xs flex-col text-left font-semibold">
                {{ $stream->status != "" ? $stream->status : $stream->title }}
                <div class="text-gray-500 text-[10px] pt-1">{{ $stream->viewers }} зрителей онлайн</div>
            </div>
        </button>
    @endforeach
</div>
{{--<button class="w-full h-[200px] sm:h-[310px] flex items-center justify-center opacity-90 hover:opacity-100 transition group">--}}
{{--    <div class="absolute w-[80px] h-[80px] bg-gray-900 group-hover:bg-apple transition rounded rounded-3xl bg-opacity-70 pl-2 pt-1">--}}
{{--        <svg id="icon_play" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">--}}
{{--            <path fill="white" d="M22.447 14.105l-14-7A1 1 0 0 0 7 8v14a.999.999 0 0 0 1.447.894l14-7a1 1 0 0 0 0-1.789"></path>--}}
{{--        </svg>--}}
{{--    </div>--}}
{{--    <div class="w-full h-full" style="background-image: url({{$stream->logo_url}});background-size: cover;"></div>--}}
{{--</button>--}}

{{--@if(/*$playMode*/ true)--}}
{{--    <div class="w-full h-[200px] h-[200px] sm:h-[310px]--}}
{{--        flex items-center justify-center relative--}}
{{--        transition bg-gray-800">--}}
{{--        <iframe id="player"--}}
{{--                ref="streamRef"--}}
{{--                site="streams[activeStreamIndex].site"--}}
{{--                title="streams[activeStreamIndex].title"--}}
{{--                src="streams[activeStreamIndex].iframe_src"--}}
{{--                class="bg-gray-800"--}}
{{--                loading="lazy"--}}
{{--                width="100%"--}}
{{--                height="100%"--}}
{{--                allow="fullscreen"--}}
{{--                title="Twitch"--}}
{{--                sandbox="allow-modals allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox allow-storage-access-by-user-activation"--}}
{{--                >--}}
{{--        </iframe>--}}
{{--        <Loader v-if="loadingStage" :backgroundClass="'bg-gray-900'"/>--}}
{{--    </div>--}}
{{--@elseif($streams && count($streams) > 0)--}}
{{--    <button class="w-full h-[200px] sm:h-[310px] flex items-center justify-center opacity-90 hover:opacity-100 transition group">--}}
{{--        <div class="absolute w-[80px] h-[80px] bg-gray-900 group-hover:bg-apple transition  rounded-3xl bg-opacity-70 pl-2 pt-1">--}}
{{--            <svg  id="icon_play" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path fill="white" d="M22.447 14.105l-14-7A1 1 0 0 0 7 8v14a.999.999 0 0 0 1.447.894l14-7a1 1 0 0 0 0-1.789"></path>--}}
{{--            </svg>--}}
{{--        </div>--}}

{{--        @if(/*$activeStreamId && $streams[$activeStreamIndex]->picture_url*/ true)--}}
{{--            <div class="w-full h-full"--}}
{{--                 style="background-image: url('{{ $streams[$activeStreamIndex]->picture_url }}'); background-size: cover;">--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </button>--}}
{{--@else--}}
{{--    <div class="flex h-[200px] sm:h-[310px] items-center--}}
{{--        justify-center text-gray-600 text-xl text-center relative">--}}

{{--        <div class="w-full h-full bg-cover opacity-50"--}}
{{--             style="background-image: url('{{ $basicURL }}media/bgs/no_streams.svg');">--}}
{{--        </div>--}}

{{--        <div class="absolute">{{ $t('state.no_streams') }}</div>--}}
{{--    </div>--}}
{{--@endif--}}


