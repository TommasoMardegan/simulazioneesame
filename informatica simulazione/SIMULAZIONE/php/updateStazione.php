<?php
// Connetti al database
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();

// Ottieni i dati dalla richiesta POST
$codice = $_POST['codice'];
$numeroSlot = $_POST['numeroSlot'];
$citta = $_POST['citta'];
$via = $_POST['via'];
$numeroCivico = $_POST['numeroCivico'];
$provincia = $_POST['provincia'];
$regione = $_POST['regione'];

// Aggiorna i dettagli della stazione
$result = $gestoreDb->updateStazione($codice, $numeroSlot, $citta, $via, $numeroCivico, $provincia, $regione);

$status = $result ? "ok" : "error";
$response = array(
    "status" => $status,
    "message" => $result
);

// Codifica la risposta in JSON
$risposta = json_encode($response);

// Stampa il risultato JSON per il JavaScript
echo $risposta;
?>
