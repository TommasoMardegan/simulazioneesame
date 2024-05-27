<?php
$mysqli;

/**
 * costruttore
 */
$mysqli = new mysqli("localhost", "root", "", "simulazione");
//MI COMPORTO COME SE FOSSI IL PARCHEGGIO
//QUINDI NON DEVO FARE CONTROLLI SPECIFICI, COME CHE LA BICI NOLEGGIATA ESISTA NELLA STAZIONE
//PERCHE' MI ASPETTO CHE LA COLONNINA DEL PARCHEGGIO FUNZIONI CORRETTAMENTE, MENTRE CONTROLLO CHE ESISTA
//NELLA VISUALIZZA DELLE BICICLETTE NEL PARCHEGGIO
function calcolaTariffa($dataInizio, $dataFine) {
    $inizio = strtotime($dataInizio);
    $fine = strtotime($dataFine);
    $differenzaMinuti = ($fine - $inizio) / 60; // Differenza in minuti

    $costoPerMinuto = 0.05; // Costo per minuto
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
//ESEMPIO http://localhost/simulazioneProva/simulazioneesame/informatica%20simulazione/webservice/CRUD/create.php?tipo=noleggia&codiceBicicletta=110&codiceUtente=1
//il cliente appoggia la tessera quindi l'id utente ce l'ho già
if(isset($_GET['tipo'])  && $_GET['tipo'] == "noleggia") {
    //io so da dove noleggia perchè mi sto comportando come la stazione
    //mi serve codiceTessera e codiceBicicletta
    if (isset($_GET['codiceBicicletta']) && isset($_GET['codiceTessera'])) {
        $tipo = $_GET['tipo'];
        $codiceTessera = intval($_GET['codiceTessera']);
        $codiceBicicletta = intval($_GET['codiceBicicletta']);
        //ATTENZIONE AL CODICE STAZIONE
        $codiceStazione = 10;
        $dataOra = date("Y-m-d H:i:s");
    
        // Controlla se il cliente è attivo
        $queryCliente = "SELECT ID FROM cliente WHERE codiceTessera = ? AND attivo = 's'";
        $stmtCliente = $mysqli->prepare($queryCliente);
        if ($stmtCliente) {
            $stmtCliente->bind_param("i", $codiceTessera);
            $stmtCliente->execute();
            $stmtCliente->store_result();
            $stmtCliente->bind_result($idUtente); // Associa il risultato alla variabile $idUtente
            $stmtCliente->fetch();
            // Non è necessario chiamare num_rows dopo fetch()
            // $num_rows = $stmtCliente->num_rows;
            if ($stmtCliente->num_rows > 0) { 
                // Prepara la query di inserimento
                $query = "INSERT INTO operazione (tipo, distanzaPercorsa, tariffa, codiceBicicletta, codiceStazione, codiceTessera, dataOra, codiceUtente) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $mysqli->prepare($query);
            
                if ($stmt) {
                    // Associa i parametri alla query
                    $distanzaPercorsa = 0;
                    $tariffa = 0;
                    $stmt->bind_param("sidiidsi", $tipo, $distanzaPercorsa, $tariffa, $codiceBicicletta, $codiceStazione, $codiceTessera, $dataOra, $idUtente);
            
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
                echo "la tessera non è attiva.";
            }
            $stmtCliente->close();
        } else {
            echo "Errore nella preparazione della query: " . $mysqli->error;
        }
    } else {
        echo "Parametri mancanti. Assicurati di fornire 'tipo', 'codiceBicicletta' e 'codiceStazione'.";
    }
//ESEMPIO: http://localhost/simulazioneProva/simulazioneesame/informatica%20simulazione/webservice/CRUD/create.php?tipo=consegna&codiceBicicletta=110&codiceTessera=8230707143
} else if(isset($_GET['tipo']) && $_GET['tipo'] == "consegna") {
    if (isset($_GET['codiceBicicletta']) && isset($_GET['codiceTessera'])) {
        $tipo = $_GET['tipo'];
        $codiceTessera = intval($_GET['codiceTessera']);
        $codiceBicicletta = intval($_GET['codiceBicicletta']);
        $codiceStazione = 10;
        $dataOraConsegna = date("Y-m-d H:i:s");

        $query = "SELECT dataOra, distanzaPercorsa, codiceUtente FROM operazione WHERE codiceBicicletta = ? AND codiceTessera = ? AND tipo = 'noleggia' ORDER BY dataOra DESC LIMIT 1";
        $stmt = $mysqli->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ii", $codiceBicicletta, $codiceTessera);
            $stmt->execute();
            $stmt->bind_result($dataOraInizio, $distanzaPercorsa, $idUtente);
            $stmt->fetch();
            $stmt->close();

            if ($dataOraInizio) {
                $tariffa = calcolaTariffa($dataOraInizio, $dataOraConsegna);

                // Inserisci i dati della consegna
                $query = "INSERT INTO operazione (tipo, distanzaPercorsa, tariffa, codiceBicicletta, codiceStazione, codiceTessera, dataOra, codiceUtente) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $mysqli->prepare($query);

                if ($stmt) {
                    $stmt->bind_param("sidiiiss", $tipo, $distanzaPercorsa, $tariffa, $codiceBicicletta, $codiceStazione, $codiceTessera, $dataOraConsegna, $idUtente);

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
                echo "Nessun noleggio trovato per questa bicicletta e tessera.";
            }
        } else {
            echo "Errore nella preparazione della query: " . $mysqli->error;
        }
    } else {
        echo "Parametri mancanti. Assicurati di fornire 'codiceBicicletta' e 'codiceTessera'.";
    }
}
 //AGGIORNO LA POSIZIONE DELLA BICI E DI CONSEGUENZA CALCOLO I KM PERCORSI (CALCOLO LA DISTANZA IN KM TRA LA LOT E LONG ATTUALE E QUELLA PRECEDENTEMENTE SALVATA)
//ESEMPIO: http://localhost/simulazione_v2/simulazioneesame/informatica%20simulazione/webservice/CRUD/create.php?tipo=aggiorna_locazione&codiceGPS=33&longitudine=2.5&latitudine=2.4
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
//ESEMPIO: http://localhost/simulazioneProva/simulazioneesame/informatica%20simulazione/webservice/CRUD/create.php?tipo=aggiorna_distanza_operazione&codiceBicicletta=110
else if (isset($_GET['tipo']) && $_GET['tipo'] == "aggiorna_distanza_operazione") {
    if (isset($_GET['codiceBicicletta'])) {
        $codiceBicicletta = intval($_GET['codiceBicicletta']);
        $distanzaAggiuntiva = 1000; // distanza aggiuntiva in metri

        // Trova l'ultima operazione di tipo noleggia per la bicicletta specificata
        $query = "SELECT id FROM operazione WHERE codiceBicicletta = ? AND tipo = 'noleggia' ORDER BY dataOra DESC LIMIT 1";
        $stmt = $mysqli->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $codiceBicicletta);
            $stmt->execute();
            $stmt->bind_result($idOperazione);
            $stmt->fetch();
            $stmt->close();

            if ($idOperazione) {
                // Aggiorna la distanza percorsa per l'operazione trovata
                $query = "UPDATE operazione SET distanzaPercorsa = distanzaPercorsa + ? WHERE id = ?";
                $stmt = $mysqli->prepare($query);

                if ($stmt) {
                    $stmt->bind_param("ii", $distanzaAggiuntiva, $idOperazione);
                    if ($stmt->execute()) {
                        echo "Distanza aggiornata con successo!";
                    } else {
                        echo "Errore nell'aggiornamento della distanza: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Errore nella preparazione della query: " . $mysqli->error;
                }
            } else {
                echo "Nessuna operazione di noleggia trovata per la bicicletta specificata.";
            }
        } else {
            echo "Errore nella preparazione della query: " . $mysqli->error;
        }
    } else {
        echo "Parametro 'codiceBicicletta' mancante. Assicurati di fornire 'codiceBicicletta'.";
    }
}
?>