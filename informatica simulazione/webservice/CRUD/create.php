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
    var_dump($differenzaMinuti);
    $costoPerMinuto = 1; // Costo per minuto
    return $differenzaMinuti * $costoPerMinuto;
}

function calcolaDistanza($lat1, $lon1, $lat2, $lon2) {
    $raggioTerra = 6371; // Raggio della Terra in km
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distanza = $raggioTerra * $c; // Distanza in km
    return $distanza;
}


//noleggio della bicicletta
/**
 * quando aggiungo una bici nuova è come se l'addetto noleggiasse la bici e la consegnasse alla stazione
 */
//ESEMPIO http://localhost/simulazioneProva/simulazioneesame/informatica%20simulazione/webservice/CRUD/create.php?tipo=noleggia&codiceBicicletta=110&codiceStazione=10&&codiceUtente=1
//il cliente appoggia la tessera quindi l'id utente ce l'ho già
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
                echo "Noleggiata con successo!";
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
//ESEMPIO: http://localhost/simulazioneProva/simulazioneesame/informatica%20simulazione/webservice/CRUD/create.php?tipo=consegna&codiceBicicletta=110&codiceStazione=10&&codiceUtente=1
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
                //aggiornare distanza percorsa
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
} //AGGIORNO LA POSIZIONE DELLA BICI E DI CONSEGUENZA CALCOLO I KM PERCORSI (CALCOLO LA DISTANZA IN KM TRA LA LOT E LONG ATTUALE E QUELLA PRECEDENTEMENTE SALVATA)
else if (isset($_GET['tipo']) && $_GET['tipo'] == "aggiorna_locazione") {
    if (isset($_GET['codiceGPS']) && isset($_GET['latitudine']) && isset($_GET['longitudine'])) {
        $codiceGPS = intval($_GET['codiceGPS']);
        $latitudine = floatval($_GET['latitudine']);
        $longitudine = floatval($_GET['longitudine']);

        // Ottieni la posizione precedente della bicicletta
        $query = "SELECT latitudine, longitudine FROM bicicletta WHERE codiceGPS = ?";
        $stmt = $mysqli->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $codiceGPS);
            $stmt->execute();
            $stmt->bind_result($latitudinePrecedente, $longitudinePrecedente);
            $stmt->fetch();
            $stmt->close();
        }

        if (isset($latitudinePrecedente) && isset($longitudinePrecedente)) {
            $distanza = calcolaDistanza($latitudinePrecedente, $longitudinePrecedente, $latitudine, $longitudine);
        } else {
            $distanza = 0; // Se non ci sono posizioni precedenti, la distanza è 0
        }

        // Aggiorna la posizione della bicicletta
        $query = "UPDATE bicicletta SET latitudine = ?, longitudine = ?, kmpercorsi = kmpercorsi + ? WHERE codiceGPS = ?";
        $stmt = $mysqli->prepare($query);
        if ($stmt) {
            $stmt->bind_param("dddi", $latitudine, $longitudine, $distanza, $codiceGPS);
            if ($stmt->execute()) {
                echo "Posizione aggiornata con successo!";
            } else {
                echo "Errore nell'aggiornamento della posizione: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Errore nella preparazione della query: " . $mysqli->error;
        }
    } else {
        echo "Parametri mancanti. Assicurati di fornire 'codiceGPS', 'latitudine' e 'longitudine'.";
    }
}
?>