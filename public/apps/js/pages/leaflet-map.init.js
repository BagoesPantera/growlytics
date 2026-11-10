// Leaflet MapLibre demo (theme sample)

// Leaflet 1.9.x with OpenStreetMap base layers - multiple map instances for theme demonstration

// Sample map 1: Standard Leaflet with OpenStreetMap
var mymap = L.map("leaflet-map").setView([51.505, -0.09], 13);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(mymap);

// Sample map 2: Marker variant
var markermap = L.map("leaflet-map-marker").setView([51.505, -0.09], 13);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(markermap);
L.marker([51.5, -0.09]).addTo(markermap);

// Sample map 3: Popup variant
var popupmap = L.map("leaflet-map-popup").setView([51.505, -0.09], 13);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(popupmap);
L.marker([51.5, -0.09]).addTo(popupmap).bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

// Sample map 4: Custom icons variant
var customiconsmap = L.map("leaflet-map-custom-icons").setView([51.5, -0.09], 13);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(customiconsmap);
var LeafIcon = L.Icon.extend({
    options: {
        iconSize: [45, 45],
        iconAnchor: [22, 94],
        popupAnchor: [-3, -76]
    }
});
var greenIcon = new LeafIcon({
    iconUrl: "assets/images/logo-sm.png"
});
L.marker([51.5, -0.09], {
    icon: greenIcon
}).addTo(customiconsmap);

// Sample map 5: Interactive map with CartoDB Voyager (uses shared window.AB_MAP_TILES)
var interactivemap = L.map("leaflet-map-interactive-map").setView([37.8, -96], 4);
// Check if AB_MAP_TILES is available (CartoDB Voyager)
if (window.AB_MAP_TILES && window.AB_MAP_TILES.url) {
    L.tileLayer(window.AB_MAP_TILES.url, {
        maxZoom: window.AB_MAP_TILES.maxZoom,
        attribution: window.AB_MAP_TILES.attribution,
        subdomains: window.AB_MAP_TILES.subdomains
    }).addTo(interactivemap);
} else {
    // Fallback to OSM
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(interactivemap);
}

// Sample map 6: Layer group control with CartoDB Voyager variants
var layergroupcontrolmap = L.map("leaflet-map-group-control", {
    center: [39.73, -104.99],
    zoom: 10
});

// Base layers using CartoDB Voyager via AB_MAP_TILES
var baseLayers = {};
if (window.AB_MAP_TILES && window.AB_MAP_TILES.url) {
    var grayscale = L.tileLayer(window.AB_MAP_TILES.url, {
        maxZoom: window.AB_MAP_TILES.maxZoom,
        attribution: window.AB_MAP_TILES.attribution,
        subdomains: window.AB_MAP_TILES.subdomains,
        id: "cartodb.voyager.labels"
    });
    var streets = L.tileLayer(window.AB_MAP_TILES.url, {
        maxZoom: window.AB_MAP_TILES.maxZoom,
        attribution: window.AB_MAP_TILES.attribution,
        subdomains: window.AB_MAP_TILES.subdomains
    });
} else {
    // Fallback layers
    var grayscale = L.tileLayer("https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        id: "cartodb.voyager.labels"
    });
    var streets = L.tileLayer("https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd'
    });
}

// Create cities layer for overlay
var cities = L.layerGroup();
L.marker([39.61, -105.02]).bindPopup("This is Littleton, CO.").addTo(cities);
L.marker([39.74, -104.99]).bindPopup("This is Denver, CO.").addTo(cities);
L.marker([39.73, -104.8]).bindPopup("This is Aurora, CO.").addTo(cities);
L.marker([39.77, -105.23]).bindPopup("This is Golden, CO.").addTo(cities);

layergroupcontrolmap.addLayer(streets);
layergroupcontrolmap.addLayer(cities);

var baseLayers = {
    Grayscale: grayscale,
    Streets: streets
};

var overlays = {
    Cities: cities
};

L.control.layers(baseLayers, overlays).addTo(layergroupcontrolmap);