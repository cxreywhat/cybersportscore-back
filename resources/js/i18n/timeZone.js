const timesZoneJson = [
    { "zone": "UTC -12:00", "offset": "-12"},
    { "zone": "UTC -11:00", "offset": "-11" },
    { "zone": "UTC -10:00", "offset": "-10" },
    { "zone": "UTC -9:00", "offset": "-9" },
    { "zone": "PST", "offset": "-8" },
    { "zone": "PDT", "offset": "-7" },
    { "zone": "CST", "offset": "-6" },
    { "zone": "EST", "offset": "-5" },
    { "zone": "EDT", "offset": "-4" },
    { "zone": "UTC -3:30", "offset": "-3.5" },
    { "zone": "CLST", "offset": "-3" },
    { "zone": "UTC -2:00", "offset": "-2" },
    { "zone": "UTC -1:00", "offset": "-1" },
    { "zone": "UTC +0:00", "offset": "0" },
    { "zone": "CET", "offset": "1" },
    { "zone": "CEST", "offset": "2" },
    { "zone": "EEST", "offset": "3" },
    { "zone": "UTC +3:30", "offset": "3" },
    { "zone": "UTC +4:00", "offset": "4" },
    { "zone": "UTC +4:30", "offset": "4" },
    { "zone": "UTC +5:00", "offset": "5" },
    { "zone": "UTC +5:30", "offset": "5" },
    { "zone": "UTC +6:00", "offset": "6" },
    { "zone": "UTC +7:00", "offset": "7" },
    { "zone": "SGT", "offset": "8" },
    { "zone": "UTC +9:00", "offset": "9" },
    { "zone": "UTC +9:30", "offset": "9" },
    { "zone": "UTC +10:00", "offset": "10" },
    { "zone": "UTC +11:00", "offset": "11" },
    { "zone": "UTC +12:00", "offset": "12" }
]

const selectedTimeZone = document.getElementById('selected-time-zone');
const listTimesZone = document.getElementById('list-times-zone');
const timesZone = document.getElementById('times-zone')
const listLangs = document.getElementById('list-langs');

const currentTime = Math.floor(new Date().getTime() / 1000);
const adjustedTimes = [];

timesZoneJson.forEach(entry => {
    const currentTimeCopy = new Date(currentTime + (entry.offset - 3) * 3600 * 1000);

    const formattedHours = String(currentTimeCopy.getHours()).padStart(2, '0');
    const formattedMinutes = String(currentTimeCopy.getMinutes()).padStart(2, '0');

    const formattedTime = `${formattedHours}:${formattedMinutes}`;

    adjustedTimes.push({
        "time": formattedTime,
        "zone": entry.zone,
        "offset": entry.offset
    });
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        listTimesZone.style.display = 'none';
    }
});


document.addEventListener('click', function(event) {
    if (!listTimesZone.contains(event.target) && event.target !== selectedTimeZone) {
        listTimesZone.style.display = 'none';
    }
});

selectedTimeZone.addEventListener('click', () => {
    addFocusStyles(selectedTimeZone);

    setTimeout(() => {
        removeFocusStyles(selectedTimeZone);
    }, 90);

    if(listTimesZone.style.display === 'none') {
        listTimesZone.style.display = 'block';

        if(listLangs.style.display === 'block') {
            listLangs.style.display = 'none';
        }


        while(timesZone.firstChild) {
            timesZone.removeChild(timesZone.firstChild);
        }

        adjustedTimes.map((adjustedTime) => {
            const timesZones = document.createElement('li')
            timesZones.ariaSelected = 'false';
            timesZones.role = 'option';
            timesZones.tabIndex = -1;
            timesZones.innerHTML = `
                    <button value=${adjustedTime.offset} class="w-full text-white text-left block py-2 px-4 whitespace-nowrap">
                        ${adjustedTime.time} ${adjustedTime.zone}
                    </button>`

            timesZones.addEventListener('mouseover', () => {
                timesZones.style.backgroundColor = '#718096';
                timesZones.addEventListener('click', () => {
                    selectedTimeZone.innerHTML = `
                     ${adjustedTime.time} ${adjustedTime.zone}
                    <svg class="ml-1 mt-1 md:mt-0 md:ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                `;

                    listTimesZone.style.display = 'none';
                    selectedTimeZone.value = adjustedTime.offset;
                })
            });
            timesZones.addEventListener('mouseout', () => {
                timesZones.style.backgroundColor = '';
            });

            timesZone.appendChild(timesZones);
        });

    } else {
        listTimesZone.style.display = 'none';
    }
});

function addFocusStyles(focusBlock) {
    focusBlock.classList.add('focus:z-10', 'focus:ring-4', 'focus:ring-gray-700');
}

function removeFocusStyles(focusBlock) {
    focusBlock.classList.remove('focus:z-10', 'focus:ring-4', 'focus:ring-gray-700');
}
