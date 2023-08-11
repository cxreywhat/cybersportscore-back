<div>
    <div class="flex flex-col md:flex-row items-center p-2
    rounded-t-md border-x border-t border-gray-700 bg-[#212D3D]">

        <h3 class="text-sm font-semibold text-gray-600 grow pl-3 w-full pb-2 md:pb-0 ">
            {{-- $t('labels.matches')--}}
        </h3>

        {{--@if(isMounted)--}}
        <div class="flex flex-col md:flex-row w-full">
            @include('components.common.filterListBox')
{{--
            @include('components.common.filterListBox')


            @include('components.common.filterListBox')--}}

        </div>
        {{--@endif--}}
    </div>

    {{--@if(isMounted)--}}
    <div class="[showLoader ? 'min-h-[785px] border-l border-r border-t' : '',
        'relative overflow-hidden border-b rounded-b-md border-gray-700 shadow-xl']">
        {{--@if(items?.length || 0 > 0)--}}
        {{--@foreach($items as $item)--}}
            @include('components.matchesIndex.matchRow')
        {{--@endforeach--}}
        {{--@endif

        {{--@elseif(!showLoader)--}}{{--
        <div class="flex border-l border-t border-r min-h-[200px] relative justify-center items-center
        overflow-hidden rounded-b-md border-gray-700 text-gray-600 text-xl
        bg-[#212D3D]">
            --}}{{--{{ $t('state.no_matches') }}--}}{{--
        </div>--}}
        {{--@endif--}}
        {{--@if(showLoader)--}}
{{--        @include('components.common.loader')--}}
        {{--@endif--}}
    </div>

    <div class="mt-5">
        @include('components.common.pagination')
    </div>
    {{--@endif--}}

</div>

<script>
//     // import matchesJson from "../json.tmp/matches.json"
//
//     import { ref, onMounted, onBeforeUnmount, nextTick, onUpdated } from 'vue'
//     import { useRouter, useRoute } from 'vue-router'
//     import { useStore } from "vuex"
//
// /*  import { gamesCollection } from "../helpers/game"
//     import { routerReplace } from "../helpers/route"
//     import api from "../helpers/api"*/
//     import {useHead} from "@vueuse/head";
//     import {useI18n} from "vue-i18n";
//
//     const backendHost = import.meta.env.VITE_BACKEND_HOST
//
//     const router = useRouter()
//     const route = useRoute()
//     const store = useStore()
//
//     const isMounted = ref(false)
//     const loadingStage = ref(false)
//     const showLoader = ref(false)
//
//     const gameFilterRef = ref()
//     const eventFilterRef = ref()
//     const teamFilterRef = ref()
//
//     const items = ref()
//     const paginationRef = ref()
//
//     const request = ref()
//     const { t } = useI18n({ useScope: 'global' })
//
//     onMounted(async () => {
//         await router.isReady()
//         isMounted.value = true
//         getMatches()
//     })
//
//     onBeforeUnmount(()=> {
//         items.value = null
//         clearInterval(refreshMatches)
//     })
//
//     const changePage = (page_number) => {
//         getMatches()
//     }
//
//     const onGameFilterChange = (subj) => {
//         let filterEntries = {game: subj}
//
//         filterEntries['page'] = null
//
//         if (!subj || subj.eng != eventFilterRef.value.selectedGameEng()) {
//             eventFilterRef.value.clearSelection()
//             filterEntries['event'] = null
//         }
//
//         if (!subj || subj.eng != teamFilterRef.value.selectedGameEng()) {
//             teamFilterRef.value.clearSelection()
//             filterEntries['team'] = null
//         }
//
//         applyFilter(filterEntries).then(() =>
//             getMatches()
//         )
//     }
//
//     const onEventFilterChange = (subj) => {
//         let filterEntries = {event: subj}
//
//         filterEntries['page'] = null
//
//         // if (!subj || subj.game_eng != teamFilterRef.value.selectedGameEng()) {
//         //   teamFilterRef.value.clearSelection()
//         //   filterEntries['team'] = null
//         // }
//
//         if (subj) {
//             gameFilterRef.value.setValueByEng(subj.game_eng)
//
//             filterEntries['game'] = {
//                 id: subj.game_id,
//                 eng: subj.game_eng
//             }
//         }
//         applyFilter(filterEntries).then(() =>
//             getMatches()
//         )
//     }
//
//     const onTeamFilterChange = (subj) => {
//         let filterEntries = {team: subj}
//
//         filterEntries['page'] = null
//
//         // if (!subj || subj.game_eng != eventFilterRef.value.selectedGameEng()) {
//         //   eventFilterRef.value.clearSelection()
//         //   filterEntries['event'] = null
//         // }
//
//         if (subj) {
//             gameFilterRef.value.setValueByEng(subj.game_eng)
//
//             filterEntries['game'] = {
//                 id: subj.game_id,
//                 eng: subj.game_eng
//             }
//         }
//
//         applyFilter(filterEntries).then(() =>
//             getMatches()
//         )
//     }
//
//     const applyFilter = (filterEntries) => {
//         let query = {}
//         let params = {}
//
//         Object.entries(filterEntries).forEach(entry => {
//             const [k, v] = entry;
//
//             if (k == 'game') {
//                 params[k] = v ? v.eng : null
//             } else {
//                 query[k] = v ? v.eng : null
//             }
//
//             store.commit('setFilter', {
//                 key: k,
//                 id: v ? v.id : null,
//                 eng: v ? v.eng : null
//             })
//         })
//
//         return routerReplace(router, route, { query: query, params: params })
//     }
//
//     const cancelLoading = async () => {
//         await nextTick()
//         loadingStage.value = false
//         showLoader.value = false
//         request.value = null
//
//         if (items.value.length == 0) {
//             useHead({
//                 meta: {
//                     name: "robots",
//                     content: "noindex"
//                 }
//             })
//         }
//     }
//
//     const getMatches = async (backgroundRequest=false) => {
//         if (request.value) {
//             await request.value
//         }
//         loadingStage.value = true
//         showLoader.value = !backgroundRequest
//
//         let get_params = {}
//
//         let game_id = gameFilterRef.value?.getSelectedValue()?.id
//         let event_id = eventFilterRef.value?.getSelectedValue()?.id
//         let team_id = teamFilterRef.value?.getSelectedValue()?.id
//
//         let game_eng = route.params.game
//         let event_eng = route.query.event
//         let team_eng = route.query.team
//
//         if (!!game_id) { get_params['game_id'] = game_id }
//         else if (!!game_eng) { get_params['game_eng'] = game_eng }
//
//         if (!!event_id) { get_params['event_id'] = event_id }
//         else if (!!event_eng) { get_params['event_eng'] = event_eng }
//
//         if (!!team_id) { get_params['team_id'] = team_id }
//         else if (!!team_eng) { get_params['team_eng'] = team_eng }
//
//         let page = route.query.page
//         if (!!page) { get_params['page'] = page }
//
//         let requestTimeout = setTimeout(() => {
//             cancelLoading()
//         }, 15000)
//
//         try {
//             request.value = api.matches.index(get_params)
//
//             request.value.then((answer) => {
//                 items.value = answer.data.data
//                 if (!backgroundRequest && paginationRef) paginationRef?.value?.parseAnswer(answer)
//                 clearTimeout(requestTimeout)
//                 cancelLoading()
//             })
//
//         } catch (err) {
//             clearTimeout(requestTimeout)
//             cancelLoading()
//             console.log(err)
//         }
//
//     }
//
//     function changeMetaTitle() {
//         if (route.path.includes('dota-2')) {
//             useHead({
//                 title: t('meta.index.title.discipline', {
//                     game: 'Dota 2',
//                     discipline: t('labels.dota2'),
//                 })
//             })
//         } else if (route.path.includes('lol')) {
//             useHead({
//                 title: t('meta.index.title.discipline', {
//                     game: 'LoL',
//                     discipline: 'Lol',
//                 })
//             })
//         } else {
//             useHead({
//                 title: t('meta.index.title.default')
//             })
//         }
//     }
//
//     changeMetaTitle();
//
//     const refreshMatches = setInterval(getMatches, 5000, true)

</script>
