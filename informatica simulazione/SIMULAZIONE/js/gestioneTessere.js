$(document).ready(function () {
    // Carica tutti i clienti inattivi al caricamento della pagina
    loadClientiInattivi();

    // Funzione per caricare tutti i clienti inattivi
    function loadClientiInattivi() {
        // Effettua una richiesta AJAX per ottenere i clienti inattivi dal server
        $.get('../php/get_clienti_inattivi.php', function (data) {
            // Parsifica i dati JSON ricevuti
            var clientiInattivi = JSON.parse(data);
            // Ottieni l'elemento tbody della tabella
            var clientiBody = $('#clientiBody');
            // Svuota il contenuto attuale della tabella
            clientiBody.empty();
            // Per ogni cliente inattivo, crea una riga nella tabella
            clientiInattivi.forEach(function (cliente) {
                // Crea la riga della tabella con i dati del cliente
                var row = '<tr>';
                row += '<td>' + cliente.ID + '</td>';
                row += '<td>' + cliente.codiceTessera + '</td>';
                row += '<td>' + cliente.email + '</td>';
                row += '<td>' + cliente.password + '</td>';
                row += '<td>' + cliente.codiceFiscale + '</td>';
                row += '<td>' + cliente.dataNascita + '</td>';
                row += '<td>' + cliente.nome + '</td>';
                row += '<td>' + cliente.cognome + '</td>';
                row += '<td>' + cliente.numero + '</td>';
                row += '<td>' + cliente.CVV + '</td>';
                row += '<td>' + cliente.dataScadenza + '</td>';
                row += '<td>' + cliente.citta + '</td>';
                row += '<td>' + cliente.via + '</td>';
                row += '<td>' + cliente.numeroCivico + '</td>';
                row += '<td>' + cliente.attivo + '</td>';
                // Aggiungi il pulsante "Rigenera Tessera"
                row += '<td><button class="btn btn-primary btn-sm rigenera-btn" data-id="' + cliente.ID + '">Rigenera Tessera</button></td>';
                row += '</tr>';
                // Aggiungi la riga alla tabella
                clientiBody.append(row);
            });
        });
    }

    // Gestisci il click sul pulsante "Rigenera Tessera"
    $(document).on('click', '.rigenera-btn', function () {
        // Ottieni l'ID del cliente dalla riga corrispondente
        var clienteID = $(this).data('id');
        // Effettua una richiesta AJAX per rigenerare la tessera del cliente
        $.post('../php/rigenera_tessera.php', { id: clienteID }, function (data) {
            dataParsed = JSON.parse(data);
            // Se la rigenerazione ha avuto successo, ricarica la lista dei clienti inattivi
            if (dataParsed["success"] == true) {
                loadClientiInattivi();
            } else {
                // Altrimenti, mostra un messaggio di errore
                alert('Si è verificato un errore durante la rigenerazione della tessera.');
            }
        });
    });
});
