import {addNews, addToNewsPage} from "./components/news";
import {createList, setEvents, setTeams} from "./components/filterListBox";
import {isNullOrUndef} from "chart.js/helpers";
import {insertChart} from "./helpers/detailsMap";

let blockId = '';
$(document).ready(function() {
    const lang = document.getElementById('selected-lang');
    if(window.location.pathname === '/news') {
        changeNews(lang.value, 15);
    }

    lang.addEventListener('click', () => {
        const langButtons = document.querySelectorAll('.lang-button');

        langButtons.forEach((button) => {
            button.addEventListener('click', () => {
                if(window.location.pathname === '/') {
                    changeNews(button.value, 5);
                } else if(window.location.pathname === '/news') {
                    changeNews(button.value, 15);
                } else {
                    changeNews(button.value, 10);
                }
            });
        });
    })


    function changeNews(lang, perPage) {
        $.ajax({
            url: '/api/news',
            method: 'GET',
            data: {
                lang: lang,
                perPage: perPage
            },
            success: function(response) {
                if(window.location.pathname === '/news') {
                    $('#news-content').html(addToNewsPage(response.data));
                } else {
                    $('#news-container').html(addNews(response.data));
                }
            },
            error: function() {
                alert('Произошла ошибка при отправке запроса.');
            }
        });
    }
});
function loadNews() {
    $('.ajax-news').click((e) => {
        e.preventDefault();

        $.ajax({
            url: '/news',
            method: 'GET',
            dataType: 'html',
            data: { is_ajax: true },
            beforeSend: function() {
                showLoader()
            },
            complete: function() {
                hideLoader();
            },
            success: function(response) {
                $('#content-container').html(response);
                history.pushState({}, '', '/news');
                loadNews();
                loadNewsBlock();
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });
}

function loadNewsBlock() {
    const newsBlock = document.querySelectorAll('.news-block');
    newsBlock.forEach((news) => {
        news.addEventListener('click', (e) => {
            e.preventDefault();
            blockId = news.getAttribute('data-news-block') ;
            $.ajax({
                url: '/news/' + blockId,
                method: 'GET',
                data: { is_ajax: true },
                dataType: 'html',
                beforeSend: function() {
                    showLoader()
                },
                complete: function() {
                    hideLoader();
                },
                success: function(response) {
                    $('#content-container').html(response);
                    history.pushState({}, '', '/news/' + block);
                    loadNews();
                    loadNewsBlock();
                },
                error: function(xhr) {
                    console.log(xhr.statusText);
                }
            });
        })
    })
}
function loadHome() {
    $('.main-logo').click((e) => {
        e.preventDefault();
        $.ajax({
            url: '/',
            method: 'GET',
            dataType: 'html',
            data: { is_ajax: true },
            beforeSend: function() {
                showLoader()
            },
            complete: function() {
                hideLoader();
            },
            success: function(response) {
                $('#content-container').html(response);
                history.pushState({}, '', '/');
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    })
}

function loadMatchBlockInfo() {
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
                data: { is_ajax: true },
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
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        })
    });
}

function loadMatchBlock() {
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
                        data: { is_ajax: true },
                        dataType: 'html',
                        beforeSend: function() {
                            showLoader()
                        },
                        complete: function() {
                            hideLoader();
                        },
                        success: function(response) {
                            $('#content-container').html(response);
                            history.pushState({}, '', '/' + matchId);
                        },
                        error: function(xhr) {
                            console.log(xhr.statusText);
                        },
                    });
                } else {
                    window.location.pathname = '/';
                }
            });
        });
    });
}

function checkDetailsMatch(gameId, num, csrfToken, container) {
    $.ajax({
        url: '/match/details?id=' + gameId + '&num=' + num,
        method: 'POST',
        dataType: 'html',
        headers: {
            'X-CSRF-Token': csrfToken,
        },
        data: {is_ajax: true},
        success: function (response) {
            container.innerHTML = response;
            insertChart();
        },
        error: function (xhr) {
            console.error(xhr);
        }
    });
}
function getTournaments(game_id) {
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
            error: function(xhr) {
                console.error(xhr);
                reject(xhr);
            }
        });
    });
}

function getTeams(game_id) {
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
            error: function(xhr) {
                console.error(xhr);
                reject(xhr);
            }
        });
    });
}

function searchItem(searchInput, itemList, api) {
    const searchText = searchInput.value;

    $.ajax({
        url: api + searchText,
        method: 'GET',
        dataType: 'html',
        success: function(response) {
            createList(JSON.parse(response).data, itemList, searchInput)
        },
        error: function(xhr) {
            console.error(xhr);
        }
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


loadMatchBlockInfo()
loadHome();
loadMatchBlock()

loadNews();
loadNewsBlock();

export default { setEvents, setTeams, searchItem, checkDetailsMatch, loadMatchBlock}
