<div class="flex flex-col w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D]">
    <div class="flex flex-row items-center grow w-full border-b border-gray-700 p-4 overflow-hidden">
        <h3 class="text-sm text-l font-semibold text-gray-600">
            <a href="/news" class="text-l font-bold text-[#d1d5db] pl-3 pr-1" rel="canonical">
                Статьи
            </a>
        </h3>
    </div>
    <div class="p-4 relative min-h-[200px]">
        @foreach($news->take(5) as $item)
            <a href="/ru/news/49958-luchshie-kerri-patcha-7-34-dlya-dota-2-ot-watson" class="transition text-xs font-normal
            leading-1 inline-block pb-2 text-gray-300">
                <span class="text" lang="ru">
                    {{$item->title}}
                </span>
            </a>
        @endforeach

    </div>
</div>

