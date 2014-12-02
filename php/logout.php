<title>Deslogando</title>
<?php
	session_start();
	session_destroy();
	header("Location: ../");
?>