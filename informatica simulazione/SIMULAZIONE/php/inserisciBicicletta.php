<?php
// Includi il file della classe gestioneDB
include_once("../service/gestioneDB.php");

// Verifica se è stata ricevuta una richiesta POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se tutti i parametri sono stati ricevuti correttamente
    if (isset($_POST["codiceRFID"]) && isset($_POST["kmpercorsi"]) && isset($_POST["codiceGPS"]) && isset($_POST["longitudine"]) && isset($_POST["latitudine"])) {
        // Crea una nuova istanza della classe gestioneDB
        $gestioneDB = new gestioneDB();

        // Ottieni i valori dei parametri dalla richiesta POST
        $codiceRFID = $_POST["codiceRFID"];
        $kmpercorsi = $_POST["kmpercorsi"];
        $codiceGPS = $_POST["codiceGPS"];
        $longitudine = $_POST["longitudine"];
        $latitudine = $_POST["latitudine"];

        // Chiamata al metodo per inserire la bicicletta nel database
        $inserimento = $gestioneDB->inserisciBicicletta($codiceRFID, $kmpercorsi, $codiceGPS, $longitudine, $latitudine);
        if($inserimento == true) {
            echo "successo";
        }
    }
}
?>
