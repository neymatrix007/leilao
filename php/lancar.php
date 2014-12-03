<?php include('../config.php');

$cobranca = 	$_POST['cobranca'];
$interessado =  $_POST['interessado'];
$produto = 		$_POST['produto'];

$query = $conn->prepare('INSERT INTO arremate set produto=?, interessado=?');

if ( ! $query->execute(array($produto, $interessado))) {
	die('Error insert arremate.');
}

$query = $conn->prepare('UPDATE usuarios SET lances = ? WHERE login = ?');

if ( ! $query->execute(array($cobranca, $interessado))) {
	die('Error update usuario.')
}

$query = $conn->prepare('UPDATE regressiva SET produto = ?, interessado = ?');

if ( ! $query->execute(array($produto, $interessado))) {
	die('Error update regressiva.')
}