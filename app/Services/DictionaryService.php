<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\GameEnum;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DictionaryService
{
    public function getHeroes(string $gameEng): \Countable
    {
        return Cache::remember(
            "dictionary-hero-$gameEng",
            60 * 60,
            fn () => DB::table('gt_hero_' . GameEnum::fromEng($gameEng)->value)
                ->select(['id', 'title'])
                ->get()
        );
    }
}
