
<div class="flex flex-row items-center grow text-gray-300 order-1 sm:order-2 w-full border-gray-700 py-5 px-1 col-span-12 sm:col-span-7 relative">
    <div id="events" class="w-full overflow-y-auto text-sm overflow-x-hidden" style="max-height: 232px; max-width: 318px;">
        @if($match->getWinner())
            <div class=" flex flex-row border-b border-dashed border-gray-700 mb-2">
                <div class="flex flex-col items-end text-xs min-w-[50px] justify-start text-right text-gray-600 pr-3">
                    <span>{{ sprintf('%02d:%02d', floor( $match->getDuration() / 60), $match->getDuration() % 60)  }}</span>
                </div>
                <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs font-semibold">
                    <div class="mb-2">
                        <span data-translate="events.winner"> Игра завершилась победой </span>
                        <span class="{{  $match->getWinner()== 't1' ? 'green-side' : 'red-side' }} font-semibold mb-2">
                            <span>
                                {{ $match->getWinner() == 't1' ? $match->getTeam1()->getShortTitle() : $match->getTeam2()->getShortTitle() }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        @endif
        @foreach(array_reverse($match->getEvents()) as $event)
            <div class="flex flex-row border-b border-dashed border-gray-700 mb-2">
                <div class="flex flex-col items-end text-xs min-w-[50px] justify-start text-right text-gray-600 pr-3">
                    <span>{{ sprintf('%02d:%02d', floor( $event->duration / 60),  $event->duration % 60)  }}</span>
                </div>
                @if(property_exists($event, 'fights'))
                    <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs">
                        @if($event->getTeam1Gold() > 0)
                            <div class="mb-2">
                                <span class="green-side font-semibold mb-2">
                                    <span>
                                        {{$match->getTeam1()->getShortTitle()}}
                                    </span>
                                </span>
                                <span data-translate="events.team_get"> получают </span>
                                <span class="font-bold text-yellow-400 whitespace-nowrap">
                                    <img class="inline h-4" src="https://cybersportscore.com/media/icons/events/gold.png" alt="gold">
                                    {{ $event->getTeam1Gold() }}
                                </span>
                            </div>
                        @endif
                        @if($event->getTeam2Gold() > 0)
                            <div class="mb-2">
                                <span class="red-side font-semibold mb-2">
                                    <span>
                                        {{$match->getTeam2()->getShortTitle()}}
                                    </span>
                                </span>
                                <span data-translate="events.team_get"> получают </span>
                                <span class="font-bold text-yellow-400 whitespace-nowrap">
                                    <img class="inline h-4" src="https://cybersportscore.com/media/icons/events/gold.png" alt="gold">
                                    {{ $event->getTeam2Gold() }}
                                </span>
                            </div>
                        @endif
                        @foreach($event->getFights() as $fight)
                            <div class="mb-2">
                                <span class="{{ $fight->side == "t1" ? 'green-side' :  'red-side' }} font-semibold mb-2">
                                    <span class="whitespace-nowrap">
                                        @if(property_exists($fight, 'killers'))
                                            @foreach($fight->getKillers() as $key => $killerId)
                                                @foreach($heroes as $hero)
                                                    @if($hero->id == $killerId)
                                                        {{ $key == array_key_last($fight->getKillers()) ? $hero->title : $hero->title.", " }}
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @elseif(property_exists($fight, 'killer'))
                                            @foreach($heroes as $hero)
                                                @if($hero->id == $fight->getKiller())
                                                    {{ $hero->title}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </span>
                                <span data-translate="events.killed"> убивает </span>
                                <span class="{{ $fight->side == "t1" ? 'red-side' :  'green-side'  }} font-semibold mb-2">
                                    <span class="whitespace-nowrap">
                                        @if(property_exists($fight, 'victims'))
                                            @foreach($fight->getVictims() as $key => $victimId)
                                                @foreach($heroes as $hero)
                                                    @if($hero->id == $victimId)
                                                        {{ $key == array_key_last($fight->getVictims()) ? $hero->title : $hero->title.", " }}
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @elseif(property_exists($fight, 'victim'))
                                            @foreach($heroes as $hero)
                                                @if($hero->id == $fight->getVictim())
                                                    {{ $hero->title}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if(property_exists($event, 'buildings'))
                    <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs">
                        <div class="mb-2">
                            <span class="{{ $event->side == 't1' ? 'green-side' : 'red-side' }} font-semibold mb-2">
                                <span>
                                    {{ $event->side == 't1' ? $match->getTeam1()->getShortTitle() : $match->getTeam2()->getShortTitle() }}
                                </span>
                            </span>
                            <span data-translate="events.team_destroyed"> уничтожают </span>
                            @foreach($event->getBuildings() as $building)
                                <span class="font-bold"> {{$building}}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($event instanceof App\Dto\MatchDetails\Events\RoshanKillEventDto)
                    <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs">
                        <div class="mb-2">
                            <span class="{{ $event->side == 't1' ? 'green-side' : 'red-side' }} font-semibold mb-2">
                                <span>
                                    {{ $event->side == 't1' ? $match->getTeam1()->getShortTitle() : $match->getTeam2()->getShortTitle() }}
                                </span>
                            </span>
                            <span data-translate="events.team_picked_up"> подбирают </span>
                            <span class="font-bold">
                                <img class="inline h-5" src="https://cybersportscore.com/media/icons/events/aegis.png" alt="Аэгис">
                                <span data-translate="events.aegis">Аэгис</span>
                            </span>
                        </div>
                        <div class="mb-2">
                            <span class="{{ $event->side == 't1' ? 'green-side' : 'red-side' }} font-semibold mb-2">
                                <span>
                                    {{ $event->side == 't1' ? $match->getTeam1()->getShortTitle() : $match->getTeam2()->getShortTitle() }}
                                </span>
                            </span>
                            <span data-translate="events.team_killed"> убивают </span>
                            <span class="font-bold">
                                <img class="inline h-5" src="https://cybersportscore.com/media/icons/events/roshan.png" alt="Рошан">
                                <span data-translate="events.roshan">Рошан</span>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
        @if($match->getDuration() > 0)
            <div class=" flex flex-row border-b border-dashed border-gray-700 mb-2">
                <div class="flex flex-col items-end text-xs min-w-[50px] justify-start text-right text-gray-600 pr-3">
                    <span>00:00</span>
                </div>
                <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs font-semibold">
                    <div class="mb-2">
                        <span class="font-semibold mb-2" data-translate="events.game_started">Игра началась</span>
                    </div>
                </div>
            </div>
        @endif
        @if($hasBans && $hasPicks)
            <div class=" flex flex-row border-b border-dashed border-gray-700 mb-2">
                <div class="flex flex-col items-end text-xs min-w-[50px] justify-start text-right text-gray-600 pr-3">
                    <span>00:00</span>
                </div>
                <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs font-semibold">
                    <div class="mb-2">
                        <span class="font-semibold mb-2" data-translate="events.picksbans">Стадия пиков и банов</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
