<?php
class gestioneDB
{
    public $mysqli;

    /**
     * costruttore
     */
    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "simulazione");
    }
    //LOGIN CLIENTE
    public function login($email, $password) {
        // Prepara la query con un segnaposto per email e password
        $query = "SELECT * FROM cliente WHERE email = ? AND password = ?";
        
        // Prepara lo statement
        $stmt = $this->mysqli->prepare($query);
        
        // Bind dei parametri
        $stmt->bind_param("ss", $email, $password);
        
        // Esegui lo statement
        $stmt->execute();
        
        // Ottieni il risultato
        $result = $stmt->get_result();

        // Verifica se ci sono righe restituite
        if ($result->num_rows > 0) {
            //avvio la sessione per salvare la mail
            session_start();
            //salvo la mail in sessione
            $_SESSION["email"] = $email;
            $_SESSION["tipo"] = "utente";
            // L'associazione email-password esiste, quindi le credenziali sono corrette
            $stmt->close(); // Chiudi lo statement
            return true;
        } else {
            // Nessuna riga restituita, quindi le credenziali non corrispondono a nessun utente
            $stmt->close(); // Chiudi lo statement
            return false;
        }
    }
    public function registrazione($email, $password, $codiceFiscale, $dataNascita, $nome, $cognome, $numeroCarta, $cvvCarta, $dataScadenzaCarta, $citta, $via, $numeroCivico, $provincia, $regione) {
        // Query SQL per l'inserimento dei dati nella tabella "cliente"
        $query = "INSERT INTO cliente (email, password, codiceFiscale, dataNascita, nome, cognome, numero, CVV, dataScadenza, citta, via, numeroCivico, provincia, regione) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepara l'istruzione SQL
        $stmt = $this->mysqli->prepare($query);
    
        // Collega i parametri alla dichiarazione preparata come stringa, stringa, ... ecc. 
        $stmt->bind_param("ssssssssssss", $email, $password, $codiceFiscale, $dataNascita, $nome, $cognome, $numeroCarta, $cvvCarta, $dataScadenzaCarta, $citta, $via, $numeroCivico);
    
        // Esegui l'istruzione preparata
        if ($stmt->execute()) {
            return true; // Ritorna true se l'inserimento ha avuto successo
        } else {
            return false; // Ritorna false se c'è stato un errore durante l'inserimento
        }
    }
    //LOGIN AL PORTALE ADMIN
    public function loginAdmin($email, $password) {
        // Prepara la query con un segnaposto per email e password
        $query = "SELECT * FROM admin_cred WHERE email = ? AND password = ?";

        // Prepara lo statement
        $stmt = $this->mysqli->prepare($query);
        
        // Bind dei parametri
        $stmt->bind_param("ss", $email, $password);
        
        // Esegui lo statement
        $stmt->execute();
        
        // Ottieni il risultato
        $result = $stmt->get_result();

        // Verifica se ci sono righe restituite
        if ($result->num_rows > 0) {
            //avvio la sessione per salvare la mail
            session_start();
            //salvo la mail in sessione
            $_SESSION["email"] = $email;
            $_SESSION["tipo"] = "admin";
            // L'associazione email-password esiste, quindi le credenziali sono corrette
            $stmt->close(); // Chiudi lo statement
            return true;
        } else {
            // Nessuna riga restituita, quindi le credenziali non corrispondono a nessun utente
            $stmt->close(); // Chiudi lo statement
            return false;
        }
    }
    
    //OTTENGO LE INFORMAZIONI DELLE STAZIONI
    public function getStazioni() {
        // Query per selezionare i dati delle stazioni
        $query = "SELECT codice, numeroSlot, citta, via, numeroCivico, provincia, regione FROM stazione";
    
        // Esegui la query
        $result = $this->mysqli->query($query);
    
        // Array per memorizzare i dati delle stazioni
        $stations = array();
    
        // Verifica se ci sono risultati dalla query
        if ($result->num_rows > 0) {
            // Cicla su ogni riga di risultato
            while ($row = $result->fetch_assoc()) {
                $station = array(
                    'codice' => $row['codice'],
                    'numeroSlot' => $row['numeroSlot'],
                    'numeroCivico' => $row['numeroCivico'],
                    'via' => $row['via'],
                    'citta' => $row['citta'],
                    'provincia' => $row['provincia'],
                    'regione' => $row['regione']
                );
    
                // Aggiungi i dati della stazione all'array
                $stations[] = $station;
            }
        }
    
        // Chiudi la connessione al database
        $this->mysqli->close();
    
        // Restituisci l'array delle stazioni come JSON
        return $stations;
    }
    // Metodo per ottenere tutte le biciclette
    public function getBiciclette() {
        // Query per selezionare i dati delle biciclette
        $query = "SELECT codiceRFID, kmpercorsi, codiceGPS, longitudine, latitudine FROM bicicletta";
        
        // Esegui la query
        $result = $this->mysqli->query($query);
        
        // Array per memorizzare i dati delle biciclette
        $biciclette = array();
        
        // Verifica se ci sono risultati dalla query
        if ($result->num_rows > 0) {
            // Cicla su ogni riga di risultato
            while ($row = $result->fetch_assoc()) {
                $bicicletta = array(
                    'codiceRFID' => $row['codiceRFID'],
                    'kmpercorsi' => $row['kmpercorsi'],
                    'codiceGPS' => $row['codiceGPS'],
                    'longitudine' => $row['longitudine'],
                    'latitudine' => $row['latitudine']
                );
                
                // Aggiungi i dati della bicicletta all'array
                $biciclette[] = $bicicletta;
            }
        }
        
        // Restituisci l'array delle biciclette
        return $biciclette;
    }
    public function inserisciBicicletta($codiceRFID, $kmpercorsi, $codiceGPS, $longitudine, $latitudine) {
        // Prepara la query per l'inserimento dei dati della bicicletta
        $query = "INSERT INTO bicicletta (codiceRFID, kmpercorsi, codiceGPS, longitudine, latitudine) VALUES (?, ?, ?, ?, ?)";
        
        // Prepara lo statement
        $stmt = $this->mysqli->prepare($query);
        
        // Verifica se lo statement è stato preparato correttamente
        if ($stmt === false) {
            die("Errore durante la preparazione dello statement: " . $this->mysqli->error);
        }
        
        // Bind dei parametri
        $stmt->bind_param("sdddd", $codiceRFID, $kmpercorsi, $codiceGPS, $longitudine, $latitudine);
        
        // Esegui lo statement
        $result = $stmt->execute();
        
        // Verifica se l'esecuzione dello statement è avvenuta con successo
        if ($result === false) {
            die("Errore durante l'esecuzione dello statement: " . $stmt->error);
        }
        
        // Chiudi lo statement
        $stmt->close();
        
        // Restituisci true se l'inserimento è avvenuto con successo
        return true;
    }
    public function deleteBicicletta($codiceRFID) {
        // Prepara la query per eliminare la bicicletta dal database
        $stmt = $this->mysqli->prepare("DELETE FROM bicicletta WHERE codiceRFID = ?");
        
        // Bind dei parametri e dell'identificatore
        $stmt->bind_param("s", $codiceRFID);

        // Esegui la query
        $codiceRFID = $_POST["codiceRFID"];
        if ($stmt->execute()) {
            $stmt->close();
            // Se l'eliminazione ha avuto successo, restituisci "success"
            return true;
        } else {
            $stmt->close();
            // Se si è verificato un errore durante l'eliminazione, restituisci un messaggio di errore
            return false;
        }
    }
    public function deleteStazione($codice) {
        // Prepara la query per eliminare la bicicletta dal database
        $stmt = $this->mysqli->prepare("DELETE FROM stazione WHERE codice = ?");
        
        // Bind dei parametri e dell'identificatore
        $stmt->bind_param("i", $codice);

        if ($stmt->execute()) {
            $stmt->close();
            // Se l'eliminazione ha avuto successo, restituisci "success"
            return true;
        } else {
            $stmt->close();
            // Se si è verificato un errore durante l'eliminazione, restituisci un messaggio di errore
            return false;
        }
    }
    public function inserisciStazione($codice, $numeroSlot, $citta, $via, $numeroCivico, $provincia, $regione) {
        // Prepara la query per l'inserimento dei dati della stazione
        $query = "INSERT INTO stazione (codice, numeroSlot, citta, via, numeroCivico, provincia, regione) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        // Prepara lo statement
        $stmt = $this->mysqli->prepare($query);
        
        // Verifica se lo statement è stato preparato correttamente
        if ($stmt === false) {
            die("Errore durante la preparazione dello statement: " . $this->mysqli->error);
        }
        
        // Bind dei parametri
        $stmt->bind_param("iississ", $codice, $numeroSlot, $citta, $via, $numeroCivico, $provincia, $regione);
        
        // Esegui lo statement
        $result = $stmt->execute();
        
        // Verifica se l'esecuzione dello statement è avvenuta con successo
        if ($result === false) {
            die("Errore durante l'esecuzione dello statement: " . $stmt->error);
        }
        
        // Chiudi lo statement
        $stmt->close();
        
        // Restituisci true se l'inserimento è avvenuto con successo
        return true;
    }
    //ottengo il numero dei posti TOTALI, non solo i disponibili
    public function getNumeroPosti($codice) {
        try {
            // Prepara la query per ottenere il numero di posti disponibili
            $stmt = $this->mysqli->prepare("SELECT numeroSlot FROM stazione WHERE codice = ?");
            $stmt->bind_param('i', $codice); // 'i' indica che il parametro è un intero
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                return $row['numeroSlot'];
            } else {
                return "null";
            }
        } catch (Exception $e) {
            echo "Errore di esecuzione della query: " . $e->getMessage();
            return "null";
        }
    }
    //aggiorno i numeri TOTALI di posti del parcheggio
    public function updateNumeroPosti($codice, $numeroPosti) {
        try {
            // Prepara e esegui l'istruzione SQL per aggiornare il numero di posti
            $stmt = $this->mysqli->prepare("UPDATE stazione SET numeroSlot = ? WHERE codice = ?");
            $stmt->bind_param('is', $numeroPosti, $codice);
            $stmt->execute();

            // Verifica se l'aggiornamento ha avuto successo
            $rowCount = $stmt->affected_rows; // Restituisce il numero di righe interessate
            $stmt->close();
            return $rowCount > 0; // Se almeno una riga è stata aggiornata, restituisce true
        } catch (Exception $e) {
            echo "Errore di esecuzione della query: " . $e->getMessage();
            return false; // Restituisce false se si verifica un errore
        }
    }
    //ottengo i dati della bicicletta
    public function getBicicletta($codiceRFID) {
        // Prepara la query SQL
        $stmt = $this->mysqli->prepare("SELECT * FROM bicicletta WHERE codiceRFID = ?");
        $stmt->bind_param("s", $codiceRFID);

        // Esegui la query
        $stmt->execute();

        // Ottieni il risultato
        $result = $stmt->get_result();
        $bicicletta = $result->fetch_assoc();

        // Chiudi lo statement
        $stmt->close();

        return $bicicletta;
    }
    //aggiornamento dei dati della bicicletta
    public function updateBicicletta($codiceRFID, $kmpercorsi, $codiceGPS, $longitudine, $latitudine) {
        $stmt = $this->mysqli->prepare("UPDATE bicicletta SET kmpercorsi = ?, codiceGPS = ?, longitudine = ?, latitudine = ? WHERE codiceRFID = ?");
        $stmt->bind_param("sssss", $kmpercorsi, $codiceGPS, $longitudine, $latitudine, $codiceRFID);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}
?>