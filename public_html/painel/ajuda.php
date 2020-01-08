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

require_once "actlogin.php";
$validar = new Login;
$compartilhar = new Compartilhamentos();

//botoes
if (isset($_GET['ajuda'])){
    header("location:info.php");
}
else if (isset($_GET['notificacao'])){
    header("location:notificacao.php");
}
else if (isset($_GET['editar'])){
    header("location:conta.php");
}
else if (isset($_GET['salvar'])){
    $validar->validar();
}
else if (isset($_GET['compartilhar'])){
    $compartilhar->inserir();
    header("location:config.php");
}
?>

<!DOCTYPE html>
<html>
<title>WIM | Configurações</title>
<meta charset="UTF-8">
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
  <link rel="shortcut icon" href="imagens/loguei.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
  <span class="w3-bar-item w3-right"><img src="imagens/ww.png" style="width: 20px"> WIM</span>
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
      <a class="w3-bar-item w3-btn" href="conta.php"><i class="fa fa-address-card"></i></a>
      <a class="w3-bar-item w3-btn" href="config.php"><i class="fa fa-cog"></i></a>

    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Painel de Controle</h5>
  </div>
   <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> Fechar Menu</a>
    <a class="w3-bar-item w3-btn w3-padding" href="painel.php"><i class="fa fa-desktop"></i> Painel Inicial</a>
    <a class="w3-bar-item w3-btn w3-padding" href="carteira.php"><i class="fa fa-money"></i> Carteira</a>
        <a class="w3-bar-item w3-btn w3-padding" href="troca.php"><i class="fa fa-exchange"></i> Trocas</a>

    <a class="w3-bar-item w3-btn w3-padding" href="acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-btn w3-padding" href="doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-btn w3-padding" href="total.php"><i class="fa fa-line-chart"></i> Total</a>
    <a class="w3-bar-item w3-btn w3-padding" href="info.php"><i class="fa fa-paperclip"></i> Informações</a>
    <a class="w3-bar-item w3-btn w3-padding" href="historico.php"><i class="fa fa-calendar-check-o"></i> Histórico</a>
    <a class="w3-bar-item w3-btn w3-padding w3-blue" href="config.php"><i class="fa fa-cog fa-fw"></i> Configurações</a>
    <a href="sair.php" class="w3-bar-item w3-btn w3-padding"><i class="fa fa-arrow-left"></i> Sair</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Fechar Menu" id="myOverlay"></div>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h2><b><i class="fa fa-info-circle"></i> Ajuda</b></h2>

<div class="container">
  <h2>Dúvidas Frequentes</h2>
 
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">1. Quando eu vou receber o dinheiro solicitado?</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body"><h5>As transferências bancárias ocorrem uma vez por mês, entre os dias 05 a 10, caso você solicite o saque no dia 10 pode ser que demore até 7 dias úteis para receber em sua conta bancária.</h5></div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">2. Como funciona o sistema de trocas?</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body"><h5>Quando você prossegue com uma troca em nosso site, levamos até 10 dias úteis para enviar o código que compoêm o gift card, a WIM não entrega o gift card em seu endereço, apenas informa o código do gift card para você inserir dentro da plataforma no qual escolheu. O código será enviado via e-mail e também iremos notificar dentro da WIM, por isso é importante manter seus dados sempre atualizados.</h5></div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">3. O que significa transferências com o status pendente?</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body"><h5>A transferência com o status pendente significa que a WIM já foi informada que você deseja realizar o saque, que só ocorre entre os dias 05 a 10. Se o seu dinheiro já foi descontado da carteira, fique tranquilo que você vai recebe-lo em breve. Caso você tenha informado os dados de sua conta bancária incorretamente, a WIM não se responsabilizará.</h5></div>
      </div>
    </div>
  </div> 
</div>
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
<!--DO BOTAO EXCLUIR-->





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

</body>
</html>
