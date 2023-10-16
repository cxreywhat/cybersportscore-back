@extends('main')

@section('content')
    <div id='homePage' class="grid grid-cols-1 md:grid-cols-5 gap-5">
        <div class="col-span-5 lg:col-span-4">
            @include('components.matchesIndex')
        </div>
        <div class="col-span-5 lg:col-span-1">
            @include("components.matchesIndex.articlesBlock")
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let lang = document.getElementById('selected-lang').value;
        Promise.all([window.loadArticlesNewsBlock(lang, 5)])
    </script>
@endsection
