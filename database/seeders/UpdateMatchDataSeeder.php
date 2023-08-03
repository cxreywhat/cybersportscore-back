<?php

namespace Database\Seeders;

use App\Models\GtMatchGame;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateMatchDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = 1;
        $chunkSize = 100;
        GtMatchGame::select('gt_match_game.match_data', 'gt_match_game.id')
            ->join('gt_match_list AS l', 'gt_match_game.mid', 'l.id')
            ->where('l.game_id', 100)
            ->where('gt_match_game.match_result', 'Tiger_Main')
            ->where('gt_match_game.db_id', '>', 0)
            ->chunk($chunkSize, function ($updateMatches) use (&$page) {
                dump('Обновляемые записи, страница: ' . $page);
                foreach ($updateMatches as $match) {
                    $newMatchData = $match->match_data;
                    $newMatchData['map']['title'] = 'Taego';
                    $match->update([
                        'match_data' =>  $newMatchData
                    ]);
                    dump($match->id);
                    sleep(1);
                }
                $page++;
            });
    }
}
