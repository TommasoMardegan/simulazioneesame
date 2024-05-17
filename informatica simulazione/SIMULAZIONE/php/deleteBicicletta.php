<?php
// Verifica se è stata ricevuta una richiesta POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se il parametro "codiceRFID" è stato ricevuto correttamente
    if (isset($_POST["codiceRFID"])) {
        // Connetti al database
        $conn = new mysqli("localhost", "root", "", "simulazione");

        // Verifica la connessione al database
        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        // Prepara la query per eliminare la bicicletta dal database
        $stmt = $conn->prepare("DELETE FROM bicicletta WHERE codiceRFID = ?");
        
        // Bind dei parametri e dell'identificatore
        $stmt->bind_param("s", $codiceRFID);

        // Esegui la query
        $codiceRFID = $_POST["codiceRFID"];
        if ($stmt->execute()) {
            // Se l'eliminazione ha avuto successo, restituisci "success"
            echo "success";
        } else {
            // Se si è verificato un errore durante l'eliminazione, restituisci un messaggio di errore
            echo "Errore durante l'eliminazione della bicicletta: " . $stmt->error;
        }

        // Chiudi lo statement e la connessione al database
        $stmt->close();
        $conn->close();
    } else {
        // Se il parametro "codiceRFID" non è stato ricevuto, restituisci un messaggio di errore
        echo "Errore: Il parametro 'codiceRFID' non è stato ricevuto.";
    }
} else {
    // Se la richiesta non è una richiesta POST, restituisci un messaggio di errore
    echo "Errore: Solo richieste POST sono supportate per questa pagina.";
}
?>
