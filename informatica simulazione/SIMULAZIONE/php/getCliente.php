<?php
// Connetti al database
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();

// Ottieni l'email del cliente dalla sessione
session_start();
$email = $_SESSION['email'];
$result = $gestoreDb->getCliente($email);

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
