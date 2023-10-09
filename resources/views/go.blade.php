<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5; URL={{$url}}"/>
    <title>@lang('go.title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            background-color: rgb(31 41 55);
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }

        .container {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            overflow-wrap: break-word;
            flex-direction: column;
            max-width: 72rem;
        }

        .icon {
            width: 1.5rem;
            height: 1.5rem;
            color: rgb(240 82 82);
            vertical-align: middle;
        }

        .title {
            text-align: center;
            font-size: 1.5rem;
            line-height: 2rem;
            font-weight: 500;
            color: white;
            margin: 0;
        }

        .link-container {
            word-break: break-word;
            max-width: 42rem;
            text-align: center;
            margin-top: calc(0.5rem * calc(1 - 0));
            margin-bottom: calc(0.5rem * 0);
        }

        .link {
            color: rgb(28 100 242);
            font-weight: 500;
            font-size: 1rem;
            line-height: 1.5rem;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .back-text {
            font-weight: 400;
            color: white;
            font-size: 1rem;
            text-align: center;
            margin: 5px 0;
        }

        .site {
            color: rgb(152 170 40);
        }

        .redirect-btn {
            color: white;
            padding: 0.5rem 0.5rem 0.5rem 0.9rem;
            background-color: rgb(88 80 236);
            border-color: transparent;
            border-width: 1px;
            border-radius: 0.375rem;
            justify-content: center;
            align-items: center;
            display: flex;
            margin-top: 0.75rem;
            cursor: pointer;
            position: relative;
            text-decoration: none;
        }

        .btn-text {
            font-size: 1rem;
            font-weight: bold;
            margin-right: 5px;
        }
    </style>
</head>
<body>
<main aria-labelledby="pageTitle" class="container">
    <h1 id="pageTitle" class="title">
        <svg aria-hidden="true" class="icon w-6 h-6 text-red-500 dark:text-apple" xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <span class="text-xl font-medium text-gray-600 sm:text-2xl dark:text-gray-400">
                @lang('go.you_go_from') <span class="site">cybersportscore.com</span> @lang('go.to_another_site')
              </span>
    </h1>
    <p class="link-container">
        <a class="link" href="{{$url}}">{{$url}}</a>
    </p>
    <p class="back-text">
        @lang('go.you_can_stay') <a href="https://cybersportscore.com/" class="link">@lang('go.back')</a>
    </p>
    <span class="back-text">@lang('go.or')</span>
    <div class="redirect-btn-container">
        <a href="{{$url}}" class="redirect-btn">
            <span class="btn-text">@lang('go.let_me_go')</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                 stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"/>
                <path d="M7 12h14l-3 -3m0 6l3 -3"/>
            </svg>
        </a>
    </div>
</main>
</body>
</html>
