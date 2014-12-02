<?php include('../config.php');

$cobrar474 = $conn->prepare('SELECT * FROM usuarios WHERE id = ?');
$cobrar474->execute(array($_GET['onde']));

$valord = false;

while($linha474 = $cobrar474->fetchAll(PDO::FETCH_ASSOC)){
	$valord = $linha474['lances'] - 1;
}

echo '<input type="hidden" name="cobranca" value="'.$valord.'" />';