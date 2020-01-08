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

//Dinheiro doado pelo usuario
$result_estoquess = "SELECT sum(valor) FROM doacao where usuario_cpf = '$login'";
$resultado_estoquess = mysqli_query($conn, $result_estoquess);
$row_estoquess = mysqli_fetch_assoc($resultado_estoquess);

//Quantidade de notificacoes
$result_estoques2 = "SELECT count(ativo) FROM notificacao where usuario_cpf = '$login' and ativo = 's'";
$resultado_estoques2 = mysqli_query($conn, $result_estoques2);
$row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);

//Quantidade de dinheiro recebido
$result_estoques3 = "SELECT recebido FROM carteira where usuario_cpf = '$login'";
$resultado_estoques3 = mysqli_query($conn, $result_estoques3);
$row_estoques3 = mysqli_fetch_assoc($resultado_estoques3);

//botoes
if (isset($_GET['retirar'])){
    header("location:php/certificado.php");
}

?>

<!DOCTYPE html>
<html>
<title>WIM | Total</title>
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
        <a class="w3-bar-item w3-btn w3-padding " href="troca.php"><i class="fa fa-exchange"></i> Trocas</a>

    <a class="w3-bar-item w3-btn w3-padding" href="acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-btn w3-padding" href="doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-btn w3-padding w3-blue" href="total.php"><i class="fa fa-line-chart"></i> Total</a>
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
  border-radius: 30px;
  margin: 8px 0;
  outline: none;
  padding: 8px;
  box-sizing: border-box;
  transition: 0.3s;
}
 input[type=""] {
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
  padding-left: 60px;
}
.inputWithIcon textarea {
  padding-left: 60px;
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
  padding-left: 50px;
}
.inputWithIcon input[type=""] {
  padding-left: 60px;
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
.inputWithIcon input[type=""]:focus + i {
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
.inputWithIcon.inputIconBg input[type=""]:focus + i {
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
    <h2><b><i class="fa fa-line-chart"></i> Total</b></h2>

<form action="total.php" method="get">
  
    <h3><b>Sua quantia doada</h3></b>
    <div class="inputWithIcon">
    <h4><input id="myInput" class="w3-input w3-border" name="doou" type="text" disabled="" value="<?php 
    if($row_estoquess['sum(valor)'] == 0){
      echo "R$ 0.00";
    }else{
      echo "R$ ".$row_estoquess['sum(valor)'];
    }?>"><i class="fa fa-money fa-lg fa-fw" aria-hidden="true" ></i></div></h4><br>
    <h3><b>Sua quantia recebida</h3></b>
    <div class="inputWithIcon">
    <h4><input id="myInput" class="w3-input w3-border" name="recebeu" type="text" disabled="" value="<?php 
    if($row_estoques3['recebido'] == 0){
      echo "R$ 0.00";
    }else{
      echo "R$ ".$row_estoques3['recebido'];
    }?>">
    <input type="" style="display:none" value="<?php echo $row_estoques['cpf'];?>" name="cpf">
    <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" ><i class="fa fa-money fa-lg fa-fw" aria-hidden="true" ></i></div></h4
<br><br>
 
   <button type="submit" disabled="" name="retirar" class="btn btn-outline-success w3-block w3-padding-large  w3-margin-bottom" onclick="myFunction()"><i class=" fa fa-image"></i> Retirar Certificado</button><hr>
</form>
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
