import axios from "axios";
import router from "../router/index";

const backendHost = import.meta.env.VITE_BACKEND_HOST;

const get = async function (resource, config = {}) {
    let apiData = null;
    try {
        apiData = await axios.get(`${backendHost}/api/${resource}`, config);
    } catch (err) {
        if (err.response.status > 399) {
            await router.push({name: 'not-found'})
        }
    }
    return apiData;
}

const api = {
    news: {
        list: function (lang, params = {}) {
            return get('news', { params: { ...params, lang } });
        },
        article: function (id, preview) {
            return get(`news/${id}`, { params: { preview } });
        }
    },
    matches: {
        index: (params = {}) => {
            return get('matches', { params: { ...params } });
        },
        preview: (id, params = {}) => {
            return get(`matches/${id}/preview`, { params: { ...params } });
        },
        streams: (id, params = {}) => {
            return get(`matches/${id}/streams`, { params: { ...params } });
        },
        logs: (id, num, params = {}) => {
            return get(`logs/${id}/${num}`, { params: { ...params } });
        },
        show: (id, params = {}) => {
            return get(`matches/${id}`, { params: { ...params } });
        },
        match: (id, params = {}) => {
            return get(`beta/matches/${id}`, { params: { ...params } });
        },
        history: (id, params = {}) => {
            return get(`matches/${id}/history`, { params: { ...params } });
        },
        historySide: (id, side, page, params = {}) => {
            return get(`matches/${id}/history/${side}?page=${page}`, { params: { ...params } });
        },
        // streams: (params = {}) => {
        //     return get('streams', { params: { ...params } });
        // },
        tournaments: {
            filter: (params = {}) => {
                return get('filters/tournaments', { params: { ...params } });
            }
        },
        teams: {
            filter: (params = {}) => {
                return get('filters/teams', { params: { ...params } });
            }
        },
        
    
    },
    dictionary: {
        heroes: (gameEng, params = {}) => {
            return get(`${gameEng}/heroes`, { params: { ...params } });
        }
    },
    banners: {
        index: function (lang, params = {}) {
            return get('banners', { params: { ...params, lang } });
        },
    },
};

export default api;