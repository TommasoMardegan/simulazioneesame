<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Stazioni</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="../js/gestioneStazioni.js"></script>
</head>
<body>
<?php
      if(!isset($_SESSION)) {
        session_start();
      }
      if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "admin") {
        header("Location: login.html");
      }
    ?>
    <div class="container mt-5">
        <h1 class="mb-4">Gestione Stazioni</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Codice</th>
                    <th>Numero Slot</th>
                    <th>Città</th>
                    <th>Via</th>
                    <th>Numero Civico</th>
                    <th>Provincia</th>
                    <th>Regione</th>
                </tr>
            </thead>
            <tbody id="stazioni-list">
                <!-- Qui verranno inserite dinamicamente le stazioni -->
            </tbody>
        </table>
        <button class="btn btn-primary"><a href="inserisciStazione.php" style="color: white; text-decoration: none;">Inserisci stazione</a></button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
