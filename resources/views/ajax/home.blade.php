<div class="grid grid-cols-1 md:grid-cols-5 gap-5">
    <div class="col-span-5 lg:col-span-4">
        @include('components.matchesIndex')
    </div>
    <div class="col-span-5 lg:col-span-1">
        @include("components.matchesIndex.articlesBlock", ['count' => 5])
    </div>
</div>
