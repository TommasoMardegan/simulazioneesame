<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Stazione</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <div class="container">
        <h1>Modifica Stazione</h1>
        <form id="modifica-stazione-form">
            <div class="form-group">
                <label for="codice">Codice</label>
                <input type="text" class="form-control" id="codice" readonly>
            </div>
            <div class="form-group">
                <label for="numeroSlot">Numero Slot</label>
                <input type="number" class="form-control" id="numeroSlot">
            </div>
            <div class="form-group">
                <label for="citta">Città</label>
                <input type="text" class="form-control" id="citta">
            </div>
            <div class="form-group">
                <label for="via">Via</label>
                <input type="text" class="form-control" id="via">
            </div>
            <div class="form-group">
                <label for="numeroCivico">Numero Civico</label>
                <input type="text" class="form-control" id="numeroCivico">
            </div>
            <div class="form-group">
                <label for="provincia">Provincia</label>
                <input type="text" class="form-control" id="provincia">
            </div>
            <div class="form-group">
                <label for="regione">Regione</label>
                <input type="text" class="form-control" id="regione">
            </div>
            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
        </form>
    </div>
    <script src="../js/modificaStazione.js"></script>
</body>
</html>
