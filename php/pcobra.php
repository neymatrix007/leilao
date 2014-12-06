<?php include('../config.php');

$cobrar474 = $conn->prepare('SELECT * FROM usuarios WHERE id = ?');
$cobrar474->execute(array($_GET['onde']));

$valord = false;

$linha474 = $cobrar474->fetch(PDO::FETCH_ASSOC);
$valord = $linha474['lances'] - 1;

echo '<input type="hidden" name="cobranca" value="'.$valord.'" />';