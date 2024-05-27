<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Clienti Inattivi</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
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
<h1>Clienti Inattivi</h1>
<table id="clientiTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Codice Tessera</th>
            <th>Email</th>
            <th>Password</th>
            <th>Codice Fiscale</th>
            <th>Data di Nascita</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Numero</th>
            <th>CVV</th>
            <th>Data di Scadenza</th>
            <th>Città</th>
            <th>Via</th>
            <th>Numero Civico</th>
            <th>Attivo</th>
        </tr>
    </thead>
    <tbody id="clientiBody">
        <!-- Qui verranno aggiunti dinamicamente i clienti inattivi -->
    </tbody>
</table>

<script src="../js/gestioneTessere.js"></script>
</body>
</html>
