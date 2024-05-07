<?php
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();
if(isset($_GET['email']) && isset($_GET['password'])) {
    // Recupera i valori dei parametri
    $email = $_GET['email'];
    $password = $_GET['password'];

    $result = $gestoreDb->login($email, $password);

    $status = "ok";
    $response = array(
        //status ok perchè il server non ha dato errori
        "status" => $status,
        //loggato con successo o meno
        "statoLogin" => $result
    );
    // Ora puoi utilizzare $email e $password come desideri, ad esempio eseguire l'accesso nel database
    // Fai attenzione alla sicurezza, ad esempio usando statement preparati per eseguire query SQL

    // Esempio di risposta che potresti inviare indietro al client
    $risposta = json_encode($response);
    // Stampa il risultato JSON per il JavaScript
    echo $risposta;
} else {
    // Se i parametri non sono stati passati correttamente
    echo "Parametri mancanti.";
}
?>