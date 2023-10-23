import {filterMatchRows} from "../matchFilter";
import {getTeams, getTournaments, searchItem} from "../helpers/ajax";

const customSelectGame = document.getElementById('custom-select-game');
const listGames = document.getElementById('list-games');
const selectedGame = document.getElementById('selected-game');

const customSelectTournament = document.getElementById('custom-select-tournament');
const listTournaments = document.getElementById('list-tournaments');
const selectedTournament = document.getElementById('selected-tournament');

const customSelectTeam = document.getElementById('custom-select-team');
const listTeams = document.getElementById('list-teams');
const selectedTeam = document.getElementById('selected-team');

let tournamentSearchInput = document.getElementById('tournament-search-input');
let teamSearchInput = document.getElementById('team-search-input');
let gameId = null;
let gameEng = '';

document.addEventListener('keydown', handleEscapeKey);
document.addEventListener('mousedown', handleMouseDown);

function handleEscapeKey(event) {
    if (event.key === 'Escape') {
        listGames.style.display = 'none';
        listTournaments.style.display = 'none';
        listTeams.style.display = 'none';
    }
}

function handleMouseDown(event) {
    const listTeams = document.getElementById('list-teams');
    const listTournaments = document.getElementById('list-tournaments');
    const listGames = document.getElementById('list-games');

    const customSelectTeam = document.getElementById('custom-select-team');
    const customSelectTournament = document.getElementById('custom-select-tournament');
    const customSelectGame = document.getElementById('custom-select-game');

    if(!listTeams || !listTournaments || !listGames) {
        return;
    }

    if (!listTeams.contains(event.target) && !customSelectTeam.contains(event.target)) {
        listTeams.style.display = 'none';
    } if (!listTournaments.contains(event.target) && !customSelectTournament.contains(event.target)) {
        listTournaments.style.display = 'none';
    } if (!listGames.contains(event.target) && !customSelectGame.contains(event.target)) {
        listGames.style.display = 'none';
    }
}

function searchEvents(){
    tournamentSearchInput = document.getElementById('tournament-search-input');
    const tournamentList = document.getElementById('tournament-list');

    tournamentList.addEventListener('input', function (event) {
        if (event.target === tournamentSearchInput) {
            searchItem(tournamentSearchInput, tournamentList, '/api/filters/tournaments?search=');
        }
    });
}

function searchTeams() {
    teamSearchInput = document.getElementById('team-search-input');
    const teamList = document.getElementById('team-list');

    teamList.addEventListener('input', function (event) {
        if (event.target === teamSearchInput) {
            searchItem(teamSearchInput, teamList, '/api/filters/teams?search=');
        }
    });
}

export function createList(items, itemList, searchInput) {
    let currentElement = itemList.firstChild;

    while (currentElement) {
        const nextElement = currentElement.nextSibling;
        if (currentElement !== searchInput) {
            itemList.removeChild(currentElement);
        }
        currentElement = nextElement;
    }

    items.forEach((item) => {
        const listItem = document.createElement('li')
        listItem.className = 'relative'

        listItem.innerHTML = `
            <button class="flex items-center w-full text-left block py-2 px-2 text-white whitespace-normal truncate h-[43px] text-xs lg:text-sm">
                <img src="/media/icons/games/${item.game_eng}-bw.svg" alt="${item.game_eng} icon" loading="lazy" class="opacity-30 w-3 h-3 inline-block mr-3"">
                <img src="${item.has_icon ? '/media/event/_120/e' + item.id + '.webp' : '/media/icons/no-icon.svg'}" loading="lazy" class="w-5 h-5 inline-block mr-2">
                ${item.title}
            </button>
            `;
        itemList.appendChild(listItem);
    });
}

function openSelect(itemSelect, listItems, selectedItem, side) {
    if(!itemSelect) {
        return;
    }

    itemSelect = removeAllEventListeners(itemSelect);
    itemSelect.addEventListener('click', () => {
        gameId = document.getElementById('selected-game').getAttribute('data-value');

        if (listItems.style.display == 'block') {
            listItems.style.display = 'none';
        } else {
            listItems.style.display = 'block';
        }

        if (side === 'tournaments') {
            getTournaments(gameId).then((data) => {
                listItems.appendChild(data);
                selectItem(listItems, itemSelect, selectedItem, side);
                searchEvents()
            }).catch((error) => {
                console.error(error);
            });
        } else if (side === 'teams') {
            getTeams(gameId).then((data) => {
                listItems.appendChild(data);
                selectItem(listItems, itemSelect, selectedItem, side);
                searchTeams()
            }).catch((error) => {
                console.error(error);
            });
        }

        document.querySelectorAll('.custom-select').forEach((select) => {
            if (select !== itemSelect) {
                select.nextElementSibling.style.display = 'none';
            }
        });

        selectItem(listItems, itemSelect, selectedItem, side);
    });

    listItems.addEventListener('change', (e) => {
        selectItem(listItems, itemSelect, selectedItem, side)
    })
}

function selectItem(listItems, itemSelect, selectedItem, side) {
    let selectedListItem = null;
    let selectedIcon = null;
    listItems.querySelectorAll('li').forEach((item) => {
        item = removeAllEventListeners(item)

        item.addEventListener('mouseover', () => {
            item.style.backgroundColor = 'rgb(79, 70, 229, var(--tw-text-opacity))';
            if (item === selectedListItem && selectedIcon) {
                selectedIcon.style.color = 'rgb(255, 255, 255, var(--tw-text-opacity))';
            }
        });

        item.addEventListener('mouseout', () => {
            if (item !== selectedListItem) {
                item.style.backgroundColor = '';
            }
            if (item === selectedListItem && selectedIcon) {
                selectedIcon.style.color = 'rgb(79, 70, 229, var(--tw-text-opacity))';
            }
        });

        item.addEventListener('click', (e) => {
            if (selectedListItem) {
                selectedListItem.style.backgroundColor = '';
                const existingCheckmark = selectedListItem.querySelector('#checkmark');
                if (existingCheckmark) {
                    existingCheckmark.remove();
                }
            }

            const iconSrc = item.querySelector('img').src;

            if(item.querySelector('img:nth-child(2)')) {
                gameId = item.getAttribute('data-game-id');
                gameEng = item.getAttribute('data-game-eng');
                itemSelect.innerHTML = `
                        <span class="ml-1 block truncate text-xs">
                            <img src="${iconSrc}" alt="Game Icon" loading="lazy" class="opacity-30 w-3 h-3 inline-block mr-3">
                            <img src="${item.querySelector('img:nth-child(2)').src}" loading="lazy" class="w-3 h-3 inline-block mr-1">
                            <span id="${side === 'teams' ? 'selected-team' : 'selected-tournament'}" data-value="${side === 'teams' ? item.id : item.id}">
                                ${item.textContent.trim()}
                            </span>
                        </span>`;

                const game = setGame(gameId, gameEng)
                clearSelect(game,'selected-game')
            } else {
                itemSelect.innerHTML = `
                        <span class="ml-1 block truncate text-xs">
                            <img src="${iconSrc}" alt="Game Icon" loading="lazy" class=" w-3 h-3 inline-block mr-3">
                            <span id="${side === 'games' ? 'selected-game' : ''}" data-value="${item.textContent.trim() === 'Dota 2' ? '582' : (item.textContent.trim() === 'Lol' ? '313' : '')}">
                                ${item.textContent.trim()}
                            </span>
                        </span>`;

            }

            itemSelect.innerHTML += `<span id='clear-${selectedItem.id}' class="absolute inset-y-0 right-0 flex items-center pr-2"><span class="z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">✕</span></span>`

            const existingCheckmark = item.querySelector('#checkmark');

            if (!existingCheckmark) {
                item.innerHTML += `<span id='checkmark' class="absolute inset-y-0 right-0 flex items-center pr-4" style="color: rgb(255, 255, 255)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-5 w-5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path></svg></span>`;
            }

            selectedItem.textContent = item.textContent.trim();
            listItems.style.display = 'none';

            const game_id = document.getElementById('selected-game').getAttribute('data-value');
            const eventId = document.getElementById('selected-tournament').getAttribute('data-value');
            const teamId = document.getElementById('selected-team').getAttribute('data-value');

            filterMatchRows(game_id, eventId, teamId)

            selectedIcon = document.getElementById('checkmark');

            selectedListItem = item;

            clearSelect(itemSelect, selectedItem.id);
            e.stopPropagation()
        });
    });
}

function clearSelect(select, selectedItemId) {
    const clear = document.getElementById('clear-' + selectedItemId);
    clear.addEventListener('click', (e) => {
        e.stopPropagation()
        if(select.id === 'custom-select-team') {
            select.innerHTML = `
                <span id="selected-team" class="ml-1 truncate text-xs text-gray-500 flex items-center" data-value="">Выбрать команду</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <span id="clear-selection-team" class="clear-selection z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">
                        <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </span>
            `
        } else if(select.id === 'custom-select-tournament') {
            select.innerHTML = `
                <span id="selected-tournament" class="ml-1 truncate text-xs text-gray-500 flex items-center" data-value="">Выбрать турнир</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <span id="clear-selection-tournaments" class="clear-selection z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">
                        <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </span>
                `
        } else if(select.id === 'custom-select-game') {
            select.innerHTML = `
            <span id="selected-game" class="ml-1 truncate text-xs text-gray-500 flex items-center" data-value="">Выбрать игру</span>
            <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                <span id="clear-selection-game" class="clear-selection z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">
                    <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </span>
            `
        }

        const gameId = document.getElementById('selected-game').getAttribute('data-value');
        const eventId = document.getElementById('selected-tournament').getAttribute('data-value');
        const teamId = document.getElementById('selected-team').getAttribute('data-value');

        filterMatchRows(gameId, eventId, teamId);
    })
}

function setGame(gameId, gameEng) {
    const gameSelect = document.getElementById('custom-select-game')
    gameSelect.innerHTML = `
        <span class="ml-1 block truncate text-xs">
            <img src="/media/icons/games/${gameEng}.webp" alt="${gameEng} icon" loading="lazy" class=" w-3 h-3 inline-block mr-2">
            <span id="selected-game" data-value="${gameId}">${gameId == 582 ? 'Dota 2' : 'Lol'}</span>
        </span>`
    gameSelect.innerHTML += `<span id='clear-selected-game' class="absolute inset-y-0 right-0 flex items-center pr-2"><span class="z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">✕</span></span>`

    return gameSelect;
}

export function setEvents(tournaments) {
    const listEvents = document.getElementById('tournament-list');
    listEvents.innerHTML = '';
    listEvents.appendChild(tournamentSearchInput);

    tournaments.map((event) => {
        const eventBlock = document.createElement('li');
        eventBlock.id = event.id;
        eventBlock.className = 'relative';
        eventBlock.setAttribute('data-game-eng', event.game_eng)
        eventBlock.setAttribute('data-game-id', event.game_id)
        eventBlock.innerHTML += `
                <button class="items-center w-full text-left block py-2 px-2 text-white whitespace-normal truncate h-[43px] text-xs lg:text-sm">
                    <img src="/media/icons/games/${event.game_eng}-bw.svg" alt="dota-2 icon" loading="lazy" class="opacity-30 w-3 h-3 inline-block mr-3">
                    <img src="${event.logo ? '/media/event/_120/e' + event.id + '.webp' : '/media/icons/no-icon.svg'}" loading="lazy" class="w-5 h-5 inline-block mr-2">
                    ${event.title}
                </button>
        `

        listEvents.appendChild(eventBlock)
    })
    return listEvents;
}

export function setTeams(teams) {
    const listTeam = document.getElementById('team-list');
    listTeam.innerHTML = '';
    listTeam.appendChild(teamSearchInput);

    teams.map((team) => {
        const teamBlock = document.createElement('li');
        teamBlock.id = team.id;
        teamBlock.className = 'relative';
        teamBlock.setAttribute('data-game-eng', team.game_eng)
        teamBlock.setAttribute('data-game-id', team.game_id)
        teamBlock.innerHTML += `
            <button class="items-center w-full text-left block py-2 px-2 text-white whitespace-normal truncate h-[43px] text-xs lg:text-sm">
                <img src="/media/icons/games/${team.game_eng}-bw.svg"
                     alt="dota-2 icon" loading="lazy" class="opacity-30 w-3 h-3 inline-block mr-3">
                <img src="${team.logo ? '/media/logo/_30/t' + team.id + '.webp' : '/media/icons/no-icon.svg'}"
                     loading="lazy" class="w-5 h-5 inline-block mr-2">
                    ${team.title}
            </button>`

        listTeam.appendChild(teamBlock)
    })

    return listTeam;
}

function removeAllEventListeners(element) {
    if(!element) {
        return
    }

    const clonedElement = element.cloneNode(true);
    element.parentNode.replaceChild(clonedElement, element);
    return clonedElement;
}

openSelect(customSelectGame, listGames, selectedGame, 'games')
openSelect(customSelectTournament, listTournaments, selectedTournament, 'tournaments')
openSelect(customSelectTeam, listTeams, selectedTeam, 'teams')
