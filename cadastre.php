<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<link rel="stylesheet" href="css/estilo.css" />
<script type="text/javascript">
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>
</head>

<body>
<?php include('header/topo.php'); ?>
<!-- Central -->
<div class="cadastro">
<h2 class="boder-bottom">Cadastro</h2>
<form action="php/cadastro.php" method="post">
<table>
<h3 class="boder-bottom">Dados Pessoais</h3>
<tr><td><span>*Nome Completo</span></td><td><input type="text" name="nome" /></td></tr>
<tr><td><span>*E-mail</span></td><td><input type="text" name="email" /></td></tr>
<tr><td><span>*Telefone</span></td><td><input type="text" name="telefone" onkeypress="formatar('## ####-####', this)" maxlength="13" /></td></tr>
<tr><td><span>*CPF</span></td><td><input type="text" name="cpf" onkeypress="formatar('###.###.###-##', this)" maxlength="14" /></td></tr>
<tr><td><span>*RG</span></td><td><input type="text" name="rg" onkeypress="formatar('######## ##', this)" maxlength="11" /></td></tr>
<tr><td><span>*Data de Nascimento</span></td><td><input type="text" name="nascimento" onkeypress="formatar('##/##/####', this)" maxlength="10" /></td></tr>
<tr><td><span>*Sexo</span></td><td><input type="radio" name="sexo" value="Masculino" /><label>Masculino</label><input type="radio" name="sexo" value="Feminino" /><label>Feminino</label></td></tr></table><table>
<h3 class="boder-bottom">Endereço</h3>
<tr><td><span>*CEP</span></td><td><input type="text" name="cep" /></td></tr>
<tr><td><span>*Endereco</span></td><td><input type="text" name="endereco" /></td></tr>
<tr><td><span>*Numero</span></td><td><input type="text" name="numero" /></td></tr>
<tr><td><span>*Complemento</span></td><td><input type="text" name="complemento" /></td></tr>
<tr><td><span>*Bairro</span></td><td><input type="text" name="bairro" /></td></tr>
<tr><td><span>*Cidade</span></td><td><input type="text" name="cidade" /></td></tr>
<tr><td><span>*Estado</span></td><td><input type="text" name="estado" /></td></tr></table><table>
<h3 class="boder-bottom">Dados para acesso</h3>
<tr><td><span>*Login</span></td><td><input type="text" name="login" /></td></tr>
<tr><td><span>*Senha</span></td><td><input type="password" name="senha" /></td></tr>
</table>
<input type="submit" value="Cadastrar" />
</form>
</div>
<!-- end Central -->
</body>
</html>