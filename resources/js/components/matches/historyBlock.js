import {teamHistory} from "./historyTeams.js";

window.historyMatchesBlock = historyMatchesBlock;

export function historyMatchesBlock(histories) {
    const historyBlock = document.getElementById('historyBlock');
    historyBlock.innerHTML = '';
    const team1 = histories.t1;
    const team2 = histories.t2;

    const commonHistory = document.createElement('div');
    commonHistory.className = 'col-span-1 md:col-span-2 border-r border-gray-700 relative'
    commonHistory.appendChild(commonBlockInfo(team1, team2));
    commonHistory.appendChild(commonBlockMatches(histories.common.matches))

    const team1History = document.createElement('div');
    team1History.className = 'col-span-1 md:col-span-2 border-r border-gray-700 relative'
    team1History.appendChild(teamInfo(team1.short_title, team1.logo))
    team1History.appendChild(teamHistory(histories.t1.matches))

    const team2History = document.createElement('div');
    team2History.className = 'col-span-1 md:col-span-2 relative'
    team2History.appendChild(teamInfo(team2.short_title, team2.logo))
    team2History.appendChild(teamHistory(histories.t2.matches))

    historyBlock.appendChild(commonHistory);
    historyBlock.appendChild(team1History);
    historyBlock.appendChild(team2History);
}


function commonBlockInfo(t1, t2) {
    const info = document.createElement('div');
    info.className = 'flex justify-center pl-[2.2rem] border-b border-gray-700 bg-gray-700 bg-opacity-40';

    info.appendChild(commonBlockTeamInfo(t1.short_title, t1.logo, 't1'));
    info.innerHTML += `
        <div class="flex justify-center items-center border-x border-gray-700 w-14 md:h-10">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-gray-600 border-1 border w-[28px] h-[28px] border-apple text-apple">
                VS
            </div>
        </div>`
    info.appendChild(commonBlockTeamInfo(t2.short_title, t2.logo, 't2'))

    return info;
}

function commonBlockMatches(commonBlock) {
    const commonHistory = document.createElement('div');
    commonHistory.className = 'overflow-y-scroll h-[15.3rem]';

    commonBlock.map((item) => {
        const team1Score = item.teams[0].score;
        const team2Score = item.teams[1].score;

        const date = item.date.split(" ")[0];

        const matchesHistory = document.createElement('div');
        matchesHistory.className = 'flex border-b justify-between border-gray-700 hover:bg-gray-800';
        matchesHistory.appendChild(dateMatch(date));
        matchesHistory.appendChild(matchInfo(team1Score, team2Score));
        matchesHistory.appendChild(eventInfo(item.event.title, item.event.logo, item.event.has_logo));

        commonHistory.appendChild(matchesHistory);
    })

    return commonHistory;
}

function dateMatch(date) {
    const info = document.createElement('div');
    info.className = 'flex w-24 items-center pl-4';
    info.innerHTML = `
        <div class="flex flex-col">
            <div class="text-[12px] text-[#6B7280] leading-none">
                ${date}
            </div>
        </div>
    `

    return info;
}

function matchInfo(t1score, t2score) {
    const info = document.createElement('div');
    info.className = 'flex m-auto justify-center';
    info.innerHTML += winOrLose(t1score, t2score, 't1');
    info.innerHTML += `
        <div class="flex justify-center items-center border-x border-gray-700 w-14 h-10">
            <div class="text-xs text-gray-300 font-bold">
                ${t1score}-${t2score}
            </div>
        </div>`
    info.innerHTML += winOrLose(t2score, t1score, 't2');

    return info;
}

function eventInfo(title, logo, hasLogo) {
    const info = document.createElement('div');
    info.className = 'flex w-14 items-center';

    info.innerHTML = `
        <span class="mx-4">
            <img src="${hasLogo ? '/media/event/_120/e${logo}.webp' : 'media/icons/no-icon.svg'}"
                 title="${title}" alt="${title} icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
        </span>`

    return info;
}

function winOrLose(t1Score, t2Score, side) {
    const padding = side === 't1'? 'pr-4' : 'pl-4'

    return t1Score > t2Score ?
        `<div class="text-xs flex ${padding} w-14 items-center">
            <div class="text-[#98AA28]">WIN</div>
        </div>` :
        `<div class="flex text-xs text-bold ${padding} w-14 items-center">
            <div class="text-[#EB5757]">LOSS</div>
        </div>`
}

function commonBlockTeamInfo(shortTitle, logo, sideTeam) {
    const side = sideTeam === 't1' ? 'flex-row-reverse items-center' : '';

    const tInfo = document.createElement('div');
    tInfo.className = 'flex w-28 items-center ' + side;
    tInfo.innerHTML = `
        <div class="flex items-center">
            <span class="px-4">
                <img src="/media/logo/_30/t${logo}.webp" alt="undefined icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </span>
        </div>
        <span class="text-gray-300 text-[12px] leading-4">
            ${shortTitle}
        </span>`

    return tInfo;
}

function teamInfo(logo, shortTitle){
    const tInfo = document.createElement('div');
    tInfo.className = 'flex items-center bg-gray-700 bg-opacity-40 border-b border-gray-700 py-2';
    tInfo.innerHTML = `
        <span class="px-4">
            <img src="/media/logo/_30/t${logo}.webp'"
                 alt="undefined icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
        </span>
        <span class="text-gray-300 text-[12px]">${shortTitle}</span>
    `

    return tInfo;
}
