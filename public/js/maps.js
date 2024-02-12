let map;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 15.09422636723272, lng: 120.7693010754442 },
        zoom: 20
    });
}

window.initMap = initMap;
