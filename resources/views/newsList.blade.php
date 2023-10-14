@extends('main')

@section('content')
<div class="max-w-6xl bg-gray-800" style="margin: 0 auto; min-height: 100vh;">
    <div class="grid grid-cols-1 md:grid-cols-6 gap-4 px-3 py-2 max-w-6xl" style="margin: 0px auto;">
        <div class="col-span-2 md:col-span-4">
            <div class="flex flex-col w-full border border-gray-700 rounded-lg relative">
                <div class="flex flex-col md:flex-row items-center p-3 border-b border-gray-700">
                    <h1 class="text-l font-bold text-white grow pl-1 w-full md:pb-0" data-translate="labels.news">
                        Новости
                    </h1>
                </div>
                <div id="loader-news" class='border-l border-r border-t relative overflow-hidden border-b rounded-b-md border-gray-700 shadow-xl' style="display: none; min-height: 650px">
                    @include('components.common.loader')
                </div>
                <div id="news-container" class="p-4">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        let lang = document.getElementById('selected-lang').value;
        window.loadArticlesNewsBlock(lang, 15, true)
    </script>
@endsection
