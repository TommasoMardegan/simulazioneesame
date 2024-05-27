<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="text-center">
            <h1 class="mb-4">Ciao, admin</h1>
            <div class="d-grid gap-2">
                <a href="gestioneBiciclette.php" class="btn btn-primary btn-lg mb-2">Gestisci le biciclette</a>
                <a href="gestioneStazioni.php" class="btn btn-secondary btn-lg mb-2">Gestisci le stazioni</a>
                <a href="consultaMappa.html" class="btn btn-success btn-lg">Consulta la mappa</a>
                <a href="gestioneTessere.php" class="btn btn-success btn-lg">Gestisci le tessere</a>
                <a href="../php/logout.php" class="btn btn-secondary">effettua il logout</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies (optional but recommended) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
