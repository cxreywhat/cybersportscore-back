import buildingsData from "../../../json/dota-2-maps.json"

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

function generateMap(buildingsData, destroyedBuildings) {
    const container = document.createElement("div");
    container.className = "relative transition";
    container.style.position = "relative";

    const backgroundImageDiv = document.createElement("div");
    backgroundImageDiv.className = "pb-[100%] w-full h-full opacity-70";
    backgroundImageDiv.style.backgroundImage = `url('media/maps/dota-2.png')`;
    backgroundImageDiv.style.backgroundSize = "cover";
    container.appendChild(backgroundImageDiv);

    buildingsData.forEach(building => {
        const buildingDiv = createBuildingElement(building, destroyedBuildings);
        container.appendChild(buildingDiv);
    });

    return container;
}

export function getMap(destroyedBuildings) {

    const mapContainer = generateMap(buildingsData, destroyedBuildings);
    const mapElement = document.getElementById("map");

    mapElement.appendChild(mapContainer);
}
