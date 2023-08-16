<div id='matchDetails' class="flex-col md:flex-row p-4 details-container">
    <div class="w-full md:w-auto flex flex-1 grow items-start">
        <div class="w-full flex flex-col bg-[#212D3D]">
            <div class="flex w-full justify-between text-sm px-3 py-2 min-h-[42px] font-semibold border-b border-gray-700
            rounded-t-md border-t border-l border-r cursor-default">
                <div class="flex text-xs items-center">
                    <img src="https://api.cybersportscore.com/media/logo/_30/t96214.webp" alt="RAM SQUAD icon" class="w-[1.6rem] aspect-[3/2] object-contain mr-2" loading="lazy">
                    <span class="green-side" title="RAM SQUAD">{{ $gameInfo->t1->t }}</span>
                </div><div class="flex text-xs items-center justify-end">
                    <span class="red-side" title="Ancient Tribe">{{ $gameInfo->t2->t }}</span>
                    <img src="https://api.cybersportscore.com/media/logo/_30/t93734.webp" alt="Ancient Tribe icon" class="w-[1.6rem] aspect-[3/2] object-contain ml-2" loading="lazy">
                </div>
            </div>
            <div class="flex flex-col relative bg-[#1F2937]">
                @foreach($gameInfo->t1->players as $key => $playerT1)
                    <div class="flex w-full justify-between text-sm py-1 border-gray-700 border-b last:rounded-b-md border-l border-r min-h-[42px] relative">
                        <div class="px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                            <img src="/media/icons/no-icon.svg" loading="lazy" class="w-4 md:w-5 opacity-10 mr-2">
                            <span class="text-gray-300 text-xs cursor-default leading-normal md:truncate" title="livinlavidaloka)">{{$playerT1->nick}}</span>
                        </div>
                        <div class="justify-end px-2 flex w-full items-center grow max-w-[50%] relative max-h-8">
                            <span class="text-gray-300 text-xs cursor-default text-right md:truncate" title="FE!N">{{$gameInfo->t2->players[$key]->nick}}</span>
                            <img src="/media/icons/no-icon.svg" loading="lazy" class="w-4 md:w-5 opacity-10 ml-2">
                        </div>
                    </div>
                @endforeach
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
