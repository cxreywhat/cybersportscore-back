import {createMatch} from "./homeSocket.js";
import {loadHomePerPage} from "../helpers/ajax";

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

export function matchesIncurrentPage(matches) {
    const matchesBlock = document.getElementById('matches')

    matchesBlock.innerHTML = '';

     matches.map((match) => {
         matchesBlock.appendChild(createMatch(match));
    })

}

