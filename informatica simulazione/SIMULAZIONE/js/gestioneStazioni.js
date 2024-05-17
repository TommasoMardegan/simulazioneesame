$(document).ready(function () {
    // Carica tutte le stazioni al caricamento della pagina
    loadStazioni();

    // Funzione per caricare tutte le stazioni
    function loadStazioni() {
        // Effettua una richiesta AJAX per ottenere le stazioni dal server
        $.get('../php/getStazioni.php', function (data) {
            // Parsifica i dati JSON ricevuti
            var stazioniJson = JSON.parse(data);
            var stazioni = stazioniJson["message"];
            // Ottieni l'elemento tbody della tabella
            var stazioniList = $('#stazioni-list');
            // Svuota il contenuto attuale della tabella
            stazioniList.empty();
            // Per ogni stazione, crea una riga nella tabella
            stazioni.forEach(function (stazione) {
                // Crea la riga della tabella con i dati della stazione
                var row = '<tr>';
                row += '<td>' + stazione.codice + '</td>';
                row += '<td>' + stazione.numeroSlot + '</td>';
                row += '<td>' + stazione.citta + '</td>';
                row += '<td>' + stazione.via + '</td>';
                row += '<td>' + stazione.numeroCivico + '</td>';
                row += '<td>' + stazione.provincia + '</td>';
                row += '<td>' + stazione.regione + '</td>';
                // Aggiungi il pulsante per eliminare la stazione
                row += '<td><button class="btn btn-danger btn-sm delete-btn" data-codice="' + stazione.codice + '">Elimina</button></td>';
                row += '</tr>';
                // Aggiungi la riga alla tabella
                stazioniList.append(row);
            });
        });
    }

    // Gestisci il click sui pulsanti di eliminazione delle stazioni
    $(document).on('click', '.delete-btn', function () {
        // Ottieni il codice della stazione da eliminare
        var codice = $(this).data('codice');
        // Effettua una richiesta AJAX per eliminare la stazione
        $.post('../php/deleteStazione.php', { codice: codice }, function (data) {
            dataParsed = JSON.parse(data);
            // Se l'eliminazione ha avuto successo, ricarica la lista delle stazioni
            if (dataParsed["message"] === true) {
                loadStazioni();
            } else {
                // Altrimenti, mostra un messaggio di errore
                alert('Si è verificato un errore durante l\'eliminazione della stazione.');
            }
        });
    });
});
