<?php include('../config.php');

$query = $conn->prepare('SELECT * FROM arremate WHERE produto = ?'); 
$query->prepare(array($_GET['onde']));

$total = $query->rowCount();

echo 'R$ '.number_format($total, 2, ",", ".");