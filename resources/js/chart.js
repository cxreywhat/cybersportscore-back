import {isNullOrUndef} from "chart.js/helpers";

const ctx = document.getElementById('myChart');
let dataGold = null;
let dataEvents = null;

if(!isNullOrUndef(ctx)) {
    dataGold = JSON.parse(ctx.getAttribute('data-gold'));
    dataEvents = JSON.parse(ctx.getAttribute('data-events'));
    ctx.setAttribute('data-gold', '')
    ctx.setAttribute('data-events', '')
    dataEvents.sort((a, b) => b.duration - a.duration)
}


function kFormatter(num) {
    const absNum = Math.abs(num);
    return absNum > 999 ? Math.sign(num) * ((absNum / 1000).toFixed(1)) + 'k' : Math.sign(num) * absNum
}

export function convertSecondsToMinutes(duration) {
    if (duration && duration >=0) {
        return new Date(duration * 1000).toISOString().slice(14, 19);
    } else {
        return '00:00'
    }
}

export const shortNumber = (amount) => {
    let num = Math.abs(amount)

    if (num < 1000) {
        return amount;
    }

    if (num >= 1000) {
        return kFormatter(num);
    }
}

export const datapoints = (gold, events=null) => {
    let gold_timeline = gold.map((el)=> el.time).sort((a,b) => a - b)
    let gold_diffline = gold.map((el)=> el.diff)

    let goldMapping = {}
    let durations = []

    for (var i = 0; i < gold_timeline.length; i++) {
        durations.push(gold_timeline[i])
        goldMapping[gold_timeline[i]] = gold_diffline[i]
    }
    let eventsMapping

    if (events) {
        eventsMapping = events?.reduce(function (r, a) {
            r[a.duration] = r[a.duration] || []
            r[a.duration].push(a)
            return r
        }, Object.create(null))

        events?.forEach((el)=> durations.push(el.duration))

        durations = Array.from(new Set(durations)).sort((a,b) => a - b)
    }

    let result = []
    durations.forEach((time, index) => {
        let nextTime = durations[index+1]
        let currentGoldAmount = goldMapping[time] || gold?.findLast(el => el.time <= time)?.diff

        result.push({
            x: '' + (time || 0),
            y: currentGoldAmount,
            game_id: 582,
            game_events: eventsMapping ? eventsMapping[time] : null,
            axis_crossing: false
        })

        // insert axis crossing keypoint
        if (nextTime) {
            let nextGoldAmount = goldMapping[nextTime] || gold?.findLast(el => el.time <= nextTime)?.diff
            if (nextGoldAmount != 0 && currentGoldAmount != 0 && Math.sign(nextGoldAmount) != Math.sign(currentGoldAmount)) {

                let x = time - (nextTime-time)*currentGoldAmount/(nextGoldAmount-currentGoldAmount)

                result.push({
                    x: '' + (x || 0),
                    y: 0,
                    game_events: null,
                    axis_crossing: true
                })
            }
        }
    })

    return result
}

const getOrCreateTooltip = (chart) => {
    let tooltipEl = chart.canvas.parentNode.querySelector('div');

    if (!tooltipEl) {
        tooltipEl = document.createElement('div');
    }
    tooltipEl.style.background = 'rgba(24, 36, 49, 0.9)';
    tooltipEl.style.borderRadius = '8px';
    tooltipEl.style.color = 'white';
    tooltipEl.style.opacity = 1;
    tooltipEl.style.textAlign = 'center';
    tooltipEl.style.minWidth = '163px';
    tooltipEl.style.pointerEvents = 'none';
    tooltipEl.style.position = 'absolute';
    tooltipEl.style.transform = 'translate(-50%, 0%)';
    tooltipEl.style.zIndex = '100'
    tooltipEl.style.transition = 'all .2s ease';

    const table = document.createElement('table');
    table.style.margin = '0px';

    tooltipEl.appendChild(table);
    chart.canvas.parentNode.appendChild(tooltipEl);
    return tooltipEl;
};

const dmgImgEl = (padding_x) => {
    const img = document.createElement("img")
    img.src = "media/icons/events/dmg.svg"
    img.style.display = 'inline-block'
    img.style.marginRight = padding_x ? padding_x : '3px'
    img.style.marginLeft = padding_x ? padding_x : '3px'
    img.style.width = '15px'
    return img
}

const killImgEl = (padding_x) => {
    const img = document.createElement("img")
    img.src = "media/icons/events/swords.svg"
    img.style.display = 'inline-block'
    img.style.marginRight = padding_x ? padding_x : '3px'
    img.style.marginLeft = padding_x ? padding_x : '3px'
    img.style.width = '15px'
    return img
}

const goldImgEl = (padding_x) => {
    const img = document.createElement("img")
    img.src = "media/icons/events/gold.png"
    img.style.display = 'inline-block'
    img.style.marginRight = padding_x ? padding_x : '3px'
    img.style.marginLeft = padding_x ? padding_x : '3px'
    img.style.width = '15px'
    return img
}

const AddGoldDmgRow = (type, parentEl, teamsConfig, event) => {
    const rowEl = document.createElement('div')
    rowEl.style.whiteSpace = 'nowrap'
    rowEl.style.padding = '2px'

    let valueLeft
    let valueRight
    let iconEl

    if (type == 'gold') {
        rowEl.style.color = 'rgb(227, 160, 8)'
        valueLeft = shortNumber(event.team1_gold)
        valueRight = shortNumber(event.team2_gold)
        iconEl = goldImgEl('5px')

    } else if (type == 'dmg') {
        rowEl.style.backgroundColor = 'rgba(255,0,0,0.05)'
        rowEl.style.color = 'rgb(224, 36, 36)'
        valueLeft = shortNumber(event.team1_damage)
        valueRight =shortNumber(event.team2_damage)
        iconEl = dmgImgEl('5px')

    }

    if ( !valueLeft || !valueRight || (valueLeft == 0 && valueRight == 0) ) return

    rowEl.appendChild(sideEl('left', 't1', valueLeft, 'text', teamsConfig))
    const centerEl = document.createElement('div')
    centerEl.style.display = 'inline-block'
    centerEl.style.width = '30px'
    centerEl.appendChild(iconEl)
    rowEl.appendChild(centerEl)
    rowEl.appendChild(sideEl('right', 't2', valueRight, 'text', teamsConfig))

    parentEl.appendChild(rowEl)
}

const heroImg = (hero_id, game_id) => {
    let img
    if (hero_id == 0) {
        img = document.createElement('div')
    } else {
        img = document.createElement("img")
        img.src = `/media/game/hero/${game_id}/_59/${hero_id}.png`
    }

    img.style.display = 'inline-block'
    img.style.margin = 'auto'
    if (game_id == 313) {
        img.style.width = '35px'
    } else if (game_id == 582) {
        img.style.height = '25px'
    }
    return img
}

const sideEl = (side, winSide, value, valueType, teamsConfig, game_id=null) => {
    let contentEl
    if (valueType == 'text') {
        contentEl = document.createTextNode(value)
    } else if (valueType == 'hero_id') {
        contentEl = heroImg(value, game_id)
    } else if (valueType == 'hero_ids') {
        contentEl = document.createElement('div')
        value.forEach((hero_id) => {
            contentEl.style.display = 'flex'
            contentEl.style.flexDirection = 'column'
            contentEl.style.justifyContent = 'center'
            contentEl.style.height = '100%'
            const imgEl = heroImg(hero_id, game_id)
            imgEl.style.display = 'block'
            imgEl.style.marginTop = '3px'
            imgEl.style.marginBottom = '3px'
            contentEl.appendChild(imgEl)
        })
    } else if (valueType == 'side') {
        contentEl = document.createElement('div')
        contentEl.style.display = 'flex'
        // contentEl.style.paddingLeft = '5px'
        contentEl.style.width = '100%'
        contentEl.style.overflow = 'hidden'
        contentEl.style.textOverflow = 'ellipsis'
        contentEl.style.height = '35px'
        contentEl.style.fontSize = value?.length > 18 ? '10px' : '12px'
        // contentEl.style.flexDirection = 'column'
        contentEl.style.whiteSpace = 'nowrap'
        contentEl.style.alignItems = 'center'
        contentEl.style.justifyContent = 'start'

        let contentElText = document.createTextNode(value)

        contentEl.appendChild(killImgEl('7px'))
        contentEl.appendChild(contentElText)
    }

    const spanEl = document.createElement('div')
    spanEl.style.display = 'inline-block'
    if (valueType == 'side') {
        spanEl.style.width = '150px'
    } else {
        spanEl.style.width = '60px'
    }

    spanEl.style.minHeight = '28px'
    spanEl.style.fontWeight = '600'

    if (side == 'left') {
        spanEl.style.paddingLeft = '2px'
    } else {
        spanEl.style.paddingRight = '2px'
    }

    if (winSide == 't1' || winSide == 't2') {
        if (side == 'left') {
            spanEl.style.borderLeftColor = teamsConfig[winSide].color
            spanEl.style.borderLeftWidth = '3px'
        } else {
            spanEl.style.borderRightColor = teamsConfig[winSide].color
            spanEl.style.borderRightWidth = '3px'
        }
    }
    spanEl.appendChild(contentEl)
    return spanEl
}

const oppositeFightSide = (side) => {
    return side == 't1' ? 't2' : (side == 't2' ? 't1' : side)
}

const AddKillRow = (parentEl, teamsConfig, fight, game_id, contentArray=[]) => {
    const rowEl = document.createElement('div')
    rowEl.style.display = 'flex'
    rowEl.style.alignItems = 'center'
    rowEl.style.lineHeight = '15px'
    rowEl.style.justifyContent = 'center'
    rowEl.style.padding = '2px'

    const centerEl = document.createElement('div')
    centerEl.style.display = 'inline-flex'
    centerEl.style.justifyContent = 'center'
    centerEl.style.alignItems = 'center'
    centerEl.style.flexDirection = 'column'
    centerEl.style.textAlign = 'center'
    centerEl.style.color = 'rgb(140, 141, 145)'
    centerEl.style.fontSize = '9px'
    centerEl.style.width = '30px'
    centerEl.style.fontWeight = '600'
    centerEl.style.lineHeight = '16px'

    centerEl.appendChild(killImgEl('5px'))

    if (fight.duration > 0) {
        const timeEl = document.createTextNode(convertSecondsToMinutes(fight.duration))
        centerEl.appendChild(timeEl)
    }

    if (fight.type == 'kill') {
        rowEl.appendChild(sideEl('left', fight.side, fight.killer, 'hero_id', teamsConfig, game_id))
        rowEl.appendChild(centerEl)
        rowEl.appendChild(sideEl('right', oppositeFightSide(fight.side), fight.victim, 'hero_id', teamsConfig, game_id))
    } else if (fight.type == 'group_kill') {
        rowEl.style.display = 'flex'
        rowEl.style.backgroundColor = 'rgba(255,0,0,0.05)'
        rowEl.appendChild(sideEl('left', fight.side, fight.killers, 'hero_ids', teamsConfig, game_id))
        rowEl.appendChild(centerEl)
        rowEl.appendChild(sideEl('right', oppositeFightSide(fight.side), fight.victims, 'hero_ids', teamsConfig, game_id))
    } else if (fight.type == 'roshan_kill') {
        rowEl.appendChild(sideEl('left', fight.side, /*t[languageSelected().id]?.events.roshan*/ 'Рошан', 'side', teamsConfig, game_id))
    } else if (fight.type == 'nashor_kill') {
        rowEl.appendChild(sideEl('left', fight.side, /*t[languageSelected().id]?.events.nashor*/ 'Нашор', 'side', teamsConfig, game_id))
    } else if (fight.type == 'building_destroy' || fight.type == 'dragon_kill') {
        rowEl.appendChild(sideEl('left', fight.side, /*t[languageSelected().id]?.events[fight.category]*/ 'Тут евент', 'side', teamsConfig, game_id))
    } else if (fight.type == 'dota_building_destroy') {
        fight.buildings.forEach((building) => {
            // parentEl.appendChild(sideEl('left', fight.side, building, 'side', teamsConfig, game_id))
            const mRowEl = document.createElement('div')
            mRowEl.style.width = '100%'
            mRowEl.style.display = 'flex'
            mRowEl.style.alignItems = 'center'
            mRowEl.style.lineHeight = '15px'
            mRowEl.style.justifyContent = 'center'
            mRowEl.style.padding = '2px'
            mRowEl.appendChild(sideEl('left', fight.side, building, 'side', teamsConfig, game_id))
            parentEl.appendChild(mRowEl)
        })

    }

    parentEl.appendChild(rowEl)
}

const AddGameEventRows = (contentArray, el) => {
    const parentEl = document.createElement('div')
    parentEl.style.display = 'flex'
    parentEl.style.flexDirection = 'column'
    const teamsConfig = {
        t1: {
            color: "#92a525",
            bgColor: "rgba(152, 170, 40, 0.3)",
            colorClass: 'green-side',
            colorMapClass: 'green-side-map'
        },
        t2: {
            color: "#c23c2a",
            bgColor: "rgba(255,60, 42, 0.3)",
            colorClass: 'red-side',
            colorMapClass: 'red-side-map'
        }
    }

    el.game_events.forEach((event) => {
        if (event.type == 'fights') {
            AddGoldDmgRow('gold', parentEl, teamsConfig, event)
            AddGoldDmgRow('dmg', parentEl, teamsConfig, event)
            event.fights.forEach((fight) => {
                if (fight.type == 'kill' || fight.type == 'group_kill') {
                    AddKillRow(parentEl, teamsConfig, fight, el.game_id)
                }
            })
        } else {
            AddKillRow(parentEl, teamsConfig, event, el.game_id, contentArray)
        }
    })

    contentArray.push(parentEl)
}

const mainContentEl = (data, tooltip) => {
    let contentArray = []
    data.forEach((el, i) => {
        if (el.axis_crossing) {
            return
        } else if (el.game_events) {
            AddGameEventRows(contentArray, el)
        }
    })

    if (contentArray.length == 0) return

    const parentEl = document.createElement('div')
    parentEl.style.width = '100%'
    parentEl.style.fontSize = '11px'

    contentArray.forEach((el) => {
        parentEl.appendChild(el)
    })

    return parentEl
}

export const externalTooltipHandler = (context) => {
    const {chart, tooltip} = context;
    const tooltipEl = getOrCreateTooltip(chart);

    if (tooltip.opacity === 0) {
        tooltipEl.style.opacity = 0;
        return;
    }

    if (tooltip.body) {

        const titleLines = tooltip.title || [];
        const bodyLines = tooltip.body.map(b => b.lines);

        const tableHead = document.createElement('thead');

        let hideTooltip = false

        const tableBody = document.createElement('tbody');
        bodyLines.forEach((body, i) => {

            const tr = document.createElement('tr')
            tr.style.backgroundColor = 'inherit'
            tr.style.borderWidth = 0

            const td = document.createElement('td')
            td.style.textAlign = 'center'
            td.style.borderWidth = 0

            const contentEl = mainContentEl(body, tooltip)

            if (!contentEl) {
                hideTooltip = true
                return
            }

            td.appendChild(contentEl);
            tr.appendChild(td);
            tableBody.appendChild(tr);
        })

        if (hideTooltip) {
            tooltipEl.style.opacity = 0
            return
        }

        const tableRoot = tooltipEl.querySelector('table');


        while (tableRoot.firstChild) {
            tableRoot.firstChild.remove();
        }

        tableRoot.appendChild(tableHead);
        tableRoot.appendChild(tableBody);
    }


    const {offsetLeft: positionX, offsetTop: positionY} = chart.canvas;

    tooltipEl.style.font = tooltip.options.bodyFont.string;
    tooltipEl.style.padding = tooltip.options.padding + 'px ' + tooltip.options.padding + 'px';

    let positionLeft = positionX + tooltip.caretX
    let positionTop = positionY + tooltip.caretY

    let leftOffset = chart.canvas.width - positionX - tooltip.caretX - tooltipEl.offsetWidth/3

    if (leftOffset < 0)
        positionLeft += leftOffset

    tooltipEl.style.left = positionLeft + 'px';
    tooltipEl.style.top = positionTop + 'px';

    tooltipEl.style.opacity = 1;
};

export const labelColor = (item) => {
    if (item.parsed.y < 0 ) {
        return {
            borderColor:  "#c23c2a",
            backgroundColor: "rgba(255,60, 42, 0.3)",
        }
    } else {
        return {
            borderColor: "#92a525",
            backgroundColor: "rgba(152, 170, 40, 0.3)",
        }
    }
}



export const label = (data) => {
    return data.raw
}

export const title = (data) => {
    return data.raw
}

if(!isNullOrUndef(ctx)) {

    const data = {
        datasets: [
            {
                data: datapoints(dataGold, dataEvents) || [], // Ваши данные
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
                radius: function (ctx) {
                    if (ctx?.raw?.game_events) {
                        let defaultSize = 4
                        let fightSum = defaultSize
                        ctx.raw.game_events.forEach((el) => el.type == 'fights' ? fightSum += el.fights.length : 0)
                        return fightSum
                    } else if (ctx?.raw?.axis_crossing) {
                        return 0
                    } else {
                        return 0
                    }
                },
                hitRadius: function (ctx) {
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
