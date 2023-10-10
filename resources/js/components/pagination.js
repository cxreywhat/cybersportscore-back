import {createMatch} from "./homeSocket";
import {buildApiUrl, pagination} from "../matchFilter";
import {checkDetailsMap} from "../helpers/detailsMap";
import {hideLoader, showLoader} from "../helpers/loader";
import {loadMatchBlock} from "../helpers/ajax";

const pageButtons = document.querySelectorAll('.page-button');

pageButtons.forEach((button) => {
    button = removeAllEventListeners(button);
        button.addEventListener('click', function() {
            const pageNumber = button.getAttribute('data-page');
            pageButtons.forEach((btn) => {
                const page = btn.getAttribute('data-page');
                if (page === pageNumber) {
                    btn.classList.add('bg-gray-700', 'font-semibold', 'text-gray-200', 'pointer-events-none', 'cursor-default');
                    btn.classList.remove('text-gray-500');
                } else {
                    btn.classList.remove('bg-gray-700', 'font-semibold', 'text-gray-200', 'pointer-events-none', 'cursor-default');
                    btn.classList.add('text-gray-500');
                }
            });

            loadHomePerPage(pageNumber);
        });
});

function removeAllEventListeners(element) {
    const clonedElement = element.cloneNode(true);
    element.parentNode.replaceChild(clonedElement, element);
    return clonedElement;
}

export function loadHomePerPage(pageNum) {
    const gameId = document.getElementById('selected-game').getAttribute('data-value');
    const eventId = document.getElementById('selected-tournament').getAttribute('data-value');
    const teamId = document.getElementById('selected-team').getAttribute('data-value');

    const basicUrl = 'api/matches?page=' + pageNum + '&'
    const url = buildApiUrl(basicUrl, gameId, eventId, teamId)

    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'html',
        data: { page: pageNum },
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
            checkDetailsMap()
            history.pushState({}, '', '/?page=' + pageNum);
            loadMatchBlock();
        },
    });
}

export function matchesIncurrentPage(matches) {
    const matchesBlock = document.getElementById('matches')

    matchesBlock.innerHTML = '';

     matches.map((match) => {
         matchesBlock.appendChild(createMatch(match));
    })

}

