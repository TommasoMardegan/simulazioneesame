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
    <div class="container mt-5">
        <?php
            session_start();
            echo "<h1 class='display-4'>Benvenuto, " . $_SESSION['email'] . "</h1>";  
        ?>
        <p class="lead">Benvenuto nella piattaforma delle stazioni. Puoi consultare la mappa delle stazioni utilizzando il link sottostante.</p>
        <a href="consultaMappa.html" class="btn btn-primary">Consulta Mappa delle Stazioni</a>
        <a href="modificaCliente.html" class="btn btn-secondary">Modifica Informazioni Cliente</a>
        <a href="../php/logout.php" class="btn btn-secondary">effettua il logout</a>
        <a href="riepilogo.html" class="btn btn-primary">Riepilogo</a>
    </div>
</body>
</html>
