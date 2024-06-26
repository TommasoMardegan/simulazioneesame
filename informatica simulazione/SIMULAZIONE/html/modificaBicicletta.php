<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Bicicletta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <h2>Modifica Bicicletta</h2>
        <form id="modifica-bicicletta-form">
            <div class="form-group">
                <label for="codiceRFID">Codice RFID:</label>
                <input type="text" class="form-control" id="codiceRFID" readonly>
            </div>
            <div class="form-group">
                <label for="kmpercorsi">Km Percorsi:</label>
                <input type="text" class="form-control" id="kmpercorsi">
            </div>
            <div class="form-group">
                <label for="codiceGPS">Codice GPS:</label>
                <input type="text" class="form-control" id="codiceGPS">
            </div>
            <div class="form-group">
                <label for="longitudine">Longitudine:</label>
                <input type="text" class="form-control" id="longitudine">
            </div>
            <div class="form-group">
                <label for="latitudine">Latitudine:</label>
                <input type="text" class="form-control" id="latitudine">
            </div>
            <div class="form-group">
                <label for="manutenzione">In Manutenzione:</label>
                <select class="form-control" id="manutenzione">
                    <option value="s">Sì</option>
                    <option value="n">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/modificaBicicletta.js"></script>
</body>
</html>
