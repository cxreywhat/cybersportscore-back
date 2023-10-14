import {createList, setEvents, setTeams} from "../components/filterListBox";
import {isNullOrUndef} from "chart.js/helpers";
import {insertChart} from "./detailsMap";
import {historyMatchesBlock} from "../components/matches/historyBlock.js";

let blockId = '';


export function loadArticlesNewsBlock(lang, perPage, isNewsPage = false) {
    $.ajax({
        url: '/articlesBlock',
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
            console.log(response)
            $('#news-container').html(response);
        },
    });
}

export function loadNews() {
    $('.ajax-news').click((e) => {
        e.preventDefault();

        $.ajax({
            url: '/news',
            method: 'GET',
            dataType: 'html',
            beforeSend: function() {
                showLoader()
            },
            complete: function() {
                hideLoader();
            },
            success: function(response) {
                $('#content-container').html(response);
                history.pushState({}, '', '/news');
                loadNewsBlock();
            },
        });
    });
}

export function loadNewsBlock() {
    const newsBlock = document.querySelectorAll('.ajax-news-block');
    newsBlock.forEach((news) => {
        news.addEventListener('click', (e) => {
            e.preventDefault();
            blockId = news.getAttribute('data-news-block') ;
            $.ajax({
                url: '/news/' + blockId,
                method: 'GET',
                dataType: 'html',
                beforeSend: function() {
                    showLoader()
                },
                complete: function() {
                    hideLoader();
                },
                success: function(response) {
                    $('#content-container').html(response);
                    history.pushState({}, '', '/news/' + blockId);
                    loadNews();
                    loadNewsBlock();
                },
            });
        })
    })
}
export function loadHome() {
    $('.main-logo').click((e) => {
        e.preventDefault();
        $.ajax({
            url: '/',
            method: 'GET',
            dataType: 'html',
            beforeSend: function() {
                showLoader()
            },
            complete: function() {
                hideLoader();
            },
            success: function(response) {
                $('#content-container').html(response);
                history.pushState({}, '', '/');

                loadNews()
            },
        });
    })
}

export function loadMatchBlockInfo() {
    $(document).ready(function() {
        const matchInfoLinks = document.querySelectorAll('.ajax-match-info');
        let id = null;
        let num = null;
        matchInfoLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const href = link.getAttribute('href');
                const matchId = href.match(/\/(\d+)\?num=(\d+)/);

                if (matchId) {
                    id = matchId[1];
                    num = matchId[2];
                }
            });
        });

        $('.ajax-match-info').click((e) => {
            e.preventDefault();
            $.ajax({
                url: '/' + id + '?num=' + num,
                method: 'GET',
                dataType: 'html',
                beforeSend: function() {
                    showLoader()
                },
                complete: function() {
                    hideLoader();
                },
                success: function(response) {
                    $('#content-container').html(response);
                    history.pushState({}, '', '/' + id + '?num=' + num);
                },
            });
        })
    });
}

export function loadMatchBlock() {
    $(document).ready(function() {
        const matchBlocks = document.querySelectorAll('.ajax-match-block');
        matchBlocks.forEach((match) => {
            match.addEventListener('click', function (event) {
                event.preventDefault();
                const matchId = match.getAttribute('data-id');

                if (matchId) {
                    $.ajax({
                        url: '/' + matchId,
                        method: 'GET',
                        dataType: 'html',
                        beforeSend: function() {
                            showLoader()
                        },
                        complete: function() {
                            hideLoader();
                        },
                        success: function(response) {
                            $('#content-container').html(response);
                            loadHistoryTeams(matchId);
                            history.pushState({}, '', '/' + matchId);
                        },
                    });
                } else {
                    window.location.pathname = '/';
                }
            });
        });
    });
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
    return new Promise((resolve, reject) => {
        let url = 'api/filters/tournaments';
        if (!isNullOrUndef(game_id)) {
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
        let url = 'api/filters/teams';
        if (!isNullOrUndef(game_id)) {
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

function showLoader() {
    $('#loader-content').show();
    $('#content-container').hide();
}

function hideLoader() {
    $('#loader-content').hide();
    $('#content-container').show();
}


function showLoaderNews() {
    $('#loader-news').show();
    $('#news-container').hide();
}

function hideLoaderNews() {
    $('#loader-news').hide();
    $('#news-container').show();
}
