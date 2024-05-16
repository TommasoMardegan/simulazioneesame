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
        $query = "SELECT codice, citta, via, numeroCivico, provincia, regione FROM stazione";
    
        // Esegui la query
        $result = $this->mysqli->query($query);
    
        // Array per memorizzare i dati delle stazioni
        $stations = array();
    
        // Verifica se ci sono risultati dalla query
        if ($result->num_rows > 0) {
            // Cicla su ogni riga di risultato
            while ($row = $result->fetch_assoc()) {
                $station = array(
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
}
?>