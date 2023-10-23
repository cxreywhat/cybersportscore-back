import {matchesIncurrentPage} from "./components/pagination";
import {isNullOrUndef} from "chart.js/helpers";
import {hideLoader, showLoader} from "./helpers/loader";
import {loadHomePerPage} from "./helpers/ajax";

export function filterMatchRows(game_id, event_id, team,id) {

    const url = buildApiUrl('/api/matches', game_id, event_id, team,id)
    const game = game_id == 582 ? 'dota-2' : (game_id == 313 ? 'lol' : '')
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'html',
        beforeSend: function() {
            showLoader('loader-match', 'matches');
        },
        complete: function() {
            hideLoader('loader-match', 'matches', 'block');
        },
        success: function(response) {
            const matches = JSON.parse(response);
            pagination(matches.meta)
            matchesIncurrentPage(matches.data);
            history.pushState({}, '', '/' + game);
        },
    });
}

export function buildApiUrl(basicUrl, game_id, event_id, team_id) {
    let params = [];

    params = params.filter(item => !item.startsWith('game_id=') || !item.startsWith('event_id=') || !item.startsWith('team_id='));

    if (!isNullOrUndef(game_id)) {
        params.push(`game_id=${game_id}`);
    } if (!isNullOrUndef(event_id)) {
        params.push(`event_id=${event_id}`);
    } if (!isNullOrUndef(team_id)) {
        params.push(`team_id=${team_id}`);
    }

    return `${basicUrl}${params.length > 0 ? '?' : ''}${params.join('&')}`;
}

export function pagination(pagesMeta) {
    const paginationContainer = document.getElementById('pagination');

    paginationContainer.innerHTML = '';

    for(let i = 1; i <= pagesMeta.last_page; i++) {
        const pageButton = document.createElement('button');
        pageButton.className = `page-button ${pagesMeta.current_page === i ? 'bg-gray-700 font-semibold text-gray-200 pointer-events-none cursor-default ' : 'text-gray-500 ' }text-xs flex rounded-3xl px-3 py-2 mr-1 enabled:hover:bg-apple enabled:hover:text-white`;
        pageButton.setAttribute('data-page', i.toString());
        pageButton.textContent = i.toString();

        pageButton.addEventListener('click', () => {
            const pageNumber = pageButton.getAttribute('data-page');

            loadHomePerPage(pageNumber);
            pageButton.childNodes.forEach((btn) => {
                const page = btn.getAttribute('data-page');
                if (page === pageNumber) {
                    btn.classList.add('bg-gray-700', 'font-semibold', 'text-gray-200', 'pointer-events-none', 'cursor-default');
                    btn.classList.remove('text-gray-500');
                } else {
                    btn.classList.remove('bg-gray-700', 'font-semibold', 'text-gray-200', 'pointer-events-none', 'cursor-default');
                    btn.classList.add('text-gray-500');
                }
            });

        })

        paginationContainer.appendChild(pageButton);
    }
}




