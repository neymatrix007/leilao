<?php
include('../config.php');

$cobrar474 = mysql_query('SELECT * FROM usuarios WHERE id = '.$_GET['onde'].'');
while($linha474 = mysql_fetch_array($cobrar474)){echo '<div id="res-vt">Você tem: <span id="tabela">'.$linha474['lances'].'</span> Lances</div>';}
?>