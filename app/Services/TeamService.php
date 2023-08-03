<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\GameEnum;
use App\Enums\GamesType;
use Dmp\Services\SearchServices\SearchInterface as Search;
use Dmp\Services\SearchServices\SearchService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TeamService
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
            ];

            $searchService = new SearchService($_ENV['DMP_ENV']);

            $sort = [
                [
                    'id' => [
                        'order' => 'desc'
                    ],
                ]
            ];

            $search = $searchService->query('team', $filter['search'], $searchFilters, $sort, 0, 10);

            $rows = [];

            if (isset($search['items']['team'])) {
                foreach ($search['items']['team'] as $item) {
                    $data = $item['data'];
                    $data['title'] = $data['ltitle'];

                    $rows[] = $data;
                }
            }

            $rows = collect(json_decode(json_encode($rows), FALSE));
        } else {
            $rows = DB::table('gt_teams_list')
                ->select([
                    'gt_teams_list.id',
                    'gt_teams_list.eng',
                    'gt_teams_list.title',
                    'gt_teams_list.logo',
                    'gt_teams_list.game_id',
                ])
                ->where('gt_teams_list.is_act', '1')
                ->whereIn('gt_teams_list.game_id', $games)
                ->join('esn_top_list', 'esn_top_list.id', 'gt_teams_list.id')
                ->where('esn_top_list.rid', 'team')
                ->orderByDesc('esn_top_list.kol')
                ->limit(10)
                ->get();

            if ($filter['team_eng']) {
                $team = DB::table('gt_teams_list')
                    ->select([
                        'gt_teams_list.id',
                        'gt_teams_list.eng',
                        'gt_teams_list.title',
                        'gt_teams_list.logo',
                        'gt_teams_list.game_id',
                    ])
                    ->whereIn('gt_teams_list.game_id', $games)
                    ->where('eng', $filter['team_eng'])
                    ->first();

                $rows->pop();
                $rows->push($team);
            }
        }

        return $rows;
    }
}
