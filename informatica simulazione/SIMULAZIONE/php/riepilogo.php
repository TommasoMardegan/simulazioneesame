<?php
// Connetti al database
include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();
session_start();
// Ottieni i dati dalla richiesta POST
$email = $_SESSION['email'];

// Ottieni l'ID dell'utente basato sull'email
$idUtente = $gestoreDb->getIdUtenteByEmail($email);

if ($idUtente) {
    // Ottieni il riepilogo delle operazioni
    $result = $gestoreDb->getRiepilogo($idUtente);

    if ($result) {
        $totaleSpeso = 0;
        $totaleKm = 0;
        $tempoTotale = 0;

        foreach ($result as $operazione) {
            $totaleSpeso += $operazione['tariffa'];
            $totaleKm += $operazione['distanzaPercorsa'];
        }

        $response = array(
            "status" => "ok",
            "totaleSpeso" => $totaleSpeso,
            "totaleKm" => $totaleKm,
        );
    } else {
        $response = array(
            "status" => "error",
            "message" => "Nessun risultato trovato."
        );
    }
} else {
    $response = array(
        "status" => "error",
        "message" => "Utente non trovato."
    );
}

// Codifica la risposta in JSON
echo json_encode($response);
?>
