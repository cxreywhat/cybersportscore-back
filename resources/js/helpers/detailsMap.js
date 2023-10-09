import {convertSecondsToMinutes, datapoints, label, labelColor, shortNumber, title} from "../chart";
import {isNullOrUndef} from "chart.js/helpers";
import {checkDetailsMatch} from "./ajax";

checkDetailsMap()

export function checkDetailsMap() {
    let isActive = false;
    let prevGameId = null;
    const matchDetailsButtons = document.querySelectorAll('[id^="matchDetailsButton-"]');

    matchDetailsButtons.forEach(matchDetailsButton => {

        matchDetailsButton = removeAllEventListeners(matchDetailsButton)
        if(matchDetailsButton.classList.contains('cursor-pointer')) {
            matchDetailsButton.addEventListener('click', function () {
                const gameId = matchDetailsButton.id.split('-')[1];
                const numMap = matchDetailsButton.getAttribute('data-num-map');

                if (prevGameId !== gameId) {
                    isActive = false;

                    const prevDetails = document.getElementById('matchDetails-' + prevGameId);

                    prevGameId = gameId;

                    if (prevDetails) {
                        while (prevDetails.firstChild) {
                            prevDetails.removeChild(prevDetails.firstChild)
                            prevDetails.style.display = "none"
                        }
                    }
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                handleMatchDetailsClick(gameId, isActive, csrfToken, numMap);
            });
        }
    });
}

function handleMatchDetailsClick(gameId, isActive, csrfToken, num) {
    const details = document.getElementById('matchDetails-' + gameId);
    isActive = !isActive;
    if (details.style.display === 'none' || details.style.display === '') {
        details.style.display = 'flex';
    } else {
        details.style.display = 'none';
    }

    if (isActive) {
        checkDetailsMatch(gameId, num, csrfToken, details)
    }
}

function removeAllEventListeners(element) {
    const clonedElement = element.cloneNode(true);
    element.parentNode.replaceChild(clonedElement, element);
    return clonedElement;
}

export function insertChart() {
    const ctx = document.getElementById('myChart');

    const existingChart = Chart.getChart(ctx);
    if (existingChart) {
        existingChart.destroy();
    }

    if (!isNullOrUndef(ctx.getAttribute('data-gold')) && !isNullOrUndef(ctx.getAttribute('data-events'))) {
        const dataGold = JSON.parse(ctx.getAttribute('data-gold'));
        const dataEvents = JSON.parse(ctx.getAttribute('data-events'));

        let data = {
            datasets: [
                {
                    data: datapoints(dataGold, dataEvents) || [],
                    fill: {
                        target: 'origin',
                        above: 'rgba(146, 165, 37, 1)',
                        below: 'rgba(194, 60, 42, 1)'
                    },
                    borderColor: 'rgb(140, 149, 164)',
                    backgroundColor: 'rgba(140, 149, 164, 0.2)',
                    cubicInterpolationMode: 'monotone', spanGaps: false,
                    segment: {
                        borderColor: (gold) => {
                            if (gold.p1.parsed.y < 0 || gold.p0.parsed.y < 0) {
                                return 'rgba(194, 60, 42, 1)'
                            } else {
                                return 'rgba(146, 165, 37, 1)'
                            }
                        },
                        backgroundColor: (gold) => {
                            if (gold.p1.parsed.y < 0 || gold.p0.parsed.y < 0) {
                                return 'rgba(194, 60, 42, 0.25)'
                            } else {
                                return 'rgba(146, 165, 37, 0.25)'
                            }
                        },
                    }
                }
            ]
        };


        const options = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: false,
                    displayColors: false,
                    position: 'average',
                    callbacks: {
                        labelColor: labelColor,
                        label: label,
                        title: title
                    }
                }
            },
            interaction: {
                intersect: true,
                mode: 'x',
                includeInvisible: false
            },
            elements: {
                point: {
                    radius: 0,
                    hitRadius: 0,
                }
            },
            scales: {
                y: {
                    display: true,
                    grid: {
                        tickColor: "#374151",
                    },
                    ticks: {
                        color: 'rgb(169,171,182)',
                        beginAtZero: true,
                        callback: shortNumber
                    },
                    suggestedMin: -100,
                    suggestedMax: 100
                },
                x: {
                    display: true,
                    grid: {
                        tickColor: "#374151",
                    },
                    ticks: {
                        color: '#b6bac6',
                        beginAtZero: true,
                        callback: function (val, index) {
                            return convertSecondsToMinutes(this.getLabelForValue(val))
                        },
                    },
                }
            },
        }
        new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    }
}
