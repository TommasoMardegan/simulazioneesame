<html>
    <?php
        session_start();
        echo "<h1>Benvenuto, " . $_SESSION['email'] . "</h1>";  
    ?>
    <a href="consultaMappa.html">consulta mappa delle stazioni</a>
    <br>
</html>