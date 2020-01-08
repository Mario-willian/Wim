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



//METAS
$result_estoques10 = "SELECT max(minutos) FROM metas";
$resultado_estoques10 = mysqli_query($conn, $result_estoques10);
$row_estoques10 = mysqli_fetch_assoc($resultado_estoques10);

$minutos = "";
$minutos = $row_estoques10['max(minutos)'];

$result_estoques11 = "SELECT * FROM metas where minutos = '$minutos'";
$resultado_estoques11 = mysqli_query($conn, $result_estoques11);
$row_estoques11 = mysqli_fetch_assoc($resultado_estoques11);
      //Valor das Metas
      $meta_total_mes_atual = $row_estoques11['total_atual'];
      $meta_total_mes_anterior = $row_estoques11['total_anterior'];
      $meta_abrigos_mes_atual = $row_estoques11['abrigo_atual'];
      $meta_abrigos_mes_anterior = $row_estoques11['abrigo_anterior'];
      $meta_instituicoes_mes_atual = $row_estoques11['instituicoes_atual'];
      $meta_instituicoes_mes_anterior = $row_estoques11['instituicoes_anterior'];


//Minutos do mes anterior
$minutos_do_mes_anterior = (date("Y") * 525600 + date("m") * 43800) - 43800;

//Minutos do mes atual
$minutos_do_mes_atual = date("Y") * 525600 + date("m") * 43800;



//Soma do dinheiro arrecadado no mes atual
$result_estoques2 = "SELECT sum(valor) FROM doacao where minutos > '$minutos_do_mes_atual'";
$resultado_estoques2 = mysqli_query($conn, $result_estoques2);
$row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);

//Soma do dinheiro arrecadado no mes anterior
$result_estoques3 = "SELECT sum(valor) FROM doacao where minutos between '$minutos_do_mes_anterior' and '$minutos_do_mes_atual'";
$resultado_estoques3 = mysqli_query($conn, $result_estoques3);
$row_estoques3 = mysqli_fetch_assoc($resultado_estoques3);

//Soma do dinheiro arrecadado PARA ABRIGOS no mes atual
$result_estoques4 = "SELECT sum(valor) FROM doacao where local_de_doacao = 'Abrigo' and minutos > '$minutos_do_mes_atual'";
$resultado_estoques4 = mysqli_query($conn, $result_estoques4);
$row_estoques4 = mysqli_fetch_assoc($resultado_estoques4);

//Soma do dinheiro arrecadado PARA ABRIGOS no mes anterior
$result_estoques5 = "SELECT sum(valor) FROM doacao where local_de_doacao = 'Abrigo' and minutos between '$minutos_do_mes_anterior' and '$minutos_do_mes_atual'";
$resultado_estoques5 = mysqli_query($conn, $result_estoques5);
$row_estoques5 = mysqli_fetch_assoc($resultado_estoques5);

//Soma do dinheiro arrecadado PARA INSTITUICOES no mes atual
$result_estoques6 = "SELECT sum(valor) FROM doacao where local_de_doacao = 'Instituicao' and minutos > '$minutos_do_mes_atual'";
$resultado_estoques6 = mysqli_query($conn, $result_estoques6);
$row_estoques6 = mysqli_fetch_assoc($resultado_estoques6);

//Soma do dinheiro arrecadado PARA INSTITUICOES no mes anterior
$result_estoques7 = "SELECT sum(valor) FROM doacao where local_de_doacao = 'Instituicao' and minutos between '$minutos_do_mes_anterior' and '$minutos_do_mes_atual'";
$resultado_estoques7 = mysqli_query($conn, $result_estoques7);
$row_estoques7 = mysqli_fetch_assoc($resultado_estoques7);

//Soma do dinheiro arrecadado no geral
$result_estoques8 = "SELECT sum(valor) FROM doacao where minutos < '$minutos_do_mes_atual'";
$resultado_estoques8 = mysqli_query($conn, $result_estoques8);
$row_estoques8 = mysqli_fetch_assoc($resultado_estoques8);

//Quantidade de notificacoes
$result_estoques9 = "SELECT count(ativo) FROM notificacao where usuario_cpf = '$login' and ativo = 's'";
$resultado_estoques9 = mysqli_query($conn, $result_estoques9);
$row_estoques9 = mysqli_fetch_assoc($resultado_estoques9);

require_once "compartilhamento.php";

$compartilhar = new Compartilhamentos();

if (isset($_GET['compartilhar'])){
    $compartilhar->inserir();
    header("location:acompanhar.php");
}
?>

<!DOCTYPE html>
<html>
<title>WIM | Acompanhar</title>
<meta charset="UTF-8">

  <link rel="shortcut icon" href="imagens/loguei.png">
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
<br>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4"><br>
      <img src="imagens/img.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar"><br>
      <span>Bem Vindo, <strong><?php echo $row_estoques['nome'];?></strong></span><br>
      <a class="w3-bar-item w3-btn" href="notificacao.php"><i class="fa fa-bell fa-fw"></i><span class="badge badge-light"><?php echo $row_estoques9['count(ativo)']; ?></span></a>
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
        <a class="w3-bar-item w3-btn w3-padding  " href="troca.php"><i class="fa fa-exchange"></i> Trocas</a>

    <a class="w3-bar-item w3-btn w3-padding w3-blue" href="acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-btn w3-padding" href="doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-btn w3-padding" href="total.php"><i class="fa fa-line-chart"></i> Total</a>
    <a class="w3-bar-item w3-btn w3-padding" href="info.php"><i class="fa fa-paperclip"></i> Informações</a>
    <a class="w3-bar-item w3-btn w3-padding" href="historico.php"><i class="fa fa-calendar-check-o"></i> Histórico</a>
    <a class="w3-bar-item w3-btn w3-padding" href="config.php"><i class="fa fa-cog fa-fw"></i> Configurações</a>
    <a href="sair.php" class="w3-bar-item w3-btn w3-padding"><i class="fa fa-arrow-left"></i> Sair</a><br><br>
  </div>
</nav>
<style >
  .header {
  position: fixed;
  top: 0;
  z-index: 1;
  width: 100%;
  background-color: #f1f1f1;
}

.header h2 {
  text-align: center;
}

.progress-container {
  width: 100%;
  height: 8px;
  background: #ccc;
}

.progress-bar {
  height: 8px;
  background: #4caf50;
  width: 0%;
}

.content {
  padding: 100px 0;
  margin: 50px auto 0 auto;
  width: 80%;
}
</style>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Fechar Menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h2><b><i class="fa fa-eye fa-fw"></i> Acompanhar</b></h2>
    <p style="display:none"><?php echo "Mes Anterior: ".$minutos_do_mes_anterior."<br>";
    echo "AGR: ".$minutos_ate_agora = (date("Y") * 525600 + date("m") * 43800 + date("d") * 1440) + date('H')*60 + date('i');;
     ?></p>
  </header>
  <div class="header">
  <h2>Scroll Indicator</h2>
  <div class="progress-container">
    <div class="progress-bar" id="myBar"></div>
  </div>  
</div>
 <div class="w3-container"><BR>

 <CENTER>   <h4><b>DINHEIRO TOTAL ARRECADADO</h4></b></CENTER>
    <H5><I>Mês atual</H5></I>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:<?php 
      $continha = ($row_estoques2['sum(valor)'] / $meta_total_mes_atual) * 100;
      if ($continha > 100) {
        echo "100";
      }else{
        echo $continha;
      }
            ?>%">R$ 
        <?php if ($row_estoques2['sum(valor)'] == 0) {
          echo "0.00";
        }else{
      echo $row_estoques2['sum(valor)'];
      }?></div>
    </div><BR>
  <H5><I>Último mês</H5></I>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:<?php 
      $continha = ($row_estoques3['sum(valor)'] / $meta_total_mes_anterior) * 100;
      if ($continha > 100) {
        echo "100";
      }else{
        echo $continha;
      }
            ?>%">R$ 
        <?php if ($row_estoques3['sum(valor)'] == 0) {
          echo "0.00";
        }else{
      echo $row_estoques3['sum(valor)'];
      }?></div>

  </div><br><center><h4><b>DINHEIRO ARRECADADO PARA ABRIGOS</h4></b></center>

       <H5><I>Mês atual</H5></I>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-brown" style="width:<?php 
      $continha = ($row_estoques4['sum(valor)'] / $meta_abrigos_mes_atual) * 100;
      if ($continha > 100) {
        echo "100";
      }else{
        echo $continha;
      }
            ?>%">R$ 
        <?php if ($row_estoques4['sum(valor)'] == 0) {
          echo "0.00";
        }else{
      echo $row_estoques4['sum(valor)'];
      }?></div>
    </div><BR>

     <H5><I>Último mês</H5></I>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-yellow" style="width:<?php 
      $continha = ($row_estoques5['sum(valor)'] / $meta_abrigos_mes_anterior) * 100;
      if ($continha > 100) {
        echo "100";
      }else{
        echo $continha;
      }
            ?>%">R$ 
        <?php if ($row_estoques5['sum(valor)'] == 0) {
          echo "0.00";
        }else{
      echo $row_estoques5['sum(valor)'];
      }?></div>
    </div><br>

    <center><h4><b>DINHEIRO TOTAL ARRECADADO PARA ONG</h4></b></center>
     <H5><I>Mês atual</H5></I>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-pink" style="width:<?php 
      $continha = ($row_estoques6['sum(valor)'] / $meta_instituicoes_mes_atual) * 100;
      if ($continha > 100) {
        echo "100";
      }else{
        echo $continha;
      }
            ?>%">R$ 
        <?php if ($row_estoques6['sum(valor)'] == 0) {
          echo "0.00";
        }else{
      echo $row_estoques6['sum(valor)'];
      }?></div>
    </div><br>

   <H5><I>Último mês</H5></I>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-blue" style="width:<?php 
      $continha = ($row_estoques7['sum(valor)'] / $meta_instituicoes_mes_anterior) * 100;
      if ($continha > 100) {
        echo "100";
      }else{
        echo $continha;
      }
            ?>%">R$ 
        <?php if ($row_estoques7['sum(valor)'] == 0) {
          echo "0.00";
        }else{
      echo $row_estoques7['sum(valor)'];
      }?></div>
    </div><br>
     <center><h4><b>TEMPO PARA LIBERAMENTO DO SAQUE</h4><b><hr><center>
<h2 style="color: #009933" id="demo"></h2>


<script>
// Set the date we're counting down to
var countDownDate = new Date("May 1, 2019 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
</center><hr>
    <br>
      <h4><b>MÍDIA</h4><b>
    <h5>Nos acompanhe pela rede social <b><I>Instagram</I></b> para saber de tudo que está acontecendo.<b> Gmail</b> para entrar em contato profissinal conosco.<b> Compartilhe,</b> juntos vamos melhorar o mundo.</h5><hr>
<div class="w3-container w3-content w3-center" style="max-width:800px" id="band">
    <div class="w3-row ">
      <div class="w3-third">
        <p>INSTAGRAM<br> wim.oficial</p>
        <a href="https://www.instagram.com/wim.oficial/" target="blank"><img src="imagens/insta.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:50px"></a>
      </div>
      <div class="w3-third">
        <p>E-MAIL<br> companywim@gmail.com</p>
        <a href="mailto:companywim@gmail.com"><img src="imagens/gmail.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:50px"></a>
      </div>
      <div class="w3-third">
        <p>COMPARTILHAR<br>
        whatsapp</p>
              <form action="acompanhar.php" method="get">
            <input type="" name="mins" style="display:none" value="<?php echo $minutos_ate_agora = (date("Y") * 525600 + date("m") * 43800 + date("d") * 1440) + date('H')*60 + date('i');;?>">
            <input class="w3-input w3-border" style="display:none" name="cpf" type="text" value="<?php echo $row_estoques['cpf'];?>" >
            <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >



              <button class="btn btn-link" name="compartilhar" onclick="window.open('https://api.whatsapp.com/send?text=Acesse: - https://wimoficial.com.br e comece a ganhar dinheiro agora! Você pode transferir seu dinheiro para sua conta bancária, doa-lo ou até mesmo trocar por diferentes tipos de gift card. O que está esperando?', 'segundajanela', 'toolbar,menubar,scrollbars,resizable,directories,status,location,copyhistory,width=800,height=600,');" ><img src="imagens/cp.png" class="w3-round" alt="Random Name" style="width:50px"></button><br><br>

    </form>
        
      </div>
    </div>
  </div>
<hr>
<br>
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
<script>
// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

function myFunction() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBar").style.width = scrolled + "%";
}
</script>
</body>
</html>
