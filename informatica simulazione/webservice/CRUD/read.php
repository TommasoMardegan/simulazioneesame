<?php
$mysqli = new mysqli("localhost", "root", "", "simulazione");

if ($mysqli->connect_error) {
    die("Connessione fallita: " . $mysqli->connect_error);
}

$codiceStazione = 10;


//ESEMPIO: http://localhost/simulazioneProva/simulazioneesame/informatica%20simulazione/webservice/CRUD/read.php

// Query per ottenere tutte le biciclette disponibili nel parcheggio specificato
// OTTENGO SOLO LE BICI CHE SONO STATE NOLEGGIATE UN NUMERO DI VOLTE UGUALE A QUELLE CHE SONO STATE CONSEGNATE (quindi sono disponibili) (tra tutte le stazioni)
// OPPURE CHE NON SONO MAI STATE NOLEGGIATE
/**$query = "
    SELECT codiceBicicletta
    FROM operazione
    WHERE codiceStazione = ? 
    AND codiceBicicletta NOT IN (
        SELECT codiceBicicletta
        FROM operazione
        GROUP BY codiceBicicletta
        HAVING COUNT(CASE WHEN tipo = 'noleggia' THEN 1 END) <> COUNT(CASE WHEN tipo = 'consegna' THEN 1 END)
    )
    GROUP BY codiceBicicletta;
"; problema: se consegno alla stazione 11 ma numero noleggi == consegne allora me la disponibile nella stazione 10
**/
/**
 * casi:
 * noleggia bici: funziona
 * consegna bici: funziona
 * noleggia bici e consegna in una stazione diversa (es: 11): funziona, la bici non è segnata come disponibile nella stazione 10
 * se noleggio la bici: funziona, bici non segnata come disponibile
 * se riconsegno la bici nella stessa stazione: funziona, segnata come disponibile
 */
$query = "
    SELECT codiceBicicletta
    FROM operazione o1
    JOIN bicicletta b ON o1.codiceBicicletta = b.codiceRFID
    WHERE o1.codiceStazione = ?
      AND o1.tipo = 'consegna'
      AND b.manutenzione = 'n'
      AND o1.dataOra = (
          SELECT MAX(o2.dataOra)
          FROM operazione o2
          WHERE o1.codiceBicicletta = o2.codiceBicicletta
      )
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
