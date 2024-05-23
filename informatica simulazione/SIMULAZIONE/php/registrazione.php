<?php
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();
if(isset($_GET['email']) && isset($_GET['password']) && isset($_GET['codiceFiscale']) && strlen($_GET['codiceFiscale']) == 16 
&& isset($_GET['dataNascita']) && isset($_GET['nome']) && isset($_GET['cognome']) && isset($_GET['numeroCarta']) && strlen($_GET['numeroCarta']) == 16 && isset($_GET['cvvCarta']) && strlen($_GET['cvvCarta']) == 3 && isset($_GET['dataScadenzaCarta']) && isset($_GET['citta']) && isset($_GET['via']) && isset($_GET['numeroCivico'])) {
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
    $provincia = $_GET['provincia'];
    $regione = $_GET['regione'];

    $result = $gestoreDb->registrazione($email, $password, $codiceFiscale, $dataNascita, $nome, $cognome, $numeroCarta, $cvvCarta, $dataScadenzaCarta, $citta, $via, $numeroCivico, $provincia, $regione);

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
    $status = "ok";
    $response = array(
        //status ok perchè il server non ha dato errori
        "status" => $status,
        //loggato con successo o meno
        "statoRegistrazione" => false
    );

    $risposta = json_encode($response);
    echo $risposta;
}
?>