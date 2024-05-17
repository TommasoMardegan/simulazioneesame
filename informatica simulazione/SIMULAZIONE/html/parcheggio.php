<?php
// Verifica se i parametri sono impostati
if (isset($_GET['latitudine']) && isset($_GET['longitudine'])) {
    $latitudine = $_GET['latitudine'];
    $longitudine = $_GET['longitudine'];
    
    // Usa le coordinate per ottenere le informazioni del parcheggio (database, API, ecc.)
    // Per esempio:
    // $infoParcheggio = getParcheggioInfo($latitudine, $longitudine);
    
    // Visualizza le informazioni del parcheggio
    echo "Informazioni per il parcheggio alla latitudine: $latitudine e longitudine: $longitudine";
    // echo "<pre>" . print_r($infoParcheggio, true) . "</pre>";
} else {
    echo "Coordinate non fornite.";
}
?>
