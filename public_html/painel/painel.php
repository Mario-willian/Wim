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

//Total de dinheiro doado
$result_estoques2 = "SELECT sum(valor) FROM doacao";
$resultado_estoques2 = mysqli_query($conn, $result_estoques2);
$row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);

//Novo usuário
$result_estoques3 = "SELECT max(minutos) FROM usuario;";
$resultado_estoques3 = mysqli_query($conn, $result_estoques3);
$row_estoques3 = mysqli_fetch_assoc($resultado_estoques3);

//Nova Doação
$result_estoques4 = "SELECT max(minutos) FROM doacao;";
$resultado_estoques4 = mysqli_query($conn, $result_estoques4);
$row_estoques4 = mysqli_fetch_assoc($resultado_estoques4);

//Total de Compartilhamento
$result_estoques5 = "SELECT sum(quantidade) FROM compartilhamento;";
$resultado_estoques5 = mysqli_query($conn, $result_estoques5);
$row_estoques5 = mysqli_fetch_assoc($resultado_estoques5);

//Novo Compartilhamento
$result_estoques6 = "SELECT max(minutos) FROM compartilhamento;";
$resultado_estoques6 = mysqli_query($conn, $result_estoques6);
$row_estoques6 = mysqli_fetch_assoc($resultado_estoques6);

//Propagandas assistidas
$result_estoques11 = "SELECT count(codigo) FROM propaganda;";
$resultado_estoques11 = mysqli_query($conn, $result_estoques11);
$row_estoques11 = mysqli_fetch_assoc($resultado_estoques11);

//Novo saque
$result_estoques14 = "SELECT max(minutos) FROM saque;";
$resultado_estoques14 = mysqli_query($conn, $result_estoques14);
$row_estoques14 = mysqli_fetch_assoc($resultado_estoques14);




//Minutos do mes anterior
$minutos_do_mes_anterior = (date("Y") * 525600 + date("m") * 43800) - 43800;

//Minutos do mes atual
$minutos_do_mes_atual = date("Y") * 525600 + date("m") * 43800;

//TESTE
$minutos_ate_agora = (date("Y") * 525600 + date("m") * 43800 + date("d") * 1440) + date('H')*60 + date('i');

//Quantidade de novos Usuarios do mes anterior
$result_estoques7 = "SELECT count(cpf) FROM usuario where minutos between '$minutos_do_mes_anterior' and '$minutos_do_mes_atual'";
$resultado_estoques7 = mysqli_query($conn, $result_estoques7);
$row_estoques7 = mysqli_fetch_assoc($resultado_estoques7);

//Quantidade de novos Usuarios do mes atual
$result_estoques8 = "SELECT count(cpf) FROM usuario where minutos > '$minutos_do_mes_atual'";
$resultado_estoques8 = mysqli_query($conn, $result_estoques8);
$row_estoques8 = mysqli_fetch_assoc($resultado_estoques8);

//Quantidade total Usuarios dos meses anteriores
$result_estoques9 = "SELECT count(cpf) FROM usuario where minutos < '$minutos_do_mes_atual'";
$resultado_estoques9 = mysqli_query($conn, $result_estoques9);
$row_estoques9 = mysqli_fetch_assoc($resultado_estoques9);

//Quantidade de notificacoes
$result_estoques10 = "SELECT count(ativo) FROM notificacao where usuario_cpf = '$login' and ativo = 's'";
$resultado_estoques10 = mysqli_query($conn, $result_estoques10);
$row_estoques10 = mysqli_fetch_assoc($resultado_estoques10);

//Quantidade total de usuários cadastrados
$result_estoques13 = "SELECT count(cpf) FROM usuario";
$resultado_estoques13 = mysqli_query($conn, $result_estoques13);
$row_estoques13 = mysqli_fetch_assoc($resultado_estoques13);

//Compartilhamento
require_once "compartilhamento.php";
$compartilhar = new Compartilhamentos();
if (isset($_GET['compartilhar'])){
    $compartilhar->inserir();
    header("location:painel.php");
}
?>

<!DOCTYPE html>
<html>
<title>WIM | Painel</title>
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
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

.callout {
  position: fixed;
  bottom: 35px;
  right: 20px;
  margin-left: 20px;
  max-width: 300px;
}

.callout-header {
  padding: 25px 15px;
  background: #0099ff;
  font-size: 30px;
  color: white;
}

.callout-container {
  padding: 15px;
  background-color: white;
  color: black
}

.closebtn {
  position: absolute;
  top: 5px;
  right: 15px;
  color: white;
  font-size: 30px;
  cursor: pointer;
}

.closebtn:hover {
  color: black;

}
</style>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}
</style>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>

<style>
body {font-family: Arial, Helvetica, sans-serif;}

.callout {
  position: fixed;
  bottom: 35px;
  right: 20px;
  margin-left: 20px;
  max-width: 300px;
}

.callout-header {
  padding: 25px 15px;
  background: #0099ff;
  font-size: 30px;
  color: white;
}

.callout-container {
  padding: 15px;
  background-color: white;
  color: black
}

.closebtn {
  position: absolute;
  top: 5px;
  right: 15px;
  color: white;
  font-size: 30px;
  cursor: pointer;
}

.closebtn:hover {
  color: black;

}
</style>
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
<body class="w3-light-grey" onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
  <script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 2000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
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

<div>
<div class="callout">
        <form action="painel.php" method="get">
        <input type="" name="mins" style="display:none" value="<?php echo $minutos_ate_agora = (date("Y") * 525600 + date("m") * 43800 + date("d") * 1440) + date('H')*60 + date('i');;?>">
        <input class="w3-input w3-border" style="display:none" name="cpf" type="text" value="<?php echo $row_estoques['cpf'];?>" >
        <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >


  <div class="callout-header">Compartilhe</div>
  <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
  <div class="callout-container">
    <p>Obrigado por usar nossa plataforma. <button style="border-radius: 50%" class="btn btn-outline-info" name="compartilhar" onclick="window.open('https://api.whatsapp.com/send?text=Acesse: - https://wimoficial.com.br e comece a ganhar dinheiro agora! Você pode transferir seu dinheiro para sua conta bancária, doa-lo ou até mesmo trocar por diferentes tipos de gift card. O que está esperando?', 'segundajanela', 'toolbar,menubar,scrollbars,resizable,directories,status,location,copyhistory,width=800,height=600,');" class="fa fa-share-alt"><i class="fa fa-share-alt"></i></button> Compartilhe para que o valor a ser recebido nas propagandas seja maior.</p></form>

  </div>
</div>
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
      <span>Bem Vindo<strong>, <?php echo $row_estoques['nome'];?></strong></span><br>
      <a class="w3-bar-item w3-btn" href="notificacao.php"><i class="fa fa-bell fa-fw"></i><span class="badge badge-light"><?php echo $row_estoques10['count(ativo)'] ?></span></a>
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
    <a class="w3-bar-item w3-btn w3-padding w3-blue" href="painel.php"><i class="fa fa-desktop"></i> Painel Inicial</a>
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

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h2><b><i class="fa fa-desktop"></i> Painel</b></h2>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-money w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo "R$ ".$row_estoques2['sum(valor)'];?></h3>
        </div>
        <div class="w3-clear"></div>
        <h5>Total de Dinheiro Doado</h5>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-star w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $row_estoques11['count(codigo)'];?></h3>
        </div>
        <div class="w3-clear"></div>
        <h5>Propagandas Assistidas</h5>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $row_estoques13['count(cpf)'];?></h3>
        </div>
        <div class="w3-clear"></div>
        <h5>Usuários Cadastrados</h5>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $row_estoques5['sum(quantidade)'];?></h3>
        </div>
        <div class="w3-clear"></div>
        <h5>Compartilhações</h5>
      </div>
    </div>
  </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h3><b>Regiões</h3></b>
        <img src="imagens/mapa.png" style="width:100%" alt="Google Regional Map">
      </div>
      <div class="w3-twothird">
        <h3><b>Movimentação</h3></b>
        <table class="w3-table w3-striped w3-white">
   
          <tr>
            <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
            <td>Novos usuários</td>
            <td><i><?php 
            date_default_timezone_set('America/Sao_Paulo');

            //AGORA
            $data_min_agora = date("Y") * 525600 + date("m") * 43800 + date("d") * 1440;
            $minutos_agora = date('H')*60 + date('i');
            $minutos_geral_agora = $data_min_agora + $minutos_agora;

            //REGISTRO
            $ultima_registro = $row_estoques3['max(minutos)'];

            //IMPRESSÃO
            $ultimo_usuario = $minutos_geral_agora - $ultima_registro;
            if($ultimo_usuario >= 60){
              $ultimo_usuario = $ultimo_usuario / 60;

                if($ultimo_usuario >= 24){
                  $ultimo_usuario = $ultimo_usuario / 24;
                  echo number_format($ultimo_usuario,0)." d";
                }else{
                echo number_format($ultimo_usuario,0)." h";
                }

            }else{
              echo $ultimo_usuario." min";
            }
            
            ?></i></td>
          </tr>
         
          <tr>
            <td><i class="fa fa-handshake-o w3-text-red w3-large"></i></td>
            <td>Última Doação</td>
            <td><i><?php 
            date_default_timezone_set('America/Sao_Paulo');

            //AGORA
            $data_min_agora = date("Y") * 525600 + date("m") * 43800 + date("d") * 1440;
            $minutos_agora = date('H')*60 + date('i');
            $minutos_geral_agora = $data_min_agora + $minutos_agora;

            //REGISTRO
            $ultima_registro = $row_estoques4['max(minutos)'];

            //IMPRESSÃO
            $ultima_doacao = $minutos_geral_agora - $ultima_registro;
            if($ultima_doacao >= 60){
              $ultima_doacao = $ultima_doacao / 60;

                if($ultima_doacao >= 24){
                  $ultima_doacao = $ultima_doacao / 24;
                  echo number_format($ultima_doacao,0)." d";
                }else{
                echo number_format($ultima_doacao,0)." h";
                }

            }else{
              echo $ultima_doacao." min";
            }


            ?></i></td><br>
          </tr>
          <tr>
            <td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>
            <td>Últimas Compartilhações.</td>
            <td><i><?php 
            date_default_timezone_set('America/Sao_Paulo');

            //AGORA
            $data_min_agora = date("Y") * 525600 + date("m") * 43800 + date("d") * 1440;
            $minutos_agora = date('H')*60 + date('i');
            $minutos_geral_agora = $data_min_agora + $minutos_agora;

            //REGISTRO
            $ultima_registro = $row_estoques6['max(minutos)'];

            //IMPRESSÃO
            $ultimo_compartilhamento = $minutos_geral_agora - $ultima_registro;
            if($ultimo_compartilhamento >= 60){
              $ultimo_compartilhamento = $ultimo_compartilhamento / 60;

                if($ultimo_compartilhamento >= 24){
                  $ultimo_compartilhamento = $ultimo_compartilhamento / 24;
                  echo number_format($ultimo_compartilhamento,0)." d";
                }else{
                echo number_format($ultimo_compartilhamento,0)." h";
                }

            }else{
              echo $ultimo_compartilhamento." min";
            }
            ?></i></td>
                 <tr>
            <td><i class="fa fa-money w3-text-red w3-large"></i></td>
            <td>Último saque realizado.</td>
            <td><i><?php 
            date_default_timezone_set('America/Sao_Paulo');

            //AGORA
            $data_min_agora = date("Y") * 525600 + date("m") * 43800 + date("d") * 1440;
            $minutos_agora = date('H')*60 + date('i');
            $minutos_geral_agora = $data_min_agora + $minutos_agora;

            //REGISTRO
            $ultima_registro = $row_estoques14['max(minutos)'];

            //IMPRESSÃO
            $ultimo_compartilhamento = $minutos_geral_agora - $ultima_registro;
            if($ultimo_compartilhamento >= 60){
              $ultimo_compartilhamento = $ultimo_compartilhamento / 60;

                if($ultimo_compartilhamento >= 24){
                  $ultimo_compartilhamento = $ultimo_compartilhamento / 24;
                  echo number_format($ultimo_compartilhamento,0)." d";
                }else{
                echo number_format($ultimo_compartilhamento,0)." h";
                }

            }else{
              echo $ultimo_compartilhamento." min";
            }
            ?></i></td>
          </tr>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <hr>

  
</center>
<!-- ATUALIZANDO-->
  <!-- ATUALIZANDO-->
    <!-- ATUALIZANDO-->
      <!-- ATUALIZANDO-->
<center>
  <button class="btn btn-primary" disabled>
  <span class="spinner-grow spinner-grow-sm"></span>
  Atualizando..
</button>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <style type="text/css"> 
a:link 
{ 
text-decoration:none; 
} 
</style>
        <!-- ATUALIZANDO-->
      <!-- ATUALIZANDO-->
    <!-- ATUALIZANDO-->
  <!-- ATUALIZANDO-->

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">

  </footer>

  <!-- End page content -->
</div>
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
