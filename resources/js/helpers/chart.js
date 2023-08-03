import { timestampToShortFormat, convertSecondsToMinutes } from "./time"
import { numberWithCommas, shortNumber } from "./common"
import { getTeamsConfig } from "./teams.js"
import t from "../i18n/messages.json"
import {languageSelected} from "./language.js"

const basicURL = import.meta.env.BASE_URL
const backendHost = import.meta.env.VITE_BACKEND_HOST

const getOrCreateTooltip = (chart) => {
  let tooltipEl = chart.canvas.parentNode.querySelector('div');

  if (!tooltipEl) {
    tooltipEl = document.createElement('div');
    tooltipEl
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
  }

  return tooltipEl;
};

const goldImgEl = (padding_x) => {
  const img = document.createElement("img")
  img.src = `${basicURL}media/icons/events/gold.png`
  img.style.display = 'inline-block'
  img.style.marginRight = padding_x ? padding_x : '3px'
  img.style.marginLeft = padding_x ? padding_x : '3px'
  img.style.width = '15px'
  return img
}

const diffImgEl = (padding_x) => {
  const img = document.createElement("img")
  img.src = `${basicURL}media/icons/events/diff.svg`
  img.style.display = 'inline-block'
  img.style.marginRight = padding_x ? padding_x : '3px'
  img.style.marginLeft = padding_x ? padding_x : '3px'
  img.style.opacity = '0.3'
  img.style.width = '19px'
  return img
}

const dmgImgEl = (padding_x) => {
  const img = document.createElement("img")
  img.src = `${basicURL}media/icons/events/dmg.svg`
  img.style.display = 'inline-block'
  img.style.marginRight = padding_x ? padding_x : '3px'
  img.style.marginLeft = padding_x ? padding_x : '3px'
  img.style.width = '15px'
  return img
}

const killImgEl = (padding_x) => {
  const img = document.createElement("img")
  img.src = `${basicURL}media/icons/events/swords.svg`
  img.style.display = 'inline-block'
  img.style.marginRight = padding_x ? padding_x : '3px'
  img.style.marginLeft = padding_x ? padding_x : '3px'
  img.style.width = '15px'
  return img
}

const heroImg = (hero_id, game_id) => {
  let img
  if (hero_id == 0) {
    img = document.createElement('div')
  } else {
    img = document.createElement("img")
    img.src = `${backendHost}/media/game/hero/${game_id}/_59/${hero_id}.png`
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

const timeView = (time) => {
  return convertSecondsToMinutes(time)
}

const shortNumberView = (gold) => {
  return gold != 0 ? `${shortNumber(Math.abs(gold))}` : 0
}

const oppositeFightSide = (side) => {
  return side == 't1' ? 't2' : (side == 't2' ? 't1' : side)
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
    const timeEl = document.createTextNode(timeView(fight.duration))
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
    rowEl.appendChild(sideEl('left', fight.side, t[languageSelected().id]?.events.roshan, 'side', teamsConfig, game_id))
  } else if (fight.type == 'nashor_kill') {
    rowEl.appendChild(sideEl('left', fight.side, t[languageSelected().id]?.events.nashor, 'side', teamsConfig, game_id))
  } else if (fight.type == 'building_destroy' || fight.type == 'dragon_kill') {
    rowEl.appendChild(sideEl('left', fight.side, t[languageSelected().id]?.events[fight.category], 'side', teamsConfig, game_id))
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

const AddGoldDmgRow = (type, parentEl, teamsConfig, event) => {
  const rowEl = document.createElement('div')
  rowEl.style.whiteSpace = 'nowrap'
  rowEl.style.padding = '2px'

  let valueLeft
  let valueRight
  let iconEl

  if (type == 'gold') {
    rowEl.style.color = 'rgb(227, 160, 8)'
    valueLeft = shortNumberView(event.team1_gold)
    valueRight = shortNumberView(event.team2_gold)
    iconEl = goldImgEl('5px')

  } else if (type == 'dmg') {
    rowEl.style.backgroundColor = 'rgba(255,0,0,0.05)'
    rowEl.style.color = 'rgb(224, 36, 36)'
    valueLeft = shortNumberView(event.team1_damage)
    valueRight = shortNumberView(event.team2_damage)
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

const AddGameEventRows = (contentArray, el) => {
  const parentEl = document.createElement('div')
  parentEl.style.display = 'flex'
  parentEl.style.flexDirection = 'column'
  const teamsConfig = getTeamsConfig(el.game_id)
  // console.log(el)
  // const parentEl = document.createElement('div')

  // contentArray.push(parentEl)
  el.game_events.forEach((event) => {
    if (event.type == 'fights') {
      // console.log(event)
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

const AddGoldDiffRows = (contentArray, el) => {
  const parentEl = document.createElement('div')
  const teamsConfig = getTeamsConfig(el.game_id)
  parentEl.style.textAlign = 'center'

  let goldDiffValue = `${shortNumberView(el.y)}`
  let timeValue = timeView(el.x)

  const timeValueText = document.createTextNode(timeValue)
  const goldDiffText = document.createTextNode(goldDiffValue)

  const spanLeft = document.createElement('span')
  // spanLeft.style.color = 'rgb(209, 213, 219)'
  spanLeft.style.color = 'rgb(140, 141, 145)'
  spanLeft.style.minHeight = '28px'
  spanLeft.style.display = 'inline-flex'
  spanLeft.style.alignItems = 'center'
  spanLeft.style.justifyContent = 'center'
  spanLeft.style.fontSize = '9px'
  spanLeft.style.width = '50px'

  spanLeft.appendChild(timeValueText)

  const spanRight = document.createElement('span')
  spanRight.style.color = 'rgb(227, 160, 8)'
  spanRight.style.minHeight = '28px'
  spanRight.style.display = 'inline-flex'
  spanRight.style.alignItems = 'center'
  spanRight.style.justifyContent = 'center'
  spanRight.style.width = '53px'
  spanRight.style.fontWeight = '600'

  if (el.y > 0) {
    spanRight.style.borderRightColor = teamsConfig['t1'].color
  } else {
    spanRight.style.borderRightColor = teamsConfig['t2'].color
  }

  spanRight.style.borderRightWidth = '3px'
  spanRight.appendChild(goldDiffText)

  parentEl.appendChild(spanLeft)
  parentEl.appendChild(diffImgEl())
  parentEl.appendChild(goldImgEl())
  parentEl.appendChild(spanRight)


  contentArray.push(parentEl)
}

// left

const mainContentEl = (data, tooltip) => {
  // let goldDiffValue
  // let timeValue
  let contentArray = []

  data.forEach((el, i) => {
    if (el.axis_crossing) {
      return
    } else if (el.game_events) {
      AddGameEventRows(contentArray, el)
    // } else {
    //   AddGoldDiffRows(contentArray, el, tooltip.labelColors[i])
    }


    // const spanRow = document.createElement('span')
    // spanRow.style.whiteSpace = 'nowrap'
    // spanRow.style.fontFamily = 'Inter'

    // spanContent.appendChild(spanRow)
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
  // Tooltip Element
  const {chart, tooltip} = context;
  // debugger

  // <img class="inline h-4" :src="`${basicURL}media/icons/events/gold.png`" alt="gold"></img>
  const tooltipEl = getOrCreateTooltip(chart);

  // Hide if no tooltip
  if (tooltip.opacity === 0) {
    tooltipEl.style.opacity = 0;
    return;
  }

  // Set Text
  if (tooltip.body) {

    const titleLines = tooltip.title || [];
    const bodyLines = tooltip.body.map(b => b.lines);

    const tableHead = document.createElement('thead');

    // titleLines.forEach(title => {
    //   const tr = document.createElement('tr');
    //   tr.style.borderWidth = 0;

    //   const th = document.createElement('th');
    //   th.style.borderWidth = 0;
    //   const text = document.createTextNode(title);

    //   th.appendChild(text);
    //   tr.appendChild(th);
    //   tableHead.appendChild(tr);
    // });

    let hideTooltip = false

    const tableBody = document.createElement('tbody');
    bodyLines.forEach((body, i) => {


      // const colors = tooltip.labelColors[i];

      // const span = document.createElement('span');
      // span.style.background = colors.backgroundColor;
      // span.style.borderColor = colors.borderColor;
      // span.style.borderWidth = '2px';
      // span.style.marginRight = '10px';
      // span.style.height = '10px';
      // span.style.width = '10px';
      // span.style.display = 'inline-block';

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

    // Remove old children
    while (tableRoot.firstChild) {
      tableRoot.firstChild.remove();
    }

    // Add new children
    tableRoot.appendChild(tableHead);
    tableRoot.appendChild(tableBody);
  }


  const {offsetLeft: positionX, offsetTop: positionY} = chart.canvas;

  tooltipEl.style.font = tooltip.options.bodyFont.string;
  tooltipEl.style.padding = tooltip.options.padding + 'px ' + tooltip.options.padding + 'px';

  let positionLeft = positionX + tooltip.caretX
  let positionTop = positionY + tooltip.caretY

  let leftOffset = chart.canvas.width - positionX - tooltip.caretX - tooltipEl.offsetWidth/3

  if (leftOffset < 0) positionLeft += leftOffset
  // if (positionTop-100 < 0) positionTop = 50

  tooltipEl.style.left = positionLeft + 'px';
  tooltipEl.style.top = positionTop + 'px';

  // Display, position, and set styles for font
  tooltipEl.style.opacity = 1;
};
