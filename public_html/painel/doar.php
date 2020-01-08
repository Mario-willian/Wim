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

//puxar codigo da carteira
$result_estoquess = "SELECT * FROM carteira where usuario_cpf = '$login'";
$resultado_estoquess = mysqli_query($conn, $result_estoquess);
$row_estoquess = mysqli_fetch_assoc($resultado_estoquess);

//Quantidade de notificacoes
$result_estoques2 = "SELECT count(ativo) FROM notificacao where usuario_cpf = '$login' and ativo = 's'";
$resultado_estoques2 = mysqli_query($conn, $result_estoques2);
$row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);

require_once "doacoes.php";
$doacao = new Doacoes();

//botoes
if (isset($_GET['doar'])){
    $doacao->inserir();
    header("location:php/doar.php");
}
else if (isset($_GET['outro'])){
    header("location:php/outro.php");
}
?>

<!DOCTYPE html>
<html>
<title>WIM | Doar</title>
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
<meta charset="UTF-8">
  <link rel="shortcut icon" href="imagens/loguei.png">
  <style>
::placeholder {
    color: #0099ff;
    opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color: #0099ff;
}

::-ms-input-placeholder { /* Microsoft Edge */
   color: #0099ff;
}
</style>
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
    <a href="#" class="w3-bar-item w3-btn w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> Fechar Menu</a>
    <a class="w3-bar-item w3-btn w3-padding" href="painel.php"><i class="fa fa-desktop"></i> Painel Inicial</a>
    <a class="w3-bar-item w3-btn w3-padding" href="carteira.php"><i class="fa fa-money"></i> Carteira</a>
        <a class="w3-bar-item w3-btn w3-padding" href="troca.php"><i class="fa fa-exchange"></i> Trocas</a>

    <a class="w3-bar-item w3-btn w3-padding" href="acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-btn w3-padding w3-blue" href="doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-btn w3-padding" href="total.php"><i class="fa fa-line-chart"></i> Total</a>
    <a class="w3-bar-item w3-btn w3-padding" href="info.php"><i class="fa fa-paperclip"></i> Informações</a>
    <a class="w3-bar-item w3-btn w3-padding" href="historico.php"><i class="fa fa-calendar-check-o"></i> Histórico</a>
    <a class="w3-bar-item w3-btn w3-padding" href="config.php"><i class="fa fa-cog fa-fw"></i> Configurações</a>
    <a href="sair.php" class="w3-bar-item w3-btn w3-padding"><i class="fa fa-arrow-left"></i> Sair</a><br><br>
  </div>
</nav>
<style type="text/css"> 
a:link 
{ 
text-decoration:none; 
} 

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
  textarea {
  width: 100%;
  border: 2px solid #aaa;
  border-radius: 4px;
  margin: 8px 0;
  outline: none;
  padding: 8px;
  box-sizing: border-box;
  transition: 0.3s;
}
 input[type="number"] {
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
textarea:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="number"] {
  padding-left: 50px;
}
.inputWithIcon textarea {
  padding-left: 40px;
}
input[type="number"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}
input[type="email"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="text"] {
  padding-left: 40px;
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
  top: 3px;
  padding: 9px 8px;
  color: #aaa;
  transition: 0.3s;
}

.inputWithIcon input[type="text"]:focus + i {
  color: dodgerBlue;
}
.inputWithIcon textarea:focus + i {
  color: dodgerBlue;
}
.inputWithIcon input[type="number"]:focus + i {
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
.inputWithIcon.inputIconBg textarea:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
.inputWithIcon.inputIconBg input[type="number"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
.inputWithIcon.inputIconBg input[type="email"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
  </style>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Fechar Menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h2><b><i class="fa fa-handshake-o"></i> Doar Dinheiro</b></h2>

  <form action="doar.php" method="get">
   <h3><b>Digite a quantia a ser doada</h3></b>

   <input  class="w3-input w3-border" style="display:none" name="usuario_cpf" type="text" value="<?php echo $row_estoques['cpf'];?>">
   <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >

   <!--Data-->
    <input type="date" style="display:none" value="<?php 
    $total = date("Y-m-d");
    echo $total?>" name="data">
<!--Hora-->
    <input type="time" style="display:none" value="<?php 
    date_default_timezone_set('America/Sao_Paulo');
    $total = date('H:i:s');
    echo $total?>" name="horario">

    
<!--Minutos-->
    <input type="text" style="display:none" value="<?php 
    date_default_timezone_set('America/Sao_Paulo');
    $data_min = date("Y") * 525600 + date("m") * 43800 + date("d") * 1440;
    $minutos = date('H')*60 + date('i');
    $minutos_geral = $data_min + $minutos;
    echo $minutos_geral?>" name="minutos">

   <input class="w3-input w3-border" style="display:none" name="carteira_codigo" type="text" value="<?php echo $row_estoquess['codigo'];?>" >

  <b><h5><div class="inputWithIcon"><input id="myInput" class="w3-input w3-border" name="valor" placeholder="Quantia mínima de R$ 1,00 real" min="1" max="<?php echo $row_estoquess['saldo']; ?>" type="number" required=""><i class="fa fa-money fa-lg fa-fw" aria-hidden="true" ></i></div><br></h5></b>

    <h3><b>Escolha aonde deseja doar</h3></b>
  <select name="local_de_doacao" class="w3-input w3-border custom-select-lg" required="">
    <option selected="" disabled="" value="Escolha uma opção">Escolha uma opção</option>
         <option value="Instituicao">ONG</option>
          <option value="Abrigo">ABRIGO</option>
      </select><br>
    <button type="submit" name="doar" class="btn btn-outline-success w3-block w3-padding-large  w3-margin-bottom"  onclick="myFunction()"><i class=" fa fa-handshake-o"></i> Doar</button><center>
    </form>
     <form action="doar.php" method="get">
      <input class="w3-input w3-border" style="display:none" name="usuario_cpf" type="text" value="<?php echo $row_estoques['cpf'];?>">
      <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >
          <button type="submit" name="outro" class="btn btn-outline-primary w3-block w3-padding-large  w3-margin-bottom" disabled=""  onclick="myFunction()"><i class="  fa fa-question-circle-o"></i> Outro tipo de doação</button></form>
          <center>

            <!--INICIO FORMULARIO BOTAO PAYPAL-->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="black">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" value="W5A35CWEXD5NG" />
<input  type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
<img alt="" border="0" src="https://www.paypal.com/pt_BR/i/scr/pixel.gif" width="1" height="1" />
</form>
<!-- FINAL FORMULARIO BOTAO PAYPAL -->
 
</center><hr>
<center>
    <center>    <h5 style="color: gray;"><i class=" fa fa-info-circle" style="color: Gray;"></i> Se você chegou até aqui, temos um objetivo em comum: melhorar vidas. E juntos, podemos fazer a diferença!</h5></b>
  <h5 style="color: gray;"><i class=" fa fa-info-circle" style="color: gray;"></i> Ao doar uma quantia de R$ 100,00 reais você poderá retirar um certificado de doador da wim na aba <a class="w3-bar-item w3-button" href="total.php"><i class="fa fa-line-chart"></i> Total</a></h5></b>
  <hr>


   <script>
// NOTIFICADOR
function myFunction() {

}
</script>




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
