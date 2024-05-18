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

    function findLatLonAddMarker(address, codice) {
        var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address);

        $.getJSON(url, function (data) {
            if (data.length > 0) {
                var lat = parseFloat(data[0].lat);
                var lon = parseFloat(data[0].lon);
                var marker = L.marker([lat, lon]).addTo(mymap).bindPopup(address);

                // Aggiungi l'evento 'click' a ciascun marker
                marker.on('click', function(e) {
                    // Prendo latitudine e longitudine del parcheggio
                    let latitudine = e.latlng.lat;
                    let longitudine = e.latlng.lng;
                    
                    // Pagina da visualizzare
                    let pagina = "../html/parcheggio.php?latitudine=" + latitudine + "&longitudine=" + longitudine + "&codice=" + codice;
                    
                    // Apro pagina che visualizza il parcheggio
                    window.location.href = pagina;
                });

                // Apri automaticamente il popup per mostrare le informazioni del marker
                marker.openPopup();
            }
        });
    }

    function loadStazioni() {
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
                // Passa l'indirizzo e l'ID del parcheggio alla funzione findLatLonAddMarker
                findLatLonAddMarker(station.numeroCivico + ',' + station.via + ', ' + station.citta + ', ' + station.provincia + ', ' + station.regione + ', ' + 'Italy', station.codice);
            });
        });
    }
    loadStazioni();
});
