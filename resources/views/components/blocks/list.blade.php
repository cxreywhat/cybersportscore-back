@if($block->data->style === 'ordered')
    <ol class="article-block-item">
        @foreach($items as $item)
            <li id="article-li-index">{!! $item !!}</li>
        @endforeach
    </ol>
@else
    <ul class="article-block-item">
        @if(count($block->data->items) > 0)
            @foreach($block->data->items as $item)
                <li id="article-li-index">{!! $item !!}</li>
            @endforeach
        @endif
    </ul>
@endif
