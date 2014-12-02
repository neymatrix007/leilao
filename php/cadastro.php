<?php
include('../config.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$nascimento = $_POST['nascimento'];
$sexo = $_POST['sexo'];
$cep = $_POST['cep'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$login = $_POST['login'];
$senha = $_POST['senha'];

$sql = mysql_query("INSERT INTO usuarios VALUES('', '".$nome."', '".$email."', '".$telefone."', '".$cpf."', '".$rg."', '".$nascimento."', '".$sexo."', '".$cep."', '".$endereco."', '".$numero."', '".$complemento."', '".$bairro."', '".$cidade."', '".$estado."', '".$login."', '".$senha."', '')");

if($sql){header('Location: ../');}
?>