<?php 

session_start();

$conn = new PDO('mysql:host=localhost;dbname=leilao', 'root', '123');

function dd($in)
{
	echo '<pre>';
	print_r($in);
	echo '</pre>';
	exit;
}