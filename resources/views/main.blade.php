<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Live scores and results of all esports matches for Dota 2, League of Legends"/>
    <meta name="keywords" content="matches, results, live, online, stream, statistics, score, team, roster"/>

    <link rel="icon" type="image/svg+xml" href={{ asset('media/icons/favicon32.png') }}/>
    <link rel="stylesheet" href={{ asset('css/critical.css') }}>
    <link rel="stylesheet" href={{ asset('css/app.css') }} />
    <title>CyberSportScore.com - livescore, live results, matches, scores, streams</title>
</head>
<body>
<div id="app" class="h-full">
    <div class="h-full fixed mx-auto">
        <a rel="nofollow" class="fixed w-full h-full" target="_blank" href="https://api.cybersportscore.com/go?n=422"
           id="css01" style="background: url('https://api.cybersportscore.com/media/a/banner422.gif') 50% 0px no-repeat scroll rgb(0, 0, 0);"></a>
    </div>
    <div class="h-full relative flex flex-col max-w-6xl mx-auto px-0 lg:px-3 bg-[#1B2838]">
        @include('components.layout.navbar')

        @yield('content')

        @include('components.layout.footer')
    </div>
</div>

</body>
</html>

<script src={{ asset('js/app.js') }}></script>

