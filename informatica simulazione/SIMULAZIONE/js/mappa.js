$(document).ready(function () {
    var mymap; // Dichiarazione della variabile mymap nell'ambito globale

    function loadMap() {
        // Inizializza la mappa
        mymap = L.map('mapid').setView([45.738777965232245, 9.129964082099326], 13);

        // Aggiungi la mappa di OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(mymap);
    }

    function findLatLonAddMarker(address) {
        var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address);

        $.getJSON(url, function (data) {
            if (data.length > 0) {
                var lat = parseFloat(data[0].lat);
                var lon = parseFloat(data[0].lon);
                L.marker([lat, lon]).addTo(mymap).bindPopup(address);
            }
        });
    }

    $("#caricaMappa").click(function () {
        // Carica i dati delle stazioni
        $.get('../php/getStazioni.php', {}, function (data) {
            // Decodifica i dati JSON
            var stations = JSON.parse(data);
            // Prende la lista contenuta nel message
            var stazioni = stations["message"];
            // Carica la mappa solo dopo aver caricato i dati delle stazioni
            loadMap();
            // Aggiungi un marker per ogni stazione
            stazioni.forEach(function (station) {
                findLatLonAddMarker(station.numeroCivico + ',' + station.via + ', ' + station.citta + ', ' + station.provincia + ', ' + station.regione + ', ' + 'Italy');
            });
        });
    });
});
