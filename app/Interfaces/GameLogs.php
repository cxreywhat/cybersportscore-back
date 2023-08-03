<?php
namespace App\Interfaces;

use App\Models\GtMatchList;

interface GameLogs
{
    public function getLogs(GtMatchList $match, int $num): array;
}
