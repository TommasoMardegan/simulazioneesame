<?php
session_start();
include_once("../service/gestioneDB.php");

$gestoreDb = new gestioneDB();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    if ($gestoreDb->aggiornaStatoUtente($email)) {
        echo json_encode(['success' => true, 'message' => 'Stato tessera aggiornato con successo.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore nell\'aggiornamento dello stato della tessera.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Utente non autenticato.']);
}
?>
