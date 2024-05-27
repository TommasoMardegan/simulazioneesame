<?php
session_start();

// Verifica se l'utente è loggato come admin
if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "admin") {
    // Se l'utente non è loggato come admin, restituisci un errore
    echo json_encode(array("success" => false, "message" => "Accesso non autorizzato."));
    exit;
}

// Verifica se l'ID del cliente è stato fornito
if (!isset($_POST["id"])) {
    // Se l'ID del cliente non è stato fornito, restituisci un errore
    echo json_encode(array("success" => false, "message" => "ID cliente non fornito."));
    exit;
}

include_once("../service/gestioneDB.php");
$gestoreDb = new gestioneDB();

// Ottieni l'ID del cliente dalla richiesta
$idCliente = $_POST["id"];

// Rigenera la tessera del cliente con l'ID fornito
$success = $gestoreDb->rigeneraTessera($idCliente);

// Verifica se la rigenerazione ha avuto successo
if ($success) {
    // Se la rigenerazione ha avuto successo, restituisci una risposta JSON con successo true
    echo json_encode(array("success" => true));
} else {
    // Altrimenti, restituisci una risposta JSON con successo false e un messaggio di errore
    echo json_encode(array("success" => false, "message" => "Si è verificato un errore durante la rigenerazione della tessera."));
}
?>
