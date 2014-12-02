<?php
include('../config.php');

$vai = $_GET['onde'];

$sql = mysql_query('SELECT * FROM arremate WHERE produto = '.$vai.''); 

$total = mysql_num_rows($sql); 

echo 'R$ '.number_format($total,2,",","."); 
?>