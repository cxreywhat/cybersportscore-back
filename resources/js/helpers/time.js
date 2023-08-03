export const timezones = [
  {'title':'UTC -12:00', 'abbr':'',    'offset':-720},
  {'title':'UTC -11:00', 'abbr':'',    'offset':-660},
  {'title':'UTC -10:00', 'abbr':'',    'offset':-600},
  {'title':'UTC -9:00',  'abbr':'',    'offset':-540},
  {'title':'UTC -8:00',  'abbr':'PST', 'offset':-480},
  {'title':'UTC -7:00',  'abbr':'PDT', 'offset':-420},
  {'title':'UTC -6:00',  'abbr':'CST', 'offset':-360},
  {'title':'UTC -5:00',  'abbr':'EST', 'offset':-300},
  {'title':'UTC -4:00',  'abbr':'EDT', 'offset':-240},
  {'title':'UTC -3:30',  'abbr':'',    'offset':-210},
  {'title':'UTC -3:00',  'abbr':'CLST','offset':-180},
  {'title':'UTC -2:00',  'abbr':'',    'offset':-120},
  {'title':'UTC -1:00',  'abbr':'',    'offset':-60},
  {'title':'UTC +0:00',  'abbr':'',    'offset':0},
  {'title':'UTC +1:00',  'abbr':'CET', 'offset':60},
  {'title':'UTC +2:00',  'abbr':'CEST','offset':120},
  {'title':'UTC +3:00',  'abbr':'EEST','offset':180},
  {'title':'UTC +3:30',  'abbr':'',    'offset':210},
  {'title':'UTC +4:00',  'abbr':'',    'offset':240},
  {'title':'UTC +4:30',  'abbr':'',    'offset':270},
  {'title':'UTC +5:00',  'abbr':'',    'offset':300},
  {'title':'UTC +5:30',  'abbr':'',    'offset':330},
  {'title':'UTC +6:00',  'abbr':'',    'offset':360},
  {'title':'UTC +7:00',  'abbr':'',    'offset':420},
  {'title':'UTC +8:00',  'abbr':'SGT', 'offset':480},
  {'title':'UTC +9:00',  'abbr':'',    'offset':540},
  {'title':'UTC +9:30',  'abbr':'',    'offset':570},
  {'title':'UTC +10:00', 'abbr':'',    'offset':600},
  {'title':'UTC +11:00', 'abbr':'',    'offset':660},
  {'title':'UTC +12:00', 'abbr':'',    'offset':720}
]

export const saveTimeZoneOffset = (el) => {
  localStorage.setItem('tz_offset', el.id);
}

export const timeZoneSelected = (timeList) => {

  let result = timeList.find(el => el.id == localTzOffset());
  if (result) {
    return result
  } else {
    return timeList.find(el => el.id == 0) // return UTC
  }
}

export const timeListCollection = () => {
  let result = []
  let timestamp = Date.now()

  timezones.forEach((timezone) => {
    let date = new Date(timezone.offset * 60 * 1000 + timestamp);
    let title = (timezone.abbr ? timezone.abbr : timezone.title)
    // let title = (timezone.abbr ? `(${timezone.title}) ${timezone.abbr}` : `(${timezone.title})`)
    title = `${hhmm(date)} ${title}`
    result.push({
      id: timezone.offset,
      title: title
    })
  }) 
  return result
}

export const timestampToShortFormat = (store, t, d, timestamp) => {
  let tzOffset = store.getters.tzOffset ?? localTzOffset()
  let date = new Date(tzOffset * 60 * 1000 + timestamp*1000)
  let today = new Date()
  
  let todayDayNumber = today.getDate()
  let dateDayNumber = date.getUTCDate()
  let dateHours = date.getUTCHours()
  if (todayDayNumber === dateDayNumber || (todayDayNumber === dateDayNumber - 1 && dateHours == 0)) {
    return `${t("date.today")}, ${hhmm(date)}`
  } else if (todayDayNumber === dateDayNumber - 1 && dateHours != 0) {
      return `${t("date.tomorrow")}, ${hhmm(date)}`
  } else {
    return `${d(date, 'short')}, ${hhmm(date)}`
  }
}

export const convertSecondsToMinutes = (duration) => {
  if (duration && duration >=0) {
    return new Date(duration * 1000).toISOString().slice(14, 19);
  } else {
    return '00:00'
  }
}

export const dateToShortFormat = (store, t, d, date) => {
  try {
    let timestamp = Date.parse(date)
    return timestampToShortFormat(store, t, d, timestamp)
  } catch (error) {
    return
  }
}

const hhmm = (date) => {
  return `${('0' + date.getUTCHours()).slice(-2)}:${('0' + date.getUTCMinutes()).slice(-2)}`
}

const localTzOffset = () => {
  return localStorage.getItem('tz_offset') ?? new Date().getTimezoneOffset()*(-1)
}