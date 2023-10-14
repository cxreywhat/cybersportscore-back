import {loadArticlesNewsBlock} from "../helpers/ajax";

const selectedLang = document.getElementById('selected-lang');
const listLangs = document.getElementById('list-langs');
const langs = document.getElementById('languages');
const listTimesZone = document.getElementById('list-times-zone');

const languages = [
    { value: 'en', t: 'English'},
    { value: 'ru', t: 'Русский'},
    { value: 'uk', t: 'Українська'},
    { value: 'zh', t: '中文'}
]

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        listLangs.style.display = 'none';
    }
});

document.addEventListener('click', function(event) {
    if (!listLangs.contains(event.target) && event.target !== selectedLang) {
        listLangs.style.display = 'none';
    }
});

selectedLang.addEventListener('click', () => {
    addFocusStyles(selectedLang);

    setTimeout(() => {
        removeFocusStyles(selectedLang);
    }, 90);

    if (listLangs.style.display === 'none') {
        listLangs.style.display = 'block';

        if(listTimesZone.style.display === 'block') {
            listTimesZone.style.display = 'none';
        }

        while(langs.firstChild) {
            langs.removeChild(langs.firstChild);
        }

        languages.map((lang) => {
            langs.appendChild(selectLanguages(lang));
        });
    } else {
        listLangs.style.display = 'none';
    }
});

function addFocusStyles(focusBlock) {
    focusBlock.classList.add('focus:z-10', 'focus:ring-4', 'focus:ring-gray-700');
}

function removeFocusStyles(focusBlock) {
    focusBlock.classList.remove('focus:z-10', 'focus:ring-4', 'focus:ring-gray-700');
}


function selectLanguages(item) {
    const lang = document.createElement('li')
    lang.ariaSelected = 'false';
    lang.role = 'option';
    lang.tabIndex = -1;
    lang.innerHTML = `
            <button value=${item.value} class="lang-button w-full text-white text-left block py-2 px-4 whitespace-nowrap">
                ${item.t}
            </button>`

    lang.addEventListener('mouseover', () => {
        lang.style.backgroundColor = '#718096';
        lang.addEventListener('click', () => {
            selectedLang.innerHTML = `
                    ${item.t}
                    <svg class="ml-1 mt-1 md:mt-0 md:ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                `;

            listLangs.style.display = 'none';
            selectedLang.value = item.value;
        })
    });
    lang.addEventListener('mouseout', () => {
        lang.style.backgroundColor = '';
    });
    return lang;
}

$(document).ready(function() {
    let lang = document.getElementById('selected-lang');
    lang.addEventListener('click', () => {
        const langButtons = document.querySelectorAll('.lang-button');

        langButtons.forEach((button) => {
            button.addEventListener('click', () => {
                if(window.location.pathname === '/') {
                    loadArticlesNewsBlock(button.value, 5);
                } else if(window.location.pathname === '/news') {
                    loadArticlesNewsBlock(button.value, 15, true);
                } else if (window.location.pathname.match(/^\/news\/\d+$/)) {
                    loadArticlesNewsBlock(button.value, 10);
                }
            });
        });
    })
});
