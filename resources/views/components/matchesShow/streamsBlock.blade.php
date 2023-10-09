<div class="flex flex-row border-b w-full h-[65px] self-start overflow-x-auto  shadow-md relative">
    @foreach($streams as $index => $stream)
        <button data-index="{{ $index }}" title="{{ $stream->status }}"
                 class="hover:bg-gray-700 hover:border-b-gray-900 flex flex-row min-w-[252px] w-[252px] text-gray-200 border-b-[5px] group box-content stream-button">
            <img class="w-[65px] h-full transition opacity-80 group-hover:opacity-100" src="{{asset('/media/streams/_50/s'.$stream->id.'.png')}}">
            <div class="p-3 basis-full h-full truncate text-xs flex-col text-left font-semibold">
                {{ $stream->status != "" ? $stream->status : $stream->title }}
                <div class="text-gray-500 text-[10px] pt-1" >
                    {{ $stream->viewers }}
                    <span data-translate="state.viewers_online"> зрителей онлайн</span>
                </div>
            </div>
        </button>
    @endforeach
</div>
<button id='startStream' data-count-streams="{{count($streams)}}" class="w-full h-[200px] sm:h-[310px] flex items-center justify-center opacity-90 hover:opacity-100 transition group">
    @if(count($streams) > 0)
        <span id="videoContainer" class="w-full h-[200px] sm:h-[310px] flex items-center justify-center relative transition bg-gray-800" style="display: none;">
            <iframe id="player"
                        class="bg-gray-800 "
                        loading="lazy"
                        height="310px"
                        width="550px"
                        allow="fullscreen"
                        title="Twitch"
                        sandbox="allow-modals allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
            >
            </iframe>
        </span>
            <span id="playButton" class="absolute w-[80px] h-[80px] bg-gray-900 group-hover:bg-apple transition rounded rounded-3xl bg-opacity-70 pl-2 pt-1">
                <svg id="icon_play" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                    <path fill="white" d="M22.447 14.105l-14-7A1 1 0 0 0 7 8v14a.999.999 0 0 0 1.447.894l14-7a1 1 0 0 0 0-1.789"></path>
                </svg>
            </span>
        <span id='static-image' class="w-full h-full" data-streams="{{json_encode($streams)}}" data-streams-count="{{ count($streams) }}"></span>
    @endif
</button>
@if(request()->is('/'.$match_id))
<script>
    const playStream = document.getElementById('startStream');
    const countStreams = playStream.getAttribute('data-count-streams');

    let videoContainer = null;
    let playButton = null;
    let staticImage = null;
    let streams = null;
    let videoPlayer = null;

    if(countStreams > 0) {
        videoContainer = document.getElementById('videoContainer');
        playButton = document.getElementById('playButton');
        staticImage = document.getElementById('static-image');
        streams =  JSON.parse(staticImage.getAttribute('data-streams'));
        videoPlayer = document.getElementById('player');
    }


    const buttons = document.querySelectorAll('.stream-button');
    const host = window.location.hostname;

    getCurrentStream(0, buttons[0]);

    buttons.forEach(function(button, index) {
        button.classList.add('border-b-gray-900');
        button.addEventListener('click', function () {

            buttons.forEach(function(btn) {
                btn.classList.remove('border-b-apple', 'bg-gray-700');
            });

            getCurrentStream(index, button)
        });
    });

    function getCurrentStream(index, button) {
        if(countStreams > 0) {
            const iframeUrl = `https://player.twitch.tv/?channel=${streams[index].eng}&parent=${host}&autoplay=false`;
            const imageUrl = `${countStreams > 0 ? streams[index].picture_url : ''}`;

            staticImage.style.backgroundImage = `url('${imageUrl}')`;
            videoPlayer.src = iframeUrl;

            button.classList.add('border-b-apple', 'bg-gray-700');
        }
    }

    if(countStreams > 0) {
        playButton.addEventListener('click', function () {
            videoContainer.style.display = 'block';

            videoPlayer.src = videoPlayer.src.replace('autoplay=false', 'autoplay=true');

            playButton.style.display = 'none';
        });
    }
</script>
@endif

