<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Riepilogo Utilizzo Bicicletta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
      if(!isset($_SESSION)) {
        session_start();
      }
      if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "utente") {
        header("Location: login.html");
      }
    ?>
    <div class="container">
        <h2>Riepilogo Utilizzo Bicicletta</h2>
        <div id="riepilogo">
            <!-- Il riepilogo sarà inserito qui tramite JavaScript -->
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/riepilogo.js"></script>
</body>
</html>
