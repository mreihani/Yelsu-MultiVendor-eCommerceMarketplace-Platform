var marker, circle;
if(!latitudeVal || !longitudeVal) {
    var map = L.map('map').setView([32.676372772089834, 54.360726309337686], 5);
} else {
    var map = L.map('map').setView([latitudeVal, longitudeVal], 5);
}

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// neshan API codes
// var map = new L.Map('map', {
//     key: 'APICODE',
//     maptype: 'neshan',
//     poi: true,
//     traffic: true,
//     center: [32.676372772089834, 54.360726309337686],
//     zoom: 5
// });
// neshan API codes


// geolocatin codes
// navigator.geolocation.watchPosition(success,error);
// function success(pos){
//     const lat = pos.coords.latitude;
//     const lng = pos.coords.longitute;
//     const accuracy = pos.coords.accuracy;

//     if(marker) {
//         map.removeLayer(marker);
//         map.removeLayer(circle);
//     }

//     marker = L.marker([lat,lng]).addTo(map);
//     circle = L.circle([lat,lng],{radius:accuracy}).addTo(map);

//     map.fitBounds(circle.getBounds());
// }
// function error(err) {
//     if(err.code === 1) {
//         console.log("Please allow location address");
//     } else {
//         console.log("Cannot get current location");
//     }
// }
// geolocatin codes


var geocoder = L.Control.geocoder({
    defaultMarkGeocode: false,
}).on('markgeocode', function(e) {
var bbox = e.geocode.bbox;
var poly = L.polygon([
    bbox.getSouthEast(),
    bbox.getNorthEast(),
    bbox.getNorthWest(),
    bbox.getSouthWest()
]).addTo(map);
    map.fitBounds(poly.getBounds());
}).addTo(map);


if(latitudeVal != null && longitudeVal != null) {
    marker = L.marker([latitudeVal, longitudeVal]).addTo(map);
}

map.on('click', function (e) {

    if (marker) { 
        map.removeLayer(marker);
    }
    marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);

    $('#latitude').val(e.latlng.lat);
    $('#longitude').val(e.latlng.lng);

    // send coordination request to neshan api
    sendCoordsNeshanApi(e.latlng.lat,e.latlng.lng);
});

function updateCoords() {
    let lat = $('#latitude').val();
    let lng = $('#longitude').val();

    if (marker) { 
        map.removeLayer(marker);
    }
    marker = L.marker([lat,lng]).addTo(map);

    // send coordination request to neshan api
    sendCoordsNeshanApi(lat,lng);
}

function sendCoordsNeshanApi(lat,lng) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    
    $.ajax({
        url: `/sendcorrdinates`,
        method: "post",
        data: { lat: lat, lng: lng},
        success: function (response) {
            $('#shop_address').val(JSON.parse(response).formatted_address);
        },
    });
}




