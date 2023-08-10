document.addEventListener("DOMContentLoaded", function () {
    let customSelect = document.getElementById("custom-select");
    let customOptions = document.getElementById("custom-options");
    let clearSelection = document.getElementById("clear-selection");
    let selectedGame = document.getElementById("selected-game");



    let customSelectTournament = document.getElementById(
        "custom-select-tournament",
    );
    let customOptionsTournament = document.getElementById(
        "custom-options-tournament",
    );
    let clearSelectionTournament = document.getElementById(
        "clear-selection-tournament",
    );

    let customSelectTeam = document.getElementById("custom-select-team");
    let customOptionsTeam = document.getElementById("custom-options-team");
    let clearSelectionTeam = document.getElementById("clear-selection-team");

    let teams = [
        {
            game: "dota-2",
            value: "vp",
            label: "VP",
            image: "https://api.cybersportscore.com/media/event/_120/e7268.webp",
            game_image: "/media/icons/games/dota-2-bw.webp",
        },
        {
            game: "dota-2",
            value: "t-spirit",
            label: "TSpirit",
            image: "https://api.cybersportscore.com/media/event/_120/e7268.webp",
            game_image: "/media/icons/games/dota-2-bw.webp",
        },
        {
            game: "dota-2",
            value: "og",
            label: "TI 2023",
            image: "https://api.cybersportscore.com/media/event/_120/e7268.webp",
            game_image: "/media/icons/games/dota-2-bw.webp",
        },
    ];

    let tournaments = [
        {
            game: "dota-2",
            value: "ti-2023",
            label: "TI 2023",
            image: "https://api.cybersportscore.com/media/event/_120/e7268.webp",
            game_image: "/media/icons/games/dota-2-bw.webp",
        },
        {
            game: "dota-2",
            value: "ti-2021",
            label: "TI 2021",
            image: "https://api.cybersportscore.com/media/event/_120/e2456.webp",
            game_image: "/media/icons/games/dota-2-bw.webp",
        },
    ];
    let games = [
        {
            value: "dota-2",
            label: "Dota 2",
            image: "/media/icons/games/dota-2.webp",
        },
        {
            value: "lol",
            label: "LoL",
            image: "/media/icons/games/lol.webp",
        },
    ];
    let selectedTeamValue = null;
    let selectedTournamentValue = null;
    let selectedGameValue = null;

    customSelect.addEventListener("click", function (event) {
        closeOtherSelectMenus(customSelectTournament, customOptionsTournament);
        closeOtherSelectMenus(customSelectTeam, customOptionsTeam);
        // ... (rest of your existing customSelect click event code)
    });

    customSelectTournament.addEventListener("click", function (event) {
        closeOtherSelectMenus(customSelect, customOptions);
        closeOtherSelectMenus(customSelectTeam, customOptionsTeam);
        // ... (rest of your existing customSelectTournament click event code)
    });

    customSelectTeam.addEventListener("click", function (event) {
        closeOtherSelectMenus(customSelect, customOptions);
        closeOtherSelectMenus(customSelectTournament, customOptionsTournament);
        // ... (rest of your existing customSelectTeam click event code)
    });

    // Function to close other select menus
    function closeOtherSelectMenus(currentSelect, currentOptions) {
        if (currentOptions.style.display === "block") {
            currentOptions.style.display = "none";
        }
    }

    customSelect.addEventListener("click", function (event) {
        event.stopPropagation();
        customOptions.innerHTML = "";
        if (customOptions.style.display === "none") {
            customOptions.style.display = "block";
            games.forEach(function (game) {
                let option = document.createElement("li");
                option.classList.add("relative");
                option.innerHTML = '<button data-value="'
                    .concat(
                        game.value,
                        '" class="flex items-center w-full text-left block py-2 px-2 text-white whitespace-normal truncate h-[43px] text-xs lg:text-sm">\n                                        <img src="',
                    )
                    .concat(
                        game.image,
                        '" loading="lazy" class="w-5 h-5 inline-block mr-2">\n                                        ',
                    )
                    .concat(
                        game.label,
                        "\n                                        ",
                    )
                    .concat(
                        game === selectedGameValue
                            ? '<span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-5 w-5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path></svg></span>'
                            : "",
                        "\n                                    </button>",
                    );
                customOptions.appendChild(option);
                option.addEventListener("click", function () {
                    selectedGameValue = game;
                    updateSelectedGame();
                    customOptions.style.display = "none";
                });
            });
        } else {
            customOptions.style.display = "none";
        }
    });
    customSelectTournament.addEventListener("click", function (event) {
        event.stopPropagation();
        customOptionsTournament.innerHTML = "";
        if (customOptionsTournament.style.display === "none") {
            customOptionsTournament.style.display = "block";
            if (
                !customOptionsTournament.querySelector("input[type='search']")
            ) {
                createSearchInputTournament();
            }
            tournaments.forEach(function (tournament) {
                let option = document.createElement("li");
                option.classList.add("relative");
                option.innerHTML = '\n                    <button data-value="'
                    .concat(
                        tournament.value,
                        '" class=" items-center w-full text-left block py-2 px-2 text-white whitespace-normal truncate h-[43px] text-xs lg:text-sm">\n                        <img src="',
                    )
                    .concat(
                        tournament.game_image,
                        '"  loading="lazy" class="opacity-50 w-3 h-3 inline-block mr-3 text-gray-500" alt="">\n                        <img src="',
                    )
                    .concat(
                        tournament.image,
                        '" loading="lazy" class="w-5 h-5 inline-block mr-1" alt="">\n                        ',
                    )
                    .concat(tournament.label, "\n                        ")
                    .concat(
                        tournament === selectedTournamentValue
                            ? '\n                            <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">\n                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-5 w-5">\n                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path>\n                                </svg>\n                            </span>'
                            : "",
                        "\n                    </button>",
                    );
                let searchInput = document.createElement("input");
                customOptionsTournament.appendChild(option);
                option.addEventListener("click", function () {
                    selectedTournamentValue = tournament;
                    updateSelectedTournament();
                    customOptionsTournament.style.display = "none";
                });
            });
        } else {
            customOptionsTournament.style.display = "none";
        }
    });
    customSelectTeam.addEventListener("click", function (event) {
        event.stopPropagation();
        customOptionsTeam.innerHTML = "";

        if (customOptionsTeam.style.display === "none") {
            customOptionsTeam.style.display = "block";

            if (!customOptionsTeam.querySelector("input[type='search']")) {
                createSearchInputTeam();
            }

            teams.forEach(team => {
                const option = document.createElement("li");
                option.classList.add("relative");
                option.innerHTML = `
                <button data-value="${team.value}" class="flex items-center w-full text-left block py-2 px-2 text-white
                    whitespace-normal truncate h-[43px] text-xs lg:text-sm">
                    <img src="${team.game_image}" alt="dota-2 icon" loading="lazy" class="opacity-50 w-3 h-3 inline-block mr-3">
                    <img src="${team.image}" loading="lazy" class="w-5 h-5 inline-block mr-2">
                    ${team.label}
                    ${team === selectedTeamValue ? `
                        <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path>
                            </svg>
                        </span>` : ''}
                </button>`;
                customOptionsTeam.appendChild(option);

                option.addEventListener("click", function () {
                    selectedTeamValue = team;
                    updateSelectedTeam();
                    customOptionsTeam.style.display = "none";
                });
            });
        } else {
            customOptionsTeam.style.display = "none";
        }
    });


    clearSelectionTournament.addEventListener("click", function (event) {
        event.stopPropagation();
        selectedTournamentValue = null;
        updateSelectedTournament();
        customOptionsTournament.style.display = "none";
    });

    clearSelectionTeam.addEventListener("click", function (event) {
        event.stopPropagation();
        selectedTeamValue = null;
        updateSelectedTeam();
        customOptionsTeam.style.display = "none";
    });


    clearSelection.addEventListener("click", function (event) {
        event.stopPropagation(); // Остановить всплытие события
        selectedGame.s = "Выбрать игру";
        clearSelection.innerHTML =
            '\n                        <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">\n                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>\n                        </svg>';
        customOptions.style.display = "none";
    });

    function updateSelectedTeam() {
        const selectedTeamElement = document.getElementById("selected-team");

        clearSelectionTeam.innerHTML = `
        <svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor">
            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>`;

        if (selectedTeamValue) {
            selectedTeamElement.classList.remove("text-gray-500");
            selectedTeamElement.classList.add("text-gray-200");
            selectedTeamElement.innerHTML = `
            <span class="ml-1 block truncate text-xs">
                <img src="${selectedTeamValue.game_image}" alt="dota-2 icon" loading="lazy" class="opacity-50 w-3 h-3 inline-block mr-3">
                <img src="${selectedTeamValue.image}" loading="lazy" class="w-3 h-3 inline-block mr-1">
                ${selectedTeamValue.label}
            </span>`;
        } else {
            selectedTeamElement.classList.add("text-gray-500");
            selectedTeamElement.classList.remove("text-gray-200");
            selectedTeamElement.textContent = "Выбрать команду";
        }
    }

    function updateSelectedTournament() {
        let selectedTournamentElement = document.getElementById(
            "selected-tournament",
        );
        clearSelectionTournament.innerHTML = `<svg class="h-5 w-5 text-gray-400 pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor"><path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>`;
        if (selectedTournamentValue) {
            selectedTournamentElement.classList.remove("text-gray-500");
            selectedTournamentElement.classList.add("text-gray-200");
            selectedTournamentElement.innerHTML =
                '\n                <span class="ml-1 block truncate text-xs">\n                    <img src="'
                    .concat(
                        selectedTournamentValue.game_image,
                        '" alt="dota-2 icon" loading="lazy" class="opacity-50 w-3 h-3 inline-block mr-3">\n                    <img src="',
                    )
                    .concat(
                        selectedTournamentValue.image,
                        '" loading="lazy" class="w-3 h-3 inline-block mr-1" alt="">\n                    ',
                    )
                    .concat(
                        selectedTournamentValue.label,
                        "\n                </span>",
                    );
        } else {
            selectedTournamentElement.classList.add("text-gray-500");
            selectedTournamentElement.classList.remove("text-gray-200");
            selectedTournamentElement.textContent = "Выбрать турнир";
        }
    }

    function updateSelectedGame() {
        let selectedGameElement = document.getElementById("selected-game");
        clearSelection.innerHTML = "✕";
        selectedGameElement.classList.remove("text-gray-500");
        selectedGameElement.classList.add("text-gray-200");
        selectedGameElement.innerHTML =
            '\n                <span class="ml-1 block truncate text-xs">\n                    <img src="'
                .concat(
                    selectedGameValue.image,
                    '" loading="lazy" class="w-3 h-3 inline-block mr-1" alt="">\n                    ',
                )
                .concat(selectedGameValue.label, "\n                </span>");
    }
        function createSearchInputTeam() {
            const searchInputTeam = document.createElement("input");
            searchInputTeam.setAttribute("type", "search");
            searchInputTeam.setAttribute("placeholder", "Поиск...");
            searchInputTeam.classList.add("w-11/12", "rounded", "text-xs", "m-auto", "mt-2", "block", "h-8", "text-white", "mb-3", "bg-gray-800", "border", "border-gray-700", "focus:border-indigo-500", "focus:outline-none", "focus:opacity-80", "focus:ring-1", "focus:ring-indigo-500");
            customOptionsTeam.insertBefore(searchInputTeam, customOptionsTeam.firstChild);
        }

    function createSearchInputTournament() {
        let searchInputTournamentHTML =
            '\n        <input type="search" placeholder="\u041F\u043E\u0438\u0441\u043A..." class="w-11/12 rounded text-xs m-auto mt-2 block h-8 text-white mb-3 bg-gray-800 border border-gray-700 focus:border-indigo-500 focus:outline-none focus:opacity-80 focus:ring-1 focus:ring-indigo-500">';
        customOptionsTournament.insertAdjacentHTML(
            "afterbegin",
            searchInputTournamentHTML,
        );
    }
});
