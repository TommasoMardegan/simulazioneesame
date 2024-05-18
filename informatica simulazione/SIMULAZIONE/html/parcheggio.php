<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Biciclette</title> 
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/parcheggio.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Parcheggio</h1>
        numero dei posti: <label for="numeroPosti" id="numeroPosti">
    </div>
    <div class="container mt-5">
    <?php
        session_start();
        $tipo = $_SESSION["tipo"];
        if($tipo == "admin") {
            echo "nuovo numero di posti: <input type='number' id='numeroPostiInput'><br>";
            echo "<button id='modificaBtn' class='btn btn-primary'>Modifica</button>";
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
