function t1Info(match, isLive, team1ShortT, team2ShortT, t1) {
    const t1InfoDiv = document.getElementById('t1-info')

    while (t1InfoDiv.firstChild) {
        t1InfoDiv.removeChild(t1InfoDiv.firstChild);
    }

    let goldExp = document.createElement("span");
    goldExp.className = "ml-3 sm:ml-0 items-col-adv text-[9px] font-semibold opacity-90";
    const golds = Object.values(match.match_data.gold);
    const gold = golds[golds.length - 1];
    if (gold > 0 && isLive) {
        let goldSpan = document.createElement("span");
        goldSpan.className = "h-[12px] block rounded border-yellow-300 text-yellow-300 leading-normal";

        goldSpan.textContent = "+" + (gold >= 1000 ? (gold / 1000).toFixed(1) + "k" : gold);

        goldExp.appendChild(goldSpan);
    }

    if (match.advantage_exp > 0 && isLive) {
        let advExpSpan = document.createElement("span");
        advExpSpan.className = "text-left h-[12px] block sm:ml-0 rounded border-[#1786ED] text-[#1786ED] leading-normal";
        advExpSpan.textContent = "+" + (match.advantage_exp / 1000).toFixed(1) + "k";

        goldExp.appendChild(advExpSpan);
    }

    t1InfoDiv.appendChild(goldExp);
    let titleTeam = document.createElement("span");
    titleTeam.className = "text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate";

    titleTeam.textContent = t1 ? team1ShortT : team2ShortT;

    t1InfoDiv.appendChild(titleTeam)
}

function t2Info(match, isLive, team1ShortT, team2ShortT, t2) {
    const t2InfoDiv = document.getElementById('t2-info')

    while (t2InfoDiv.firstChild) {
        t2InfoDiv.removeChild(t2InfoDiv.firstChild);
    }

    let titleTeam = document.createElement("span");

    titleTeam.className = "text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate";

    titleTeam.textContent = t2 ? team2ShortT : team1ShortT;

    t2InfoDiv.appendChild(titleTeam)

    const golds = Object.values(match.match_data.gold);
    const gold = golds[golds.length - 1];
console.log(gold);

    let goldExp = document.createElement("span");

    goldExp.className = "ml-3 sm:ml-0 items-col-adv text-[9px] font-semibold opacity-90";

    if (gold < 0 && isLive) {
        let goldSpan = document.createElement("span");

        goldSpan.className = "h-[12px] block rounded border-yellow-300 text-yellow-300 leading-normal";

        goldSpan.textContent = "+" + (gold <= -1000 ? (gold / 1000).toFixed(1) * -1 + "k" : gold * -1 );
        goldExp.appendChild(goldSpan);

    }

    if (match.advantage_exp < 0 && isLive ) {
        let advExpSpan = document.createElement("span");
        advExpSpan.className = "text-left h-[12px] block sm:ml-0 rounded border-[#1786ED] text-[#1786ED] leading-normal";
        const shortExp = match.advantage_exp <= -1000;
        advExpSpan.textContent = "+" + (shortExp ? (match.advantage_exp / 1000).toFixed(1) * -1 + "k" : match.advantage_exp * -1);
        goldExp.appendChild(advExpSpan);

    }
    t2InfoDiv.appendChild(goldExp)
}


function scoreMatch(teams, t1, t2) {
    const score = document.getElementById('score-match');

    while(score.firstChild) {
        score.removeChild(score.firstChild);
    }
    console.log(true)
    let t1score = document.createElement("span");
    t1score.className = "leading-normal text-apple text-xs sm:text-sm text-right font-bold pr-1";

    if (t1) {
        t1score.textContent = teams.t1.score;
    } else {
        t1score.textContent = teams.t2.score;
    }

    score.appendChild(t1score);

    let colonSpan = document.createElement("span");
    colonSpan.textContent = ":";

    score.appendChild(colonSpan);

    let t2score = document.createElement("span");
    t2score.className = "leading-normal text-apple text-xs sm:text-sm text-center font-bold pl-1";

    if (t2) {
        t2score.textContent = teams.t2.score;
    } else {
        t2score.textContent = teams.t1.score;
    }

    score.appendChild(t2score);
}

function duration(seconds) {
    const timeMap = document.getElementById('time-map');
    const span = document.createElement("span");

    let minutes = Math.floor(seconds / 60);
    let remainingSeconds = seconds % 60;

    span.textContent = (
        (minutes < 10 ? "0" : "") + minutes + ":" +
        (remainingSeconds < 10 ? "0" : "") + remainingSeconds
    );
    timeMap.appendChild(span);
}

export function getMainPartInfo(matchBeta, numGame, preview) {
    const match = matchBeta.match_games[numGame - 1];
    const teams = match.match_data.teams;
    const t1 = teams.t1.tid === preview.teams[0].id;
    const t2 = teams.t2.tid === preview.teams[1].id;
    const isLive = matchBeta.is_live;
    const t1ShortTitle = preview.teams[0].short_title;
    const t2ShortTitle = preview.teams[1].short_title;

    t1Info(match, isLive, t1ShortTitle, t2ShortTitle, t1);
    duration(match.match_data.duration);
    scoreMatch(teams, t1, t2);
    t2Info(match, isLive, t1ShortTitle, t2ShortTitle, t2);
}
