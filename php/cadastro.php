<?php include('../config.php');

$data = array_values($_POST);

$insert = $conn->prepare('INSERT INTO usuarios set 
		nome=?, email=? telefone=?, cpf=?, rg=?, nascimento=?, sexo=?, cep=?, endereco=?, 
		numero=?, complemento=?, bairro=?, cidade=?, estado=?, login=?, senha=?');

if ( ! $insert->execute($data)) {
	die('Error');
}

header('Location: ../');