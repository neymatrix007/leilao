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
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="/js/contador.js"></script>
<script type="text/javascript" src="[url=http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js]http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js [/url]"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
    jQuery('#lancar').submit(function(){
    var dados = jQuery(this).serialize();
     
    jQuery.ajax({
    type: "POST",
    url: "php/lancar.php",
    data: dados,
    success: function(data)
    {
    document.getElementById('msg').innerHTML = data;
    }
    });
    return false;
    });
    });
    </script>
<script type="text/javascript">
function atualiza(n){
var num = (parseInt(n) + 1);

$('#bus').html(num);
}

$(document).ready(function() {
setInterval(function() { atualiza($('#bus').text()); }, 1000);

})
</script>
</head>

<body>
<?php include('header/topo.php'); ?>
<!-- Central -->
<?php
$sql = mysql_query('SELECT * FROM produtos WHERE id = '.$_GET['uid'].'');
while($linha = mysql_fetch_array($sql)){
?>
<div class="prod">
<div class="titu"><?php echo $linha['titulo']; ?></div>
<ul>
<li><img class="improd" src="<?php echo $linha['imagem']; ?>" /></li>
<li>
<div class="info">
<?php if($linha['disponivel'] == 1){ ?>
<script type="text/javascript">
	$(document).ready(function(){
		atualizar_nomes();	
	});
	setInterval(function (){
		atualizar_nomes();
	} , 1000); // 1 segundos
	function atualizar_nomes(){
		$.get("php/nomes.php", function(nome) {
			$("#dvalorp").html(nome);
		});
	};
</script>
<script type="text/javascript">
	$(document).ready(function(){
		atualizar_preco();	
	});
	setInterval(function (){
		atualizar_preco();
	} , 1000); // 1 segundos
	function atualizar_preco(){
		$.get("php/precos.php?onde=<?php echo $linha['id']; ?>", function(preco) {
			$("#dprecop").html(preco);
		});
	};
</script>
<script type="text/javascript">
	$(document).ready(function(){
		atualizar_cobra();	
	});
	setInterval(function (){
		atualizar_cobra();
	} , 1000); // 1 segundos
	function atualizar_cobra(){
		$.get("php/pcobra.php?onde=<?php echo $user_id; ?>", function(cobra) {
			$("#dcobrap").html(cobra);
		});
	};
</script>
<?php } ?>
<?php if($linha['disponivel'] == 3){ ?>
<div class="caixa0">
<table>
<tr><td><span>De</span></td><td style="text-align:center;"><span class="bruto">R$ <?php echo number_format($linha['preco'],2,",","."); ?></span></td></tr>
<tr><td><span>Por</span></td><td style="text-align:center;">
<?php $uid = $_GET['uid']; $busca_vencedor = mysql_query('SELECT * FROM arremate WHERE produto = '.$_GET['uid'].' ORDER BY id DESC LIMIT 1');
while($result_vencedor = mysql_fetch_array($busca_vencedor)){$campeao = $result_vencedor['interessado'];} ?>
<?php
$buscar_valor = mysql_query("SELECT * FROM arremate WHERE produto = '$uid' AND interessado = '$campeao'");
$total = mysql_num_rows($buscar_valor);
echo '<span class="varremate">R$ '.number_format($total,2,",",".").'</span>';
?></td></tr>
</table>
<div class="economia"><span class="normal">Economia de: </span><span class="vnormal"> R$ <?php $economia = $linha['preco'] - $total; echo number_format($economia,2,",","."); ?></span></div>
</div>
<?php } ?>
<div class="vencedor"><?php if($linha['disponivel'] == 1){echo 'Andamento';}elseif($linha['disponivel'] == 3){echo 'Vencedor';} ?></div>

<?php if($linha['disponivel'] == 1){ ?>
<script type="text/javascript">
$(document).ready(function(){
atualizar_quinze();	
});
setInterval(function (){
atualizar_quinze();
} , 17000); // 1 segundos
function atualizar_quinze(){
$.get("php/quinze.php?produto=<?php echo $_GET['uid']; ?>&onde=<?php echo $user_login; ?>", function(quinze) {
$("#inicio").html(quinze);
});
};
</script>
<div id="preinicio"><span id="inicio"></span></div>
<div class="sporp"><span id="dvalorp"></span></div>
<div class="sporpc"><span id="dprecop"></span></div>
<?php if(isset($user_id)){ ?>
<form action="" method="post" id="lancar">
<span id="dcobrap"></span>
<input type="hidden" name="interessado" value="<?php echo $user_login; ?>" />
<input type="hidden" name="produto" value="<?php echo $linha['id']; ?>" />
<input type="submit" name="enviar" value="LANCE" />
</form>
<?php }else{ ?>
<a style="text-decoration:none;" href="cadastre.php"><input type="submit" value="Login" /></a>
<?php } ?>
<?php } ?>
<?php if($linha['disponivel'] == 3){ ?>
<div class="pessoa">
<?php echo $campeao;?>
</div>
<div class="arrematou"><span class="inf">Arrematou com APENAS </span>
<span class="valu">
<?php
$busca_lances = mysql_query("SELECT * FROM arremate WHERE produto = '$uid' AND interessado = '$campeao'");
$result_lances = mysql_num_rows($busca_lances);
echo $result_lances. ' Lances';
?>
</span></div>
<div class="arrematado"><span>ARREMATADO</span></div>
<?php } ?>
<?php if($linha['disponivel'] == 2){ ?>
<?php
$i = 0;
$sql2 = mysql_query('SELECT * FROM produtos WHERE id = '.$_GET['uid'].'');
while ($linha2 = mysql_fetch_array($sql2)) {
?>
<div class="crono" data-countdown="<?php echo implode('/', array_reverse(explode('/', $linha['data']))) ?>"></div>
<script type="text/javascript">
			$('[data-countdown]').each(function() {
			   var $this = $(this), finalDate = $(this).data('countdown');
			   $this.countdown(finalDate, function(event) {
			     $this.html(event.strftime('Falta apenas <br /> %D dias <br /> %H:%M:%S'));
			   });
			 });
		</script>
<?php $i++;} ?>

<?php } ?>
</div>
</li>
<li>
<div class="texto"><?php echo utf8_encode($linha['descricao']); ?></div>
</li>
<li>
<a href="javascript:;"><img class="fg" src="images/fg.jpg" /></a>
<a href="javascript:;"><img class="fg" src="images/comprar.png" /></a>
<a href="javascript:;"><img class="fg" src="images/socio.png" /></a>
</li>
</ul>
</div>
<?php } ?>
<!-- end Central -->
</body>
</html>