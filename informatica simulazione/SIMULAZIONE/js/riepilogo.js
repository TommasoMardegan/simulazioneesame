$(document).ready(function () {
    // Carica il riepilogo delle operazioni al caricamento della pagina
    loadRiepilogo();

    // Funzione per caricare il riepilogo delle operazioni
    function loadRiepilogo() {
        $.post('../php/riepilogo.php', {}, function (data) {
            var riepilogo = JSON.parse(data);

            if (riepilogo.status === "ok") {
                var html = "<h3>Dettagli Utilizzo</h3>";
                html += "<p>Totale Speso: " + riepilogo.totaleSpeso + " €</p>";
                html += "<p>Totale Km Percorsi: " + riepilogo.totaleKm + " km</p>";

                $('#riepilogo').html(html);
            } else {
                $('#riepilogo').html("<p>Errore nel caricamento del riepilogo.</p>");
            }
        });
    }
});
