function convertSecondsToDate(seconds) {
    if (seconds < 0 || seconds >= 6000) {
        return "Invalid input";
    }

    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;

    const formattedMinutes = String(minutes).padStart(2, "0");
    const formattedSeconds = String(remainingSeconds).padStart(2, "0");

    return `<div class="flex flex-col items-end text-xs min-w-[50px] justify-start text-right text-gray-600 pr-3">
                <span>${formattedMinutes}:${formattedSeconds}</span>
            </div>`;
}

function matchStart() {
    const event = document.createElement('div');

    event.className = 'flex flex-row border-b border-dashed border-gray-700 mb-2';
    event.innerHTML += convertSecondsToDate(0);
    event.innerHTML += `
        <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs font-semibold">
            <div class="mb-2">
                <span class="font-semibold mb-2" data-translate="events.game_started">Игра началась</span>
            </div>
        </div>`

    return event;
}


function stagePicksAndBans() {
    const event = document.createElement('div');

    event.className = 'flex flex-row border-b border-dashed border-gray-700 mb-2';
    event.innerHTML += convertSecondsToDate(0);
    event.innerHTML += `
        <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs font-semibold">
            <div class="mb-2">
                <span class="font-semibold mb-2" data-translate="events.picksbans">Стадия пиков и банов</span>
            </div>
        </div>`

    return event;
}

function roshanKill(shortTitleTeam, side, duration) {
    const event = document.createElement('div');
    event.className = 'flex flex-row border-b border-dashed border-gray-700 mb-2'
    event.innerHTML += convertSecondsToDate(duration);

    const eventContent = document.createElement('div');
    eventContent.className = 'flex flex-col grow items-start justify-start text-left pr-3 text-xs';
    eventContent.innerHTML += aegis(shortTitleTeam, side);
    eventContent.innerHTML += `
        <div class="mb-2">
            <span class="${side} font-semibold mb-2">
                <span>
                    ${shortTitleTeam}
                </span>
            </span>
            <span data-translate="events.team_killed"> убивают </span>
            <span class="font-bold">
                <img class="inline h-5" src="https://cybersportscore.com/media/icons/events/roshan.png" alt="Рошан">
                <span data-translate="events.roshan">Рошан</span>
            </span>
        </div>`

    event.appendChild(eventContent);

    return event;
}

function killNahor() {

}

function aegis(shortTitleTeam, side) {
    return `
        <div class="mb-2">
            <span class="${side} font-semibold mb-2">
                <span>
                    ${shortTitleTeam}
                </span>
            </span>
            <span data-translate="events.team_picked_up"> подбирают </span>
            <span class="font-bold">
                <img class="inline h-5" src="https://cybersportscore.com/media/icons/events/aegis.png" alt="Аэгис">
                <span data-translate="events.aegis">Аэгис</span>
            </span>
        </div>
    `
}

function teamFights(heroes, event, teamsTitle, side) {
    const eventFight = document.createElement('div');
    eventFight.className = 'flex flex-row border-b border-dashed border-gray-700 mb-2'
    eventFight.innerHTML += convertSecondsToDate(event.duration);
    const contentEventFight = document.createElement('div');
    contentEventFight.className = 'flex flex-col grow items-start justify-start text-left pr-3 text-xs'
    contentEventFight.innerHTML += event.team1_gold > 0 ? gold(event.team1_gold, teamsTitle.t1, side.green) : '';
    contentEventFight.innerHTML += event.team2_gold > 0 ? gold(event.team2_gold, teamsTitle.t2, side.red) : '';

    event.fights.map((fight) => {

        if(fight.type === 'kill') {
            contentEventFight.innerHTML +=
                `<div class="mb-2">
                    <span class="${event.side === 't1' ? side.green : side.red} font-semibold mb-2">
                        <span class="whitespace-nowrap">
                            ${heroes.find(hero => hero.id === fight.killer).title}
                        </span>
                    </span>
                    <span data-translate="events.killed"> убивает </span>
                    <span class="${event.side === 't1' ? side.red: side.green} font-semibold mb-2">
                        <span class="whitespace-nowrap">
                           ${heroes.find(hero => hero.id === fight.victim).title}
                        </span>
                    </span>
                </div>`
        } else if(fight.type === 'group_kill') {

            const killerTitles = fight.killers.map(killerId => {
                const heroWithMatchingId = heroes.find(hero => hero.id === killerId);
                return heroWithMatchingId ? heroWithMatchingId.title : null;
            });

            const victimsTitles = fight.victims.map(killerId => {
                const heroWithMatchingId = heroes.find(hero => hero.id === killerId);
                return heroWithMatchingId ? heroWithMatchingId.title : null;
            });

            contentEventFight.innerHTML +=
                `<div class="mb-2">
                    <span class="${event.side === 't1' ? side.green : side.red} font-semibold mb-2">
                        <span class="whitespace-nowrap">
                           ${killerTitles.filter(Boolean).join(', ')}
                        </span>
                    </span>
                    <span data-translate="events.team_killed"> убивают </span>
                    <span class="${event.side === 't1' ? side.red: side.green} font-semibold mb-2">
                        <span class="whitespace-nowrap">
                           ${victimsTitles.filter(Boolean).join(', ')}
                        </span>
                    </span>
                </div>`
        }
    })

    eventFight.appendChild(contentEventFight);

    return eventFight;
}

function gold(teamGold, shortTitleTeam, side) {
    return `
        <div class="mb-2">
            <span class="${side} font-semibold mb-2">
                <span>
                    ${shortTitleTeam}
                </span>
            </span>
            <span data-translate="events.team_get"> получают </span>
            <span class="font-bold text-yellow-400 whitespace-nowrap">
                <img class="inline h-4" src="https://cybersportscore.com/media/icons/events/gold.png" alt="gold">
                ${teamGold}
            </span>
        </div>
    `
}

function destroyedTowers(buildings, shortTitleTeam, side, duration) {
    const buildingElements = buildings.map((building) => {
        return `<span class="font-bold">${building}</span>`;
    });

    const buildingHtml = buildingElements.join(', ');

    const event = document.createElement('div');

    event.className = "flex flex-row border-b border-dashed border-gray-700 mb-2"
    event.innerHTML += convertSecondsToDate(duration);
    event.innerHTML += `
        <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs">
            <div class="mb-2">
                <span class="${side} font-semibold mb-2">
                    <span>
                        ${shortTitleTeam}
                    </span>
                </span>
                <span data-translate="events.team_destroyed"> уничтожают </span>
                <span class="font-bold"> ${buildingHtml}</span>
            </div>
        </div>`

    return event;
}

function matchEnd(teamShortTitle, side, duration) {
    const event = document.createElement('div');
    event.className = 'flex flex-row border-b border-dashed border-gray-700 mb-2';
    event.innerHTML += convertSecondsToDate(duration);
    event.innerHTML += `
        <div class="flex flex-col grow items-start justify-start text-left pr-3 text-xs font-semibold">
            <div class="mb-2">
                <span data-translate="events.winner"> Игра завершилась победой </span>
                <span class="${side} font-semibold mb-2">
                    <span>
                        ${teamShortTitle}
                    </span>
                </span>
            </div>
        </div>`

    return event;
}

export function addEventToLogs(match, heroes) {
    const logs = document.getElementById('events');
    const sides = {
        green: 'green-side',
        red: 'red-side'
    }

    while(logs.firstChild) {
        logs.removeChild(logs.firstChild);
    }

    const reversedEvents = match.events.slice().reverse();

    if(!!match.winner) {
        const winner = match.winner === 't1' ? match.teams[0].short_title : match.teams[1].short_title;
        const side = match.winner === 't1' ? sides.green : sides.red;
        logs.appendChild(matchEnd(winner, side, match.duration));
    }

    reversedEvents.map((event, index) => {
        if (index === reversedEvents.length - 1) {
            logs.appendChild(matchStart());
            logs.appendChild(stagePicksAndBans());
        } else if(event.type === 'fights') {
            const teams = {
                t1: match.teams[0].short_title,
                t2:  match.teams[1].short_title
            };

            logs.appendChild(teamFights(heroes, event, teams, sides));
        }
        else if(event.type === 'dota_building_destroy') {
            const team = event.side === 't1' ? match.teams[0].short_title : match.teams[1].short_title;
            const side = event.side === 't1' ? sides.green : sides.red;

            logs.appendChild(destroyedTowers(event.buildings, team, side, event.duration));
        }
        else if (event.type === 'roshan_kill') {
            const team = event.side === 't1' ? match.teams[0].short_title : match.teams[1].short_title;
            const side = event.side === 't1' ? sides.green : sides.red;

            logs.appendChild(roshanKill(team, side, event.duration));
        }


    })

}
