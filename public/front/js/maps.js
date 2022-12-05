// Maps access token
var key = 'pk.87f2d9fcb4fdd8da1d647b46a997c727';

// Initial map view | Syria
var INITIAL_LNG = 34.802075;
var INITIAL_LAT = 38.996815;

// Change the initial view if there is a GeoIP lookup
if (typeof Geo === 'object') {
    INITIAL_LNG = Geo.lon;
    INITIAL_LAT = Geo.lat;
}

// Add layers that we need to the map
var streets = L.tileLayer.Unwired({key: key, scheme: "streets"});
var earth = L.tileLayer.Unwired({key: key, scheme: "earth"});
var hybrid = L.tileLayer.Unwired({key: key, scheme: "hybrid"});

// Add map
var map = L.map('map', {
    scrollWheelZoom: (window.self === window.top) ? true : false,
    dragging: (window.self !== window.top && L.Browser.touch) ? false : true,
    layers: [streets],
    tap: (window.self !== window.top && L.Browser.touch) ? false : true,
}).setView([INITIAL_LNG, INITIAL_LAT], 6);

// Add marker
var marker = L.marker([INITIAL_LNG, INITIAL_LAT]).addTo(map);

// Add the 'layers' control
L.control.layers({
    "Streets": streets,
    "Earth": earth,
    "Hybrid": hybrid,
}, null, {
    position: "topright"
}).addTo(map);

// Add the 'scale' control
L.control.scale().addTo(map);
