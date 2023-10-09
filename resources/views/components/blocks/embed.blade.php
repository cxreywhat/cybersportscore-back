@inject('newsService', 'App\Services\NewsService')

@php
    $request = app('request');
    $item = new App\Http\Resources\NewsItemResource(
            $newsService->getNewsItem($id, (bool) $request->get('preview'))
        );
@endphp
<a href="{{ $item->source }}" class="external-post">
    <picture data-v-dcd628b6="">
        <source srcset="{{asset('/media/news/_182/'.$item->pic)}}">
        <img src="{{asset('/media/news/_182/'.$item->pic)}}" loading="lazy" alt="">
    </picture>
    <div>
        <div class="exp-title">
           {{ $item->title }}
        </div>
        <div class="exp-subtitle"></div>
    </div>
</a>
