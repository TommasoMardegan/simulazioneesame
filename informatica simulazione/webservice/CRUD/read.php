<?php
$mysqli = new mysqli("localhost", "root", "", "simulazione");

if ($mysqli->connect_error) {
    die("Connessione fallita: " . $mysqli->connect_error);
}

$codiceStazione = 10;


//ESEMPIO: http://localhost/simulazioneProva/simulazioneesame/informatica%20simulazione/webservice/CRUD/read.php

// Query per ottenere tutte le biciclette disponibili nel parcheggio specificato
// OTTENGO SOLO LE BICI CHE SONO STATE NOLEGGIATE UN NUMERO DI VOLTE UGUALE A QUELLE CHE SONO STATE CONSEGNATE (quindi sono disponibili)
// OPPURE CHE NON SONO MAI STATE NOLEGGIATE
$query = "
    SELECT codiceBicicletta
    FROM operazione
    WHERE codiceStazione = ?
    GROUP BY codiceBicicletta
    HAVING COUNT(CASE WHEN tipo = 'noleggia' THEN 1 END) = COUNT(CASE WHEN tipo = 'consegna' THEN 1 END)
       OR COUNT(CASE WHEN tipo = 'noleggia' THEN 1 END) = 0
";

$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $codiceStazione);
    $stmt->execute();
    $result = $stmt->get_result();

    $bicicletteDisponibili = [];
    while ($row = $result->fetch_assoc()) {
        $bicicletteDisponibili[] = $row;
    }

    $stmt->close();
    
    header('Content-Type: application/json');
    echo json_encode($bicicletteDisponibili);
} else {
    echo json_encode(["error" => "Errore nella preparazione della query: " . $mysqli->error]);
}

$mysqli->close();
?>
