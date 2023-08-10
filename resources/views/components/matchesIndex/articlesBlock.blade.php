<div>
    <div class="flex flex-col w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D]">
        <div class="flex flex-row items-center grow w-full border-b border-gray-700 p-4 overflow-hidden">
            <h3 class="text-sm text-l font-semibold text-gray-600">
                {{--<router-link class="text-l font-bold text-[#d1d5db] pl-3 pr-1" rel="canonical" :to="{ name: 'news', params: { locale: currentLangForRoute(store, route) }}">
                    {{ $t('labels.atricles')}}
                </router-link>--}}
            </h3>
        </div>

        <div class="p-4 relative min-h-[200px]">
{{--            @if(!!articles)--}}
{{--                <div>--}}
{{--                    @foreach($articles as $article)--}}
{{--                        <router-link :to="{ name: 'article', params: { locale: currentLangForRoute(store, route), id: article.id, slug: article.eng }}" :class="[props.selected_id == article.id ? 'cursor-default pointer-events-none text-gray-700 opacity-40' : '','transition text-xs font-normal leading-1 inline-block pb-2 text-gray-300']">--}}
{{--                            <!-- <span class="text-gray-400 mr-1">--}}
{{--                        {{ dateToShortFormat(store, t, d, article.date) }}--}}
{{--                            </span> -->--}}
{{--                            <!-- <span class="font-semibold text-apple">--}}
{{--                        {{ article.game_id }}--}}
{{--                            </span> -->--}}
{{--                            <span class="text" :lang="currentLang(store,route)">--}}
{{--                        {{ article.title }}--}}
{{--                    </span>--}}
{{--                        </router-link>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            @include("components.common.loader")--}}
        </div>

    </div>
</div>

{{--<script setup lang="ts">--}}
{{--    import { onMounted, onBeforeUnmount, ref, inject } from 'vue'--}}
{{--    import { useI18n } from 'vue-i18n'--}}
{{--    import { useRouter, useRoute } from 'vue-router'--}}
{{--    import { useStore } from "vuex"--}}
{{--    import { timestampToShortFormat, dateToShortFormat } from "../../helpers/time"--}}
{{--    import { gamesMapping } from "../../helpers/game"--}}
{{--    import { currentLangForRoute, currentLang } from "../../helpers/language"--}}
{{--    import Loader from '../common/Loader.vue'--}}

{{--    import api from "../../helpers/api"--}}

{{--    const { t, d, locale } = useI18n({ useScope: 'global' })--}}
{{--    const router = useRouter()--}}
{{--    const route = useRoute()--}}
{{--    const store = useStore()--}}
{{--    const articles = ref()--}}

{{--    const props = defineProps({--}}
{{--        selected_id: String || null,--}}
{{--        count: Number || null,--}}
{{--    })--}}

{{--    const loadingStage = ref(true)--}}

{{--    const emitter = inject('emitter')--}}

{{--    // const emit = defineEmits(["onChange"])--}}

{{--    onMounted(async () => {--}}
{{--        await router.isReady()--}}

{{--        emitter.on('lang-changed', () => {--}}
{{--            getNews()--}}
{{--        })--}}

{{--        getNews()--}}
{{--    })--}}

{{--    // const onChangeHandler = (article) => {--}}
{{--    //   emit('onChange', article)--}}
{{--    // }--}}

{{--    const getNews = () => {--}}
{{--        loadingStage.value = true--}}

{{--        let requestTimeout = setTimeout(() => {--}}
{{--            loadingStage.value = false--}}
{{--        }, 10000)--}}

{{--        try {--}}
{{--            api.news.list( currentLang(store, route), { perPage: props.count }).then((answer) => {--}}
{{--                clearTimeout(requestTimeout)--}}
{{--                loadingStage.value = false--}}
{{--                articles.value = answer.data.data--}}
{{--            })--}}

{{--        } catch (err) {--}}
{{--            clearTimeout(requestTimeout)--}}
{{--            loadingStage.value = false--}}
{{--            console.log(err)--}}
{{--        }--}}
{{--    }--}}

{{--</script>--}}

<style>
    .text {
        -webkit-hyphens: auto;
        -moz-hyphens: auto;
        -ms-hyphens: auto;
        hyphens: auto;
    }
</style>
