<div class="flex flex-col md:flex-row w-full">
    <div class="relative shadow-sm ml-2 pb-3 md:w-[205px] lg:w-[235px] md:pb-0">
        <div class="inline-block w-full" data-headlessui-state="">
            <div id="custom-select" class="custom-select h-[35px] relative w-full rounded-md border py-2 pl-2 pr-7 text-left shadow-sm focus:border-indigo-500 focus:outline-none
            focus:ring-2 focus:opacity-80 focus:ring-indigo-500 sm:text-sm text-gray-200 bg-gray-800 border-gray-700 hover:bg-gray-700">
                <span id="selected-game" class="ml-1 truncate text-xs text-gray-500 flex items-center">Выбрать игру</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <span id="clear-selection" class="z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">
                        <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </span>
            </div>
            <ul id="custom-options" class="custom-options absolute w-full mt-1 z-10 py-1 text-sm rounded shadow-md max-h-50 overflow-y-auto text-gray-200 bg-gray-800 border border-gray-700" style="display: none;"></ul>
        </div>
    </div>

    <div class="relative shadow-sm ml-2 pb-3 md:w-[205px] lg:w-[235px] md:pb-0">
        <div class="inline-block w-full" data-headlessui-state="">
            <div id="custom-select-tournament" class="custom-select h-[35px] relative w-full rounded-md border py-2 pl-2 pr-7 text-left shadow-sm focus:border-indigo-500 focus:outline-none
            focus:ring-2 focus:opacity-80 focus:ring-indigo-500 sm:text-sm text-gray-200 bg-gray-800 border-gray-700 hover:bg-gray-700">
                <span id="selected-tournament" class="ml-1 truncate text-xs text-gray-500 flex items-center">Выбрать турнир</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                <span id="clear-selection-tournament" class="z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">
                    <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </span>
            </div>
            <ul id="custom-options-tournament" class="custom-options absolute w-full mt-1 z-10 py-1 text-sm rounded shadow-md max-h-50 overflow-y-auto text-gray-200 bg-gray-800 border border-gray-700" style="display: none;"></ul>
        </div>
    </div>

    <div class="relative shadow-sm ml-2 pb-3 md:w-[205px] lg:w-[235px] md:pb-0">
        <div class="inline-block w-full" >
            <div id="custom-select-team" class="custom-select h-[35px] relative w-full rounded-md border py-2 pl-2 pr-7 text-left shadow-sm focus:border-indigo-500 focus:outline-none
            focus:ring-2 focus:opacity-80 focus:ring-indigo-500 sm:text-sm text-gray-200 bg-gray-800 border-gray-700 hover:bg-gray-700">
                <span id="selected-team" class="ml-1 truncate text-xs text-gray-500 flex items-center">Выбрать команду</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                <span id="clear-selection-team" class="z-11 hover:text-apple text-center h-5 w-5 text-white cursor-pointer">
                    <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </span>
            </div>
            <ul id="custom-options-team" class="custom-options absolute w-full mt-1 z-10 py-1 text-sm rounded shadow-md max-h-50 overflow-y-auto text-gray-200 bg-gray-800 border border-gray-700" style="display: none;"></ul>
        </div>
    </div>
</div>

<script src={{ asset('js/components/filterListBox.js') }}></script>

