import { createStore } from 'vuex'
const store = createStore({
  state: {
    filter: {
      query: {
        game: null,
        event: null,
        team: null
      },
      ids: {
        game: null,
        event: null,
        team: null
      }
    },
    lang: "en",
    tzOffset: null
  },
  getters: {
    filter: (state) => state.filter,
    lang: (state) => state.lang,
    tzOffset: (state) => state.tzOffset
  },
  mutations: {
    setFilter(state, subj) {
      state.filter.query[subj.key] = subj.eng
      state.filter.ids[subj.key] = subj.id
    },
    setLanguage(state, val) {
      state.lang = val
    },
    setTzOffset(state, val) {
      state.tzOffset = val
    }
  }
})

export default store;