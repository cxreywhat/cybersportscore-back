/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/helpers/chart.js":
/*!***************************************!*\
  !*** ./resources/js/helpers/chart.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   externalTooltipHandler: () => (/* binding */ externalTooltipHandler)
/* harmony export */ });
/* harmony import */ var _time__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./time */ "./resources/js/helpers/time.js");
/* harmony import */ var _common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./common */ "./resources/js/helpers/common.js");
/* harmony import */ var _teams_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./teams.js */ "./resources/js/helpers/teams.js");
/* harmony import */ var _i18n_messages_json__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../i18n/messages.json */ "./resources/js/i18n/messages.json");
/* harmony import */ var _language_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./language.js */ "./resources/js/helpers/language.js");





var basicURL = /* unsupported import.meta.env.BASE_URL */ undefined.BASE_URL;
var backendHost = /* unsupported import.meta.env.VITE_BACKEND_HOST */ undefined.VITE_BACKEND_HOST;
var getOrCreateTooltip = function getOrCreateTooltip(chart) {
  var tooltipEl = chart.canvas.parentNode.querySelector('div');
  if (!tooltipEl) {
    tooltipEl = document.createElement('div');
    tooltipEl;
    tooltipEl.style.background = 'rgba(24, 36, 49, 0.9)';
    tooltipEl.style.borderRadius = '8px';
    tooltipEl.style.color = 'white';
    tooltipEl.style.opacity = 1;
    tooltipEl.style.textAlign = 'center';
    tooltipEl.style.minWidth = '163px';
    tooltipEl.style.pointerEvents = 'none';
    tooltipEl.style.position = 'absolute';
    tooltipEl.style.transform = 'translate(-50%, 0%)';
    tooltipEl.style.zIndex = '100';
    tooltipEl.style.transition = 'all .2s ease';
    var table = document.createElement('table');
    table.style.margin = '0px';
    tooltipEl.appendChild(table);
    chart.canvas.parentNode.appendChild(tooltipEl);
  }
  return tooltipEl;
};
var goldImgEl = function goldImgEl(padding_x) {
  var img = document.createElement("img");
  img.src = "".concat(basicURL, "media/icons/events/gold.png");
  img.style.display = 'inline-block';
  img.style.marginRight = padding_x ? padding_x : '3px';
  img.style.marginLeft = padding_x ? padding_x : '3px';
  img.style.width = '15px';
  return img;
};
var diffImgEl = function diffImgEl(padding_x) {
  var img = document.createElement("img");
  img.src = "".concat(basicURL, "media/icons/events/diff.svg");
  img.style.display = 'inline-block';
  img.style.marginRight = padding_x ? padding_x : '3px';
  img.style.marginLeft = padding_x ? padding_x : '3px';
  img.style.opacity = '0.3';
  img.style.width = '19px';
  return img;
};
var dmgImgEl = function dmgImgEl(padding_x) {
  var img = document.createElement("img");
  img.src = "".concat(basicURL, "media/icons/events/dmg.svg");
  img.style.display = 'inline-block';
  img.style.marginRight = padding_x ? padding_x : '3px';
  img.style.marginLeft = padding_x ? padding_x : '3px';
  img.style.width = '15px';
  return img;
};
var killImgEl = function killImgEl(padding_x) {
  var img = document.createElement("img");
  img.src = "".concat(basicURL, "media/icons/events/swords.svg");
  img.style.display = 'inline-block';
  img.style.marginRight = padding_x ? padding_x : '3px';
  img.style.marginLeft = padding_x ? padding_x : '3px';
  img.style.width = '15px';
  return img;
};
var heroImg = function heroImg(hero_id, game_id) {
  var img;
  if (hero_id == 0) {
    img = document.createElement('div');
  } else {
    img = document.createElement("img");
    img.src = "".concat(backendHost, "/media/game/hero/").concat(game_id, "/_59/").concat(hero_id, ".png");
  }
  img.style.display = 'inline-block';
  img.style.margin = 'auto';
  if (game_id == 313) {
    img.style.width = '35px';
  } else if (game_id == 582) {
    img.style.height = '25px';
  }
  return img;
};
var timeView = function timeView(time) {
  return (0,_time__WEBPACK_IMPORTED_MODULE_0__.convertSecondsToMinutes)(time);
};
var shortNumberView = function shortNumberView(gold) {
  return gold != 0 ? "".concat((0,_common__WEBPACK_IMPORTED_MODULE_1__.shortNumber)(Math.abs(gold))) : 0;
};
var oppositeFightSide = function oppositeFightSide(side) {
  return side == 't1' ? 't2' : side == 't2' ? 't1' : side;
};
var sideEl = function sideEl(side, winSide, value, valueType, teamsConfig) {
  var game_id = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : null;
  var contentEl;
  if (valueType == 'text') {
    contentEl = document.createTextNode(value);
  } else if (valueType == 'hero_id') {
    contentEl = heroImg(value, game_id);
  } else if (valueType == 'hero_ids') {
    contentEl = document.createElement('div');
    value.forEach(function (hero_id) {
      contentEl.style.display = 'flex';
      contentEl.style.flexDirection = 'column';
      contentEl.style.justifyContent = 'center';
      contentEl.style.height = '100%';
      var imgEl = heroImg(hero_id, game_id);
      imgEl.style.display = 'block';
      imgEl.style.marginTop = '3px';
      imgEl.style.marginBottom = '3px';
      contentEl.appendChild(imgEl);
    });
  } else if (valueType == 'side') {
    contentEl = document.createElement('div');
    contentEl.style.display = 'flex';
    // contentEl.style.paddingLeft = '5px'
    contentEl.style.width = '100%';
    contentEl.style.overflow = 'hidden';
    contentEl.style.textOverflow = 'ellipsis';
    contentEl.style.height = '35px';
    contentEl.style.fontSize = (value === null || value === void 0 ? void 0 : value.length) > 18 ? '10px' : '12px';
    // contentEl.style.flexDirection = 'column'
    contentEl.style.whiteSpace = 'nowrap';
    contentEl.style.alignItems = 'center';
    contentEl.style.justifyContent = 'start';
    var contentElText = document.createTextNode(value);
    contentEl.appendChild(killImgEl('7px'));
    contentEl.appendChild(contentElText);
  }
  var spanEl = document.createElement('div');
  spanEl.style.display = 'inline-block';
  if (valueType == 'side') {
    spanEl.style.width = '150px';
  } else {
    spanEl.style.width = '60px';
  }
  spanEl.style.minHeight = '28px';
  spanEl.style.fontWeight = '600';
  if (side == 'left') {
    spanEl.style.paddingLeft = '2px';
  } else {
    spanEl.style.paddingRight = '2px';
  }
  if (winSide == 't1' || winSide == 't2') {
    if (side == 'left') {
      spanEl.style.borderLeftColor = teamsConfig[winSide].color;
      spanEl.style.borderLeftWidth = '3px';
    } else {
      spanEl.style.borderRightColor = teamsConfig[winSide].color;
      spanEl.style.borderRightWidth = '3px';
    }
  }
  spanEl.appendChild(contentEl);
  return spanEl;
};
var AddKillRow = function AddKillRow(parentEl, teamsConfig, fight, game_id) {
  var contentArray = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : [];
  var rowEl = document.createElement('div');
  rowEl.style.display = 'flex';
  rowEl.style.alignItems = 'center';
  rowEl.style.lineHeight = '15px';
  rowEl.style.justifyContent = 'center';
  rowEl.style.padding = '2px';
  var centerEl = document.createElement('div');
  centerEl.style.display = 'inline-flex';
  centerEl.style.justifyContent = 'center';
  centerEl.style.alignItems = 'center';
  centerEl.style.flexDirection = 'column';
  centerEl.style.textAlign = 'center';
  centerEl.style.color = 'rgb(140, 141, 145)';
  centerEl.style.fontSize = '9px';
  centerEl.style.width = '30px';
  centerEl.style.fontWeight = '600';
  centerEl.style.lineHeight = '16px';
  centerEl.appendChild(killImgEl('5px'));
  if (fight.duration > 0) {
    var timeEl = document.createTextNode(timeView(fight.duration));
    centerEl.appendChild(timeEl);
  }
  if (fight.type == 'kill') {
    rowEl.appendChild(sideEl('left', fight.side, fight.killer, 'hero_id', teamsConfig, game_id));
    rowEl.appendChild(centerEl);
    rowEl.appendChild(sideEl('right', oppositeFightSide(fight.side), fight.victim, 'hero_id', teamsConfig, game_id));
  } else if (fight.type == 'group_kill') {
    rowEl.style.display = 'flex';
    rowEl.style.backgroundColor = 'rgba(255,0,0,0.05)';
    rowEl.appendChild(sideEl('left', fight.side, fight.killers, 'hero_ids', teamsConfig, game_id));
    rowEl.appendChild(centerEl);
    rowEl.appendChild(sideEl('right', oppositeFightSide(fight.side), fight.victims, 'hero_ids', teamsConfig, game_id));
  } else if (fight.type == 'roshan_kill') {
    var _t$languageSelected$i;
    rowEl.appendChild(sideEl('left', fight.side, (_t$languageSelected$i = _i18n_messages_json__WEBPACK_IMPORTED_MODULE_3__[(0,_language_js__WEBPACK_IMPORTED_MODULE_4__.languageSelected)().id]) === null || _t$languageSelected$i === void 0 ? void 0 : _t$languageSelected$i.events.roshan, 'side', teamsConfig, game_id));
  } else if (fight.type == 'nashor_kill') {
    var _t$languageSelected$i2;
    rowEl.appendChild(sideEl('left', fight.side, (_t$languageSelected$i2 = _i18n_messages_json__WEBPACK_IMPORTED_MODULE_3__[(0,_language_js__WEBPACK_IMPORTED_MODULE_4__.languageSelected)().id]) === null || _t$languageSelected$i2 === void 0 ? void 0 : _t$languageSelected$i2.events.nashor, 'side', teamsConfig, game_id));
  } else if (fight.type == 'building_destroy' || fight.type == 'dragon_kill') {
    var _t$languageSelected$i3;
    rowEl.appendChild(sideEl('left', fight.side, (_t$languageSelected$i3 = _i18n_messages_json__WEBPACK_IMPORTED_MODULE_3__[(0,_language_js__WEBPACK_IMPORTED_MODULE_4__.languageSelected)().id]) === null || _t$languageSelected$i3 === void 0 ? void 0 : _t$languageSelected$i3.events[fight.category], 'side', teamsConfig, game_id));
  } else if (fight.type == 'dota_building_destroy') {
    fight.buildings.forEach(function (building) {
      // parentEl.appendChild(sideEl('left', fight.side, building, 'side', teamsConfig, game_id))
      var mRowEl = document.createElement('div');
      mRowEl.style.width = '100%';
      mRowEl.style.display = 'flex';
      mRowEl.style.alignItems = 'center';
      mRowEl.style.lineHeight = '15px';
      mRowEl.style.justifyContent = 'center';
      mRowEl.style.padding = '2px';
      mRowEl.appendChild(sideEl('left', fight.side, building, 'side', teamsConfig, game_id));
      parentEl.appendChild(mRowEl);
    });
  }
  parentEl.appendChild(rowEl);
};
var AddGoldDmgRow = function AddGoldDmgRow(type, parentEl, teamsConfig, event) {
  var rowEl = document.createElement('div');
  rowEl.style.whiteSpace = 'nowrap';
  rowEl.style.padding = '2px';
  var valueLeft;
  var valueRight;
  var iconEl;
  if (type == 'gold') {
    rowEl.style.color = 'rgb(227, 160, 8)';
    valueLeft = shortNumberView(event.team1_gold);
    valueRight = shortNumberView(event.team2_gold);
    iconEl = goldImgEl('5px');
  } else if (type == 'dmg') {
    rowEl.style.backgroundColor = 'rgba(255,0,0,0.05)';
    rowEl.style.color = 'rgb(224, 36, 36)';
    valueLeft = shortNumberView(event.team1_damage);
    valueRight = shortNumberView(event.team2_damage);
    iconEl = dmgImgEl('5px');
  }
  if (!valueLeft || !valueRight || valueLeft == 0 && valueRight == 0) return;
  rowEl.appendChild(sideEl('left', 't1', valueLeft, 'text', teamsConfig));
  var centerEl = document.createElement('div');
  centerEl.style.display = 'inline-block';
  centerEl.style.width = '30px';
  centerEl.appendChild(iconEl);
  rowEl.appendChild(centerEl);
  rowEl.appendChild(sideEl('right', 't2', valueRight, 'text', teamsConfig));
  parentEl.appendChild(rowEl);
};
var AddGameEventRows = function AddGameEventRows(contentArray, el) {
  var parentEl = document.createElement('div');
  parentEl.style.display = 'flex';
  parentEl.style.flexDirection = 'column';
  var teamsConfig = (0,_teams_js__WEBPACK_IMPORTED_MODULE_2__.getTeamsConfig)(el.game_id);
  // console.log(el)
  // const parentEl = document.createElement('div')

  // contentArray.push(parentEl)
  el.game_events.forEach(function (event) {
    if (event.type == 'fights') {
      // console.log(event)
      AddGoldDmgRow('gold', parentEl, teamsConfig, event);
      AddGoldDmgRow('dmg', parentEl, teamsConfig, event);
      event.fights.forEach(function (fight) {
        if (fight.type == 'kill' || fight.type == 'group_kill') {
          AddKillRow(parentEl, teamsConfig, fight, el.game_id);
        }
      });
    } else {
      AddKillRow(parentEl, teamsConfig, event, el.game_id, contentArray);
    }
  });
  contentArray.push(parentEl);
};
var AddGoldDiffRows = function AddGoldDiffRows(contentArray, el) {
  var parentEl = document.createElement('div');
  var teamsConfig = (0,_teams_js__WEBPACK_IMPORTED_MODULE_2__.getTeamsConfig)(el.game_id);
  parentEl.style.textAlign = 'center';
  var goldDiffValue = "".concat(shortNumberView(el.y));
  var timeValue = timeView(el.x);
  var timeValueText = document.createTextNode(timeValue);
  var goldDiffText = document.createTextNode(goldDiffValue);
  var spanLeft = document.createElement('span');
  // spanLeft.style.color = 'rgb(209, 213, 219)'
  spanLeft.style.color = 'rgb(140, 141, 145)';
  spanLeft.style.minHeight = '28px';
  spanLeft.style.display = 'inline-flex';
  spanLeft.style.alignItems = 'center';
  spanLeft.style.justifyContent = 'center';
  spanLeft.style.fontSize = '9px';
  spanLeft.style.width = '50px';
  spanLeft.appendChild(timeValueText);
  var spanRight = document.createElement('span');
  spanRight.style.color = 'rgb(227, 160, 8)';
  spanRight.style.minHeight = '28px';
  spanRight.style.display = 'inline-flex';
  spanRight.style.alignItems = 'center';
  spanRight.style.justifyContent = 'center';
  spanRight.style.width = '53px';
  spanRight.style.fontWeight = '600';
  if (el.y > 0) {
    spanRight.style.borderRightColor = teamsConfig['t1'].color;
  } else {
    spanRight.style.borderRightColor = teamsConfig['t2'].color;
  }
  spanRight.style.borderRightWidth = '3px';
  spanRight.appendChild(goldDiffText);
  parentEl.appendChild(spanLeft);
  parentEl.appendChild(diffImgEl());
  parentEl.appendChild(goldImgEl());
  parentEl.appendChild(spanRight);
  contentArray.push(parentEl);
};

// left

var mainContentEl = function mainContentEl(data, tooltip) {
  // let goldDiffValue
  // let timeValue
  var contentArray = [];
  data.forEach(function (el, i) {
    if (el.axis_crossing) {
      return;
    } else if (el.game_events) {
      AddGameEventRows(contentArray, el);
      // } else {
      //   AddGoldDiffRows(contentArray, el, tooltip.labelColors[i])
    }

    // const spanRow = document.createElement('span')
    // spanRow.style.whiteSpace = 'nowrap'
    // spanRow.style.fontFamily = 'Inter'

    // spanContent.appendChild(spanRow)
  });

  if (contentArray.length == 0) return;
  var parentEl = document.createElement('div');
  parentEl.style.width = '100%';
  parentEl.style.fontSize = '11px';
  contentArray.forEach(function (el) {
    parentEl.appendChild(el);
  });
  return parentEl;
};
var externalTooltipHandler = function externalTooltipHandler(context) {
  // Tooltip Element
  var chart = context.chart,
    tooltip = context.tooltip;
  // debugger

  // <img class="inline h-4" :src="`${basicURL}media/icons/events/gold.png`" alt="gold"></img>
  var tooltipEl = getOrCreateTooltip(chart);

  // Hide if no tooltip
  if (tooltip.opacity === 0) {
    tooltipEl.style.opacity = 0;
    return;
  }

  // Set Text
  if (tooltip.body) {
    var titleLines = tooltip.title || [];
    var bodyLines = tooltip.body.map(function (b) {
      return b.lines;
    });
    var tableHead = document.createElement('thead');

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

    var hideTooltip = false;
    var tableBody = document.createElement('tbody');
    bodyLines.forEach(function (body, i) {
      // const colors = tooltip.labelColors[i];

      // const span = document.createElement('span');
      // span.style.background = colors.backgroundColor;
      // span.style.borderColor = colors.borderColor;
      // span.style.borderWidth = '2px';
      // span.style.marginRight = '10px';
      // span.style.height = '10px';
      // span.style.width = '10px';
      // span.style.display = 'inline-block';

      var tr = document.createElement('tr');
      tr.style.backgroundColor = 'inherit';
      tr.style.borderWidth = 0;
      var td = document.createElement('td');
      td.style.textAlign = 'center';
      td.style.borderWidth = 0;
      var contentEl = mainContentEl(body, tooltip);
      if (!contentEl) {
        hideTooltip = true;
        return;
      }
      td.appendChild(contentEl);
      tr.appendChild(td);
      tableBody.appendChild(tr);
    });
    if (hideTooltip) {
      tooltipEl.style.opacity = 0;
      return;
    }
    var tableRoot = tooltipEl.querySelector('table');

    // Remove old children
    while (tableRoot.firstChild) {
      tableRoot.firstChild.remove();
    }

    // Add new children
    tableRoot.appendChild(tableHead);
    tableRoot.appendChild(tableBody);
  }
  var _chart$canvas = chart.canvas,
    positionX = _chart$canvas.offsetLeft,
    positionY = _chart$canvas.offsetTop;
  tooltipEl.style.font = tooltip.options.bodyFont.string;
  tooltipEl.style.padding = tooltip.options.padding + 'px ' + tooltip.options.padding + 'px';
  var positionLeft = positionX + tooltip.caretX;
  var positionTop = positionY + tooltip.caretY;
  var leftOffset = chart.canvas.width - positionX - tooltip.caretX - tooltipEl.offsetWidth / 3;
  if (leftOffset < 0) positionLeft += leftOffset;
  // if (positionTop-100 < 0) positionTop = 50

  tooltipEl.style.left = positionLeft + 'px';
  tooltipEl.style.top = positionTop + 'px';

  // Display, position, and set styles for font
  tooltipEl.style.opacity = 1;
};

/***/ }),

/***/ "./resources/js/helpers/common.js":
/*!****************************************!*\
  !*** ./resources/js/helpers/common.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   numberWithCommas: () => (/* binding */ numberWithCommas),
/* harmony export */   shortNumber: () => (/* binding */ shortNumber)
/* harmony export */ });
Array.prototype.max = function () {
  return Math.max.apply(null, this);
};
Array.prototype.min = function () {
  return Math.min.apply(null, this);
};
var numberWithCommas = function numberWithCommas(x) {
  if (!x) {
    return;
  }
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
function kFormatter(num) {
  return Math.abs(num) > 999 ? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + 'k' : Math.sign(num) * Math.abs(num);
}
var shortNumber = function shortNumber(amount) {
  var num = Math.abs(amount);
  if (num < 1000) {
    return amount;
  }
  if (num >= 1000) {
    return kFormatter(num);
  }
};

/***/ }),

/***/ "./resources/js/helpers/language.js":
/*!******************************************!*\
  !*** ./resources/js/helpers/language.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   currentLang: () => (/* binding */ currentLang),
/* harmony export */   currentLangForRoute: () => (/* binding */ currentLangForRoute),
/* harmony export */   currentLangForRouter: () => (/* binding */ currentLangForRouter),
/* harmony export */   defaultRouteLang: () => (/* binding */ defaultRouteLang),
/* harmony export */   langRedirect: () => (/* binding */ langRedirect),
/* harmony export */   languageCollection: () => (/* binding */ languageCollection),
/* harmony export */   languageSelected: () => (/* binding */ languageSelected),
/* harmony export */   saveLanguage: () => (/* binding */ saveLanguage)
/* harmony export */ });
/* harmony import */ var _route__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./route */ "./resources/js/helpers/route.js");

var defaultRouteLang = 'en';
var languageCollection = [{
  id: 'en',
  title: 'English'
}, {
  id: 'ru',
  title: 'Русский'
}, {
  id: 'uk',
  title: 'Українська'
}, {
  id: 'zh',
  title: '中文'
}];
var currentLang = function currentLang(store, route) {
  var _store$getters, _route$query;
  return (store === null || store === void 0 || (_store$getters = store.getters) === null || _store$getters === void 0 ? void 0 : _store$getters.lang) || (route === null || route === void 0 || (_route$query = route.query) === null || _route$query === void 0 ? void 0 : _route$query.lang) || defaultRouteLang;
};
var currentLangForRoute = function currentLangForRoute(store, route) {
  var _lang = currentLang(store, route);
  if (_lang == defaultRouteLang) {
    return null;
  }
  return _lang;
};
var currentLangForRouter = function currentLangForRouter(store, route) {
  var _lang = currentLang(store, route);
  if (!_lang) {
    return defaultRouteLang;
  }
  return _lang;
};
var saveLanguage = function saveLanguage(el) {
  localStorage.setItem('lang', el.id);
};
var langRedirect = function langRedirect(router, route, lang) {
  var locale = lang.id;
  if ((route.name == 'home' || !route.name) && lang.id == defaultRouteLang) {
    locale = null;
  } else if (lang.id == defaultRouteLang) {
    locale = null;
  }
  return (0,_route__WEBPACK_IMPORTED_MODULE_0__.routerReplace)(router, route, {
    params: {
      locale: locale,
      game: route.params.game
    }
  });
};
var languageSelected = function languageSelected() {
  var _localStorage$getItem;
  var langFromUrl = getLanguageFromUrl();
  if (langFromUrl) {
    return langFromUrl;
  }
  var userLang = (_localStorage$getItem = localStorage.getItem('lang')) !== null && _localStorage$getItem !== void 0 ? _localStorage$getItem : userLanguage();
  var langInList = languageCollection.find(function (el) {
    return el.id == userLang;
  });
  if (langInList) {
    return langInList;
  } else {
    return languageCollection[0];
  }
};
var userLanguage = function userLanguage() {
  return window.navigator.userLanguage || window.navigator.language || 'en';
};
var getLanguageFromUrl = function getLanguageFromUrl() {
  var locale = window.location.pathname.replace(/^\/([^\/]+).*/i, '$1');
  if (locale != '/') {
    var languageFromList = languageCollection.find(function (el) {
      return el.id == locale;
    });
    if (languageFromList) {
      return languageFromList;
    }
  }
  return null;
};

/***/ }),

/***/ "./resources/js/helpers/pagination.js":
/*!********************************************!*\
  !*** ./resources/js/helpers/pagination.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getPaginationFromResponse: () => (/* binding */ getPaginationFromResponse)
/* harmony export */ });
var getPaginationFromResponse = function getPaginationFromResponse(response) {
  return {
    currentPage: response.data.meta.current_page,
    lastPage: response.data.meta.last_page
  };
};

/***/ }),

/***/ "./resources/js/helpers/route.js":
/*!***************************************!*\
  !*** ./resources/js/helpers/route.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   routerReplace: () => (/* binding */ routerReplace)
/* harmony export */ });
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(arr, i) { var _i = null == arr ? null : "undefined" != typeof Symbol && arr[Symbol.iterator] || arr["@@iterator"]; if (null != _i) { var _s, _e, _x, _r, _arr = [], _n = !0, _d = !1; try { if (_x = (_i = _i.call(arr)).next, 0 === i) { if (Object(_i) !== _i) return; _n = !1; } else for (; !(_n = (_s = _x.call(_i)).done) && (_arr.push(_s.value), _arr.length !== i); _n = !0); } catch (err) { _d = !0, _e = err; } finally { try { if (!_n && null != _i["return"] && (_r = _i["return"](), Object(_r) !== _r)) return; } finally { if (_d) throw _e; } } return _arr; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
// @router: useRouter
// @route: useRoute
// @data { name: {}, query: {}, params: {}}

var routerReplace = function routerReplace(router, route, data) {
  var params = _objectSpread(_objectSpread({}, route.params), data.params);
  var query = _objectSpread(_objectSpread({}, route.query), data.query);
  params = Object.entries(params).reduce(function (a, _ref) {
    var _ref2 = _slicedToArray(_ref, 2),
      k = _ref2[0],
      v = _ref2[1];
    return v == null ? a : (a[k] = v, a);
  }, {});
  query = Object.entries(query).reduce(function (a, _ref3) {
    var _ref4 = _slicedToArray(_ref3, 2),
      k = _ref4[0],
      v = _ref4[1];
    return v == null ? a : (a[k] = v, a);
  }, {});
  return new Promise(function (resolve) {
    resolve(router.push({
      name: data.name || route.name,
      hash: data.hash || route.hash,
      params: params,
      query: query
    }));
  });
};

/***/ }),

/***/ "./resources/js/helpers/status.js":
/*!****************************************!*\
  !*** ./resources/js/helpers/status.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   calcStatus: () => (/* binding */ calcStatus)
/* harmony export */ });
var calcStatus = function calcStatus(details) {
  var _details$teams$, _details$teams$2;
  var num_live = (details === null || details === void 0 ? void 0 : details.num_live) || (details === null || details === void 0 ? void 0 : details.num) || 0;
  var num = (details === null || details === void 0 ? void 0 : details.num) || 0;
  var t1Score = (details === null || details === void 0 || (_details$teams$ = details.teams[0]) === null || _details$teams$ === void 0 ? void 0 : _details$teams$.match_score) || 0;
  var t2Score = (details === null || details === void 0 || (_details$teams$2 = details.teams[1]) === null || _details$teams$2 === void 0 ? void 0 : _details$teams$2.match_score) || 0;
  var duration = (details === null || details === void 0 ? void 0 : details.duration) || 0;
  var matchDataPresent = details === null || details === void 0 ? void 0 : details.has_match_data;
  var matchDataNotPresent = !(details !== null && details !== void 0 && details.has_match_data);
  var winner = details === null || details === void 0 ? void 0 : details.winner;
  var MatchStartTime = (details === null || details === void 0 ? void 0 : details.datetime) || 0;
  var isLive = (details === null || details === void 0 ? void 0 : details.is_live) || matchDataPresent;
  var isCurrentMapLive = num > t1Score + t2Score && isLive;
  var isPickBansPhase = duration == 0 && ((details === null || details === void 0 ? void 0 : details.has_picks) || (details === null || details === void 0 ? void 0 : details.has_bans));
  var isCurrentMapNotStarted = isCurrentMapLive && (isPickBansPhase || matchDataNotPresent);
  var isCurrentMapStarted = isCurrentMapLive && matchDataPresent && duration >= 0;
  var isCurrentMapEnded = num > 0 && num <= t1Score + t2Score || !!winner;
  var isBreak = isCurrentMapNotStarted;
  var withPreview = isLive || MatchStartTime < getTimestampInSeconds();
  return {
    isLive: isLive,
    withPreview: withPreview,
    isCurrentMapLive: isCurrentMapLive,
    isPickBansPhase: isPickBansPhase,
    isCurrentMapNotStarted: isCurrentMapNotStarted,
    isCurrentMapStarted: isCurrentMapStarted,
    isCurrentMapEnded: isCurrentMapEnded,
    isBreak: isBreak,
    hasWinner: winner
  };
};
function getTimestampInSeconds() {
  return Math.floor(Date.now() / 1000);
}

/***/ }),

/***/ "./resources/js/helpers/teams.js":
/*!***************************************!*\
  !*** ./resources/js/helpers/teams.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getTeamsConfig: () => (/* binding */ getTeamsConfig)
/* harmony export */ });
var getTeamsConfig = function getTeamsConfig(gameId) {
  if (gameId == 582) {
    return {
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
    };
  } else if (gameId == 313) {
    return {
      t1: {
        color: "#0085be",
        bgColor: "rgba(0, 133, 190, 0.3)",
        colorClass: 'blue-side',
        colorMapClass: 'blue-side-map'
      },
      t2: {
        color: "#c23c2a",
        bgColor: "rgba(255,60, 42, 0.3)",
        colorClass: 'red-side',
        colorMapClass: 'red-side-map'
      }
    };
  }
};

/***/ }),

/***/ "./resources/js/helpers/time.js":
/*!**************************************!*\
  !*** ./resources/js/helpers/time.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   convertSecondsToMinutes: () => (/* binding */ convertSecondsToMinutes),
/* harmony export */   dateToShortFormat: () => (/* binding */ dateToShortFormat),
/* harmony export */   saveTimeZoneOffset: () => (/* binding */ saveTimeZoneOffset),
/* harmony export */   timeListCollection: () => (/* binding */ timeListCollection),
/* harmony export */   timeZoneSelected: () => (/* binding */ timeZoneSelected),
/* harmony export */   timestampToShortFormat: () => (/* binding */ timestampToShortFormat),
/* harmony export */   timezones: () => (/* binding */ timezones)
/* harmony export */ });
var timezones = [{
  'title': 'UTC -12:00',
  'abbr': '',
  'offset': -720
}, {
  'title': 'UTC -11:00',
  'abbr': '',
  'offset': -660
}, {
  'title': 'UTC -10:00',
  'abbr': '',
  'offset': -600
}, {
  'title': 'UTC -9:00',
  'abbr': '',
  'offset': -540
}, {
  'title': 'UTC -8:00',
  'abbr': 'PST',
  'offset': -480
}, {
  'title': 'UTC -7:00',
  'abbr': 'PDT',
  'offset': -420
}, {
  'title': 'UTC -6:00',
  'abbr': 'CST',
  'offset': -360
}, {
  'title': 'UTC -5:00',
  'abbr': 'EST',
  'offset': -300
}, {
  'title': 'UTC -4:00',
  'abbr': 'EDT',
  'offset': -240
}, {
  'title': 'UTC -3:30',
  'abbr': '',
  'offset': -210
}, {
  'title': 'UTC -3:00',
  'abbr': 'CLST',
  'offset': -180
}, {
  'title': 'UTC -2:00',
  'abbr': '',
  'offset': -120
}, {
  'title': 'UTC -1:00',
  'abbr': '',
  'offset': -60
}, {
  'title': 'UTC +0:00',
  'abbr': '',
  'offset': 0
}, {
  'title': 'UTC +1:00',
  'abbr': 'CET',
  'offset': 60
}, {
  'title': 'UTC +2:00',
  'abbr': 'CEST',
  'offset': 120
}, {
  'title': 'UTC +3:00',
  'abbr': 'EEST',
  'offset': 180
}, {
  'title': 'UTC +3:30',
  'abbr': '',
  'offset': 210
}, {
  'title': 'UTC +4:00',
  'abbr': '',
  'offset': 240
}, {
  'title': 'UTC +4:30',
  'abbr': '',
  'offset': 270
}, {
  'title': 'UTC +5:00',
  'abbr': '',
  'offset': 300
}, {
  'title': 'UTC +5:30',
  'abbr': '',
  'offset': 330
}, {
  'title': 'UTC +6:00',
  'abbr': '',
  'offset': 360
}, {
  'title': 'UTC +7:00',
  'abbr': '',
  'offset': 420
}, {
  'title': 'UTC +8:00',
  'abbr': 'SGT',
  'offset': 480
}, {
  'title': 'UTC +9:00',
  'abbr': '',
  'offset': 540
}, {
  'title': 'UTC +9:30',
  'abbr': '',
  'offset': 570
}, {
  'title': 'UTC +10:00',
  'abbr': '',
  'offset': 600
}, {
  'title': 'UTC +11:00',
  'abbr': '',
  'offset': 660
}, {
  'title': 'UTC +12:00',
  'abbr': '',
  'offset': 720
}];
var saveTimeZoneOffset = function saveTimeZoneOffset(el) {
  localStorage.setItem('tz_offset', el.id);
};
var timeZoneSelected = function timeZoneSelected(timeList) {
  var result = timeList.find(function (el) {
    return el.id == localTzOffset();
  });
  if (result) {
    return result;
  } else {
    return timeList.find(function (el) {
      return el.id == 0;
    }); // return UTC
  }
};

var timeListCollection = function timeListCollection() {
  var result = [];
  var timestamp = Date.now();
  timezones.forEach(function (timezone) {
    var date = new Date(timezone.offset * 60 * 1000 + timestamp);
    var title = timezone.abbr ? timezone.abbr : timezone.title;
    // let title = (timezone.abbr ? `(${timezone.title}) ${timezone.abbr}` : `(${timezone.title})`)
    title = "".concat(hhmm(date), " ").concat(title);
    result.push({
      id: timezone.offset,
      title: title
    });
  });
  return result;
};
var timestampToShortFormat = function timestampToShortFormat(store, t, d, timestamp) {
  var _store$getters$tzOffs;
  var tzOffset = (_store$getters$tzOffs = store.getters.tzOffset) !== null && _store$getters$tzOffs !== void 0 ? _store$getters$tzOffs : localTzOffset();
  var date = new Date(tzOffset * 60 * 1000 + timestamp * 1000);
  var today = new Date();
  var todayDayNumber = today.getDate();
  var dateDayNumber = date.getUTCDate();
  var dateHours = date.getUTCHours();
  if (todayDayNumber === dateDayNumber || todayDayNumber === dateDayNumber - 1 && dateHours == 0) {
    return "".concat(t("date.today"), ", ").concat(hhmm(date));
  } else if (todayDayNumber === dateDayNumber - 1 && dateHours != 0) {
    return "".concat(t("date.tomorrow"), ", ").concat(hhmm(date));
  } else {
    return "".concat(d(date, 'short'), ", ").concat(hhmm(date));
  }
};
var convertSecondsToMinutes = function convertSecondsToMinutes(duration) {
  if (duration && duration >= 0) {
    return new Date(duration * 1000).toISOString().slice(14, 19);
  } else {
    return '00:00';
  }
};
var dateToShortFormat = function dateToShortFormat(store, t, d, date) {
  try {
    var timestamp = Date.parse(date);
    return timestampToShortFormat(store, t, d, timestamp);
  } catch (error) {
    return;
  }
};
var hhmm = function hhmm(date) {
  return "".concat(('0' + date.getUTCHours()).slice(-2), ":").concat(('0' + date.getUTCMinutes()).slice(-2));
};
var localTzOffset = function localTzOffset() {
  var _localStorage$getItem;
  return (_localStorage$getItem = localStorage.getItem('tz_offset')) !== null && _localStorage$getItem !== void 0 ? _localStorage$getItem : new Date().getTimezoneOffset() * -1;
};

/***/ }),

/***/ "./resources/js/i18n/messages.json":
/*!*****************************************!*\
  !*** ./resources/js/i18n/messages.json ***!
  \*****************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"en":{"meta":{"match":{"title":"{team1} vs {team2} match bets and predictions, {date} at the {event} by {discipline}"},"index":{"title":{"default":"Live score, match schedule, results, watch matches online - Esports","discipline":"{game} match schedule, live score, {discipline} streams and broadcasts"}}},"events":{"game_started":"The game has started","winner":"The game ended with the victory of the","picksbans":"Picks and bans stage","t0_picked_up":"was picked up","killed":"killed","t0_killed":"was killed","team_killed":"killed","destroyed":"destroyed","t0_destroyed":"was destroyed","team_destroyed":"destroyed","picked_up":"picked up","team_picked_up":"picked up","get":"get","team_get":"get","deals":"deals","team_deals":"deals","tower_building":"Tower","inhibitor_building":"Inhibitor","dragon":"Drake","fire_dragon":"Infernal Drake","chemtech_dragon":"Chemtech Drake","hextech_dragon":"Hextech Drake","earth_dragon":"Mountain Drake","air_dragon":"Cloud Drake","water_dragon":"Ocean Drake","riftherald":"Rift Herald","nashor":"Nashor","roshan":"Roshan","aegis":"Aegis"},"details":{"networth":"Networth","first_blood":"First blood","first_10_kills":"First 10 kills","first_tower":"First Tower","first_roshan_kill":"First Roshan kill","first_nashor_kill":"First Nashor kill","tower":"Tower","barracs":"Barracks","melee":"Meele","range":"Ranged","tier":"Tier"},"date":{"today":"Today","tomorrow":"Tomorrow","now":"Now"},"placeholder":{"game":"Select game","event":"Select event","team":"Select team","stream":"Select stream","search":"Search..."},"state":{"loading":"Loading...","load_more":"Load more","no_matches":"There are no upcoming matches with these params","no_data":"No data","no_logs":"No logs","match_is_over":"The match is over","streams_ended":"The stream has ended","no_streams":"No streams","unavailable_content":"Unavailable content","viewers_online":"viewers online"},"footer":{"description":"Follow the results of CSGO, Dota 2, League of Legends, Overwatch matches, compare odds and bets on matches, learn more about the players, and view the schedules of streams","legal":"© 2013-2020 • cybersportscore.com is operated by Brivio Limited, a company registered in the Republic of Cyprus, with its principal place of business at: Office 102, 12A Lekorpouzier, Limassol, Cyprus"},"labels":{"matches":"Matches","last_matches":"Last matches","atricles":"Articles","news":"News","map":"Map","dota2":"Dota 2"},"article":{"source":"Source","sourcePic":"Source picture"}},"ru":{"meta":{"match":{"title":"Ставки и прогнозы на матч {team1} против {team2}, {date} на турнире {event} по {discipline}"},"index":{"title":{"default":"Расписание матчей, live score, смотреть матчи онлайн - Киберспорт","discipline":"{game} расписание матчей, live score, стримы и трансляции {discipline}"}}},"events":{"game_started":"Игра началась","winner":"Игра завершилась победой","picksbans":"Стадия пиков и банов","t0_picked_up":"был подобран","killed":"убивает","t0_killed":"был убит","team_killed":"убивают","destroyed":"уничтожает","t0_destroyed":"была уничтожена","team_destroyed":"уничтожают","picked_up":"подбирает","team_picked_up":"подбирают","get":"получает","team_get":"получают","deals":"наносит","team_deals":"наносят","tower_building":"Башня(ю)","inhibitor_building":"Ингибитор","dragon":"Дракон","fire_dragon":"Адский Дрейк","chemtech_dragon":"Схемтек Дрейк","hextech_dragon":"Хекстек Дрейк","earth_dragon":"Горный Дрейк","air_dragon":"Облачный Дрейк","water_dragon":"Оушен Дрейк","riftherald":"Весник Разлома","nashor":"Нашор","roshan":"Рошан","aegis":"Аэгис"},"details":{"networth":"Ценность героя","first_blood":"Первая кровь","first_10_kills":"Первые 10 убийств","first_tower":"Первая башня","first_roshan_kill":"Первое убийство Рошана","first_nashor_kill":"Первое убийство Нашора","tower":"Башня","barracs":"Бараки","tier":"Tier"},"date":{"today":"Сегодня","now":"Сейчас","tomorrow":"Завтра"},"placeholder":{"game":"Выбрать игру","event":"Выбрать турнир","team":"Выбрать команду","stream":"Выбрать стрим","search":"Поиск..."},"state":{"loading":"Загрузка...","load_more":"Загрузить еще","no_matches":"Нету будущих матчей с такими параметрами","no_data":"Данные отсутствуют","no_logs":"Нет логов","match_is_over":"Матч закончился","streams_ended":"Стрим закончился","no_streams":"Нет стримов","unavailable_content":"Контент недоступен","viewers_online":"зрителей онлайн"},"footer":{"description":"Follow the results of CSGO, Dota 2, League of Legends, Overwatch matches, compare odds and bets on matches, learn more about the players, and view the schedules of streams","legal":"© 2013-2020 • cybersportscore.com is operated by Brivio Limited, a company registered in the Republic of Cyprus, with its principal place of business at: Office 102, 12A Lekorpouzier, Limassol, Cyprus"},"labels":{"matches":"Матчи","last_matches":"Последние матчи","atricles":"Статьи","news":"Новости","map":"Карта","dota2":"дота 2"},"article":{"source":"Источник","sourcePic":"Заглавное фото"}},"zh":{"meta":{"match":{"title":"在 {discipline} 举办的锦标赛 {event} {date} 上对 {team1} 对阵 {team2} 的比赛的投注和预测"},"index":{"title":{"default":"比赛日程、实时比分、在线观看比赛 - 电子竞技","discipline":"{game} 比赛日程、比分直播、直播和转播 {discipline}"}}},"events":{"game_started":"比赛开始","winner":"比赛结束，获胜","picksbans":"选择和禁止阶段","killed":"杀死","t0_killed":"杀死","t0_picked_up":"被提出","team_killed":"杀死","destroyed":"销毁","t0_destroyed":"被摧毁","team_destroyed":"被摧毁","picked_up":"拿起","team_picked_up":"捡到","get":"得到","team_get":"得到","deals":"交易","team_deals":"交易","tower_building":"塔楼","inhibitor_building":"抑制剂","dragon":"龙","fire_dragon":"地狱龙","chemtech_dragon":"德雷克的示意图","hextech_dragon":"德雷克海克斯科技","earth_dragon":"山龙","air_dragon":"云龙","water_dragon":"海龙","riftherald":"裂谷先驱","nashor":"纳舒拉","roshan":"肉山","aegis":"宙斯盾"},"details":{"networth":"英雄的价值","first_blood":"第一滴血","first_10_kills":"前 10 次击杀","first_tower":"第一塔","first_roshan_kill":"第一次杀死 Roshan","first_nashor_kill":"第一次杀死 Nashor"},"date":{"today":"今天","now":"现在","tomorrow":"明天"},"placeholder":{"game":"选择游戏","event":"选择事件","team":"选择团队","stream":"选择流","search":"搜索..."},"state":{"loading":"加载中...","load_more":"装载更多","no_matches":"这些参数没有即将到来的比赛","no_data":"暂无数据","no_logs":"没有日志","match_is_over":"比赛结束了","streams_ended":"视频流已结束","no_streams":"没有流","unavailable_content":"不可用的内容","viewers_online":"在线观众"},"footer":{"description":"Follow the results of CSGO, Dota 2, League of Legends, Overwatch matches, compare odds and bets on matches, learn more about the players, and view the schedules of streams","legal":"© 2013-2020 • cybersportscore.com is operated by Brivio Limited, a company registered in the Republic of Cyprus, with its principal place of business at: Office 102, 12A Lekorpouzier, Limassol, Cyprus"},"labels":{"matches":"火柴","last_matches":"最后一场比赛","atricles":"文章","news":"消息","map":"卡鲁塔","dota2":"Dota 2"},"article":{"source":"Source","sourcePic":"Source picture"}},"uk":{"meta":{"match":{"title":"Ставки та прогнози на матч {team1} проти {team2}, {date} на турнірі {event} з {discipline}"},"index":{"title":{"default":"Розклад матчів, live score, дивитись матчі онлайн - Кіберспорт","discipline":"{game} розклад матчів, live score, стрими та трансляції {discipline}"}}},"events":{"game_started":"Гра розпочалася","winner":"Гра завершилася перемогою","picksbans":"Стадія піків і банів","t0_picked_up":"був піднятий","killed":"вбиває","t0_killed":"був убитий","team_killed":"вбивають","destroyed":"знищує","t0_destroyed":"була знищена","team_destroyed":"знищують","picked_up":"підбирає","team_picked_up":"підбирають","get":"отримує","team_get":"отримують","deals":"наносить","team_deals":"наносять","tower_building":"Башта(у)","inhibitor_building":"Інгібітор","dragon":"Дракон","fire_dragon":"Пекельний Дрейк","chemtech_dragon":"Чемтеч Дрейк","hextech_dragon":"Хекстеч Дрейк","earth_dragon":"Гірський Дрейк","air_dragon":"Хмарний Дрейк","water_dragon":"Оушен Дрейк","riftherald":"Вісник Розлому","nashor":"Нашор","roshan":"Рошан","aegis":"Аеґіс"},"details":{"networth":"Цінність героя","first_blood":"Перша кров","first_10_kills":"Перші 10 вбивств","first_tower":"Перша вежа","first_roshan_kill":"Перше вбивство Рошана","first_nashor_kill":"Перше вбивство Нашора"},"date":{"today":"Сьогодні","now":"Зараз","tomorrow":"Завтра"},"placeholder":{"game":"Оберіть гру","event":"Оберіть подію","team":"Оберіть команду","stream":"Оберіть стрім","search":"Пошук..."},"state":{"loading":"Завантаження...","load_more":"Завантажити ще","no_matches":"Немає майбутніх матчів з такими параметрами","no_data":"Дані відсутні","no_logs":"Логи відсутні","match_is_over":"Матч завершився","streams_ended":"Стрім завершився","no_streams":"Немає стрімів","unavailable_content":"Контент тимчасово недоступний","viewers_online":"глядачів онлайн"},"footer":{"description":"Follow the results of CSGO, Dota 2, League of Legends, Overwatch matches, compare odds and bets on matches, learn more about the players, and view the schedules of streams","legal":"© 2013-2020 • cybersportscore.com is operated by Brivio Limited, a company registered in the Republic of Cyprus, with its principal place of business at: Office 102, 12A Lekorpouzier, Limassol, Cyprus"},"labels":{"matches":"Матчі","last_matches":"Останні матчі","atricles":"Статті","news":"Новини","map":"Карта","dota2":"дота 2"},"article":{"source":"Джерело","sourcePic":"Заголовне фото"}}}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!****************************************!*\
  !*** ./resources/js/helpers/helper.js ***!
  \****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _chart__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./chart */ "./resources/js/helpers/chart.js");
/* harmony import */ var _common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./common */ "./resources/js/helpers/common.js");
/* harmony import */ var _language__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./language */ "./resources/js/helpers/language.js");
/* harmony import */ var _pagination__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./pagination */ "./resources/js/helpers/pagination.js");
/* harmony import */ var _status__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./status */ "./resources/js/helpers/status.js");
/* harmony import */ var _teams__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./teams */ "./resources/js/helpers/teams.js");
/* harmony import */ var _time__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./time */ "./resources/js/helpers/time.js");









})();

/******/ })()
;