import {createList, setEvents, setTeams} from "../components/filterListBox";
import {isNullOrUndef} from "chart.js/helpers";
import {checkDetailsMap, insertChart} from "./detailsMap";
import {historyMatchesBlock} from "../components/matches/historyBlock.js";
import {matchesIncurrentPage} from "../components/pagination";
import {buildApiUrl, pagination} from "../matchFilter";

export function loadArticlesNewsBlock(lang, perPage, isNewsPage = false) {
    $.ajax({
        url: '/api/articlesBlock',
        beforeSend: function() {
            showLoaderNews()
        },
        complete: function() {
            hideLoaderNews();
        },
        data: {
            lang: lang,
            perPage: perPage,
            isNewsPage: isNewsPage
        },
        method: 'GET',
        success: function(response) {
            $('#news-container').html(response);
        },

        error: function (error) {
            console.log(error.message)
        }
    });
}

export function loadHomePerPage(pageNum) {
    const gameId = document.getElementById('selected-game').getAttribute('data-value');
    const eventId = document.getElementById('selected-tournament').getAttribute('data-value');
    const teamId = document.getElementById('selected-team').getAttribute('data-value');

    const lang = document.getElementById('selected-lang').value;
    const selectedGame = document.getElementById('selected-game').getAttribute('data-value') || '';
    const game = selectedGame == 582 ? '/dota-2' : (selectedGame == 313 ? '/lol' : '');

    const basicUrl = '/api/matches?page=' + pageNum + '&'
    const url = buildApiUrl(basicUrl, gameId, eventId, teamId)
    const historyUrl = `/${lang}${game}?page=${pageNum}${buildUrl(eventId, teamId)}`;

    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'html',
        data: { lang: lang, page: pageNum },
        beforeSend: function() {
            showLoaderMatches()
        },
        complete: function() {
            hideLoaderMatches()
        },
        success: function(response) {
            const matches = JSON.parse(response);
            pagination(matches.meta)
            matchesIncurrentPage(matches.data);
            checkDetailsMap()

            history.pushState({}, '', historyUrl);
        },
    });
}

function buildUrl(eventId, teamId) {
    let url = '';

    if(eventId != null || undefined) {
        url += `&event_id=${eventId}`;
    }
    if(teamId != null || undefined) {
        url += `&team_id=${teamId}`;
    }

    return url;
}


function loadHistoryTeams(id) {
    $.ajax({
        url: '/api/matches/' + id + '/history',
        method: 'GET',
        dataType: 'html',
        success: function(response) {
            const histories = JSON.parse(response).data
            historyMatchesBlock(histories);
        },
    });
}

export function checkDetailsMatch(gameId, num, csrfToken, container) {
    $.ajax({
        url: '/match/details?id=' + gameId + '&num=' + num,
        method: 'POST',
        dataType: 'html',
        headers: {
            'X-CSRF-Token': csrfToken,
        },
        success: function (response) {
            container.innerHTML = response;
            insertChart();
        },
    });
}
export function getTournaments(game_id) {
    return new Promise((resolve) => {
        let url = '/api/filters/tournaments';
        if (game_id != null || game_id != undefined) {
            url += '?game_id=' + game_id;
        }

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                const events = JSON.parse(response).data;
                const listEvents = setEvents(events);
                resolve(listEvents);
            },
        });
    });
}

export function getTeams(game_id) {
    return new Promise((resolve, reject) => {
        let url = '/api/filters/teams';
        if (game_id != null || game_id != undefined) {
            url += '?game_id=' + game_id;
        }

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                const teams = JSON.parse(response).data;
                const listTeams = setTeams(teams);
                resolve(listTeams);
            },
        });
    });
}

export function searchItem(searchInput, itemList, api) {
    const searchText = searchInput.value;

    $.ajax({
        url: api + searchText,
        method: 'GET',
        dataType: 'html',
        success: function(response) {
            createList(JSON.parse(response).data, itemList, searchInput)
        },
    });
}


function showLoaderNews() {
    $('#loader-news').show();
    $('#news-container').hide();
}

function hideLoaderNews() {
    $('#loader-news').hide();
    $('#news-container').show();
}

function showLoaderMatches() {
    $('#loader-match').show();
    $('#matches').hide();
}

function hideLoaderMatches() {
    $('#loader-match').hide();
    $('#matches').show();
}
