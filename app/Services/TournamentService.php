<?php

declare(strict_types=1);

namespace App\Services;

use Dmp\Services\SearchServices\SearchInterface as Search;
use Dmp\Services\SearchServices\SearchService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TournamentService
{
    public function getFilterItems(Search $search, array $filter = []): Collection
    {
        $games = config('app.games');

        if ($filter['game_id']) {
            $games = array_intersect($games, [$filter['game_id']]);
        }

        if ($filter['search']) {
            $searchFilters = [
                'game_id' => array_values($games ?? config('app.games')),
               /* 'is_current' => ['1', '2']*/
            ];

            $searchService = new SearchService($_ENV['DMP_ENV']);

            $sort = [
                [
                    'name.keyword' => [
                        'order' => 'desc'
                    ],
                    /*'esn_top' => [
                        'order' => 'desc'
                    ],*/
                    'id' => [
                        'order' => 'desc'
                    ],
                ]
            ];

            $search = $searchService->query('event', $filter['search'], $searchFilters, $sort, 0, 10);

            $rows = [];

            if (isset($search['items']['event'])) {
                foreach ($search['items']['event'] as $item) {
                    $data = $item['data'];
                    $data['logo'] = isset($data['icon']) ?: '';
                    $data['title'] = $data['name'];
                    $data['eng'] = isset($data['icon']) ?: '';
                    $rows[] = $data;
                }
            }
            $rows = collect(json_decode(json_encode($rows), FALSE));
        } else {
            $rows = DB::table('gt_tournaments')
                ->select([
                    'gt_tournaments.id',
                    'gt_tournaments.eng',
                    'gt_tournaments.title',
                    'gt_tournaments.logo',
                    'gt_tournaments.game_id',
                ])
                ->whereIn('gt_tournaments.game_id', $games)
                ->join('esn_top_list', 'esn_top_list.id', 'gt_tournaments.id')
                ->where('esn_top_list.rid', 'event')
                ->orderByDesc('esn_top_list.kol')
                ->limit(10)
                ->get();
            if ($filter['event_eng']) {
                $event = DB::table('gt_tournaments')
                    ->select([
                        'gt_tournaments.id',
                        'gt_tournaments.eng',
                        'gt_tournaments.title',
                        'gt_tournaments.logo',
                        'gt_tournaments.game_id',
                    ])
                    ->whereIn('gt_tournaments.game_id', $games)
                    ->where('eng', $filter['event_eng'])
                    ->first();

                $rows->pop();
                $rows->push($event);
            }
        }
        return $rows;
    }
}
