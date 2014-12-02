<?php
include('../config.php');

$buscar_nome = mysql_query("SELECT * FROM arremate ORDER BY id DESC LIMIT 1");
$result_nome = mysql_fetch_array($buscar_nome);
echo $result_nome['interessado'];
?>