<?php
// Connetti al database
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();

// Ottieni i dati dalla richiesta POST
$email = $_POST['email'];
$password = $_POST['password'];
$codiceFiscale = $_POST['codiceFiscale'];
$dataNascita = $_POST['dataNascita'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$numero = $_POST['numero'];
$CVV = $_POST['CVV'];
$dataScadenza = $_POST['dataScadenza'];
$citta = $_POST['citta'];
$via = $_POST['via'];
$numeroCivico = $_POST['numeroCivico'];

// Aggiorna i dettagli del cliente
$result = $gestoreDb->updateCliente($email, $password, $codiceFiscale, $dataNascita, $nome, $cognome, $numero, $CVV, $dataScadenza, $citta, $via, $numeroCivico);

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
