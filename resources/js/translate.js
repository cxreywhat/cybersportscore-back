import languageData from '../json/message.json';
let currentLanguage = 'en';

document.addEventListener('DOMContentLoaded', function () {
    const languageList = document.getElementById('languages');

    languageList.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') {
            const selectedLanguage = event.target.getAttribute('value');
            changeLanguage(selectedLanguage);
        }
    });
});
export function changeLanguage(selectedLanguage) {
    currentLanguage = selectedLanguage;
    updatePageContent();
}

function updatePageContent() {
    const elementsToUpdate = document.querySelectorAll('[data-translate]');

    elementsToUpdate.forEach(function (element) {
        const key = element.getAttribute('data-translate');
        const keyParts = key.split('.');
        let translatedText = languageData[currentLanguage];
        for (const part of keyParts) {
            translatedText = translatedText[part];
            if (!translatedText) break;
        }

        if (translatedText) {
            element.textContent = translatedText;
        } else {
            console.error(`Translation not found for key: ${key}`);
        }

        element.textContent = translatedText;
    });
}

updatePageContent();
