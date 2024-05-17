<?php
// Includi il file della classe gestioneDB
include_once("../service/gestioneDB.php");

// Verifica se è stata ricevuta una richiesta POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se tutti i parametri sono stati ricevuti correttamente
    if (isset($_POST["codice"]) && isset($_POST["numeroSlot"]) && isset($_POST["citta"]) && isset($_POST["via"]) && isset($_POST["numeroCivico"]) && isset($_POST["provincia"]) && isset($_POST["regione"])) {
        // Crea una nuova istanza della classe gestioneDB
        $gestioneDB = new gestioneDB();

        // Ottieni i valori dei parametri dalla richiesta POST
        $codice = $_POST["codice"];
        $numeroSlot = $_POST["numeroSlot"];
        $citta = $_POST["citta"];
        $via = $_POST["via"];
        $numeroCivico = $_POST["numeroCivico"];
        $provincia = $_POST["provincia"];
        $regione = $_POST["regione"];

        // Chiamata al metodo per inserire la stazione nel database
        $inserimento = $gestioneDB->inserisciStazione($codice, $numeroSlot, $citta, $via, $numeroCivico, $provincia, $regione);
        if ($inserimento == true) {
            echo "successo";
        } else {
            echo "errore";
        }
    } else {
        echo "parametri mancanti";
    }
}
?>
