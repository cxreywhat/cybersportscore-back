import {formateDate} from "../helpers/matchRow";
import {checkDetailsMap} from "../helpers/detailsMap";

export function updateMatches(matches) {
    const matchBlock = document.getElementById('matches');

    while(matchBlock.firstChild) {
        matchBlock.removeChild(matchBlock.firstChild);
    }

    matches.map((match) => {
        matchBlock.appendChild(createMatch(match));
    })
}

function scoreMap(duration, scoreT1, scoreT2, timeStartMatchSeconds, isLive, bbOdds) {
    const infoScore = document.createElement('div');
    infoScore.className = 'flex flex-col border-l border-r text-gray-400 items-center justify-center sm:text-sm w-32 sm:w-40 h-full border-gray-700 text-gray-500';

    if(bbOdds && !isLive) {
        infoScore.innerHTML = ` <div class="flex flex-col items-center justify-content" onClick="window.location.href='/${bbOdds.url}&lang=en'">
            <div class="md:py-1">
                <img width="35px" loading="lazy" src="/media/odds/small/bb.png" alt="bb">
            </div>
            <div class="text-[9px] leading-[1rem] sm:text-xs text-gray-300 font-extrabold">${bbOdds.rates[0]} - ${bbOdds.rates[1]}</div>
        </div>`
    }
    else if(timeStartMatchSeconds < Math.round(Date.now() / 1000) && isLive) {
        infoScore.innerHTML = `
            <div class="flex flex-row items-center justify-center">
                <svg class="opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: rgb(171, 175, 187); height: 1.1em;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd"></path></svg>
                <div class="w-[30px] sm:w-[38px] text-right text-[9px] sm:text-xs leading-normal">
                    <span id='time-game' class="">${formatTime(duration)}</span>
                </div>
            </div>
            <div class="flex flex-row items-center text-base justify-center italic" >
                <span class="leading-normal text-apple text-xs sm:text-sm text-right font-bold pr-1" >${scoreT1}</span>
                :
                <span class="leading-normal text-apple text-xs sm:text-sm text-center font-bold pl-1" >${scoreT2}</span>
            </div>`
    } else {
        infoScore.innerHTML = `<div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple">VS</div>`
    }

    return infoScore;
}

function teamTitle(shortTitleTeam) {
    return `
        <div class="flex flex-col items-end w-8 sm:w-10 overflow-visible text-xs md:text-base h-full justify-center border-gray-400 text-gray-500 grow">
            <div class="flex flex-col-reverse md:flex-row md:items-center w-[100%] flex-grow-1">
                <span class="text-[10px] sm:text-xs text-gray-300 font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate">${shortTitleTeam}</span>
            </div>
        </div>`
}

function teamAdvAndTitle(shortTitleTeam, sideTeam) {
    const container = document.createElement('div')
    container.className = (sideTeam === 'team-left' ? 'items-end' : 'items-start') + " flex h-full flex-col justify-center grow w-8 sm:w-10 overflow-visible text-xs border-gray-400 text-gray-500 md:text-base";

    const content = document.createElement('div')
    content.className = "md:items-center flex-col-reverse items-end md:flex-row flex";
    content.innerHTML = teamTitle(shortTitleTeam);

    container.appendChild(content);

    return container;
}

function scoreMatch(seriesBO, t1ScoreMatch, t2ScoreMatch, matchDate, isLive) {
    return `
        <div class="w-12 items-center flex flex-col justify-center h-full border-gray-400 text-gray-500">
            <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4 mx-auto ">BO${seriesBO}</div>
            <span class="${matchDate < Math.round(Date.now() / 1000) && isLive ? 'bg-apple' : 'bg-gray-500'} text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white mx-auto text-center">${t1ScoreMatch}:${t2ScoreMatch}</span>
        </div>`
}


function logoTeam(idTeam) {
    return `
        <div class="flex flex-col w-12 md:w-16 items-center sm:flex justify-center h-full border-gray-400 text-gray-500">
            <div class="flex flex-col items-center mx-auto">
                <img src="/media/logo/_30/t${idTeam}.webp" alt="team icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        `
}

function dateMatch(isLive, numMap, matchDate, matchId) {
    return `
        <div class="flex flex-col justify-center h-full w-12 sm:w-32 md:w-36 p-0 sm:px-3 py-3 items-start text-sm border-gray-400 text-gray-500">
            ${matchDate < Math.round(Date.now() / 1000) && isLive? `
                <div class="font-semibold text-sm text-red-500 leading-4 flex flex-col items-center opacity-90">
                    <span class="hidden md:flex">LIVE</span>
                    <span class="text-[9px] sm:text-xs font-semibold mt-0 md:mt-1 px-1 rounded bg-red-500 text-gray-900" >
                        <span>MAP ${numMap}</span>
                    </span>
                </div>` :
                `<div class="w-12 sm:w-32 md:w-36 py-3 leading-4 text-xs flex flex-col justify-center h-full border-gray-400 text-gray-500">
                    <span id="date-match-${matchId}" class="text-gray-400 sm:text-gray-300 sm:text-xs" data-time-match="${matchDate}">
                        ${formateDate(matchDate)}
                    </span>
                </div>
            `}
        </div>`
}

function eventLogo(eventId) {

    return `
        <div class="w-20 hidden sm:flex items-center flex flex-col justify-center h-full border-gray-400 text-gray-500">
            <div class="flex flex-col items-center mx-auto">
                <img src='/media/event/_30/e${eventId}.webp' title="Miso Soup" alt="Miso Soup icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>`
}

function iconGame(gameId) {
    const data = [
        { id: 582, game: 'dota-2' },
        { id: 313, game: 'lol' }
    ];

    const matchingGame = data.find(item => item.id === gameId);

    const gameName = matchingGame.game;
    const gameLogo = document.createElement('div');
    gameLogo.className = "flex pl-4 w-[45px]";
    gameLogo.style.display = 'flex';
    gameLogo.style.height = '100%';
    gameLogo.style.flexDirection = 'column';
    gameLogo.style.justifyContent = 'center';
    gameLogo.style.borderColor = '#718096';
    gameLogo.style.color = '#718096';
    gameLogo.innerHTML = `<img loading="lazy" class="opacity-50 w-5 h-5" alt="${gameName} icon" src="media/icons/games/${gameName}-bw.webp">`

    return gameLogo;
}

function addDetails(matchId) {
    return `<div id='matchDetails-${matchId}' class="min-h-[285px] flex-col md:flex-row p-4 relative w-full" style="display: none; background: linear-gradient(180deg, rgba(214, 214, 214, 0.06) 0%, rgba(217, 217, 217, 0.03) 100%)"></div>`

}

export function createMatch(match) {
    const matchDiv = document.createElement("div");
    const teamsInfo = match.teams;
    matchDiv.id = "match";
    matchDiv.className = "border-gray-700 border-x border-b justify-between relative bg-opacity-20 text-gray-500 items-center will-change-contents";
    matchDiv.setAttribute("data-game", `${match.game_id === 582 ? '582' : '313' }`);
    matchDiv.setAttribute("data-tournament", `${ match.event.id }`);
    matchDiv.setAttribute("data-teams", `[${teamsInfo[0].id}, ${teamsInfo[0].id}]`);

    const matchContent = document.createElement('div');
    matchContent.className = `items-row hover:bg-gray-800 border-l-[1px] w-full border-l-[4px] ${match.datetime < Math.round(Date.now() / 1000) ? 'border-red-500' : 'border-transparent'}`;

    matchContent.appendChild(createRefMatch(match));
    matchContent.appendChild(detailsButton(match.id, match.datetime, match.num));
    matchDiv.appendChild(matchContent);
    matchDiv.innerHTML += addDetails(match.id)
    checkDetailsMap(true)
    return matchDiv;
}

function detailsButton(idMatch, matchDate, mapNum) {
    const detailsButton = document.createElement('button');

    detailsButton.id = "matchDetailsButton-" + idMatch
    detailsButton.className = (matchDate < Math.round(Date.now() / 1000) && mapNum !== null ? 'hover:bg-apple bg-gray-700 text-gray-300 cursor-pointer' : 'text-gray-700 cursor-default') + " w-[46px] sm:w-[42px] h-full justify-center items-center flex";
    detailsButton.setAttribute('data-num-map', mapNum)
    detailsButton.innerHTML += `
        <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
        </svg>`
    return detailsButton;
}

function createRefMatch(match) {
    const refMatch = document.createElement('a');

    refMatch.setAttribute('id', 'ajax-match-block');
    refMatch.className = 'flex flex-row w-full h-full items-center ';
    if (match.is_live) {
        refMatch.classList.add('cursor-pointer', 'ajax-match-block');
        refMatch.href = '/' + match.id
    } else {
        refMatch.classList.add('cursor-default');
    }

    if (match.isLive) {
        refMatch.setAttribute('href', `/${match.id}`);
    }

    const t1 = match.teams[0];
    const t2 = match.teams[1];
    const bbOdds = match.odds.length > 0 ? match.odds[0] : null;

    refMatch.setAttribute('data-id', match.id);
    refMatch.appendChild(iconGame(match.game_id));
    refMatch.innerHTML += dateMatch(match.is_live, match.num, match.datetime, match.id);
    refMatch.appendChild(teamAdvAndTitle(t1.short_title, 'team-left'));
    refMatch.innerHTML += logoTeam(t1.id);
    refMatch.appendChild(scoreMap(match.duration, t1.map_score, t2.map_score, match.datetime, match.is_live, bbOdds))
    refMatch.innerHTML += logoTeam(t2.id);
    refMatch.appendChild(teamAdvAndTitle(t2.short_title, 'team-right'));
    refMatch.innerHTML += eventLogo(match.event.id);
    refMatch.innerHTML += scoreMatch(match.bo, t1.match_score, t2.match_score, match.datetime, match.is_live);
    return refMatch;
}

function formatTime(seconds) {
    if (isNaN(seconds) || seconds < 0) {
        return "00:00";
    }

    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    const minutesStr = minutes < 10 ? `0${minutes}` : `${minutes}`;
    const secondsStr = remainingSeconds < 10 ? `0${remainingSeconds}` : `${remainingSeconds}`;

    return `${minutesStr}:${secondsStr}`;
}
