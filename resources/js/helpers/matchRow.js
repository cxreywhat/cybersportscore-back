const matchElements = document.querySelectorAll('[data-match-id]');
import m from '../../json/message.json'
function changeUTCDate(matchTimeInSeconds, selectedLang) {
    const offset = document.getElementById('selected-time-zone').value;

    const matchDateUTC = new Date(matchTimeInSeconds * 1000);
    const adjustedMatchTime = new Date(matchDateUTC.getTime() + (offset - 3) * 3600 * 1000);
    const adjustedMatchTimeInSeconds = Math.floor(adjustedMatchTime.getTime() / 1000);
    return formatMatchTime(adjustedMatchTimeInSeconds, selectedLang);
}

matchElements.forEach(match => {
    const matchIsLive = match.getAttribute('data-matchStart');
    const matchId = match.getAttribute('data-match-id');
    const dateMatch = document.getElementById('date-match-' + matchId);
    const selectedLang = document.getElementById('selected-lang')

    if (parseInt(matchIsLive) > 0) {
        return;
    }
    dateMatch.innerHTML = changeUTCDate(dateMatch.getAttribute('data-time-match'), selectedLang.value);

    const languageList = document.getElementById('languages');

    languageList.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') {
            const selectedLanguage = event.target.getAttribute('value');
            dateMatch.innerHTML = changeUTCDate(dateMatch.getAttribute('data-time-match'), selectedLanguage);
        }
    })
});


function addLeadingZero(number) {
    return number < 10 ? `0${number}` : number.toString();
}

function formatMatchTime(matchTimeInSeconds, language) {
    const now = new Date();
    const matchDate = new Date(matchTimeInSeconds * 1000);

    const dayOfMonth = matchDate.getDate();
    const monthIndex = matchDate.getMonth();
    const hours = addLeadingZero(matchDate.getHours());
    const minutes = addLeadingZero(matchDate.getMinutes());

    const current = language === 'en' ? "Now" : (language === 'ru' ? "Сейчас" : '现在')
    if (now >= matchDate) {
        return `<span data-translate='date.now'>${current}</span>, ${hours}:${minutes}`;
    }

    if (now.getFullYear() === matchDate.getFullYear() &&
        now.getMonth() === monthIndex &&
        now.getDate() === dayOfMonth
    ) {
        return `<span data-translate='date.today'>Сегодня</span>, ${hours}:${minutes}`;
    }

    const tomorrow = new Date(now);
    tomorrow.setDate(now.getDate() + 1);

    if (tomorrow.getFullYear() === matchDate.getFullYear() &&
        tomorrow.getMonth() === monthIndex &&
        tomorrow.getDate() === dayOfMonth
    ) {
        return `<span data-translate='date.tomorrow'>Завтра</span>, ${hours}:${minutes}`;
    }

    const selectedMonthNames = m[language] || m['en'];
    const month = matchDate.toLocaleDateString('en-US', { month: 'long' }).toLowerCase()
    const monthName = selectedMonthNames['months'][month];

    return `${dayOfMonth} ${monthName}, ${hours}:${minutes}`;
}

export function formateDate (timeMatch) {
    const languageList = document.getElementById('languages');
    const listTimeZones = document.getElementById('times-zone');
    languageList.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') {
            const selectedLanguage = event.target.getAttribute('value');

            return changeUTCDate(timeMatch, selectedLanguage);
        }
    })

    listTimeZones.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') {
            const selectedLang = document.getElementById('selected-lang').value;

            return changeUTCDate(timeMatch, selectedLang);
        }
    })

    const lang = document.getElementById('selected-lang').value;
    return changeUTCDate(timeMatch, lang);
}


