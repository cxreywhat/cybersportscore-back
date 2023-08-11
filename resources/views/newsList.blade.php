@extends('main')

@section('content')
    <div class="max-w-6xl bg-gray-800" style="margin: 0 auto; min-height: 100vh;">
    <div class="grid grid-cols-1 md:grid-cols-6 gap-4 px-3 py-2 max-w-6xl" style="margin: 0px auto;">
        <div class="col-span-2 md:col-span-4">
            <div class="flex flex-col w-full border border-gray-700 rounded-lg relative">
                <div class="flex flex-col md:flex-row items-center p-3 border-b border-gray-700">
                    <h1 class="text-l font-bold text-white grow pl-1 w-full md:pb-0">
                        Новости
                    </h1>
                </div>
                <div class="p-4">
                    <article>
                        <a href="/ru/news/49962-topson-propustit-otborochnye-na-the-international-2023"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            Topson пропустит отборочные на The International 2023
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49961-mira-i-yatoro-nazvali-luchshie-izmeneniya-patcha-7-34-v-dota-2"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            Mira и Yatoro назвали лучшие изменения патча 7.34 в Dota 2
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49960-v-patche-13-16-dlya-lol-skorrektiruyut-usloviya-kapitulyatsii"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            В патче 13.16 для LoL скорректируют условия капитуляции
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49959-ns-dyrachyo-nastoyashchiy-djentlmen-i-ambassador-piva-i-dvijuhi"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            NS: «Dyrachyo — настоящий джентльмен и амбассадор пива и движухи»
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49958-luchshie-kerri-patcha-7-34-dlya-dota-2-ot-watson"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            Лучшие керри патча 7.34 для Dota 2 от Watson
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49957-overdrive-o-bane-na-twitch-nadeyus-chto-paragon-vyvesit-kuda-nibud-pravila-dlya-komyuniti-strimerov"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            OverDrive о бане на Twitch: «Надеюсь, что Paragon вывесит куда-нибудь правила для комьюнити-стримеров»
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49956-qojqva-pro-dodj-list-tak-silno-nenaviju-etu-sistemu-ya-plachu-za-osobennost-v-igre-kotoruyu-ne-poluchayu"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            Qojqva про додж-лист: «Так сильно ненавижу эту систему. Я плачу за особенность в игре, которую не получаю»
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49955-team-liquid-s-dvumya-rossiyanami-ne-proshla-v-pley-off-valorant-champions-2023"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            Team Liquid с двумя россиянами не прошла в плей-офф VALORANT Champions 2023
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49954-overwatch-2-startovala-v-steam-s-36-polojitelnyh-otzyvov"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            Overwatch 2 стартовала в Steam с 36% положительных отзывов
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49952-iceberg-invoker-stal-superj-stkim-geroem-dlya-pusha-liniy"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            Iceberg: «Invoker стал супержёстким героем для пуша линий»
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49953-gh-o-patche-7-34-nujno-sygrat-sotnyu-pabov-chtoby-vo-vs-m-razobratsya"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            GH о патче 7.34: «Нужно сыграть сотню пабов, чтобы во всём разобраться»
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49951-b1t-problem-s-kollami-ot-aleksib-ne-bylo-ya-ponimayu-chto-govoryat-na-angliyskom-uje-davno-igrayu-v-cs"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            B1T: «Проблем с коллами от Aleksib не было. Я понимаю, что говорят на английском, уже давно играю в CS»
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49950-zayavki-na-pri-m-v-komandy-zakonchilis-resolut1on-i-atf-poka-bez-sostavov" class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">З
                            аявки на приём в команды закончились — Resolut1on и ATF пока без составов
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49949-twitch-zabanil-zonera-i-overdrayva-za-strim-iem-sydney-2023-po-jalobe-paragon-sama-ona-ne-pokazyvaet-matchi"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            Twitch забанил Зонера и Овердрайва за стрим IEM Sydney 2023 по жалобе Paragon — сама она не показывает матчи
                        </a>
                    </article>
                    <article>
                        <a href="/ru/news/49948-s1mple-zanyal-2-mesto-po-populyarnosti-v-chate-twitch-na-iem-cologne-2023"
                           class="text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100">
                            S1mple занял 2 место по популярности в чате Twitch на IEM Cologne 2023
                        </a>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
