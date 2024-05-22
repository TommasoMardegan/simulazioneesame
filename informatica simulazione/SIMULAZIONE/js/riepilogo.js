$(document).ready(function () {
    // Carica il riepilogo delle operazioni al caricamento della pagina
    loadRiepilogo();

    // Funzione per caricare il riepilogo delle operazioni
    function loadRiepilogo() {
        // Effettua una richiesta AJAX per ottenere il riepilogo delle operazioni dal server
        $.get('../php/getRiepilogo.php', function (data) {
            // Parsifica i dati JSON ricevuti
            var operazioni = JSON.parse(data);
            // Ottieni l'elemento tbody della tabella
            var tableBody = $('#riepilogo-table tbody');
            // Svuota il contenuto attuale della tabella
            tableBody.empty();
            // Per ogni operazione, crea una riga nella tabella
            operazioni.forEach(function (operazione) {
                // Crea la riga della tabella con i dati dell'operazione
                var row = '<tr>';
                //row += '<td>' + operazione["id"] + '</td>';
                if(operazione.tipo == "noleggia") {
                    row += '<td>' + operazione.tipo + '</td>';
                    row += '<td>' + operazione.codiceBicicletta + '</td>';
                    row += '<td>' + operazione.codiceStazione + '</td>';
                    row += '<td>' + operazione.dataOra + '</td>';
                    row += '</tr>';
                } else if(operazione.tipo == "consegna") {
                    row += '<td>' + operazione.distanzaPercorsa + '</td>';
                    row += '<td>' + operazione.tariffa + '</td>';
                    row += '<td>' + operazione.tipo + '</td>';
                    row += '<td>' + operazione.codiceBicicletta + '</td>';
                    row += '<td>' + operazione.codiceStazione + '</td>';
                    row += '<td>' + operazione.dataOra + '</td>';
                    row += '</tr>';
                }
                // Aggiungi la riga alla tabella
                tableBody.append(row);
            });
        });
    }
});
