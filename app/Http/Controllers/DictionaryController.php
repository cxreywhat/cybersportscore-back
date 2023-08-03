<?php

namespace App\Http\Controllers;

use App\Services\DictionaryService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class DictionaryController extends Controller
{
    public function heroes(Request $request, string $eng, DictionaryService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->getHeroes($eng)
        ]);
    }
}
