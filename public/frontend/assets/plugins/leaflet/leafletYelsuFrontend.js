var map = L.map('map').setView([latitudeVal, longitudeVal], 5);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

for(let key in outletsArr) {
    let outletItem = outletsArr[key];

    let customIcon = L.icon({
        iconUrl: outletItem[4],
        className: outletItem[5],
    })

    L.marker(outletItem[2], {
        title: outletItem[0],
        icon: customIcon,
    })
    .bindPopup(`<span class="leafletPopupInfo">
                    <h5>${outletItem[0]}</h5>
                    <p>آدرس: ${outletItem[1]}</p>
                    <a class="btn btn-primary btn-sm btn-ellipse" href="${outletItem[3]}">
                    اطلاعات بیشتر
                    <i class="w-icon-store"></i>
                    </a>
                </span>`)
    .addTo(map);
}

