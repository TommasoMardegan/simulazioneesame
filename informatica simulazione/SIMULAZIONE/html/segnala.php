<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smarrimento Tessera</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/segnala.js"></script>
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
    <h1>Gestione Smarrimento Tessera</h1>
    <button id="smarrimentoButton">Segnala Smarrimento Tessera</button>
    <p id="responseMessage"></p>
</body>
</html>