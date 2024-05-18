<?php
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();
$codice = $_GET["codice"];
$numeroPosti = $_GET["numeroPosti"];
$result = $gestoreDb->updateNumeroPosti($codice, $numeroPosti);

$status = "ok";
$response = array(
    //status ok perchè il server non ha dato errori
    "status" => $status,
    //loggato con successo o meno
    "message" => $result
);
// Ora puoi utilizzare $email e $password come desideri, ad esempio eseguire l'accesso nel database
// Fai attenzione alla sicurezza, ad esempio usando statement preparati per eseguire query SQL
// Esempio di risposta che potresti inviare indietro al client
$risposta = json_encode($response);
// Stampa il risultato JSON per il JavaScript
echo $risposta;
?>