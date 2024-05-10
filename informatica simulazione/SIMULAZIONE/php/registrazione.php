<?php
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();
if(isset($_GET['email']) && isset($_GET['password']) && isset($_GET['codiceFiscale']) && isset($_GET['dataNascita']) && isset($_GET['nome']) && isset($_GET['cognome']) && isset($_GET['numeroCarta']) && isset($_GET['cvvCarta']) && isset($_GET['dataScadenzaCarta']) && isset($_GET['citta']) && isset($_GET['via']) && isset($_GET['numeroCivico'])) {
    // Recupera i valori dei parametri
    $email = $_GET['email'];
    $password = $_GET['password'];
    $codiceFiscale = $_GET['codiceFiscale'];
    $dataNascita = $_GET['dataNascita'];
    $nome = $_GET['nome'];
    $cognome = $_GET['cognome'];
    $numeroCarta = $_GET['numeroCarta'];
    $cvvCarta = $_GET['cvvCarta'];
    $dataScadenzaCarta = $_GET['dataScadenzaCarta'];
    $citta = $_GET['citta'];
    $via = $_GET['via'];
    $numeroCivico = $_GET['numeroCivico'];

    $result = $gestoreDb->registrazione($email, $password, $codiceFiscale, $dataNascita, $nome, $cognome, $numeroCarta, $cvvCarta, $dataScadenzaCarta, $citta, $via, $numeroCivico);

    $status = "ok";
    $response = array(
        //status ok perchè il server non ha dato errori
        "status" => $status,
        //loggato con successo o meno
        "statoRegistrazione" => $result
    );

    $risposta = json_encode($response);
    echo $risposta;
} else {
    echo "errore nella registrazione";
}
?>