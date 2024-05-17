$(document).ready(function () {
    // Gestisci l'invio del modulo
    $('#inserisci-bicicletta-form').submit(function (event) {
        // Evita il comportamento predefinito del modulo
        event.preventDefault();
        
        // Ottieni i valori dal modulo
        var codiceRFID = $('#codiceRFID').val();
        var kmpercorsi = $('#kmpercorsi').val();
        var codiceGPS = $('#codiceGPS').val();
        var longitudine = $('#longitudine').val();
        var latitudine = $('#latitudine').val();

        // Effettua una richiesta AJAX per inserire la bicicletta
        $.post('../php/inserisciBicicletta.php', {
            codiceRFID: codiceRFID,
            kmpercorsi: kmpercorsi,
            codiceGPS: codiceGPS,
            longitudine: longitudine,
            latitudine: latitudine
        }, function (data) {
            // Se l'inserimento ha avuto successo, reindirizza alla pagina di gestione biciclette
            if (data === "successo") {
                alert("bicicletta inserita con successo");
            } else {
                // Altrimenti, mostra un messaggio di errore
                alert('Si è verificato un errore durante l\'inserimento della bicicletta.');
            }
        });
    });
});
