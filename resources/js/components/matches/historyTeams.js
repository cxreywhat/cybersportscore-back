export function teamHistory(teamBlock) {
    const history = document.createElement('div');
    history.className = 'overflow-y-scroll h-[15.3rem]'

    teamBlock.map((item) => {
        const block = document.createElement('div');
        block.className = 'flex border-b border-gray-700 hover:bg-gray-800 py-1';

        const team1Score = item.teams[0].score;
        const team2Score = item.teams[1].score;
        const shortTitleTeam2 = item.teams[1].short_title;

        const date = item.date.split(" ")[0];
        block.appendChild(scoreTeam(team1Score, team2Score));
        block.appendChild(teamInfo(shortTitleTeam2, item.teams[1].id, item.teams[1].has_icon));
        block.appendChild(eventInfo(date, item.event.logo, item.event.title, item.event.has_icon));
        history.appendChild(block);
    })

    return history;
}


function scoreTeam(t1Score, t2Score) {
    const color = t1Score === t2Score ? 'text-white' :
        (t1Score > t2Score ? 'text-apple' : 'text-red-500')

    const score = document.createElement('div');
    score.className = 'flex justify-center items-center px-1 w-14';
    score.innerHTML = `<div class="text-xs font-bold ${color}">${t1Score}-${t2Score}</div>`;

    return score;
}

function teamInfo(shortTitle, id, hasLogo) {
    const info = document.createElement('div');
    info.className = 'flex grow py-1 gap-2 relative';
    info.innerHTML = `
        <div class="flex grow flex-1 content-center md:items-center gap-1 md:gap-3 flex-row">
            <span class="px-2 w-14"><img src="${hasLogo ? `/media/logo/_30/t${id}.webp` : 'media/icons/no-icon.svg'}" alt="" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy"></span>
            <span class="text-gray-300 text-[12px]">${shortTitle}</span>
        </div>`

    return info;
}

function eventInfo(date, logo, shortTitle, hasLogo) {
    const info = document.createElement('div');
    info.className = 'flex items-center w-[140px] justify-end gap-3 pr-3';
    info.innerHTML = `
        <div class="text-[12px] w-[80px] text-[#6B7280] leading-4 pr-1">${date}</div>
        <span class="px-1"><img src="${ hasLogo ? `/media/event/_120/e${logo}.webp` : 'media/icons/no-icon.svg'}" title="${shortTitle}" alt="" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline"></span>`

    return info;
}
