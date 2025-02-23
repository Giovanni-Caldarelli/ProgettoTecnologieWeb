function initMap() {
    const locations = [
        { lat: 40.8471, lng: 14.2576, name: "Centro Storico", address: "Via Toledo, 123, Napoli", link: "https://www.google.com/maps?q=Via+Toledo,+123,+Napoli" },
        { lat: 40.8308, lng: 14.2269, name: "Mergellina", address: "Via Caracciolo, 45, Napoli", link: "https://www.google.com/maps?q=Via+Caracciolo,+45,+Napoli" },
        { lat: 40.8442, lng: 14.2337, name: "Vomero", address: "Via Scarlatti, 67, Napoli", link: "https://www.google.com/maps?q=Via+Scarlatti,+67,+Napoli" }
    ];  

    const generalMap = L.map("map-all", {
        center: [40.8401, 14.2522],
        zoom: 13,
        scrollWheelZoom: false, 
        dragging: true, 
        touchZoom: true, 
        doubleClickZoom: false 
    });
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(generalMap);

    const blueIcon = L.icon({
        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34]
    });

    let markers = []; 
    locations.forEach(location => {
        const marker = L.marker([location.lat, location.lng], { icon: blueIcon }).addTo(generalMap);
        marker.bindPopup(`<b>${location.name}</b><br>${location.address}<br><a href='${location.link}' target='_blank'>Apri su Maps</a>`);
        location.marker = marker; 
        markers.push(marker);
    });

    const group = L.featureGroup(markers);
    generalMap.fitBounds(group.getBounds());


    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;
            generalMap.setView([userLat, userLng], 15);
            
            const redIcon = L.icon({
                iconUrl: '../risorse/immagini/Map-Pin.svg',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34]
            });
            
            const userMarker = L.marker([userLat, userLng], { icon: redIcon }).addTo(generalMap);
            userMarker.bindPopup("<b>La tua posizione</b>").openPopup();

            let nearestLocation = null;
            let nearestDistance = Infinity;

            locations.forEach(location => {
                const distance = Math.sqrt(Math.pow(userLat - location.lat, 2) + Math.pow(userLng - location.lng, 2));
                if (distance < nearestDistance) {
                    nearestDistance = distance;
                    nearestLocation = location;
                }
            });

            if (nearestLocation) {
                nearestLocation.marker.bindPopup(`<b>${nearestLocation.name} (Parcheggio più vicino)</b><br>${nearestLocation.address}<br>
                    <a href='#' onclick='openGoogleMaps(${nearestLocation.lat}, ${nearestLocation.lng})'>Apri su Maps</a>`).openPopup();
            }
        }, () => {
            console.log("Geolocalizzazione non consentita.");
        });
    }
}

window.openGoogleMaps = function(destLat, destLng) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;
            window.open(`https://www.google.com/maps/dir/${userLat},${userLng}/${destLat},${destLng}/`, '_blank');
        });
    } else {
        window.open(`https://www.google.com/maps?q=${destLat},${destLng}`, '_blank');
    }
};

document.addEventListener("DOMContentLoaded", initMap);
