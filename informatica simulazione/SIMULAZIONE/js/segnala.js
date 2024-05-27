$(document).ready(function() {
    $("#smarrimentoButton").click(function(event) {
        event.preventDefault();

        $.post("../php/update_status.php", function(data) {
            let dataParsed = JSON.parse(data);
            let responseMessage = $("#responseMessage");

            if (dataParsed.success) {
                responseMessage.text("Stato tessera aggiornato con successo. l'assistenza ti invierà una nuova tessera a breve.");
            } else {
                responseMessage.text("Errore nell'aggiornamento dello stato della tessera.");
            }
        })
    });
});
