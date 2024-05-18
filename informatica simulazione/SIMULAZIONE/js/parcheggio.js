$(document).ready(function() {
    // Funzione per ottenere i parametri dalla URL
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    // Ottenere i parametri dalla URL
    var latitudine = getUrlParameter('latitudine');
    var longitudine = getUrlParameter('longitudine');
    var codice = getUrlParameter('codice');

    // Effettuare una chiamata AJAX alla pagina getNumeroPosti.php
    if (codice) {
        $.get('../php/getNumeroPosti.php', { codice: codice }, function(data) {
            // Gestire la risposta
            dataParsed = JSON.parse(data);
            numeroPosti = dataParsed["message"];
            // Visualizza i dati nella pagina
            $('#numeroPosti').text(numeroPosti);

            // Se necessario, puoi eseguire altre operazioni con i dati ricevuti
        });
    } else {
        console.error("ID non specificato nella URL");
    }
    //modifico il numero dei posti TOTALi
    $('#modificaBtn').click(function() {
        var numeroPosti = $('#numeroPostiInput').val();
        $.get('../php/modificaNumeroPosti.php', { codice: codice, numeroPosti: numeroPosti }, function(data) {
            // Gestire la risposta
            dataParsed = JSON.parse(data);
            result = dataParsed["message"];
            if(result == true) {
                alert("Numero posti modificati correttamente");
                // Visualizza i dati nella pagina
                $('#numeroPosti').text(numeroPosti);
            }
            else {
                alert("errore nel modificare il numero dei posti");
            }
            // Se necessario, puoi eseguire altre operazioni con i dati ricevuti
        });
    });
});
