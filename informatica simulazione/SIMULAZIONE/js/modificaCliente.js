$(document).ready(function () {
    // Carica i dati del cliente al caricamento della pagina
    loadCliente();

    // Funzione per caricare i dati del cliente
    function loadCliente() {
        $.get('../php/getCliente.php', function (data) {
            var cliente = JSON.parse(data)["message"];
            // Popola i campi del form con i dati del cliente
            $('#email').val(cliente.email);
            $('#password').val(cliente.password);
            $('#codiceFiscale').val(cliente.codiceFiscale);
            $('#dataNascita').val(cliente.dataNascita);
            $('#nome').val(cliente.nome);
            $('#cognome').val(cliente.cognome);
            $('#numero').val(cliente.numero);
            $('#CVV').val(cliente.CVV);
            $('#dataScadenza').val(cliente.dataScadenza);
            $('#citta').val(cliente.citta);
            $('#via').val(cliente.via);
            $('#numeroCivico').val(cliente.numeroCivico);
        });
    }

    // Gestisci il submit del form per salvare le modifiche
    $('#modifica-cliente-form').submit(function (event) {
        event.preventDefault();
        // Ottieni i dati dal form
        var cliente = {
            email: $('#email').val(),
            password: $('#password').val(),
            codiceFiscale: $('#codiceFiscale').val(),
            dataNascita: $('#dataNascita').val(),
            nome: $('#nome').val(),
            cognome: $('#cognome').val(),
            numero: $('#numero').val(),
            CVV: $('#CVV').val(),
            dataScadenza: $('#dataScadenza').val(),
            citta: $('#citta').val(),
            via: $('#via').val(),
            numeroCivico: $('#numeroCivico').val()
        };
        // Effettua una richiesta AJAX per salvare le modifiche
        $.post('../php/updateCliente.php', cliente, function (data) {
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
