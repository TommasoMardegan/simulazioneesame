<?php
// Connetti al database
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();

// Ottieni il codice dalla richiesta
$codice = $_GET['codice'];
$result = $gestoreDb->getStazione($codice);

$status = "ok";
$response = array(
    "status" => $status,
    "message" => $result
);

// Codifica la risposta in JSON
$risposta = json_encode($response);

// Stampa il risultato JSON per il JavaScript
echo $risposta;
?>
