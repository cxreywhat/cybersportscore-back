<?php
namespace App\Interfaces;

interface GameEvents {
    public function firstDestroyedTower(array $events): ?string;
    public function firstKilledEliteCreep(array $events): ?string;
    public function firstTenKills(array $events): ?string;
    public function firstBlood(array $events);
}
