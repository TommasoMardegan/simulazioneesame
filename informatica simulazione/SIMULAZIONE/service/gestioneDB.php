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
    
    //OTTENGO LATITUDINE E LONGITUDINE DELLE STAZIONI
    public function getLocations() {
        // Query per selezionare i dati delle stazioni
        $query = "SELECT codice, citta, via, numeroCivico, provincia, regione FROM stazione";

        // Esegui la query
        $result = $this->mysqli->query($query);

        // Array per memorizzare le coordinate di latitudine e longitudine di ogni stazione
        $coordinates = array();

        // Verifica se ci sono risultati dalla query
        if ($result->num_rows > 0) {
            // Cicla su ogni riga di risultato
            while ($row = $result->fetch_assoc()) {
                // Dati dell'indirizzo della stazione
                $via = urlencode($row['via']);
                $numeroCivico = urlencode($row['numeroCivico']);
                $città = urlencode($row['citta']);
                $provincia = urlencode($row['provincia']);
                $regione = urlencode($row['regione']);

                // URL per la richiesta all'API di Google Maps Geocoding
                $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$via},{$numeroCivico},{$città},{$provincia},{$regione}&key=TUA_API_KEY";

                // Effettua la richiesta all'API
                $response = file_get_contents($url);

                // Decodifica la risposta JSON
                $data = json_decode($response);

                // Verifica se la richiesta ha avuto successo
                if ($data->status == 'OK') {
                    // Ottieni le coordinate di latitudine e longitudine
                    $latitudine = $data->results[0]->geometry->location->lat;
                    $longitudine = $data->results[0]->geometry->location->lng;

                    // Aggiungi le coordinate all'array
                    $coordinates[$row['codice']] = array('latitudine' => $latitudine, 'longitudine' => $longitudine);
                }
            }
        }

        // Chiudi la connessione al database
        $this->mysqli->close();

        // Restituisci l'array con le coordinate di latitudine e longitudine di ogni stazione
        return $coordinates;
    }   
}
?>