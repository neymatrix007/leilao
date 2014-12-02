<?php include('config.php'); ?>
<?php
	session_start();
	
	$loginv = $_SESSION['login'];
	$sqlv = mysql_query("SELECT * FROM usuarios WHERE login = '$loginv'");
	while($linhav = mysql_fetch_array($sqlv)) {
		$user_id = $linhav['id'];
		$user_nome = $linhav['nome'];
		$user_email = $linhav['email'];
		$user_login = $linhav['login'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<link rel="stylesheet" href="css/estilo.css" />
</head>

<body>
<?php include('header/topo.php'); ?>
<!-- Central -->
<div class="mpbase">

</div>
<!-- end Central -->
</body>
</html>