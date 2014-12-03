<?php include('config.php'); ?>
<?php
	if (isset($_SESSION['login'])) {

		$loginv = $_SESSION['login'];
		$sqlv = $conn->prepare('SELECT * FROM usuarios WHERE login = ?');
		$sqlv->execute(array($loginv));

		while($linhav = $sqlv->fetchAll(PDO::FETCH_ASSOC)) {

			$user_id    = $linhav['id'];
			$user_nome  = $linhav['nome'];
			$user_email = $linhav['email'];
			$user_login = $linhav['login'];
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Documento sem título</title>
		<link rel="stylesheet" href="css/estilo.css" />
	</head>
	<body>
		<?php include('header/topo.php'); ?>
		<!-- Central -->
		<div class="mpbase"></div>
		<!-- end Central -->
	</body>
</html>