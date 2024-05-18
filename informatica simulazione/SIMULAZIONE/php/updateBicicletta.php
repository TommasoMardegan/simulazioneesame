<?php
// Connetti al database
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();

// Ottieni i dati dalla richiesta POST
$codiceRFID = $_POST['codiceRFID'];
$kmpercorsi = $_POST['kmpercorsi'];
$codiceGPS = $_POST['codiceGPS'];
$longitudine = $_POST['longitudine'];
$latitudine = $_POST['latitudine'];

// Aggiorna i dettagli della bicicletta
$result = $gestoreDb->updateBicicletta($codiceRFID, $kmpercorsi, $codiceGPS, $longitudine, $latitudine);

$status ="ok";
$response = array(
    "status" => $status,
    "message" => $result
);

// Codifica la risposta in JSON
$risposta = json_encode($response);

// Stampa il risultato JSON per il JavaScript
echo $risposta;

?>
