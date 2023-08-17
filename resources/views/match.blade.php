@extends('main')

@section('content')
    <div class="w-full h-full relative">
        <?php dd($preview)?>
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 relative mb-3">
            <div class="col-span-6 lg:col-span-3 flex justify-between items-center w-full flex-col sm:flex-row">
                <div class="flex my-5 sm:my-0 text-gray-300 font-bold text-[10px] sm:text-xs">
                    <div class="flex flex-col h-full ml-1 bg-gray-100 bg-opacity-60 w-[55px] h-[50px] items-center justify-center rounded-[100%]">
                        <img src="https://api.cybersportscore.com/media/event/_120/e8311.webp" title="LNTI" alt="LNTI icon" loading="lazy" class="w-[2.5rem] h-[2.5rem] inline">
                    </div>
                    <span class="flex flex-col ml-4 justify-center"><span class="whitespace-nowrap">LNTIassa</span><br><span>$20,000</span></span>
                </div>
                <div class="flex flex-row align-center md:w-56 md:justify-center sm:justify-end sm:ml-3 flex-wrap">
                    <span class="mx-1 sm:mx-2 my-1 sm:mr-0"><a aria-current="page" href="/ru/dota-2/524035?num=1" class="router-link-active router-link-exact-active cursor-default pointer-events-none bg-apple text-gray-900 uppercase text-[10px] font-semibold px-2 py-1 rounded sm:text-xs"><span class="animate-pulse inline-flex w-[8px] h-[8px] bg-red-500 border border-gray-400 border-1 rounded-[100%] mr-1"></span><span class="inline-flex">Карта 1</span></a></span><span class="mx-1 sm:mx-2 my-1 sm:mr-0"><a aria-current="page" href="/ru/dota-2/524035?num=2" class="router-link-active router-link-exact-active text-gray-700 border border-1 border-gray-700 cursor-default pointer-events-none uppercase text-[10px] font-semibold px-2 py-1 rounded sm:text-xs"><!----><span class="inline-flex">Карта 2</span></a></span>
                </div>
            </div>
            <div class="col-span-6 lg:col-span-3 flex justify-between items-center">
                <div class="flex flex-row w-full border border-gray-700 h-[55px] rounded-lg shadow-xl bg-[#212D3D] items-center justify-center relative">
                    @include('components.matchesIndex.matchRowMainPart')
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 relative">
            <div class="col-span-6 lg:col-span-3">
                @include('components.matchesShow.streamsBlock')
                <div class="w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D] grid grid-cols-12 gap-2 flex">
                    <div class="flex flex-row items-center grow w-full border-r border-gray-700 p-4 col-span-12 sm:col-span-5 order-2 sm:order-1">
                        <div class="w-full flex flex-col-reverse flex-col">
                            @include('components.matchesIndex.matchRowDetailsSummary')
                            @include('components.matchesIndex.matchRowDetailsMapDota2')
                        </div>
                    </div>
                    @include('components.matchesShow.logsBlock')
                </div>
            </div>
            <div class="col-span-6 lg:col-span-3">
                <div class="flex flex-col w-full min-h-[96px] justify-center">
                    @include('components.matchesShow.pickBansBlock')
                </div>
                <div class="flex flex-col w-full border border-gray-700 rounded-lg shadow-xl min-h-[300px] bg-[#212D3D] p-3 mb-6">
                    @include('components.matchesIndex.matchRowDetailsChart')
                </div>
                @include('components.matchesIndex.matchRowDetailsPlayers')
            </div>
            <div class="col-span-6 lg:col-span-6">
                <div class="flex flex-col w-full border border-gray-700 rounded-lg shadow-xl bg-[#212D3D] overflow-x-hidden">
                    @include('components.matchesShow.statisticBlock')
                </div>
            </div>
            <div class="col-span-6 lg:col-span-6">
                <div class="flex flex-col w-full rounded-lg shadow-xl bg-[#212D3D] overflow-x-hidden">
                    @include('components.matchesShow.matchHistoryBlock')
                </div>
            </div>
        </div>
        <!---->
    </div>
@endsection()
<style lang="scss">

    .items-col-adv span + span {
        margin-left: 0;
    }

    @media (min-width: 640px) {
        .items-col-adv span + span {
            margin-left: 0.25rem;
        }
    }

    @media (min-width: 768px) {
        .items-col-adv span + span {
            margin-left: 0.5rem;
        }
    }

    .items-col {
        display: flex;
        height: 100%;
        flex-direction: column;
        align-items: start;
        justify-content: center;
        border-color: gray;
        color: #555555;
    }
    .items-col-adv span + span {
        margin-left: 0.25rem; /* Добавьте нужные вам значения отступов */
    }

    @media (min-width: 768px) {
        .items-col-adv span + span {
            margin-left: 0.5rem; /* Добавьте нужные вам значения отступов для больших экранов */
        }
    }
</style>
<script>
    import { onMounted, onBeforeUnmount, ref, inject, computed, watch } from 'vue'
    import { useI18n } from 'vue-i18n'
    import { useRouter, useRoute } from 'vue-router'
    import { useStore } from "vuex"

    import { timestampToShortFormat, convertSecondsToMinutes } from "../../helpers/time"
    import { shortNumber, numberWithCommas } from "../../helpers/common"
    import { externalTooltipHandler } from "../../helpers/chart"


    import { Chart, registerables } from 'chart.js'

    Chart.register(...registerables)

    const { t, d, locale } = useI18n({ useScope: 'global' })
    const router = useRouter()
    const route = useRoute()
    const store = useStore()

    const props = defineProps({
        gold: Array || null,
        events: Object || null,
        gameId: Number,
        teamsConfig: Object || null,
        status: Object,
        num: Number
    })

    const chartRef = ref()

    let chart
    let currentGoldLength = 0

    const segmentColor = (ctx) => {
        if(ctx.p1.parsed.y < 0 || ctx.p0.parsed.y < 0) {
            return props.teamsConfig.t2.color
        } else {
            return props.teamsConfig.t1.color
        }
    }

    const labelColor = (item) => {
        if ( item.parsed.y < 0 ) {
            return {
                borderColor: props.teamsConfig.t2.color,
                backgroundColor: props.teamsConfig.t2.bgColor,
            }
        } else {
            return {
                borderColor: props.teamsConfig.t1.color,
                backgroundColor: props.teamsConfig.t1.bgColor,
            }
        }
    }

    const datapoints = (gold, events=null) => {
        if (props.status.isBreak) {
            return []
        } else {
            //  fix lol gold issue
            let gold_timeline = gold.map((el)=> el.time).sort((a,b) => a - b)
            let gold_diffline = gold.map((el)=> el.diff)

            let goldMapping = {}
            let durations = []

            for (var i = 0; i < gold_timeline.length; i++) {
                durations.push(gold_timeline[i])
                goldMapping[gold_timeline[i]] = gold_diffline[i]
            }
            let eventsMapping

            if (events) {
                eventsMapping = events?.reduce(function (r, a) {
                    r[a.duration] = r[a.duration] || []
                    r[a.duration].push(a)
                    return r
                }, Object.create(null))

                events?.forEach((el)=> durations.push(el.duration))

                durations = Array.from(new Set(durations)).sort((a,b) => a - b)
            }

            let result = []
            durations.forEach((time, index) => {
                let nextTime = durations[index+1]
                let currentGoldAmount = goldMapping[time] || gold?.findLast(el => el.time <= time)?.diff

                result.push({
                    x: '' + (time || 0),
                    y: currentGoldAmount,
                    game_events: eventsMapping ? eventsMapping[time] : null,
                    game_id: props.gameId,
                    axis_crossing: false
                })

                // insert axis crossing keypoint
                if (nextTime) {
                    let nextGoldAmount = goldMapping[nextTime] || gold?.findLast(el => el.time <= nextTime)?.diff
                    if (nextGoldAmount != 0 && currentGoldAmount != 0 && Math.sign(nextGoldAmount) != Math.sign(currentGoldAmount)) {

                        let x = time - (nextTime-time)*currentGoldAmount/(nextGoldAmount-currentGoldAmount)

                        result.push({
                            x: '' + (x || 0),
                            y: 0,
                            game_events: null,
                            axis_crossing: true
                        })
                    }
                }
            })

            return result

        }
    }

    const data = {

        datasets: [
            {
                data: datapoints(props.gold, props.events) || [],
                // pointRadius: 0,
                // pointHoverRadius: 5,
                fill: {
                    target: 'origin',
                    above: props.teamsConfig.t1.bgColor,
                    below: props.teamsConfig.t2.bgColor
                },
                borderColor: 'rgb(140, 149, 164)',
                backgroundColor: 'rgba(140, 149, 164, 0.2)',
                cubicInterpolationMode: 'monotone',
                // tension: 0.4,
                spanGaps: false,
                segment: {
                    borderColor: ctx => segmentColor(ctx),
                }
            }
        ]
    }

    const label = (data) => {
        return data.raw
    }

    const title = (data) => {
        return data.raw
    }


    const options = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false,
                displayColors: false,
                // position: 'nearest',
                position: 'average',
                external: externalTooltipHandler,
                callbacks: {
                    labelColor: labelColor,
                    label: label,
                    title: title
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'x',
            // mode: 'dataset',
            includeInvisible: false
        },
        elements: {
            point: {
                radius: function(ctx) {
                    if (ctx?.raw?.game_events) {
                        let defaultSize = 4
                        let fightSum = defaultSize
                        ctx.raw.game_events.forEach((el) => el.type == 'fights' ? fightSum += el.fights.length : 0)
                        return fightSum
                    } else if (ctx?.raw?.axis_crossing) {
                        return 0
                    } else {
                        return 0
                    }
                },
                hitRadius: function(ctx) {
                    if (ctx?.raw?.game_events) {
                        return 2
                    } else {
                        return 0
                    }
                }
            }
        },
        scales: {
            x: {
                display: true,
                grid: {
                    tickColor: "#374151",
                },
                ticks: {
                    color: '#b6bac6',
                    beginAtZero: true,
                    callback: function(val, index) {
                        return convertSecondsToMinutes(this.getLabelForValue(val))
                    },
                }
            },
            y: {
                display: true,
                grid: {
                    tickColor: "#374151",
                    color: ctx => !props.status.isBreak && props.gold && props.gold.length > 0 && ctx.tick.value == 0 ? "#374151" : "#1f2a38",
                    lineWidth: ctx => !props.status.isBreak && props.gold && props.gold.length > 0 && ctx.tick.value == 0 ? 2 : 1,
                },
                ticks: {
                    color: '#b6bac6',
                    beginAtZero: true,
                    callback: value => shortNumber(value)
                },
                suggestedMin: -100,
                suggestedMax: 100
            }
        }
    }

    onMounted(async () => {
        await router.isReady()
        currentGoldLength = props.gold.length
        chart = new Chart(
            chartRef.value,
            {
                type: 'line',
                data: data,
                options: options
            })
    })

    watch(() => props.gold, (newGold) => {
        if (props.status.isBreak) {
            chart.data.datasets[0].data = null
            chart.update()
            return
        }
        if (!chart?.data?.datasets) { return }
        if (newGold.length <= currentGoldLength) { return }
        chart.data.datasets[0].data = datapoints(newGold, props.events)
        currentGoldLength = newGold.length
        chart.update()
    })

    watch(() => props.status.isBreak, () => {
        if (props.status.isBreak) {
            chart.data.datasets[0].data = null
            chart.update()
            return
        }
    })

</script>
