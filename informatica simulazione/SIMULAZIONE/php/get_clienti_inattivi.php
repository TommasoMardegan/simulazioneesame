<?php
include_once("../service/gestioneDB.php");

$gestoreDb = new gestioneDB();
$clientiInattivi = $gestoreDb->getClientiInattivi();

echo json_encode($clientiInattivi);
?>
