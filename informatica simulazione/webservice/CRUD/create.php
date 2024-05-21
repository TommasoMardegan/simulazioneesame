<?php
$mysqli;

/**
 * costruttore
 */
$mysqli = new mysqli("localhost", "root", "", "simulazione");

function calcolaTariffa($dataInizio, $dataFine) {
    $inizio = strtotime($dataInizio);
    $fine = strtotime($dataFine);
    $differenzaMinuti = ($fine - $inizio) / 60; // Differenza in minuti
    $costoPerMinuto = 0.05; // Costo per minuto
    return $differenzaMinuti * $costoPerMinuto;
}

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
} else if(isset($_GET['tipo']) && $_GET['tipo'] == "consegna") {
    if (isset($_GET['codiceBicicletta']) && isset($_GET['codiceUtente'])) {
        $tipo = $_GET['tipo'];
        $codiceUtente = intval($_GET['codiceUtente']);
        $codiceBicicletta = intval($_GET['codiceBicicletta']);
        $codiceStazione = 10;
        $dataOraConsegna = date("Y-m-d H:i:s");

        // Ottieni la data di inizio del noleggio
        $query = "SELECT dataOra FROM operazione WHERE codiceBicicletta = ? AND codiceUtente = ? AND tipo = 'noleggia' ORDER BY dataOra DESC LIMIT 1";
        $stmt = $mysqli->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ii", $codiceBicicletta, $codiceUtente);
            $stmt->execute();
            $stmt->bind_result($dataOraInizio);
            $stmt->fetch();
            $stmt->close();
        }

        if ($dataOraInizio) {
            $tariffa = calcolaTariffa($dataOraInizio, $dataOraConsegna);

            // Inserisci i dati della consegna
            $query = "INSERT INTO operazione (tipo, distanzaPercorsa, tariffa, codiceBicicletta, codiceStazione, codiceUtente, dataOra) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
    
            if ($stmt) {
                $distanzaPercorsa = 0;
                $stmt->bind_param("siiiiis", $tipo, $distanzaPercorsa, $tariffa, $codiceBicicletta, $codiceStazione, $codiceUtente, $dataOraConsegna);
    
                if ($stmt->execute()) {
                    echo "Dati di consegna inseriti con successo!";
                } else {
                    echo "Errore nell'inserimento dei dati di consegna: " . $stmt->error;
                }
    
                $stmt->close();
            } else {
                echo "Errore nella preparazione della query: " . $mysqli->error;
            }
        } else {
            echo "Nessun noleggio trovato per questa bicicletta e utente.";
        }
    } else {
        echo "Parametri mancanti. Assicurati di fornire 'tipo', 'codiceBicicletta' e 'codiceUtente'.";
    }
}
?>