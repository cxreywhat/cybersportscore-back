<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta name="referrer" content="strict-origin-when-cross-origin">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Live scores and results of all esports matches for Dota 2, League of Legends"/>
        <meta name="keywords" content="matches, results, live, online, stream, statistics, score, team, roster"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/svg+xml" href='https://cybersportscore.com/media/icons/favicon32.png'/>
        <link rel="stylesheet" href={{ asset('css/critical.css') }}>
        <link rel="stylesheet" href={{ asset('css/app.css') }} />
        <link rel="stylesheet" href={{ asset('css/style.css') }} />
        <title data-translate="meta.index.title.default">CyberSportScore.com - livescore, live results, matches, scores, streams</title>
    </head>
    <body>
        <div id="app" class="h-full">
<!--            <div class="h-full fixed mx-auto">
                <a rel="/" class="fixed w-full h-full" target="_blank"
                   id="css01" style="background: url('/media/a/banner247.gif') 50% 0 no-repeat scroll rgb(0, 0, 0);"></a>
            </div>-->
            <div class="h-auto relative flex flex-col max-w-6xl mx-auto px-0 lg:px-3 bg-[#1B2838]">
                @include('components.layout.navbar')

                <div id="loader-content" class='min-h-[785px] border-l border-r border-t relative overflow-hidden border-b rounded-b-md border-gray-700 shadow-xl' style="display: block">
                    @include('components.common.loader')
                </div>

                <div id="content-container" class="hidden">
                    @yield('content')
                </div>

                @include('components.layout.footer')
            </div>
        </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src={{ asset('js/app.js') }}></script>
<script src='{{asset('js/helpers/loadAjax.js')}}'></script>
<script src="{{ asset('js/translate.js') }}"></script>
@if (Request::path() === '/' || preg_match('/\/\?page=\d+/', Request::fullUrl()))
    <script src="{{ asset('js/components/filterListBox.js') }}"></script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loader = document.getElementById('loader-content');
        const contentContainer = document.getElementById('content-container');

        loader.style.display = 'none';
        contentContainer.style.display = 'block';
    });
</script>
@yield('scripts')
