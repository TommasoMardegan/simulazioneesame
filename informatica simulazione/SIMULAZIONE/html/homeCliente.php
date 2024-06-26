<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvenuto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <?php
            echo "<h1 class='display-4'>Benvenuto, " . $_SESSION['email'] . "</h1>";  
        ?>
        <p class="lead">Benvenuto nella piattaforma delle stazioni. Puoi consultare la mappa delle stazioni utilizzando il link sottostante.</p>
        <a href="consultaMappa.html" class="btn btn-primary">Consulta Mappa delle Stazioni</a>
        <a href="modificaCliente.php" class="btn btn-secondary">Modifica Informazioni Cliente</a>
        <a href="../php/logout.php" class="btn btn-secondary">effettua il logout</a>
        <a href="riepilogo.php" class="btn btn-primary">Riepilogo</a>
        <a href="segnala.php" class="btn btn-primary">Segnala lo smarrimento della tessera</a>
    </div>
</body>
</html>
