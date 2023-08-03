import { createI18n } from "vue-i18n"
import jsonMessages from "./messages.json"
import jsonDatetimeFormats from "./datetime.json"
import { languageSelected } from "../helpers/language"

const selectedLang = languageSelected()
let locale = 'en'

if (selectedLang) { locale = selectedLang.id }

const messages = { ...jsonMessages }
const datetimeFormats = { ...jsonDatetimeFormats }

const i18n = createI18n({
  legacy: false,
  locale: locale,
  fallbackLocale: 'en',
  allowComposition: true,
  messages: messages,
  datetimeFormats: datetimeFormats
})

export default i18n