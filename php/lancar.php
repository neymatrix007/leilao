<?php
include('../config.php');

$cobranca = $_POST['cobranca'];
$interessado = $_POST['interessado'];
$produto = $_POST['produto'];

mysql_query("INSERT INTO arremate VALUES('', '".$produto."', '".$interessado."')");

mysql_query("UPDATE usuarios SET lances = '".$cobranca."' WHERE login = '".$interessado."'");

mysql_query("UPDATE regressiva SET produto = '".$produto."', interessado = '".$interessado."'");
?>