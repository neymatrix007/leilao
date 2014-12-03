<?php include('../config.php');

$query = $conn->query('SELECT * FROM arremate ORDER BY id DESC LIMIT 1');
$assoc = $query->fetch(PDO::FETCH_ASSOC);

echo $assoc['interessado'];