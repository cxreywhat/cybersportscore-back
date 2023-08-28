@extends('main')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-5 gap-5">
{{--        @php
            dd($items);
        @endphp--}}
        <div class="col-span-5 lg:col-span-4">
            @include('components.matchesIndex')
        </div>
        <div class="col-span-5 lg:col-span-1">
            @include("components.matchesIndex.articlesBlock", ['news' => $news, 'count' => 5])
        </div>
    </div>
@endsection
<style lang="css">

</style>
