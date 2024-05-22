<?php
session_start();
include_once("../service/gestioneDB.php");
$mysqli = new mysqli("localhost", "root", "", "simulazione");
$gestioneDB = new gestioneDB();
if ($mysqli->connect_error) {
    die("Connessione fallita: " . $mysqli->connect_error);
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Ottenere l'ID utente dalla email
    $query = "SELECT ID FROM cliente WHERE email = ?";
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($codiceUtente);
        $stmt->fetch();
        $stmt->close();

        if ($codiceUtente) {
            $result = $gestioneDB->getOperazioniByUtente($codiceUtente);
            echo json_encode($result);
        }
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}

$mysqli->close();
?>
