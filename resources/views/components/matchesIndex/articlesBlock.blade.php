<div class="flex flex-col w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D]">
    <div class="flex flex-row items-center grow w-full border-b border-gray-700 p-4 overflow-hidden">
        <h3 class="text-sm text-l font-semibold text-gray-600">
            <a id='news-blog' href="{{ $lang == 'en' ? '' : $lang  }}/blog" class="ajax-news text-l font-bold text-[#d1d5db] pl-3 pr-1"  rel="canonical" data-translate="labels.atricles">
                Статьи
            </a>
        </h3>
    </div>
    <div id="loader-news" class='border-l border-r border-t relative overflow-hidden border-b rounded-b-md border-gray-700 shadow-xl' style="display: none; min-height: 250px">
        @include('components.common.loader')
    </div>
    <div id="news-container" class="p-4 relative min-h-[200px]">
        @include('components.matchesIndex.articles')
    </div>
</div>

