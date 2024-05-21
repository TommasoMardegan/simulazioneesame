<?php
//noleggio della bicicletta
if(isset($_GET['tipo'])  && $_GET['tipo'] == "noleggia") {
    //io so da dove noleggia perchè mi sto comportando come la stazione
    //mi serve idUtente e codiceBicicletta
    if (isset($_GET['codiceBicicletta'])) {
        $tipo = $_GET['tipo'];
        $codiceBicicletta = intval($_GET['codiceBicicletta']);
        $codiceStazione = 1;
    
        // Prepara la query di inserimento
        $query = "INSERT INTO operazione (tipo, codiceBicicletta, codiceStazione) VALUES (?, ?, ?)";
        $stmt = $db->mysqli->prepare($query);
    
        if ($stmt) {
            // Associa i parametri alla query
            $stmt->bind_param("sii", $tipo, $codiceBicicletta, $codiceStazione);
    
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