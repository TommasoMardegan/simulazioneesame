$(document).ready(function () {
    // Ottieni i parametri URL
    var urlParams = new URLSearchParams(window.location.search);
    var codice = urlParams.get('codice');

    // Carica i dati della stazione al caricamento della pagina
    loadStazione(codice);

    // Funzione per caricare i dati della stazione
    function loadStazione(codice) {
        // Effettua una richiesta AJAX per ottenere i dati della stazione
        $.get('../php/getStazione.php', { codice: codice }, function (data) {
            var stazione = JSON.parse(data)["message"];
            // Popola i campi del form con i dati della stazione
            $('#codice').val(stazione.codice);
            $('#numeroSlot').val(stazione.numeroSlot);
            $('#citta').val(stazione.citta);
            $('#via').val(stazione.via);
            $('#numeroCivico').val(stazione.numeroCivico);
            $('#provincia').val(stazione.provincia);
            $('#regione').val(stazione.regione);
        });
    }

    // Gestisci il submit del form per salvare le modifiche
    $('#modifica-stazione-form').submit(function (event) {
        event.preventDefault();
        // Ottieni i dati dal form
        var stazione = {
            codice: $('#codice').val(),
            numeroSlot: $('#numeroSlot').val(),
            citta: $('#citta').val(),
            via: $('#via').val(),
            numeroCivico: $('#numeroCivico').val(),
            provincia: $('#provincia').val(),
            regione: $('#regione').val()
        };
        // Effettua una richiesta AJAX per salvare le modifiche
        $.post('../php/updateStazione.php', { stazione }, function (data) {
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
