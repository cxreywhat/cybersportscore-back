function t1Info(goldAdv, expAdv, t1ShortTitle) {
    const t1InfoDiv = document.getElementById('t1-info')

    while (t1InfoDiv.firstChild) {
        t1InfoDiv.removeChild(t1InfoDiv.firstChild);
    }

    let goldExp = document.createElement("span");
    goldExp.className = "ml-3 sm:ml-0 items-col-adv text-[9px] font-semibold opacity-90";

    if (goldAdv > 0) {
        let goldSpan = document.createElement("span");
        goldSpan.className = "h-[12px] block rounded border-yellow-300 text-yellow-300 leading-normal";

        goldSpan.textContent = "+" + (goldAdv >= 1000 ? (goldAdv / 1000).toFixed(1) + "k" : goldAdv);

        goldExp.appendChild(goldSpan);
    }

    if (expAdv > 0) {
        let advExpSpan = document.createElement("span");
        advExpSpan.className = "text-left h-[12px] block sm:ml-0 rounded border-[#1786ED] text-[#1786ED] leading-normal";
        advExpSpan.textContent = "+" + (expAdv >= 1000 ? (expAdv / 1000).toFixed(1) + "k" : expAdv);

        goldExp.appendChild(advExpSpan);
    }

    t1InfoDiv.appendChild(goldExp);
    let titleTeam = document.createElement("span");
    titleTeam.className = "text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate";

    titleTeam.textContent = t1ShortTitle;

    t1InfoDiv.appendChild(titleTeam)
}

function t2Info(goldAdv, expAdv, t2ShortTitle) {
    const t2InfoDiv = document.getElementById('t2-info')

    while (t2InfoDiv.firstChild) {
        t2InfoDiv.removeChild(t2InfoDiv.firstChild);
    }

    let titleTeam = document.createElement("span");

    titleTeam.className = "text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate";

    titleTeam.textContent = t2ShortTitle;

    t2InfoDiv.appendChild(titleTeam)

    let goldExp = document.createElement("span");

    goldExp.className = "ml-3 sm:ml-0 items-col-adv text-[9px] font-semibold opacity-90";

    if (goldAdv < 0) {
        let goldSpan = document.createElement("span");

        goldSpan.className = "h-[12px] block rounded border-yellow-300 text-yellow-300 leading-normal";

        goldSpan.textContent = "+" + (goldAdv <= -1000 ? (goldAdv / 1000).toFixed(1) * -1 + "k" : goldAdv * -1 );
        goldExp.appendChild(goldSpan);

    }

    if (expAdv < 0) {
        let advExpSpan = document.createElement("span");
        advExpSpan.className = "text-left h-[12px] block sm:ml-0 rounded border-[#1786ED] text-[#1786ED] leading-normal";
        const shortExp = expAdv <= -1000;
        advExpSpan.textContent = "+" + (shortExp ? (expAdv / 1000).toFixed(1) * -1 + "k" : expAdv * -1);
        goldExp.appendChild(advExpSpan);

    }
    t2InfoDiv.appendChild(goldExp)
}


function scoreMatch(t1, t2) {
    const score = document.getElementById('score-match');

    while(score.firstChild) {
        score.removeChild(score.firstChild);
    }

    let t1score = document.createElement("span");
    t1score.className = "leading-normal text-apple text-xs sm:text-sm text-right font-bold pr-1";
    t1score.textContent = t1.map_score;
    score.appendChild(t1score);

    let colonSpan = document.createElement("span");
    colonSpan.textContent = ":";
    score.appendChild(colonSpan);

    let t2score = document.createElement("span");
    t2score.className = "leading-normal text-apple text-xs sm:text-sm text-center font-bold pl-1";
    t2score.textContent = t2.map_score;
    score.appendChild(t2score);
}

function duration(seconds) {
    const timeMap = document.getElementById('time-map');
    const span = document.createElement("span");

    let minutes = Math.floor(seconds / 60);
    let remainingSeconds = seconds % 60;

    while(timeMap.firstChild) {
        timeMap.removeChild(timeMap.firstChild);
    }

    span.textContent = (
        (minutes < 10 ? "0" : "") + minutes + ":" +
        (remainingSeconds < 10 ? "0" : "") + remainingSeconds
    );
    timeMap.appendChild(span);
}

export function getMainPartInfo(match) {

    t1Info(match.teams[0].gold_adv, match.teams[0].exp_adv, match.teams[0].short_title);
    duration(match.duration);
    scoreMatch(match.teams[0], match.teams[1]);
    t2Info(match.teams[1].gold_adv, match.teams[1].exp_adv, match.teams[1].short_title);
}
