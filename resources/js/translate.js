import languageData from '../json/message.json';

let currentLanguage = document.getElementById('selected-lang').value;

document.addEventListener('DOMContentLoaded', function () {
    const languageList = document.getElementById('languages');
    changeLanguage(currentLanguage)

    languageList.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') {
            const selectedLanguage = event.target.getAttribute('value');
            changeLanguage(selectedLanguage);
        }
    });
});

export function changeLanguage(lang) {
    const elementsToUpdate = document.querySelectorAll('[data-translate]');

    elementsToUpdate.forEach(function (element) {
        const key = element.getAttribute('data-translate');
        const keyParts = key.split('.');
        let translatedText = languageData[lang];
        for (const part of keyParts) {
            translatedText = translatedText[part];
            if (!translatedText) break;
        }

        if (translatedText) {
            element.textContent = translatedText;
        }

        element.textContent = translatedText;
    });

    lang = lang.endsWith('/') ? lang.slice(0, -1) : lang;
    const path = window.location.pathname + window.location.search;
    let newPath;

    if (lang === 'en') {
        newPath = path.replace(/^\/(ru|zh|uk)\b/, '');
    } else {
        newPath = path.replace(new RegExp(`^\\/(ru|zh|uk)(\\/|$)`, 'g'), '/');

        if (lang === '' || lang) {
            newPath = `/${lang}${newPath}`;
        }
    }

    if (!path.startsWith(`/${lang}`)) {
        history.pushState({}, '', newPath);
    }
}
