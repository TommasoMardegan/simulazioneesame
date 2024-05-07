<?php
class gestioneDB
{
    public $mysqli;

    /**
     * costruttore
     */
    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "biciclette");
    }
    //EFFETTUO LA LOGIN
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
    
}
?>