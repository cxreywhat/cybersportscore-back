<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\EsnNews;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Eloquent\Builder;

class NewsService
{
    const NEWS_SITE = 'css';

    private function getBasicQuery(): Builder
    {
        return EsnNews::query();
//            ->join('esn_news_out', function (JoinClause $query) {
//                return $query->on('esn_news_out.news_id', '=', 'esn_news.id')
//                    ->where('esn_news_out.site', static::NEWS_SITE);
//            });

    }

    public function getNewsItem(int $id, bool $preview = false): EsnNews
    {
        return $this->getBasicQuery()
            ->select(['id', 'title', 'blocks', 'info', 'pic', 'pic_in', 'lang', 'data'])
            ->where('esn_news.id', $id)
            ->when(!$preview, function ($query) {
                return $query->where('is_act', '1')
                    ->where('esn_news.date', '<=', Carbon::now());
            })
            ->firstOrFail();
    }

    public function getNewsList(array $filter = []): Paginator
    {
        $filter['lang'] = $filter['lang'] ?? 'en';

        return $this->getBasicQuery()
            ->when($filter['lang'], function ($query, $lang) {
                return $query->where('lang', $lang);
            })
            ->select(['id', 'eng', 'title', 'date'])
            ->where('is_act',  '1')
            ->where('esn_news.date', '<=', Carbon::now())
            ->orderBy('date', 'desc')
            ->paginate($filter['per_page']);
    }
}
