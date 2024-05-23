$(document).ready(function () {
    // Ottieni i parametri URL
    var urlParams = new URLSearchParams(window.location.search);
    var codiceRFID = urlParams.get('codiceRFID');

    // Carica i dati della bicicletta al caricamento della pagina
    loadBicicletta(codiceRFID);

    // Funzione per caricare i dati della bicicletta
    function loadBicicletta(codiceRFID) {
        // Effettua una richiesta AJAX per ottenere i dati della bicicletta
        $.get('../php/getBicicletta.php', { codiceRFID: codiceRFID }, function (data) {
            var bicicletta = JSON.parse(data)["message"];
            // Popola i campi del form con i dati della bicicletta
            $('#codiceRFID').val(bicicletta.codiceRFID);
            $('#kmpercorsi').val(bicicletta.kmpercorsi);
            $('#codiceGPS').val(bicicletta.codiceGPS);
            $('#longitudine').val(bicicletta.longitudine);
            $('#latitudine').val(bicicletta.latitudine);
            $('#manutenzione').val(bicicletta.manutenzione); // Aggiunto per il campo manutenzione
        });
    }

    // Gestisci il submit del form per salvare le modifiche
    $('#modifica-bicicletta-form').submit(function (event) {
        event.preventDefault();
        // Ottieni i dati dal form
        var bicicletta = {
            codiceRFID: $('#codiceRFID').val(),
            kmpercorsi: $('#kmpercorsi').val(),
            codiceGPS: $('#codiceGPS').val(),
            longitudine: $('#longitudine').val(),
            latitudine: $('#latitudine').val(),
            manutenzione: $('#manutenzione').val() // Aggiunto per il campo manutenzione
        };
        // Effettua una richiesta AJAX per salvare le modifiche
        $.post('../php/updateBicicletta.php', bicicletta, function (data) {
            var dataParsed = JSON.parse(data);
            // Se il salvataggio ha avuto successo, reindirizza alla pagina principale
            if (dataParsed["message"] === true) {
                alert('Modifiche salvate con successo.');
            } else {
                // Altrimenti, mostra un messaggio di errore
                alert('Si è verificato un errore durante il salvataggio delle modifiche.');
            }
        });
    });
});
