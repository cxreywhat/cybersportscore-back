<div class="flex items-center justify-center text-gray-600 relative w-full h-full ">
    @if(count($match->getGold()) <= 0)
        <span class="absolute" data-translate="state.no_data">Данные отсутствуют</span>
    @endif
    <canvas id='myChart' class="h-full w-full"
        data-events="{{ json_encode($match->getEvents()) }}"
        data-gold="{{ json_encode($match->getGold()) }}"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
