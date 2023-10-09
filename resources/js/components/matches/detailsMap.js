import buildingsDota2 from "../../../json/dota-2-maps.json"
import buildingsLol from "../../../json/lol-maps.json"

function createBuildingElement(building, destroyedBuildings) {
    const buildingDiv = document.createElement("div");
    const sideClass = building.side === "t1" ? "green-side-map" : "red-side-map";
    const isDestroyed = destroyedBuildings.includes(building.id);
    const classes = isDestroyed ? "destroyed-side-map" : sideClass;

    const size = building.style.size ?? "7%";
    const borderRadius = building.type === "tower" || building.type === "fort" ? " 50%" : " 0";
    const left = building.style.left ?? " 0%";
    const top = building.style.top ?? " 0%";

    buildingDiv.id = building.id;
    buildingDiv.className = `${classes} absolute shadow-sm transition`;
    buildingDiv.style.width = size;
    buildingDiv.style.height = size;
    buildingDiv.style.transform = building.style.transform !== undefined ? building.style.transform + " translate(-50%,-50%)" : "translate(-50%,-50%)";
    buildingDiv.style.borderRadius = borderRadius;
    buildingDiv.style.left = left;
    buildingDiv.style.top = top;

    return buildingDiv;
}

function generateMap(buildingsData, destroyedBuildings, gameId) {
    const container = document.createElement("div");
    container.className = "relative transition";

    const backgroundImageDiv = document.createElement("img");
    backgroundImageDiv.className = "w-full h-full opacity-70 pb-[100%]";
    backgroundImageDiv.style.backgroundImage = gameId === 582 ? `url('/media/maps/dota-2.png')` : `url('/media/maps/lol.png')`;
    container.appendChild(backgroundImageDiv);

    buildingsData.forEach(building => {
        container.appendChild(createBuildingElement(building, destroyedBuildings));
    });


    return container;
}

function generateSummary(events) {
    const fb = events.first_blood === "t1" ? "green-side" : (events.first_blood === "t2" ? "red-side" : "#374151");
    const f10k = events.first_10_kills === "t1" ? "green-side" : (events.first_10_kills === "t2" ? "red-side" : "#374151");
    const ftd = events.first_tower_destroy === "t1" ? "green-side" : (events.first_tower_destroy === "t2" ? "red-side" : "#374151");
    const feck = events.first_elite_creep_kill === "t1" ? "green-side" : (events.first_elite_creep_kill === "t2" ? "red-side" : "#374151");

    const fbIconColor = fb === "green-side" ? "#92a525" : (fb === "red-side" ? "#c23c2a" : "#374151");
    const f10kIconColor = f10k === "green-side" ? "#92a525" : (f10k === "red-side" ? "#c23c2a" : "#374151");
    const ftdIconColor = ftd === "green-side" ? "#92a525" : (ftd === "red-side" ? "#c23c2a" : "#374151");
    const feckIconColor = feck === "green-side" ? "#92a525" : (feck === "red-side" ? "#c23c2a" : "#374151");

    const mapElement = document.createElement('div');
    mapElement.className = "flex justify-center items-center gap-3 pt-5 text-[#374151] cursor-default";

    mapElement.innerHTML = `
            <div class="${fb} group flex w-[24px] h-[29px] relative" title="Первая кровь">
                <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">
                    FB
                </div>
                <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z" stroke="${fbIconColor}" stroke-width="2px"></path>
                </svg>
            </div>
            <div class="${f10k} group flex w-[24px] h-[29px] relative" title="Первые 10 убийств" style="transition-delay: 0.2s">
                <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">
                    F10
                </div>
                <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z" stroke="${f10kIconColor}" stroke-width="2px"></path>
                </svg>
            </div>
            <div class="${ftd} group flex w-[24px] h-[29px] relative" title="Первая башня" style="transition-delay: 0.4s">
                <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">
                    T1
                </div>
                <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z" stroke="${ftdIconColor}" stroke-width="2px"></path>
                </svg>
            </div>
            <div class="${feck} group flex w-[24px] h-[29px] relative" title="Первое убийство Рошана" style="transition-delay: 0.6s">
                <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">
                    R
                </div>
                <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z" stroke="${feckIconColor}" stroke-width="2px"></path>
                </svg>
            </div>
    `;

    return mapElement;
}

export function getMap(events, gameId) {
    const buildings = gameId === 582 ? buildingsDota2 : buildingsLol;
    const mapElement = document.getElementById("map");

    while(mapElement.firstChild) {
        mapElement.removeChild(mapElement.firstChild);
    }

    const mapContainer = generateMap(buildings, events.destroyed_buildings, gameId);
    const detailsSummary = generateSummary(events)

    mapElement.appendChild(detailsSummary);
    mapElement.appendChild(mapContainer);
}
