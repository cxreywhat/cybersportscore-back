<div class="flex flex-col w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D]">
<div class="flex flex-row items-center grow w-full border-b border-gray-700 p-4 overflow-hidden">
    <h3 class="text-sm text-l font-semibold text-gray-600">
        <a href="/news" class="ajax-news text-l font-bold text-[#d1d5db] pl-3 pr-1"  rel="canonical" data-translate="labels.atricles">
            Статьи
        </a>
    </h3>
</div>
<div id="news-container" class="p-4 relative min-h-[200px]">
    @foreach($news->take($count) as $item)
        <a href="/news/{{$item->id}}" data-news-block="{{$item->id}}"
           class="ajax-news-block transition text-xs font-normal leading-1 inline-block pb-2 text-gray-300">
            <span class="text" lang="en">
                {{$item->title}}
            </span>
        </a>
    @endforeach

</div>
</div>

