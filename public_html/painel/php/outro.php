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
      header("location:../../index.php");
    }
}else{
  header("location:../../index.php");
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

//botoes
if (isset($_GET['voltar'])){
    header("location:../carteira.php");
}
?>

<!DOCTYPE html>
<html>
<title>WIM | Doação</title>
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
  <meta name="description" content="Create modal windows that can be morphed from anything with jQuery Adaptive Modal plugin by Pete Rojwongsuriya" />

  <link href='http://fonts.googleapis.com/css?family=Noto+Serif:400italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="jquery.adaptive-modal.js"></script>
  <link href='adaptive-modal.css' rel='stylesheet' type='text/css'>
  <style>
    html {
      height: 100%;
    }
    body {
      background: #fff;
      padding: 0;
      text-align: center;
      font-family: 'Open Sans';
      position: relative;
      margin: 0;
      height: 100%;
      -webkit-font-smoothing: antialiased;
      text-rendering: optimizelegibility;
    }
    
    a {
      color: black;
    }
    
    .header {
      padding: 30px 0 0;
      float: left;
      width: 100%;
      background: white;
    }
    
    .wrapper {
      height: auto !important;
      height: 100%;
      margin: 0 auto; 
      overflow: hidden;
    }
    
    a {
      text-decoration: none;
    }
    
    
    h1, h2 {
      width: 100%;
      float: left;
    }
    h1 {
      margin-top: 100px;
      color: #999;
      margin-bottom: 5px;
      font-size: 70px;
      font-weight: 100;
    }
    h2 {
      padding: 00px 20px 30px 20px;
      box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      letter-spacing: 0px;
      color: #888;
      font-size: 20px;
      line-height: 160%;
      font-weight: 100;
      margin-top: 10px;
      margin-bottom: 0;
    }
    
    
    .pointer {
      color: #00B0FF;
      font-family: 'Pacifico';
      font-size: 24px;
      margin-top: 15px;
      position: absolute;
      top: 130px;
      right: -40px;
    }
    .pointer2 {
      color: #00B0FF;
      font-family: 'Pacifico';
      font-size: 24px;
      margin-top: 15px;
      position: absolute;
      top: 130px;
      left: -40px;
    }
    pre {
      margin: 80px auto;
    }
    pre code {
      padding: 35px;
      border-radius: 5px;
      font-size: 15px;
      background: rgba(0,0,0,0.1);
      border: rgba(0,0,0,0.05) 5px solid;
      max-width: 500px;
    }


    .main {
      float: left;
      width: 100%;
      margin: 0 auto;
    }
    
    
    .main h1 {
      padding:20px 50px 10px;
      float: left;
      width: 100%;
      font-size: 60px;
      box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      font-weight: 100;
      margin: 0;
      padding-top: 25px;
      font-family: 'Open Sans';
      letter-spacing: -1px;
      text-transform: capitalize;
    }
   
    .main h1.demo1 {
      background: #1ABC9C;
    }
    
    .reload.bell {
      font-size: 12px;
      padding: 20px;
      width: 45px;
      text-align: center;
      height: 47px;
      border-radius: 50px;
      -webkit-border-radius: 50px;
      -moz-border-radius: 50px;
    }
    
    .reload.bell #notification {
      font-size: 25px;
      line-height: 140%;
    }
    .btn.btn-outline {
      border: DodgerBlue 2px solid;
      background: none;
      color: DodgerBlue;
    }
    .btn.btn-outline:hover {
      border: DodgerBlue 2px solid;
      background: DodgerBlue;
      color: #fff;
    }

 
    .btn {
      width: 150px;
      height: 100px;
    }
    .clear {
      width: auto;
    }
    .btn:hover, .btn:hover {
      background: #317af2;
    }
    .btns {
      margin: 50px auto;
    }
    .credit {
      text-align: center;
      color: #888;
      padding: 10px 10px;
      margin: 0 0 0 0;
      float: left;
      width: 100%;
    }
    .credit a {
      text-decoration: none;
      font-weight: bold;
      color: black;
    }
    
    .back {
      position: absolute;
      top: 0;
      left: 0;
      text-align: center;
      display: block;
      padding: 7px;
      width: 100%;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      background:#f5f5f5;
      font-weight: bold;
      font-size: 13px;
      color: #888;
      -webkit-transition: all 200ms ease-out;
      -moz-transition: all 200ms ease-out;
      -o-transition: all 200ms ease-out;
      transition: all 200ms ease-out;
    }
    .back:hover {
      background: #eee;
    }
  
    .container {
      width: 980px;
      margin: 0 auto;
      overflow: hidden;
    }
    
    .page-container {
      float: left;
      width: 100%;
      margin: 0 auto 300px;
      position: relative;
    }
    
    .header {
      overflow: hidden;
      clear: both;
    }
    
    .bg {
      position: absolute;
      min-height: 100% !important;
      width: 100%;
      z-index: 0;
    }
    
    .ibg-bg {
      position: absolute;
    }
    #btns {
      text-align: center;
      margin: 50px auto;
      height: 50px;
      overflow: hidden;
      float: left;
      width: 100%;
    }
    
    
    .main {
      position: relative;
    }
    
    .newmain {
      margin-top: 35px;
      color: #666;
      font-size: 14px;
    }
    .newmain p a {
      display: inline-block;
      border-radius: 3px;
      padding: 3px 5px;
      color: white;
      font-weight: bold;
    }
    
    .newmain p a.custom {
      background: #5DC9E6;
    }
    
    body .am-expanded.am-modal.modal1 {
      width: 400px;
      margin-left: -200px;
    }

    body .am-expanded.am-modal.modal1 .am-expanded.am-back {
      width: 400px;
      border-radius: 5px;
    }
    body .am-expanded.am-modal.modal3 {
      width: 640px;
      margin-left: -320px;
    }
    
    body .am-expanded.am-modal.modal3 .am-modal-content {
      padding: 15px;
    }

    body .am-expanded.am-modal.modal3 .am-expanded.am-back {
      width: 640px;
      padding: 0;
      border-radius: 5px;
    }
    .newmain p a.am-remote-link {
      background: #F8C864;
      color: fff;
    }
    .am-modal-content {
      color: white;
      padding: 25px;
      box-sizing: border-box;
    }
    .am-modal-content h1 {
      font-size: 64px;
      margin-top: 0;
      font-family: 'Grand Hotel', cursive;
      color: white;
    }
    
    .am-modal-content form input{
      background: rgba(255,255,255,0.25);
      border: none;
      margin-bottom: 10px;
      padding: 10px;
      font-size: 16px;
      color: black;
      border-radius: 3px;
    }
    .am-modal-content form .btns{
      margin: 10px auto;
    }
    
    .am-modal-content form a{
      font-weight: bold;
      letter-spacing: 1px;
      text-transform: uppercase;
      font-size: 12px;
      text-align: center;
      color: white;
      border: 2px solid white;
      border-radius: 3px;
      display: inline-block;
      padding: 10px 15px;
    }

  </style>
  <script>
    $(document).ready(function(){
      $(".am-remote-link").adaptiveModal({
        success: function(data) {
          $.each( data.shots, function( i, item ) {
            $( "<img/>" ).attr( "src", item.image_teaser_url ).prependTo( $(".am-remote") );
            if ( i === 55 ) {
              return false;
            }
          });
        }
      });
    });
    
  </script>
<meta charset="UTF-8">
  <link rel="shortcut icon" href="imagens/loguei.png">
  <style>


.marca{
  float: left;
  margin-left: 50px;
  margin-top: 20px;
}



h1.subtitulo-1{
  text-align: center;
  margin-bottom: 30px;
  color: #555;
  font-family: 'Lato', sans-serif;
  font-size: 50px;
}

.area-mini{
  width: 170px;
  height: 230px;
  margin-top: 50px;
  margin-left: 29px;
  float: left;
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
<div class="w3-bar w3-top w3-orange w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right" style="color: white"><img src="../imagens/ww.png" style="width: 20px"> WIM</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="imagens/img.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Bem Vindo, <strong><?php echo $row_estoques['nome'];?></strong></span><br>
      <a class="w3-bar-item w3-button" href="../notificacao.php"><i class="fa fa-bell fa-fw"></i><span class="badge badge-light"><?php echo $row_estoques2['count(ativo)'] ?></span></a>
      <a class="w3-bar-item w3-button" href="../conta.php"><i class="fa fa-address-card"></i></a>
      <a class="w3-bar-item w3-button" href="../config.php"><i class="fa fa-cog"></i></a>

    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Painel de Controle</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> Fechar Menu</a>
    <a class="w3-bar-item w3-button w3-padding" href="../painel.php"><i class="fa fa-desktop"></i> Painel Inicial</a>
    <a class="w3-bar-item w3-button w3-padding" href="../carteira.php"><i class="fa fa-money"></i> Carteira</a>
    <a class="w3-bar-item w3-button w3-padding" href="../acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-button w3-padding w3-blue" href="../doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-button w3-padding" href="../total.php"><i class="fa fa-line-chart"></i> Total</a>
    <a class="w3-bar-item w3-button w3-padding" href="../info.php"><i class="fa fa-paperclip"></i> Informações</a>
    <a class="w3-bar-item w3-button w3-padding" href="../historico.php"><img src="../imagens/ab.png" style="width: 18px"> Histórico</a>
    <a class="w3-bar-item w3-button w3-padding" href="../config.php"><i class="fa fa-cog fa-fw"></i> Configurações</a>
    <a href="../sair.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-arrow-left"></i> Sair</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Fechar Menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h2><b><i class="fa fa-handshake-o"></i> Doação</b></h2>
     <CENTER><h3><b><i class="  fa fa-info-circle" style="color: Dodgerblue"></i> Escolha a categoria que deseja doar.</b></h3></CENTER>
<div class="area-mini">
  <center>
  <div class="container">     
            <a href="#" data-toggle="adaptive-modal" data-title="<h1>Olá,</h1><p> Para prosseguir com sua doação é necessário enviar o livro para a nossa <b>caixa postal: 0000.</b><br> Você pode optar em nós irmos buscar a sua doação, para isso, entre em contato pelo nosso<br> <b> e-mail: companywim@gmail.com</b> ou pela nossa rede social <b>instagram: @wim.oficial.</b><br> Requisitos para irmos buscar sua doação: Morar em Minas Gerais (MG) e pagar um valor total de R$ 10,00 reais.</p>" class="btn btn-outline"><img src="../imagens/cc.png" style="width: 80px"></a>
          </div><bR>
            <H3>LIVROS</H3>
             
  </center>

</div>
<div class="area-mini">
  <center>
  <div class="container">     
            <a href="#" data-toggle="adaptive-modal" data-title="<h1>Olá,</h1><p> Para prosseguir com sua doação 
              vale lembrar que é importante seu vestuário estar em possíveis condições de uso e é necessário enviar para a nossa <b>caixa postal: 0000.</b><br> Você pode optar em nós irmos buscar a sua doação, para isso, entre em contato pelo nosso<br> <b> e-mail: companywim@gmail.com</b> ou pela nossa rede social <b>instagram: @wim.oficial.</b><br> Requisitos para irmos buscar sua doação: Morar em Minas Gerais (MG) e pagar um valor total de R$ 10,00 reais.</p>" class="btn btn-outline"><img src="../imagens/dd.png" style="width: 80px"></a>
          </div><bR>
            <H3>VESTUÁRIO</H3>
  </center>
</div>
  <div class="area-mini">
     <center>
  <div class="container">     
            <a href="#" data-toggle="adaptive-modal" data-title="<h1>Olá,</h1><p> Para prosseguir com sua doação vale lembrar que só recebemos alimentos não-pereciveis e é necessário enviar para a nossa <b>caixa postal: 0000.</b><br> Você pode optar em nós irmos buscar a sua doação, para isso, entre em contato pelo nosso<br> <b> e-mail: companywim@gmail.com</b> ou pela nossa rede social <b>instagram: @wim.oficial.</b><br> Requisitos para irmos buscar sua doação: Morar em Minas Gerais (MG) e pagar um valor total de R$ 10,00 reais.</p>" class="btn btn-outline"><img src="../imagens/bb.png" style="width: 80px"></a>
          </div><bR>
            <H3>ALIMENTOS</H3>
  </center>
</div>
  <div class="area-mini">
     <center>
  <div class="container">     
            <a href="#" data-toggle="adaptive-modal" data-title="<h1>Olá,</h1><p> Para prosseguir com sua doação vale lembrar que é importante o material estar em condições de uso e é necessário enviar para a nossa <b>caixa postal: 0000.</b><br> Você pode optar em nós irmos buscar a sua doação, para isso, entre em contato pelo nosso<br> <b> e-mail: companywim@gmail.com</b> ou pela nossa rede social <b>instagram: @wim.oficial.</b><br> Requisitos para irmos buscar sua doação: Morar em Minas Gerais (MG) e pagar um valor total de R$ 10,00 reais.</p>" class="btn btn-outline"><img src="../imagens/ee.png" style="width: 80px"></a>
          </div><bR>
            <H3>MATERIAL ESCOLAR</H3>
  </center>
</div>
  <div class="area-mini">
   <center>
  <div class="container">     
            <a href="#" data-toggle="adaptive-modal" data-title="<h1>Olá,</h1><p> Para prosseguir com sua doação  é necessário enviar para a nossa <b>caixa postal: 0000.</b><br></p>" class="btn btn-outline"><img src="../imagens/aa.png" style="width: 80px"></a>
          </div><bR>
            <H3>OUTROS</H3>
  </center>
</div>
 </header>
</div>
</form>
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
