<?php
    $info_match = json_decode($item['info']);
?>

<div class="items-row hover:bg-gray-800 border-l-[4px] border-red-500">
    <a href="/match" class="border-transparent flex flex-row w-full h-full items-center">
        <div class="flex items-col pl-4 w-[45px]">
            <img loading="lazy" class="opacity-50 w-5 h-5" alt="dota-2 icon"
                 src={{ $item->game_id == 582 ? asset('media/icons/games/dota-2-bw.webp') :
                    asset('media/icons/games/lol-bw.webp')}}>
        </div>
        <span>
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-sm">
                <div class="font-semibold text-sm text-red-500 leading-4 flex flex-col items-center opacity-90">
                    <span class="hidden md:flex">LIVE</span>
                    <span class="bg-red-500 text-gray-900 text-[9px] sm:text-xs font-semibold mt-0 md:mt-1 px-1 rounded bg-red-500 text-gray-900" >
                        <span >MAP 3</span>
                    </span>
                </div>
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse md:flex-row md:items-center flex text-left">
                <span class="mr-3 sm:mr-0 md:mr-8 items-col-adv text-[9px] font-semibold opacity-90">
                    <span class="h-[12px] sm:h-[18px] block sm:inline md:p-1 md:border rounded border-yellow-300 text-yellow-300 leading-normal">
                        +9.1k
                    </span>
                    <span class="text-right h-[12px] sm:h-[18px] block sm:inline md:border md:p-1 rounded border-[#1786ED] text-[#1786ED] leading-normal">
                        +5.7k
                    </span>
                </span>
                <span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate ">
                   {{ $info_match->t1->t }}
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t96142.webp" alt="Holy Grail icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="flex flex-col items-center border-l border-r text-gray-400 align-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="flex flex-row items-center justify-center">
                <svg class="opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: rgb(171, 175, 187); height: 1.1em;">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd"></path>
                </svg>
                <div class="w-[30px] sm:w-[38px] text-right text-[9px] sm:text-xs leading-normal">
                    <span class="">
                        23:26
                    </span>
                </div>
            </div>
            <div class="flex flex-row items-center text-base justify-center italic" >
                <span class="leading-normal text-apple text-xs sm:text-sm text-right font-bold pr-1" >
                    11
                </span>
                :
                <span class="leading-normal text-apple text-xs sm:text-sm text-center font-bold pl-1" >
                    4
                </span>
            </div>
        </div>

        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t96142.webp" alt="Holy Grail icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    {{ $info_match->t2->t }}
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8268.webp" title="Miso Soup" alt="Miso Soup icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center">
            <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4 mx-auto ">
                BO5
            </div>
            <span class="bg-apple text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white mx-auto text-center">
                1:1
            </span>
        </div>
    </a>
    <button class="hover:bg-apple bg-gray-700 text-gray-300 w-[48px] sm:w-[42px] h-full justify-center items-center flex" >
        <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd">

            </path>
        </svg>
    </button>
</div>






























<div class="flex flex-col md:flex-row p-4 details-container">
    <div class="w-full md:w-auto flex flex-1 grow items-start">
        <div class="w-full flex flex-col bg-[#212D3D]">
            <div class="flex w-full justify-between text-sm px-3 py-2 min-h-[42px] font-semibold border-b border-gray-700
            rounded-t-md border-t border-l border-r cursor-default">
                <div class="flex text-xs items-center">
                    <img src="https://api.cybersportscore.com/media/logo/_30/t96214.webp" alt="RAM SQUAD icon" class="w-[1.6rem] aspect-[3/2] object-contain mr-2" loading="lazy">
                    <span class="green-side" title="RAM SQUAD">Rams</span>
                </div><div class="flex text-xs items-center justify-end">
                    <span class="red-side" title="Ancient Tribe">ATT</span>
                    <img src="https://api.cybersportscore.com/media/logo/_30/t93734.webp" alt="Ancient Tribe icon" class="w-[1.6rem] aspect-[3/2] object-contain ml-2" loading="lazy">
                </div>
            </div>
            <div class="flex flex-col relative bg-[#1F2937]">
                <div class="flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative">
                    <div class="px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 32,746" class="left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
                         font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.9);"></span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/35.png"
                             alt="Sniper" title="Sniper" loading="lazy">
                        <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="kAAN">kAAN</span>
                        <span title="24 Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500 border-2
                            border-gray-700 hover:border-gray-600 rounded">24</span>
                    </div>
                    <div class="justify-end px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 28,555" class="right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
                         font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.784813);"></span>
                        <span title="27 Level" class="mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px]
                        text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">27</span>
                        <span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="WoE">WoE</span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/54.png" alt="Lifestealer" title="Lifestealer" loading="lazy">
                    </div>
                </div>
                <div class="flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative">
                    <div class="px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 31,433" class="left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition
                        font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.863913);"></span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/17.png"
                             alt="Storm Spirit" title="Storm Spirit" loading="lazy">
                        <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="canceL^">canceL^</span>
                        <span title="26 Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px]
                            text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">26</span>
                    </div>
                    <div class="justify-end px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 24,133" class="right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400
                            transition font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.663278);"></span>
                        <span title="23 Level" class="mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px]
                            text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">23</span>
                        <span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="Mo13ei">Mo13ei</span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/47.png" alt="Viper" title="Viper" loading="lazy">
                    </div>
                </div>
                <div class="flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative">
                    <div class="px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 30,372" class="left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.834752);"></span><!----><!---->
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/135.png" alt="Dawnbreaker" title="Dawnbreaker" loading="lazy">
                        <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="w33haa">w33haa</span>
                        <span title="28 Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">28</span>
                    </div>
                    <div class="justify-end px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 18,645" class="right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400
                        transition font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.512444);"></span>
                        <span title="23 Level" class="mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px]
                            text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">23</span>
                        <span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="Mr. Luck">Mr. Luck</span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/2.png" alt="Axe" title="Axe" loading="lazy">
                    </div>
                </div>
                <div class="flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative">
                    <div class="px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 20,072" class="left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400
                        transition font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.551664);"></span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/101.png"
                             alt="Skywrath Mage" title="Skywrath Mage" loading="lazy">
                        <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="Michael">Michael</span>
                        <span title="23 Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px]
                        text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">23</span>
                    </div>
                    <div class="justify-end px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 15,901" class="right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400
                        transition font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.437027);"></span>
                        <span title="22 Level" class="mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500 border-2
                        border-gray-700 hover:border-gray-600 rounded">22</span><span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="LeBronDota">LeBronDota</span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/68.png" alt="Ancient Apparition" title="Ancient Apparition" loading="lazy">
                    </div>
                </div>
                <div class="flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative">
                    <div class="px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 15,812" class="left-2 origin-left hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400
                        transition font-bold absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.434581);"></span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 mr-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/91.png" alt="Io" title="Io" loading="lazy">
                        <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="Flash">Flash</span>
                        <span title="23 Level" class="ml-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500 border-2 border-gray-700 hover:border-gray-600 rounded">23</span>
                    </div>
                    <div class="justify-end px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                        <span title="Ценность героя 14,397" class="right-2 origin-right hover:bg-clip-border py-[2px] -bottom-[9px] opacity-90 bg-yellow-400 transition font-bold
                        absolute w-full border border-t-[1px] border-b-[1px] border-transparent bg-clip-padding" style="transform: scaleX(0.395691);"></span>
                        <span title="21 Level" class="mr-2 font-semibold bg-gray-700 bg-opacity-20 px-1 py-0 leading-normal cursor-default text-[8px] text-gray-500 border-2
                        border-gray-700 hover:border-gray-600 rounded">21</span>
                        <span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="Alex">Alex</span>
                        <img class="max-w-7 max-h-6 hover:max-h-10 hover:max-w-10 ml-2" src="https://api.cybersportscore.com/media/game/hero/582/_59/7.png" alt="Earthshaker" title="Earthshaker" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 md:py-0 flex w-full flex-col md:w-[180px] justify-center items-center px-4" data-v-5e84aa1e="">
        <div class="w-full flex flex-col-reverse flex-col">
            <div class="flex justify-center items-center gap-3 pt-5 text-[#374151] cursor-default">
                <div class="green-side group flex w-[24px] h-[29px] relative" title="Первая кровь">
                    <div class="absolute font-bold text-[9px] w-full text-center top-[1px]"> FB </div>
                    <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z" stroke="#92a525" stroke-width="2px"></path>
                    </svg>
                </div>
                <div class="green-side group flex w-[24px] h-[29px] relative" title="Первые 10 убийств" style="transition-delay: 0.2s;">
                    <div class="absolute font-bold text-[9px] w-full text-center top-[1px]"> F10 </div>
                    <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z" stroke="#92a525" stroke-width="2px"></path>
                    </svg>
                </div>
                <div class="green-side group flex w-[24px] h-[29px] relative zoom-fade-enter-active zoom-fade-enter-to" title="Первая башня" style="transition-delay: 0.4s;">
                    <div class="absolute font-bold text-[9px] w-full text-center top-[1px]"> T1 </div>
                    <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z" stroke="#92a525" stroke-width="2px"></path>
                    </svg>
                </div>
                <div class="green-side group flex w-[24px] h-[29px] relative zoom-fade-enter-active zoom-fade-enter-to" title="Первое убийство Рошана" style="transition-delay: 0.6s;">
                    <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">R</div>
                    <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z" stroke="#92a525" stroke-width="2px"></path>
                    </svg>
                </div>
            </div>
            <div class="relative transition">
                <div class="h-0 w-[100%] pb-[100%] w-full h-full opacity-70" style="background-image: url({{asset('/media/maps/dota-2.png')}}); background-size: cover;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 5%; height: 5%; transform: translate(-50%, -50%); border-radius: 50%; left: 17%; top: 89%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 5%; height: 5%; transform: translate(-50%, -50%); border-radius: 50%; left: 12%; top: 83%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 29%; top: 94.5%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 51%; top: 95%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 84%; top: 95%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 22%; top: 78%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 31%; top: 69%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 41%; top: 59%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 6%; top: 71%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 6%; top: 49%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 6%; top: 32%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: translate(-50%, -50%); border-radius: 0; left: 22%; top: 91.5%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: translate(-50%, -50%); border-radius: 0; left: 22%; top: 96.5%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: rotate(45deg) translate(-50%, -50%); border-radius: 0; left: 16%; top: 80.5%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: rotate(45deg) translate(-50%, -50%); border-radius: 0; left: 19%; top: 84%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: translate(-50%, -50%); border-radius: 0; left: 3.5%; top: 77.5%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: translate(-50%, -50%); border-radius: 0; left: 8.5%; top: 77.5%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 5%; height: 5%; transform: translate(-50%, -50%); border-radius: 50%; left: 91%; top: 16%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 5%; height: 5%; transform: translate(-50%, -50%); border-radius: 50%; left: 85%; top: 11%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 95%; top: 31%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 95%; top: 48%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 95%; top: 66%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 78%; top: 24%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 69%; top: 32%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 57%; top: 45%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 72%; top: 5%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 50%; top: 5%;"></div>
                <div class="destroyed-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 20%; top: 5%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: translate(-50%, -50%); border-radius: 0; left: 91.5%; top: 25%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: translate(-50%, -50%); border-radius: 0; left: 96.5%; top: 25%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: rotate(45deg) translate(-50%, -50%); border-radius: 0; left: 81.5%; top: 17.5%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: rotate(45deg) translate(-50%, -50%); border-radius: 0; left: 84.5%; top: 20%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: translate(-50%, -50%); border-radius: 0; left: 78%; top: 3%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 4%; height: 4%; transform: translate(-50%, -50%); border-radius: 0; left: 78%; top: 8%;"></div>
                <div class="green-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 6%; top: 93%;"></div>
                <div class="red-side-map absolute shadow-sm transition" style="width: 7%; height: 7%; transform: translate(-50%, -50%); border-radius: 50%; left: 94%; top: 6%;"></div>
            </div>
        </div>
    </div>
    <div class="flex md:w-auto flex-1 w-full grow items-center" data-v-5e84aa1e="">
        <div class="flex w-full h-full items-center justify-center text-gray-600 relative" data-v-5e84aa1e=""><!---->
            <canvas class="h-full w-full" width="376" height="289" style="display: block; box-sizing: border-box; height: 263px; width: 342px;"></canvas>
            <div style="background: rgba(24, 36, 49, 0.9); border-radius: 8px; color: white; opacity: 0; text-align: center; min-width: 163px; pointer-events: none; position: absolute; transform: translate(-50%, 0%); z-index: 100; transition: all 0.2s ease 0s;">
                <table style="margin: 0;"></table>
            </div>
        </div>
    </div>
</div>
<div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                    VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div>
<div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div><div class="border-gray-700 border-x border-t justify-between">
    <div class="items-row hover:bg-gray-800 border-l-[4px] border-transparent" data-v-283f8db8="">
        <div class="flex items-col pl-4 w-[45px]" data-v-3ea41e3b="">
            <img src="/media/icons/games/lol-bw.webp" alt="lol icon" loading="lazy" class="opacity-50 w-5 h-5" data-v-3ea41e3b="">
        </div>
        <span data-v-3ea41e3b="">
            <div class="w-[45px] sm:w-[120px] md:w-[130px] items-col p-0 sm:px-3 py-3 text-gray-400 sm:text-gray-300 leading-[1rem] text-[9px] sm:text-xs">
                Сегодня, 19:00
            </div>
        </span>
        <div class="items-end flex-col items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col-reverse items-end md:flex-row md:items-center flex" >
                <!----><!----><span class="text-[10px] sm:text-xs font-semibold mr-3 sm:mr-0 mb-0 sm:mb-1 md:mb-0 truncate" >
                    QLS
                </span>
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t94353.webp" alt="QLS icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy">
            </div>
        </div>
        <div class="items-col border-l border-r text-gray-400 items-center justify-content sm:text-sm w-[70px] sm:w-[100px]">
            <div class="font-semibold flex text-[10px] rounded-full justify-center items-center border-1 border w-[28px] h-[28px] border-apple text-apple mx-auto" data-v-e3302de3="">
                VS
            </div>
        </div>
        <div class="items-col w-[50px] md:w-[60px] items-center hidden sm:flex" data-v-e3302de3="">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/logo/_30/t88839.webp" alt="AYM icon" class="w-[1.6rem] aspect-[3/2] object-contain" loading="lazy" data-v-e3302de3="">
            </div>
        </div>
        <div class="items-col grow w-8 sm:w-10 overflow-visible text-xs text-gray-300 md:text-base">
            <div class="flex-col md:flex-row md:items-center flex">
                <span class="text-[10px] sm:text-xs font-semibold ml-3 sm:ml-0 mb-0 sm:mb-1 md:mb-0 truncate">
                    <div class="flex flex-col items-center mx-auto">
                        AYM
                    </div>
                </span><!----><!---->
            </div>
        </div>
        <div class="items-col w-[80px] hidden sm:flex items-center">
            <div class="flex flex-col items-center mx-auto">
                <img src="https://api.cybersportscore.com/media/event/_120/e8189.webp" title="LVP SL 2 Div 2023 Summer" alt="LVP SL 2 Div 2023 Summer icon" loading="lazy" class="w-[1.6rem] h-[1.6rem] inline">
            </div>
        </div>
        <div class="items-col w-[50px] items-center" >
            <div class="flex flex-col items-center mx-auto">
                <div class="flex font-semibold flex-col text-xs text-gray-300 leading-4" >
                    BO5
                </div>
                <span class="bg-gray-500 text-[11px] leading-none font-semibold mt-0.5 w-7 px-1 py-0.5 rounded text-white text-center">
                    0:0
                </span>
            </div>
        </div>
        <span class="w-[44px] sm:w-[40px] h-full items-center flex justify-center cursor-default pointer-events-none text-gray-700">
            <svg class="h-5 w-5 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-v-283f8db8="">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" >

                </path>
            </svg>
        </span>
    </div><!---->
</div>
<style>
    .items-row {
        position: relative;
        display: flex;
        height: 3.2rem;
        background-color: #212D3D;
        color: gray;
        align-items: center;
        will-change: contents;
    }

    .items-col {
        display: flex;
        height: 100%;
        flex-direction: column;
        align-items: start;
        justify-content: center;
        border-color: gray;
        color: gray;
    }

    .items-col-adv span + span {
        margin-left: 1px;
    }

    .details-container {
        position: relative;
        min-height: 295px;
        width: 100%;
        background: linear-gradient(180deg, rgba(214, 214, 214, 0.06) 0%, rgba(217, 217, 217, 0.03) 100%);
    }
    .text {
        -webkit-hyphens: auto;
        -moz-hyphens: auto;
        -ms-hyphens: auto;
        hyphens: auto;
    }
    @tailwind base;
    @tailwind components;
    @tailwind utilities;

    @layer components {
        .items-row {
            @apply relative flex bg-[#192536] h-[3.2rem] bg-gray-700 bg-opacity-20 text-gray-500 items-center;
            will-change: contents;
        }
        .items-col {
            @apply flex h-full flex-col items-start justify-center border-gray-700 text-gray-500;
        }
        .items-col-adv  span + span{
            @apply ml-1 md:ml-2;
        }

        .details-container {
            @apply relative min-h-[285px] w-full;
            background:
                linear-gradient(180deg,
                rgba(214, 214, 214, 0.06) 0%,
                rgba(217, 217, 217, 0.03) 100%);
        }
    }
</style>
