<div id="selects" class="flex flex-col md:flex-row w-full">
    <div class="relative shadow-sm ml-2 pb-3 md:w-[205px] lg:w-[235px] md:pb-0">
        <div class="inline-block w-full" data-headlessui-state="">

            <div id="custom-select-game" class="custom-select cursor-pointer h-[35px] relative w-full rounded-md border py-2 pl-2 pr-7 text-left shadow-sm focus:border-indigo-500 focus:outline-none
            focus:ring-2 focus:opacity-80 focus:ring-indigo-500 sm:text-sm text-gray-200 bg-gray-800 border-gray-700 hover:bg-gray-700">
                <span id="selected-game" class="ml-1 truncate text-xs text-gray-500 flex items-center" data-translate="placeholder.game">Выбрать игру</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <span id="clear-selection" class="clear-selection z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">
                        <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </span>
            </div>

            <div id="list-games" class="absolute w-full mt-1 z-10" style="display: none">
                <ul aria-orientation="vertical" id="headlessui-listbox-options-40" role="listbox" tabindex="0" data-headlessui-state="open" class="py-1 text-sm rounded shadow-md max-h-50 overflow-y-auto text-gray-200 bg-gray-800 border border-gray-700" aria-labelledby="headlessui-listbox-button-39">
                    <li role="option" tabindex="-1" aria-selected="false" data-headlessui-state="" class="relative">
                        <button class="game-button flex items-center w-full text-left block py-2 px-2 text-white whitespace-normal truncate h-[43px] text-xs lg:text-sm" value="582">
                            <img src="/media/icons/games/dota-2.webp" loading="lazy" class="w-5 h-5 inline-block mr-2">
                            <span data-value="582">
                                Dota 2
                            </span>
                        </button>
                    </li>
                    <li role="option" tabindex="-1" aria-selected="false"  class="relative">
                        <button class="game-button flex items-center w-full text-left block py-2 px-2 text-white whitespace-normal truncate h-[43px] text-xs lg:text-sm" value="313">
                            <img src="/media/icons/games/lol.webp" loading="lazy" class="w-5 h-5 inline-block mr-2">
                            <span data-value="313">
                                Lol
                            </span>
                        </button>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="relative shadow-sm ml-2 pb-3 md:w-[205px] lg:w-[235px] md:pb-0">
        <div class="inline-block w-full" data-headlessui-state="">
            <div id="custom-select-tournament" class="custom-select cursor-pointer h-[35px] relative w-full rounded-md border py-2 pl-2 pr-7 text-left shadow-sm focus:border-indigo-500 focus:outline-none
            focus:ring-2 focus:opacity-80 focus:ring-indigo-500 sm:text-sm text-gray-200 bg-gray-800 border-gray-700 hover:bg-gray-700">
                <span id="selected-tournament" class="ml-1 truncate text-xs text-gray-500 flex items-center" data-translate="placeholder.event">Выбрать турнир</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <span id="clear-selection-tournaments" class="clear-selection z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">
                        <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </span>
            </div>
            <div id="list-tournaments" class="absolute w-full mt-1 z-10" style="display: none">
                <ul id="tournament-list" aria-labelledby="headlessui-listbox-button-43" aria-orientation="vertical"  role="listbox" tabindex="0" data-headlessui-state="open" class="py-1 text-sm rounded shadow-md max-h-50 overflow-y-auto text-gray-200 bg-gray-800 border border-gray-700">
                    <input id='tournament-search-input' placeholder="Поиск..." type="search" class="w-11/12 rounded text-xs m-auto mt-2 block h-8 text-white mb-3 bg-gray-800 border border-gray-700 focus:border-indigo-500 focus:outline-none focus:opacity-80 focus:ring-1 focus:ring-indigo-500">

                </ul>
            </div>
        </div>
    </div>

    <div class="relative shadow-sm ml-2 pb-3 md:w-[205px] lg:w-[235px] md:pb-0">
        <div class="inline-block w-full" >
            <div id="custom-select-team" class="custom-select cursor-pointer h-[35px] relative w-full rounded-md border py-2 pl-2 pr-7 text-left shadow-sm focus:border-indigo-500 focus:outline-none
            focus:ring-2 focus:opacity-80 focus:ring-indigo-500 sm:text-sm text-gray-200 bg-gray-800 border-gray-700 hover:bg-gray-700">
                <span id="selected-team" class="ml-1 truncate text-xs text-gray-500 flex items-center" data-translate="placeholder.team">Выбрать команду</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <span id="clear-selection-team" class="clear-selection z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer" >
                        <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </span>
            </div>
            <div id="list-teams" class="absolute w-full mt-1 z-10" style="display: none">
                <ul id="team-list" aria-labelledby="headlessui-listbox-button-44" aria-orientation="vertical" role="listbox" tabindex="0" data-headlessui-state="open" class="py-1 text-sm rounded shadow-md max-h-50 overflow-y-auto text-gray-200 bg-gray-800 border border-gray-700">
                    <input id="team-search-input" placeholder="Поиск..." type="search" class="w-11/12 rounded text-xs m-auto mt-2 block h-8 text-white mb-3 bg-gray-800 border border-gray-700 focus:border-indigo-500 focus:outline-none focus:opacity-80 focus:ring-1 focus:ring-indigo-500">

                </ul>
            </div>
        </div>
    </div>
</div>
