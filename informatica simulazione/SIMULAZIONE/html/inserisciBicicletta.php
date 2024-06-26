<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Bicicletta</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/inserisciBicicletta.js"></script>
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
        <h1 class="mb-4">Inserisci Bicicletta</h1>
        <form id="inserisci-bicicletta-form">
            <div class="form-group">
                <label for="codiceRFID">Codice RFID</label>
                <input type="text" class="form-control" id="codiceRFID" name="codiceRFID" required>
            </div>
            <div class="form-group">
                <label for="kmpercorsi">Km Percorsi</label>
                <input type="number" class="form-control" id="kmpercorsi" name="kmpercorsi" required>
            </div>
            <div class="form-group">
                <label for="codiceGPS">Codice GPS</label>
                <input type="text" class="form-control" id="codiceGPS" name="codiceGPS" required>
            </div>
            <div class="form-group">
                <label for="longitudine">Longitudine</label>
                <input type="number" class="form-control" id="longitudine" name="longitudine" step="any" required>
            </div>
            <div class="form-group">
                <label for="latitudine">Latitudine</label>
                <input type="number" class="form-control" id="latitudine" name="latitudine" step="any" required>
            </div>
            <button type="submit" class="btn btn-primary">Inserisci Bicicletta</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="inserisciBicicletta.js"></script>
</body>
</html>
