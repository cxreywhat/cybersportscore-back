@php
    $jsonData = file_get_contents("json/dota-2-maps.json");
    $buildings = json_decode($jsonData);
@endphp

<div class="relative transition">
    <div class="pb-[100%] w-full h-full opacity-70 "
         style="
             background-image: url('/media/maps/dota-2.png');
             background-size: cover;">
    </div>
    @if($match->getDuration() > 0)
        @foreach($buildings as $building)
            <div id="{{$building->id}}"
                 class="{{in_array($building->id, $match->getAggregatedEvents()->getDestroyedBuildings())
                    ? "destroyed-side-map"
                    : ($building->side == "t1" ? "green-side-map" : "red-side-map")}}
                 absolute shadow-sm transition"
                 style="
                    width:{{ $building->style->size ?? ' 7%' }};
                    height:{{ $building->style->size ?? ' 7%' }};
                    transform:{{ isset($building->style->transform) ? $building->style->transform . ' translate(-50%,-50%)' : 'translate(-50%,-50%)' }};
                    border-radius:{{ $building->type == 'tower' || $building->type == 'fort' ? ' 50%' : ' 0' }};
                    left:{{ $building->style->left ?? ' 0%' }};
                    top:{{ $building->style->top ?? ' 0%' }}">
            </div>
        @endforeach
    @endif
</div>
