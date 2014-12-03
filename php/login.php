<?php include('../config.php') ?>

<html>
	<head>
		<title>Redirecionando...</title>

		<script type="text/javascript">
			function loginsuccessfully() {
				setTimeout("window.location='../'", 2000);
			}

			function loginfailed() {
				setTimeout("window.location='../'", 2000);
			}
		</script>

	</head>
	<body>
		<?php

		if (count($_POST)) {

			$login = $_POST['login'];
			$senha = $_POST['senha'];

			$query = $conn->prepare('SELECT * FROM usuarios WHERE login = ? and senha = ?');
			$execute = $query->execute(array($_POST['login'], $_POST['senha']));

			if ($execute->rowCount()) {

				$_SESSION['login'] = $_POST['login'];
				$_SESSION['senha'] = $_POST['senha'];
				
				echo "<center><h2>Login efetuado com sucesso! Aguarde um instante...</h2></center>";
				echo "<script>loginsuccessfully()</script>";
				
			} else {

				echo "<center><h2>Login ou Senha Invalidos! Aguarde um instante para tentar novamente!</h2></center>";
				echo "<script>loginfailed()</script>";
			}
		}
		?>
	</body>
</html>