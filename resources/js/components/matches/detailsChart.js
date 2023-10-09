import {
    convertSecondsToMinutes,
    datapoints,
    externalTooltipHandler,
    label,
    labelColor,
    shortNumber,
    title
} from "../../chart";

export function addChart(dataGold, dataEvents) {
    const ctx = document.getElementById('myChart');

    if (ctx) {
        Chart.getChart(ctx)?.destroy();
    }

    const data =  {
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
                        if(gold.p1.parsed.y < 0 || gold.p0.parsed.y < 0) {
                            return 'rgba(194, 60, 42, 1)'
                        } else {
                            return 'rgba(146, 165, 37, 1)'
                        }
                    },
                    backgroundColor: (gold) => {
                        if(gold.p1.parsed.y < 0 || gold.p0.parsed.y < 0) {
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
            tooltip:  {
                enabled: false,
                displayColors: false,
                position: 'average',
                external: externalTooltipHandler,
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
                radius: function(ctx) {
                    if (ctx?.raw?.game_events) {
                        let fightSum = 4
                        ctx.raw.game_events.forEach((el) => el.type == 'fights' ? fightSum += el.fights.length : 0)
                        return fightSum
                    } else if (ctx?.raw?.axis_crossing) {
                        return 0
                    } else {
                        return 0
                    }
                },
                hitRadius: function(ctx) {
                    if (ctx?.raw?.game_events) {
                        return 2
                    } else {
                        return 0
                    }
                }
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
                    callback: function(val, index) {
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


export function addChartToHome(dataGold, dataEvents) {
    const ctx = document.getElementById('myChart');

    if (ctx) {
        Chart.getChart(ctx)?.destroy();
    }

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

