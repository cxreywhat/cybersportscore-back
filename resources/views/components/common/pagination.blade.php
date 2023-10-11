@php
    $currentPage = request()->query('page');
@endphp

<div id="pagination" class="flex flex-row w-full overflow-x-auto pb-3 px-2 sm:px-0 ">
    @for($i = 1; $i <= $pages->lastPage(); $i++)
    <button class="page-button {{$pages->currentPage() == $i ? 'bg-gray-700 font-semibold text-gray-200 pointer-events-none cursor-default ' : 'text-gray-500 ' }}
        text-xs flex rounded-3xl px-3 py-2 mr-1 enabled:hover:bg-apple enabled:hover:text-white" data-page="{{$i}}">{{ $i }}</button>
    @endfor
</div>
