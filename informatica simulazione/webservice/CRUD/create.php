<?php
$mysqli;

/**
 * costruttore
 */
$mysqli = new mysqli("localhost", "root", "", "simulazione");
//noleggio della bicicletta
if(isset($_GET['tipo'])  && $_GET['tipo'] == "noleggia") {
    //io so da dove noleggia perchè mi sto comportando come la stazione
    //mi serve idUtente e codiceBicicletta
    if (isset($_GET['codiceBicicletta']) && isset($_GET['codiceUtente'])) {
        $tipo = $_GET['tipo'];
        $codiceUtente = intval($_GET['codiceUtente']);
        $codiceBicicletta = intval($_GET['codiceBicicletta']);
        //ATTENZIONE AL CODICE STAZIONE
        $codiceStazione = 10;
        $dataOra = date("Y-m-d H:i:s");
    
        // Prepara la query di inserimento
        $query = "INSERT INTO operazione (tipo, distanzaPercorsa, tariffa, codiceBicicletta, codiceStazione, codiceUtente, dataOra) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
    
        if ($stmt) {
            // Associa i parametri alla query
            $distanzaPercorsa = 0;
            $tariffa = 0;
            $stmt->bind_param("siiiiis", $tipo, $distanzaPercorsa, $tariffa, $codiceBicicletta, $codiceStazione, $codiceUtente, $dataOra);
    
            // Esegui la query
            if ($stmt->execute()) {
                echo "Dati inseriti con successo!";
            } else {
                echo "Errore nell'inserimento dei dati: " . $stmt->error;
            }
    
            // Chiude lo statement
            $stmt->close();
        } else {
            echo "Errore nella preparazione della query: " . $db->mysqli->error;
        }
    } else {
        echo "Parametri mancanti. Assicurati di fornire 'tipo', 'codiceBicicletta' e 'codiceStazione'.";
    }
} else if(isset($_GET['tipo'])  && $_GET['tipo'] == "consegna") {

}

?>