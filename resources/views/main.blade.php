<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Live scores and results of all esports matches for Dota 2, League of Legends"/>
    <meta name="keywords" content="matches, results, live, online, stream, statistics, score, team, roster"/>

    <link rel="icon" type="image/svg+xml" href={{ asset('media/icons/favicon32.png') }}/>
    <link rel="stylesheet" href={{ asset('css/app.css') }} />
    <title>CyberSportScore.com - livescore, live results, matches, scores, streams</title>

</head>
<body>
    <div class="h-full relative flex flex-col max-w-6xl mx-auto px-0 lg:px-3 bg-[#1B2838]">
        @include('home')
    </div>
</body>
</html>

<script src={{ asset('js/app.js') }}></script>

