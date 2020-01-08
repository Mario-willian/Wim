<?php 
header("Content-Type:Text/html; charset=utf8");

session_start();
include_once ("conexao.php");
//Evitar Bugs
if (!empty($_SESSION['usuario'])) {
  $cargo = "";
  $cargo = $_SESSION['usuario']->cargo;
    //Verificando se é um ADM
    if ($cargo == "c") {
      $cmdzao = $_SESSION['usuario']->cmd;
    }else{
      header("location:../index.php");
    }
}else{
  header("location:../index.php");
}

//LOGIIIIIIIIN
$result_estoques0 = "SELECT cpf FROM usuario where cmd = '$cmdzao'";
$resultado_estoques0 = mysqli_query($conn, $result_estoques0);
$row_estoques0 = mysqli_fetch_assoc($resultado_estoques0);
$login = $row_estoques0['cpf'];

$result_estoques = "SELECT * FROM usuario where cpf = '$login'";
$resultado_estoques = mysqli_query($conn, $result_estoques);
$row_estoques = mysqli_fetch_assoc($resultado_estoques);

//Quantidade de notificacoes
$result_estoques2 = "SELECT count(ativo) FROM notificacao where usuario_cpf = '$login' and ativo = 's'";
$resultado_estoques2 = mysqli_query($conn, $result_estoques2);
$row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);

require_once "actlogin2.php";

$validar = new Login;

if (isset($_GET['sacar'])){
    header("location:php/sacar.php");
}
else if (isset($_GET['salvar'])){
    $validar->validar();
}
?>

<!DOCTYPE html>
<html>
<title>WIM | Conta</title>
<meta charset="UTF-8">
  <link rel="shortcut icon" href="imagens/loguei.png">
<!--
                       
\$\         |$|         /$/        |$$|    /$$\      /$$\
 \$\        |$|        /$/        |$$|    /$/\$\    /$/\$\
  \$\       |$|       /$/        |$$|    /$/  \$\  /$/  \$\
   \$\    /$/\$\     /$/        |$$|    /$/   \$\ /$/    \$\
    \$\  /$/  \$\  /$/         |$$|    /$/    \$\/$/      \$\
     \$\/$/    \$\/$/         |$$|    /$/      \$$/        \$\
____________________________________________________________________
 @ https://www.wimoficial.com.br

-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">
<!--TIRAR O SUBLINHADOOOOOOOOOOOOOOOOOOO-->
<!--TIRAR O SUBLINHADOOOOOOOOOOOOOOOOOOO-->
<style type="text/css"> 
a:link 
{ 
text-decoration:none; 
} 
</style>
<!--TIRAR O SUBLINHADOOOOOOOOOOOOOOOOOOO-->
<!--TIRAR O SUBLINHADOOOOOOOOOOOOOOOOOOO-->
<!-- Top container -->
<div class="w3-bar w3-top w3-green w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"><img src='imagens/ww.png' style='width: 20px'> WIM</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="imagens/img.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Bem Vindo, <strong><?php echo $row_estoques['nome'];?></strong></span><br>
      <a class="w3-bar-item w3-btn" href="notificacao.php"><i class="fa fa-bell fa-fw"></i><span class="badge badge-light"><?php echo $row_estoques2['count(ativo)'] ?></span></a>
      <a class="w3-bar-item w3-btn w3-blue" href="conta.php"><i class="fa fa-address-card"></i></a>
      <a class="w3-bar-item w3-btn" href="config.php"><i class="fa fa-cog"></i></a>

    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Painel de Controle</h5>
  </div>
<div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-btn w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> Fechar Menu</a>
    <a class="w3-bar-item w3-btn w3-padding" href="painel.php"><i class="fa fa-desktop"></i> Painel Inicial</a>
    <a class="w3-bar-item w3-btn w3-padding" href="carteira.php"><i class="fa fa-money"></i> Carteira</a>
    <a class="w3-bar-item w3-btn w3-padding" href="troca.php"><i class="fa fa-exchange"></i> Trocas</a>
    <a class="w3-bar-item w3-btn w3-padding" href="acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-btn w3-padding" href="doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-btn w3-padding" href="total.php"><i class="fa fa-line-chart"></i> Total</a>
    <a class="w3-bar-item w3-btn w3-padding" href="info.php"><i class="fa fa-paperclip"></i> Informações</a>
    <a class="w3-bar-item w3-btn w3-padding" href="historico.php"><i class="fa fa-calendar-check-o"></i> Histórico</a>
    <a class="w3-bar-item w3-btn w3-padding" href="config.php"><i class="fa fa-cog fa-fw"></i> Configurações</a>
    <a href="sair.php" class="w3-bar-item w3-btn w3-padding"><i class="fa fa-arrow-left"></i> Sair</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Fechar Menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
<style type="text/css">
   input[type="text"] {
  width: 100%;
  border: 2px solid #aaa;
  border-radius: 4px;
  margin: 8px 0;
  outline: none;
  padding: 8px;
  box-sizing: border-box;
  transition: 0.3s;
}
 input[type="password"] {
  width: 100%;
  border: 2px solid #aaa;
  border-radius: 4px;
  margin: 8px 0;
  outline: none;
  padding: 8px;
  box-sizing: border-box;
  transition: 0.3s;
}
   input[type="date"] {
  width: 100%;
  border: 2px solid #aaa;
  border-radius: 4px;
  margin: 8px 0;
  outline: none;
  padding: 8px;
  box-sizing: border-box;
  transition: 0.3s;
}
 input[type="email"] {
  width: 100%;
  border: 2px solid #aaa;
  border-radius: 4px;
  margin: 8px 0;
  outline: none;
  padding: 8px;
  box-sizing: border-box;
  transition: 0.3s;
}

input[type="text"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="password"] {
  padding-left: 40px;
}
input[type="password"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="text"] {
  padding-left: 40px;
}

input[type="email"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="date"] {
  padding-left: 40px;
}
input[type="date"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="email"] {
  padding-left: 40px;
}



.inputWithIcon {
  position: relative;
}

.inputWithIcon i {
  position: absolute;
  left: 0;
  top: 15px;
  padding: 9px 8px;
  color: #aaa;
  transition: 0.3s;
}

.inputWithIcon input[type="text"]:focus + i {
  color: dodgerBlue;
}
.inputWithIcon input[type="password"]:focus + i {
  color: dodgerBlue;
}
.inputWithIcon input[type="date"]:focus + i {
  color: dodgerBlue;
}
.inputWithIcon input[type="email"]:focus + i {
  color: dodgerBlue;
}

.inputWithIcon.inputIconBg i {
  background-color: #aaa;
  color: #fff;
  padding: 9px 4px;
  border-radius: 4px 0 0 4px;
}

.inputWithIcon.inputIconBg input[type="text"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
.inputWithIcon.inputIconBg input[type="password"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
.inputWithIcon.inputIconBg input[type="date"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
.inputWithIcon.inputIconBg input[type="email"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
</style>
  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h2><b><i class="fa fa-address-card"></i> Conta</b></h2>
    <h3><b>Dados Pessoais:</h3></b>

    <!--Apresenta mensanges de conclusao-->
                <?php
                      if (!empty($_SESSION['conclusao'])) {
                        echo $_SESSION['conclusao'];
                      }
                ?>

  <form>
<br>

   <h4>Nome Completo</h4>

   <b><div class="inputWithIcon">
  <input value="<?php echo $row_estoques['nome'];?>" maxlength="45" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  name="nome" type="text" placeholder="Digite seu nome" disabled="">
  <i class="fa fa-address-card-o fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>
    <h4>Nome de Usuário</h4>

    <b><div class="inputWithIcon">
  <input value="<?php echo $row_estoques['usuario'];?>"   maxlength="20" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  name="usuario" type="text" placeholder="Digite um nome de usuário" disabled="">
  <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>
    <h4>Senha</h4>
   <div class="inputWithIcon">
  <input maxlength="18" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"   value="<?php echo $row_estoques['senha'];?>" id="myInput" name="senha" type="password" disabled="">
  <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
</div><br>
</b>

    <h4>Data de Nascimento</h4>
   <b><div class="inputWithIcon">
  <input value="<?php echo $row_estoques['datanascimento'];?>" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;" name="datanascimento" type="date" disabled="">
  <i class="fa fa-calendar fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>

    <h4>E-mail</h4>
  <b><div class="inputWithIcon">
  <input value="<?php echo $row_estoques['email'];?>" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="30" name="email" type="email" placeholder="Digite seu email" disabled="">
  <i class="  fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>
     <h4>Sexo</h4>
   <b><div class="inputWithIcon">
  <input value="<?php echo $row_estoques['sexo'];?>" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="90" name="endereco" type="text" placeholder="Digite seu endereco" disabled="">
  <i class="  fa fa-heart-o fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>
    <h4>País</h4>
  <b><div class="inputWithIcon">
  <input value="<?php echo $row_estoques['pais'];?>" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="90" name="endereco" type="text" placeholder="Digite seu endereco" disabled="">
  <i class="  fa fa-globe fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>
      <h4>Estado</h4>
     <b><div class="inputWithIcon">
  <input value="<?php echo $row_estoques['estado'];?>" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="90" name="endereco" type="text" placeholder="Digite seu endereco" disabled="">
  <i class="  fa fa-globe fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>

      <h4>Endereço</h4>
 <b><div class="inputWithIcon">
  <input value="<?php echo $row_estoques['endereco'];?>" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="90" name="endereco" type="text" placeholder="Digite seu endereco" disabled="">
  <i class="  fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>

      <h4>Complemento</h4>
 <b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="20" name="complemento" type="text" value="<?php echo $row_estoques['complemento'];?>" placeholder="Ex: Apartamento" disabled="">
  <i class="  fa fa-building-o fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>

      <h4>Telefone</h4>
  <b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  placeholder="Ex: 00-90000-0000" type="text" name="telefone" maxlength="13" OnKeyPress="formatar('##-#####-####', this)" disabled="" value="<?php echo $row_estoques['telefone'];?>">
  <i class="  fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>

      <h4>CPF</h4> <b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  placeholder="Ex: 00-90000-0000" type="text" name="telefone" maxlength="13" OnKeyPress="formatar('##-#####-####', this)" disabled="" value="<?php echo $row_estoques['cpf'];?>">
  <i class="  	fa fa-address-card fa-lg fa-fw" aria-hidden="true"></i>
</div></b><br>
 <br>

</form>
  <br>
    <input type="" style="display:none" value="<?php echo $row_estoques['cpf'];?>" name="cpf">
    <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >
 <button type="submit" name="editar" class="btn btn-outline-primary w3-block w3-padding-large  w3-margin-bottom" class="form-control" onclick="document.getElementById('download').style.display='block'"><i class="fa fa-pencil-square-o"></i> Editar Dados</button>



      <form action="conta.php" method="get">
        <input type="" style="display:none" value="<?php echo $row_estoques['cpf'];?>" name="cpf">
        <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >
    <button type="submit" name= "sacar" class="btn btn-outline-success w3-block w3-padding-large  w3-margin-bottom"><i class="  fa fa-money"></i> Sacar Dinheiro</button><br>
</form>

  <hr>


  <!--DO BOTAO EDITAR-->
<form action="conta.php" method="GET">
<!-- Modal -->
<div id="download" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content" style="padding:32px">
    <div class="w3-container w3-white">
      <i onclick="document.getElementById('download').style.display='none'" class="fa fa-remove w3-xlarge w3-button w3-transparent w3-right w3-xlarge"></i>
      <h2 class="w3-wide">Procedimento de Verificação</h2>
      <p>Confirme seu login para continuar</p>
      
      <p><input class="w3-input w3-border" name="usuario"  type="text" placeholder="Digite seu nome de usuário" required=""></p>
      <p><input class="w3-input w3-border" name="senha" type="password" placeholder="Digite sua senha" required="" id="myInput"></p><h4>
<input type="checkbox" onclick="myFunction()"> Mostrar senha

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script></h4>
            <style>
.button {
  display: inline-block;
  border-radius: 10px;
  background-color: DodgerBlue;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 25px;
  padding: 20px;
  width: 800px;

  transition: all 0.5s;
  cursor: grab;
  margin: 5px;
}
.buttons {
  display: inline-block;
  border-radius: 10px;
  background-color: Orange;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 25px;
  padding: 20px;
  width: 800px;

  transition: all 0.5s;
  cursor: grab;
  margin: 5px;
}
.botao {
  display: inline-block;
  border-radius: 10px;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 25px;
  padding: 20px;
  width: 200px;

  transition: all 0.5s;
  cursor: grab;
  margin: 5px;
}
.botao {
  display: inline-block;
  border-radius: 10px;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 25px;
  padding: 20px;
  width: 200px;

  transition: all 0.5s;
  cursor: grab;
  margin: 5px;
}
.botoes {

  border-radius: 10px;

}


.help {
  cursor: help;
}
.button span {
  cursor: grab;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

.buttons span {
  cursor: grab;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.buttons span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.buttons:hover span {
  padding-right: 25px;
}

.buttons:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
    <button type="submit" class="button w3-block w3-padding-large  w3-margin-bottom efeito efeito-3" name="salvar"><i class="fa fa-check" style="vertical-align:middle"></i> <span> Confirmar</span></button>
      <script>
</script>


    </form>


  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>
</form>
</body>
</html>
