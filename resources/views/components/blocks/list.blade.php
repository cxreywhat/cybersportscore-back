    @if($style === 'ordered')
        <ol class="article-block-item">
            @foreach($items as $item)
                <li id="article-li-index">{!! $item !!}</li>
            @endforeach
        </ol>
    @else
        <ul class="article-block-item">
            @foreach($items as $item)
                <li id="article-li-index">{!! $item !!}</li>
            @endforeach
        </ul>
    @endif
