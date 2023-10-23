<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        $language = $request->language;

        if(in_array($language, ['dota-2', 'lol']) || empty($language)) {
            $language = 'en';
        }

        if (!in_array($language, ['ru', 'zh', 'uk', 'en'])) {
            abort(404);
        }

        $request->language = $language;
        return $next($request);
    }
}
