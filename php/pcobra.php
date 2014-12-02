<?php
include('../config.php');

$cobrar474 = mysql_query('SELECT * FROM usuarios WHERE id = '.$_GET['onde'].'');
while($linha474 = mysql_fetch_array($cobrar474)){$valord = $linha474['lances'] - 1;}
echo '<input type="hidden" name="cobranca" value="'.$valord.'" />';
?>