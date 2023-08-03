import { createRouter, createWebHistory, createMemoryHistory } from "vue-router";
import HomeView from '../pages/HomeView.vue'
import MatchView from '../pages/MatchView.vue'
import NewsListView from "../pages/NewsListView.vue";
import NewsArticleView from "../pages/NewsArticleView.vue";
import NotFound from '../pages/NotFound.vue';

const matchRoutes = () => {
    let result:any = []
    result.push({
        path: "/:locale(en|zh|ru|uk)?/:game(lol|dota-2)/:id(\\d+)",
        name: 'match',
        component: MatchView,
        beforeEnter: (to, from) => {
            let params = Object.keys(to.query);
            const whitelist = ['num']
            const hasNonWhitelistedElements = params.some((element) => !whitelist.includes(element))
            if (params.length > 0 && hasNonWhitelistedElements) {
                return router.push(to.path)
            }
        },
    })
    return result
}

const homeRoutes = () => {
    let result:any = []
    result.push({
        name: 'home',
        path: "/:locale(en|zh|ru|uk)?/:game(lol|dota-2)?",
        component: HomeView,
        beforeEnter: (to, from) => {
            let params = Object.keys(to.query);
            const whitelist = ['page', 'event', 'team']
            const hasNonWhitelistedElements = params.some((element) => !whitelist.includes(element))
            if (params.length > 0 && hasNonWhitelistedElements) {
                return router.push(to.path)
            }
        },
    })

    return result
}
// Для решения проблемы возврата 404 у SPA приложения роуты продублированы в ingress.yaml
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/:locale(en|zh|ru|uk)?/news/:id-:slug',
            name: 'article',
            component: NewsArticleView,
            beforeEnter: (to, from) => {
                let params = Object.keys(to.query);

                if (params.length > 0) {
                    return router.push(to.path)
                }
            },
        },
        {
            path: '/:locale(en|zh|ru|uk)?/news',
            name: 'news',
            component: NewsListView,
            beforeEnter: (to, from) => {
                let params = Object.keys(to.query);

                if (params.length > 0) {
                    return router.push(to.path)
                }
            },
        },
        ...homeRoutes(),
        ...matchRoutes(),
        {
            name: '404',
            path: '/:catchAll(.*)*',
            component: NotFound,
        }
    ]
})

export default router
