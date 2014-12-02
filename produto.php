<?php include('config.php'); 

	if (isset($_SESSION['login'])) {

		$sqlv = $conn->prepare('SELECT * FROM usuarios WHERE login = ?');
		$sqlv->execute(array($_SESSION['login']));
		
		while($linhav = $sqlv->fetchAll(PDO::FETCH_ASSOC)) {
			$user_id    = $linhav['id'];
			$user_nome  = $linhav['nome'];
			$user_email = $linhav['email'];
			$user_login = $linhav['login'];
		}
	}

	$sql = $conn->prepare('SELECT * FROM produtos WHERE id = ?');
	$sql->execute(array($_GET['uid']));

	$produto = $sql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Documento sem título</title>
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
	
			function atualiza(n) {
				var num = (parseInt(n) + 1);
				$('#bus').html(num);
			}
	
			$(document).ready(function() {
				setInterval(function() {
					atualiza($('#bus').text());
				}, 1000);
			})
		</script>
	</head>
	<body>
		<?php include('header/topo.php'); ?>
		<!-- Central -->

		<div class="prod">
			<div class="titu"><?php echo $produto['titulo']; ?></div>
			<ul>
				<li>
					<img class="improd" src="<?php echo $produto['imagem']; ?>" />
				</li>

				<li>
					<div class="info">
					
					<?php if ($produto['disponivel'] == 1): ?>
						<script type="text/javascript">
							$(document).ready(function() {
								atualizar_nomes();
								atualizar_preco();
								atualizar_cobra();
							});

							setInterval(function() {
								atualizar_nomes();
								atualizar_preco();
								atualizar_cobra();
							}, 1000); // 1 segundos

							function atualizar_nomes() {
								$.get("php/nomes.php", function(nome) {
									$("#dvalorp").html(nome);
								});
							};

							function atualizar_preco() {
								$.get("php/precos.php?onde=<?php echo $produto['id']; ?>", function(preco) {
									$("#dprecop").html(preco);
								});
							};

							function atualizar_cobra() {
								$.get("php/pcobra.php?onde=<?php echo $user_id; ?>", function(cobra) {
									$("#dcobrap").html(cobra);
								});
							};
						</script>
						<?php endif ?>

						<?php if ($produto['disponivel'] == 3): ?>
						
						<div class="caixa0">
							<table>
								<tr>
									<td>
										<span>De</span>
									</td>

									<td style="text-align:center;">
										<span class="bruto">R$ <?php echo number_format($produto['preco'],2,",","."); ?></span>
									</td>
								</tr>

								<tr>
									<td>
										<span>Por</span>
									</td>

									<td style="text-align:center;">
										<?php 
											$uid = $_GET['uid']; 
											$busca_vencedor = $conn->prepare('SELECT * FROM arremate WHERE produto = ? ORDER BY id DESC LIMIT 1');
											$busca_vencedor->execute(array($produto['id']));

											$result_vencedor = $busca_vencedor->fetch(PDO::FETCH_ASSOC);
											$campeao = $result_vencedor['interessado'];
											
											$buscar_valor = $conn->prepare('SELECT * FROM arremate WHERE produto = ? AND interessado = ?');
											$buscar_valor->execute(array($_GET['uid'], $campeao));

											$total = $buscar_valor->rowCount();

											echo '<span class="varremate">R$ '.number_format($total,2,",",".").'</span>';
										?>
									</td>
								</tr>
							</table>
							
							<div class="economia">
								<span class="normal">Economia de: </span>
								<span class="vnormal"> R$ <?php $economia = $produto['preco'] - $total; echo number_format($economia,2,",","."); ?></span>
							</div>
						</div>
						<?php endif ?>

						<div class="vencedor">
							<?php 
							if ($produto['disponivel'] == 1):
								echo 'Andamento';
							elseif ($produto['disponivel'] == 3):
								echo 'Vencedor';
							endif ?>
						</div>

						<?php if ($produto['disponivel'] == 1): ?>
							<script type="text/javascript">
								$(document).ready(function() {
									atualizar_quinze();
								});
								
								setInterval(function() {
									atualizar_quinze();
								}, 17000); // 1 segundos
								
								function atualizar_quinze() {
									$.get("php/quinze.php?produto=<?php echo $_GET['uid']; ?>&onde=<?php echo $user_login; ?>", function(quinze) {
										$("#inicio").html(quinze);
									});
								};
							</script>
							
							<div id="preinicio"><span id="inicio"></span></div>
							<div class="sporp"><span id="dvalorp"></span></div>
							<div class="sporpc"><span id="dprecop"></span></div>
							
							<?php if (isset($user_id)): ?>
							<form action="" method="post" id="lancar">
								<span id="dcobrap"></span>
								<input type="hidden" name="interessado" value="<?php echo $user_login; ?>" />
								<input type="hidden" name="produto" value="<?php echo $produto['id']; ?>" />
								<input type="submit" name="enviar" value="LANCE" />
							</form>
							<?php else: ?>
							<a style="text-decoration:none;" href="cadastre.php"><input type="submit" value="Login" /></a>
							<?php endif ?>
						<?php endif ?>
					
						<?php if ($produto['disponivel'] == 3): ?>
							<div class="pessoa">
								<?php echo $campeao;?>
							</div>
							
							<div class="arrematou">
								<span class="inf">Arrematou com APENAS </span>
								<span class="valu">
								<?php
								$busca_lances = $conn->prepare('SELECT * FROM arremate WHERE produto = ? AND interessado = ?');
								$busca_lances->execute(array($uid, $campeao));

								echo $busca_lances->rowCount(). ' Lances';
								?>
								</span>
							</div>
							
							<div class="arrematado">
								<span>ARREMATADO</span>
							</div>
						<?php endif ?>
						
						<?php if ($produto['disponivel'] == 2): ?>

							<div class="crono" data-countdown="<?php echo implode('/', array_reverse(explode('/', $produto['data']))) ?>"></div>
							
							<script type="text/javascript">
								$('[data-countdown]').each(function() {
									var $this = $(this),
										finalDate = $(this).data('countdown');
									$this.countdown(finalDate, function(event) {
										$this.html(event.strftime('Falta apenas <br /> %D dias <br /> %H:%M:%S'));
									});
								});
							</script>
						<?php endif ?>
					<?php endif ?>
				</li>

				<li>
					<div class="texto"><?php echo utf8_encode($produto['descricao']); ?></div>
				</li>

				<li>
					<a href="javascript:;"><img class="fg" src="images/fg.jpg" /></a>
					<a href="javascript:;"><img class="fg" src="images/comprar.png" /></a>
					<a href="javascript:;"><img class="fg" src="images/socio.png" /></a>
				</li>
			</ul>
		</div>
		<!-- end Central -->
	</body>
</html>