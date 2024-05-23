<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Informazioni Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    <div class="container mt-5">
        <h1>Modifica Informazioni Cliente</h1>
        <form id="modifica-cliente-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" readonly>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="form-group">
                <label for="codiceFiscale">Codice Fiscale</label>
                <input type="text" class="form-control" id="codiceFiscale">
            </div>
            <div class="form-group">
                <label for="dataNascita">Data di Nascita</label>
                <input type="date" class="form-control" id="dataNascita">
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome">
            </div>
            <div class="form-group">
                <label for="cognome">Cognome</label>
                <input type="text" class="form-control" id="cognome">
            </div>
            <div class="form-group">
                <label for="numero">Numero</label>
                <input type="text" class="form-control" id="numero">
            </div>
            <div class="form-group">
                <label for="CVV">CVV</label>
                <input type="text" class="form-control" id="CVV">
            </div>
            <div class="form-group">
                <label for="dataScadenza">Data di Scadenza</label>
                <input type="date" class="form-control" id="dataScadenza">
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
            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
        </form>
    </div>
    <script src="../js/modificaCliente.js"></script>
</body>
</html>
