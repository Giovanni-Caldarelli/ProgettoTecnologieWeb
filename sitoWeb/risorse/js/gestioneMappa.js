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

    locations.forEach(location => {
        const marker = L.marker([location.lat, location.lng]).addTo(generalMap);
        marker.bindPopup(`<b>${location.name}</b><br>${location.address}<br><a href='${location.link}' target='_blank'>Apri su Maps</a>`);
    });
}
document.addEventListener("DOMContentLoaded", initMap);
