$(document).ready(function () {
    // Gestisci l'invio del modulo
    $('#inserisci-stazione-form').submit(function (event) {
        // Evita il comportamento predefinito del modulo
        event.preventDefault();
        
        // Ottieni i valori dal modulo
        var codice = $('#codice').val();
        var numeroSlot = $('#numeroSlot').val();
        var citta = $('#citta').val();
        var via = $('#via').val();
        var numeroCivico = $('#numeroCivico').val();
        var provincia = $('#provincia').val();
        var regione = $('#regione').val();

        // Effettua una richiesta AJAX per inserire la stazione
        $.post('../php/inserisciStazione.php', {
            codice: codice,
            numeroSlot: numeroSlot,
            citta: citta,
            via: via,
            numeroCivico: numeroCivico,
            provincia: provincia,
            regione: regione
        }, function (data) {
            // Se l'inserimento ha avuto successo, mostra un messaggio di successo
            if (data === "successo") {
                alert("Stazione inserita con successo");
                // Resetta il modulo
                $('#inserisci-stazione-form')[0].reset();
            } else {
                // Altrimenti, mostra un messaggio di errore
                alert('Si è verificato un errore durante l\'inserimento della stazione.');
            }
        });
    });
});
