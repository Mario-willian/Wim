<?php
header("Content-Type:Text/html; charset=utf8");

session_start();
include_once ("conexao.php");
//Evitar Bugs
if (!empty($_SESSION['usuario'])) {
  if(!empty($_SESSION['produto'])){

  $cargo = "";
  $cargo = $_SESSION['usuario']->cargo;
    //Verificando se é um ADM
    if ($cargo == "c") {
      $cmdzao = $_SESSION['usuario']->cmd;
    }else{
      header("location:../../index.php");
    }

  }else{
    header("location:../troca.php");
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

//puxar a carteira
$result_estoquess = "SELECT * FROM carteira where cmd = '$cmdzao'";
$resultado_estoquess = mysqli_query($conn, $result_estoquess);
$row_estoquess = mysqli_fetch_assoc($resultado_estoquess);

//Quantidade de notificacoes
$result_estoques2 = "SELECT count(ativo) FROM notificacao where usuario_cpf = '$login' and ativo = 's'";
$resultado_estoques2 = mysqli_query($conn, $result_estoques2);
$row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);


$nome = $row_estoques['nome'];

//Recuperar arquivo da classe
require_once "trocas.php";
//Criar um objeto do tipo cliente
$troca = new Trocas();

if (isset($_GET['confirmar'])){
    $troca->inserir();
    header("location:../troca.php");
}

?>
<!DOCTYPE html>
<html>
<title>WIM | Carteira</title>
<meta charset="UTF-8">
<link rel='shortcut icon' href='imagens/loguei.png'>
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
html,body,h1,h2,h3,h4,h5 {font-family: 'Raleway', sans-serif}
</style>"
<body class='w3-light-main'>
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
<div class='w3-bar w3-top w3-orange w3-large' style='z-index:4'>
  <button class='w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey' onclick='w3_open();'><i class='fa fa-bars'></i>  Menu</button>
  <span class='w3-bar-item w3-right' style="color: white"><img src='../imagens/ww.png' style='width: 20px'> WIM</span>
</div>

<!-- Sidebar/menu -->
<nav class='w3-sidebar w3-collapse w3-white w3-animate-left' style='z-index:3;width:300px;' id='mySidebar'><br><br>
  <div class='w3-container w3-row'>
    <div class='w3-col s4'>
      <img src='imagens/img.png' class='w3-circle w3-margin-right' style='width:46px'>
    </div>
    <div class='w3-col s8 w3-bar'>
      <span>Bem Vindo, <strong><?php echo $row_estoques['nome'];?></strong></span><br>
      <a class="w3-bar-item w3-btn" href="../notificacao.php"><i class="fa fa-bell fa-fw"></i><span class="badge badge-light"><?php echo $row_estoques2['count(ativo)'] ?></span></a>
      <a class="w3-bar-item w3-btn" href="../conta.php"><i class="fa fa-address-card"></i></a>
      <a class="w3-bar-item w3-btn" href="../config.php"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class='w3-container'>
    <h5>Painel de Controle</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-btn w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> Fechar Menu</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../painel.php"><i class="fa fa-desktop"></i> Painel Inicial</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../carteira.php"><i class="fa fa-money"></i> Carteira</a>
        <a class="w3-bar-item w3-btn w3-padding w3-blue" href="../troca.php"><i class="fa fa-exchange"></i> Trocas</a>

    <a class="w3-bar-item w3-btn w3-padding" href="../acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../total.php"><i class="fa fa-line-chart"></i> Total</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../info.php"><i class="fa fa-paperclip"></i> Informações</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../historico.php"><i class="fa fa-calendar-check-o"></i> Histórico</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../config.php"><i class="fa fa-cog fa-fw"></i> Configurações</a>
    <a href="../sair.php" class="w3-bar-item w3-btn w3-padding"><i class="fa fa-arrow-left"></i> Sair</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class='w3-overlay w3-hide-large w3-animate-opacity' onclick='w3_close()'' style='cursor:pointer' title='Fechar Menu' id='myOverlay'></div>

<!-- !PAGE CONTENT! -->
<div class='w3-main' style='margin-left:300px;margin-top:43px;'>
	<div class="container">
    <h2><b><i class="fa fa-exchange"></i> Troca</b></h2>
    
  <!-- Header -->
  <header class='w3-container' style='padding-top:22px'>

<center>

      <input class="w3-input w3-border" style="display:none" name="cpf" type="text" value="<?php echo $row_estoques['cpf'];?>">
      <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >

      <div class="card">

        <?php  
          if ($_SESSION['produto'] == "Gift Card Steam") {
            $valorp = "20";
          }else if($_SESSION['produto'] == "Gift Card Digital Netflix"){
            $valorp = "40";
          }else if($_SESSION['produto'] == "Gift Card Digital Uber"){
            $valorp = "50";
          }else if($_SESSION['produto'] == "Gift Card Digital Google Play"){
            $valorp = "30";
          }else if($_SESSION['produto'] == "Gift Card Digital Spotify"){
            $valorp = "17";
          }else if($_SESSION['produto'] == "Gift Card Digital Xbox Game Pass 1 Mês"){
            $valorp = "29";
          }else if($_SESSION['produto'] == "Gift Card Digital Riot League Of Legends"){
            $valorp = "20";
          }else if($_SESSION['produto'] == "Gift Card Digital Sony Playstation"){
            $valorp = "60";
          }
        ?>

  <h1><?php echo $_SESSION['produto'];?></h1>
  <H2 class="price" ><?php echo $valorp;?>,00</H2>
  <h4>E-mail cadastrado: <?php echo $row_estoques['email'];?></h4>
  <h4>Telefone cadastrado:  <?php echo $row_estoques['telefone'];?></h4>
  <p style="color: green"><i class="fa fa-check"></i> Este item está disponível para troca.</p>
  <p style="color: green"><i class="	fa fa-calendar-check-o"></i> Prazo de entrega de até 7 dias.</p>
    <p style="color: green"><i class="	fa fa-lock"></i> Segurança garantida na troca.</p>

</div>
  

<script>
function myFunction() {
  alert("Sucesso! Agora é so aguardar receber seu código do gift card via e-mail ou telefone celular. Não se preocupe, nós temos até 7 dias para lhe entregar o código, caso ao contrário iremos devolver seu dinheiro.");
}
</script>
    <?php if($row_estoquess['saldo'] < $valorp){
      echo "<br><div class='alert alert-danger text-center'><strong>Saldo Insuficiente para a compra do produto.</strong></div>";
  } ?>

     <div class="row">
          <div class="col-md-6 col-xs-6">
                <form action="troca.php" method="get">
                  <input name="produto" type="text" style="display:none" value="<?php echo $_SESSION['produto'];?>">
                  <input name="valor" type="text" style="display:none" value="<?php echo $valorp;?>">
                  <input name="data" type="date" style="display:none" value="<?php 
                  $total = date("Y-m-d");
                  echo $total?>">
                  <input name="carteira_codigo" type="text" style="display:none" value="<?php echo $row_estoquess['codigo'];?>">
                  <input name="usuario_cpf" type="text" style="display:none" value="<?php echo $row_estoques['cpf'];?>">
                  <input class="w3-input w3-border" style="display:none"  name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >
            <br>
            <?php if($row_estoquess['saldo'] < $valorp){
                echo "<button onclick='myFunction()'' disabled data-toggle='modal' data-target='#myModal' type='submit' name='confirmar'  class='btn btn-outline-success w3-block w3-padding-large  w3-margin-bottom'><i class='fa fa-check'></i> Confirmar</button>";
            }else{
                echo "<button onclick='myFunction()'' data-toggle='modal' data-target='#myModal' type='submit' name='confirmar'  class='btn btn-outline-success w3-block w3-padding-large  w3-margin-bottom'><i class='fa fa-check'></i> Confirmar</button>";
            } ?>
            <br>
          </form>
          
            
          </div>
          <div class="col-md-6 col-xs-6">
                <form action="../troca.php" method="get">
              <input type="" style="display:none" value="<?php echo $row_estoques['cpf'];?>" name="cpf">
              <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >
            <br><button type="submit" name="cancelar" class="btn btn-outline-danger w3-block w3-padding-large  w3-margin-bottom"><i class="fa fa-close"></i> Cancelar</button>
          </form>
          </div>
        </div>
</form>
  </header>
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById('mySidebar');

// Get the DIV with overlay effect
var overlayBg = document.getElementById('myOverlay');

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = 'block';
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = 'none';
    overlayBg.style.display = 'none';
}
</script>

</body>
</html>