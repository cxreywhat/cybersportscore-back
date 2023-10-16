@foreach($news as $item)
    <a href="/news/{{$item->id}}" data-news-block="{{$item->id}}"
       class="ajax-news-block text-xs font-normal leading-1 {{ \Aws\boolean_value($isNewsPage)  ? 'flex items-center p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100' : 'transition inline-block pb-2 text-gray-300' }}">
        <span class="text" lang="en">
            {{$item->title}}
        </span>
    </a>
@endforeach
