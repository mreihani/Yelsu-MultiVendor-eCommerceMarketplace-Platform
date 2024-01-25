let mapContainerArray = $(".shipping-page-map-container");
let mapContainerIdArr = $.map( mapContainerArray, function( val, i ) {

    return {
        id: $(val).attr("id"),
        vendor_coords: $(val).attr("vendor_coords"),
        user_coords: $(val).attr("user_coords"),
    }
});

$.each(mapContainerIdArr, (key, val) => {
    let mapObj = val.id;
    let vendorCoords = JSON.parse(val.vendor_coords);
    let userCoords = JSON.parse(val.user_coords);

    // only for neshan tiles
    mapObj = new L.Map(mapObj, {
        key: "web.72d88acbee68404289191f19fc1d2643",
        maptype: "dreamy-gold",
        poi: false,
        traffic: false,
        center: userCoords[0][2],
        zoom: 4,
    })

    // mapObj = L.map(mapObj).setView(userCoords[0][2], 4);
    // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    // }).addTo(mapObj);

    for(let key in vendorCoords) {
        let outletItem = vendorCoords[key];

        let customIcon = L.icon({
            iconUrl: outletItem[5],
            className: outletItem[6],
        })

        L.marker(outletItem[3], {
            title: outletItem[1],
            icon: customIcon,
        })
        .bindPopup(`<span class="leafletPopupInfo">
                        <h5>${outletItem[1]}</h5>
                        <p>آدرس: ${outletItem[2]}</p>
                        <a class="btn btn-primary btn-sm btn-ellipse" href="${outletItem[4]}">
                        اطلاعات بیشتر
                        <i class="w-icon-store"></i>
                        </a>
                    </span>`)
        .addTo(mapObj);
    }

    for(let key in userCoords) {
        let outletItem = userCoords[key];

        L.marker(outletItem[2], {
            title: outletItem[1],
        })
        .addTo(mapObj);
    }

});




