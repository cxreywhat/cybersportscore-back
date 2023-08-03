import { routerReplace } from "./route"

export const defaultRouteLang = 'en'

export const languageCollection = [
  {
    id: 'en',
    title: 'English',
  },
  {
    id: 'ru',
    title: 'Русский',
  },
  {
    id: 'uk',
    title: 'Українська',
  },
  {
    id: 'zh',
    title: '中文',
  }
]

export const currentLang = (store, route) => {
  return store?.getters?.lang || route?.query?.lang || defaultRouteLang
}

export const currentLangForRoute = (store, route) => {
  let _lang = currentLang(store, route)

  if (_lang == defaultRouteLang) {
    return null
  }

  return _lang
}

export const currentLangForRouter = (store, route) => {
  let _lang = currentLang(store, route)

  if (!_lang) {
    return defaultRouteLang
  }
  
  return _lang
}

export const saveLanguage = (el) => {
  localStorage.setItem('lang', el.id)
}

export const langRedirect = (router, route, lang) => {
  let locale = lang.id
  
  if ((route.name == 'home' || !route.name) && lang.id == defaultRouteLang) {
    locale = null
  } else if (lang.id == defaultRouteLang) {
    locale = null
  }

  return routerReplace(router, route, { 
    params: {
      locale: locale,
      game: route.params.game
    }
  })
}

export const languageSelected = () => {
  let langFromUrl = getLanguageFromUrl()
  if (langFromUrl) { return langFromUrl }
  let userLang = localStorage.getItem('lang') ?? userLanguage()
  let langInList = languageCollection.find(el => el.id == userLang)
  if (langInList) {
    return langInList
  } else {
    return languageCollection[0]
  }
}

const userLanguage = () => {
  return window.navigator.userLanguage || window.navigator.language || 'en'
}

const getLanguageFromUrl = () => {
  let locale = window.location.pathname.replace(/^\/([^\/]+).*/i,'$1');
  if (locale != '/') {
    let languageFromList = languageCollection.find(el => el.id == locale)
    if (languageFromList) {
      return languageFromList
    }
  }
  return null
}