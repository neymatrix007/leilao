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
		<title><?php echo $user_email; ?></title>
		<link rel="stylesheet" href="css/estilo.css" />
		
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="/js/contador.js"></script>
		<script type="text/javascript" src="[url=http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js]http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js [/url]"></script>
		
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#lancar').submit(function() {
					var dados = jQuery(this).serialize();

					jQuery.ajax({
						type: "POST",
						url: "php/lancar.php",
						data: dados,
						success: function(data) {
							document.getElementById('msg').innerHTML = data;
						}
					});
					return false;
				});
			});
		</script>
	</head>

	<body>
		<?php include('header/topo.php'); ?>
		<!-- Central -->
		<div class="box">
			<ul>
				<?php
				$i = 0;
				$sql = $conn->query('SELECT * FROM produtos');
				
				while ($linha = $sql->fetchAll(PDO::FETCH_ASSOC)): ?>

					<?php if ($linha['disponivel'] == 2){ ?>

					<li class="lof">
						<div class="fech"></div>

						<a class="title2" href="produto.php?uid=<?php echo $linha['id']; ?>">
							<?php echo $linha['titulo']; ?>
						</a>
						<img src="<?php echo $linha['imagem']; ?>" />
						
						<div class="spor">
							<span id="dvalor">--//--</span>
						</div>
						
						<div class="spor">
							<span id="dpreco">R$ 0,00</span>
						</div>
						
						<div>
							<span class="cro-parado">15</span>
						</div>
						
						<div class="agenda">
							<?php if ($linha['data'] <> date("d/m/Y")): ?>
								<div data-countdown="<?php echo implode('/', array_reverse(explode('/', $linha['data']))) ?>"></div>

							<?php elseif ($linha['data'] == date("d/m/Y")): ?>
								<span class="hoje">Daqui a pouco!</span>

							<?php endif ?>
						</div>
					</li>

					<?php elseif ($linha['disponivel'] == 1): ?>

					<li class="lon">
						<a class="title" href="produto.php?uid=<?php echo $linha['id']; ?>">
							<?php echo $linha['titulo']; ?>
						</a>
						
						<img src="<?php echo $linha['imagem']; ?>" />
						
						<script type="text/javascript">
							$(document).ready(function() {
								atualizar_nomes();
								atualizar_preco();
								atualizar_cobra();
								atualizar_quinze();
							});
							
							setInterval(function() {
								atualizar_nomes();
								atualizar_preco();
								atualizar_cobra();
							}, 1000); // 1 segundos
							
							setInterval(function (){
								atualizar_quinze();
							} , 17000); // 17 segundos
							
							function atualizar_nomes() {
								$.get("php/nomes.php", function(nome) {
									$("#dvalorp").html(nome);
								});
							};

							function atualizar_preco() {
								$.get("php/precos.php?onde=<?php echo $linha['id']; ?>", function(preco) {
									$("#dpreco").html(preco);
								});
							};

							function atualizar_cobra() {
								$.get("php/pcobra.php?onde=<?php echo $user_id; ?>", function(cobra) {
									$("#dcobra").html(cobra);
								});
							};

							function atualizar_quinze(){
								$.get("php/quinze.php", function(quinze) {
									$("#inicioj").html(quinze);
								});
							};
						</script>

						<div class="spor">
							<span id="dvalorp"></span>
						</div>
						
						<div class="spor">
							<span id="dpreco"></span>
						</div>

						<div id="preinicio">
							<span id="inicioj"></span>
						</div>

						<?php if (isset($user_nome)): ?>
						
						<form action="" method="post" id="lancar">
							<span id="dcobra"></span>
							<input type="hidden" name="interessado" value="<?php echo $user_login; ?>" />
							<input type="hidden" name="produto" value="<?php echo $linha['id']; ?>" />
							<input type="submit" name="enviar" value="LANCE" />
						</form>
						<?php else: ?>
						<a style="text-decoration:none;" href="cadastre.php"><input type="submit" value="Login" /></a>
						<?php endif ?>
					</li>
					<?php endif ?>

				<?php $i++; endwhile ?>
			</ul>
		</div>
		<!-- end Central -->
		
		<script type="text/javascript">
			$('[data-countdown]').each(function() {
				var $this = $(this),
					finalDate = $(this).data('countdown');
				$this.countdown(finalDate, function(event) {
					$this.html(event.strftime('Falta apenas <br /> %D dias <br /> %H:%M:%S'));
				});
			});
		</script>
	</body>
</html>