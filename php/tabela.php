<?php include('../config.php');

$cobrar474 = $conn->prepare('SELECT * FROM usuarios WHERE id = ?');
$cobrar474->execute(array($_GET['onde']));

while($linha474 = $cobrar474->fetchAll(PDO::FETCH_ASSOC)): 
?>

<div id="res-vt">Você tem: <span id="tabela"><?php echo $linha474['lances'] ?></span> Lances</div>;

<?php endwhile;