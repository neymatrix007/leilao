<div id="topo">
<?php if(isset($user_id)){ ?>
<script type="text/javascript">
	$(document).ready(function(){
		atualizar_tabela();	
	});
	setInterval(function (){
		atualizar_tabela();
	} , 1000); // 1 segundos
	function atualizar_tabela(){
		$.get("../php/tabela.php?onde=<?php echo $user_id; ?>", function(tabela) {
			$("#res-lances").html(tabela);
		});
	};
</script>
<div id="res-lances"></div>
<div class="nombre">
<?php echo 'Olá, '.$user_login.' <a href="../php/logout.php">Sair</a>'; ?>
</div>
<a class="renember" href="my-prod.php">Meus Produtos</a><span class="barv">| </span> <a class="cad" href="comprar_lances.php">Comprar Lances</a>
<?php }else{ ?>
<form action="php/login.php" method="post">
<input type="text" placeholder="Login" name="login" />
<input type="password" placeholder="Senha" name="senha" />
<input type="submit" value="OK" />
</form>
<a class="renember" href="javascript:;">Esqueci a senha</a><span class="barv">| </span> <a class="cad" href="cadastre.php">Cadastre-se aqui</a>
<?php } ?>
</div>
<div class="menu">
<ul>
<a href="../"><li><span>PÁGINA INÍCIAL</span></li></a>
<a href="#"><li><span>ARREMATADOS</span></li></a>
<a href="#"><li><span>SOBRE O GRUPO</span></li></a>
<a href="#"><li><span>DEPOIMENTOS</span></li></a>
<a href="#"><li><span>FUNCIONAMENTO</span></li></a>
<a href="#"><li><span>FALE CONOSCO</span></li></a>
</ul>
</div>