<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo Tragitti</title>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/tragitti.js"></script>
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
        <h1 class="mb-4 text-center">Riepilogo dei Tragitti</h1>
        <div class="table-responsive">
            <table id="riepilogo-table" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Distanza Percorsa (m)</th>
                        <th>Tariffa (€)</th>
                        <th>Tipo</th>
                        <th>Codice Bicicletta</th>
                        <th>Codice Stazione</th>
                        <th>Data Ora</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- I dati verranno inseriti qui da JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
