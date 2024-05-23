<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Stazione</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/inserisciStazione.js"></script>
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
        <h2>Inserisci Nuova Stazione</h2>
        <form id="inserisci-stazione-form">
            <div class="form-group">
                <label for="codice">Codice</label>
                <input type="text" class="form-control" id="codice" name="codice" required>
            </div>
            <div class="form-group">
                <label for="numeroSlot">Numero Slot</label>
                <input type="number" class="form-control" id="numeroSlot" name="numeroSlot" required>
            </div>
            <div class="form-group">
                <label for="citta">Città</label>
                <input type="text" class="form-control" id="citta" name="citta" required>
            </div>
            <div class="form-group">
                <label for="via">Via</label>
                <input type="text" class="form-control" id="via" name="via" required>
            </div>
            <div class="form-group">
                <label for="numeroCivico">Numero Civico</label>
                <input type="text" class="form-control" id="numeroCivico" name="numeroCivico" required>
            </div>
            <div class="form-group">
                <label for="provincia">Provincia</label>
                <input type="text" class="form-control" id="provincia" name="provincia" required>
            </div>
            <div class="form-group">
                <label for="regione">Regione</label>
                <input type="text" class="form-control" id="regione" name="regione" required>
            </div>
            <button type="submit" class="btn btn-primary">Inserisci Stazione</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
