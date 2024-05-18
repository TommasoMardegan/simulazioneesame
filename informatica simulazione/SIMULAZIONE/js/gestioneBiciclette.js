$(document).ready(function () {
    // Carica tutte le biciclette al caricamento della pagina
    loadBiciclette();

    // Funzione per caricare tutte le biciclette
    function loadBiciclette() {
        // Effettua una richiesta AJAX per ottenere le biciclette dal server
        $.get('../php/getBiciclette.php', function (data) {
            // Parsifica i dati JSON ricevuti
            var bicicletteJson = JSON.parse(data);
            var biciclette = bicicletteJson["message"];
            // Ottieni l'elemento tbody della tabella
            var bicicletteList = $('#biciclette-list');
            // Svuota il contenuto attuale della tabella
            bicicletteList.empty();
            // Per ogni bicicletta, crea una riga nella tabella
            biciclette.forEach(function (bicicletta) {
                // Crea la riga della tabella con i dati della bicicletta
                var row = '<tr>';
                row += '<td>' + bicicletta.codiceRFID + '</td>';
                row += '<td>' + bicicletta.kmpercorsi + '</td>';
                row += '<td>' + bicicletta.codiceGPS + '</td>';
                row += '<td>' + bicicletta.longitudine + '</td>';
                row += '<td>' + bicicletta.latitudine + '</td>';
                // Aggiungi il pulsante per eliminare la bicicletta
                row += '<td><button class="btn btn-danger btn-sm delete-btn" data-codice="' + bicicletta.codiceRFID + '">Elimina</button></td>';
                // Aggiungi il pulsante per modificare la bicicletta
                row += '<td><button class="btn btn-warning btn-sm edit-btn" data-codice="' + bicicletta.codiceRFID + '">Modifica</button></td>';
                row += '</tr>';
                // Aggiungi la riga alla tabella
                bicicletteList.append(row);
            });
        });
    }

    // Gestisci il click sui pulsanti di eliminazione delle biciclette
    $(document).on('click', '.delete-btn', function () {
        // Ottieni il codice RFID della bicicletta da eliminare
        var codiceRFID = $(this).data('codice');
        // Effettua una richiesta AJAX per eliminare la bicicletta
        $.post('../php/deleteBicicletta.php', { codiceRFID: codiceRFID }, function (data) {
            dataParsed = JSON.parse(data);
            // Se l'eliminazione ha avuto successo, ricarica la lista delle biciclette
            if (dataParsed["message"] === true) {
                loadBiciclette();
            } else {
                // Altrimenti, mostra un messaggio di errore
                alert('Si è verificato un errore durante l\'eliminazione della bicicletta.');
            }
        });
    });

    // Gestisci il click sui pulsanti di modifica delle biciclette
    $(document).on('click', '.edit-btn', function () {
        // Ottieni il codice RFID della bicicletta da modificare
        var codiceRFID = $(this).data('codice');
        // Reindirizza alla pagina di modifica con il codice RFID come parametro URL
        window.location.href = 'modificaBicicletta.html?codiceRFID=' + codiceRFID;
    });
});
