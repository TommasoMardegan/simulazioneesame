$(document).ready(function() {
    $("#caricaMappa").click(function () {
        $.get("../php/caricaMappa.php", {}, function(data) {
            dataParsed = JSON.parse(data);
            var listaStazioni = dataParsed["message"];
        });
    });
});
