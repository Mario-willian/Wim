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

//puxar a carteira
$result_estoquess = "SELECT max(codigo) FROM doacao where usuario_cpf = '$login'";
$resultado_estoquess = mysqli_query($conn, $result_estoquess);
$row_estoquess = mysqli_fetch_assoc($resultado_estoquess);

$codigo = $row_estoquess['max(codigo)'];

//Puxar ultimo registro
$result_estoquesss = "SELECT * FROM doacao where codigo = '$codigo'";
$resultado_estoquesss = mysqli_query($conn, $result_estoquesss);
$row_estoquesss = mysqli_fetch_assoc($resultado_estoquesss);

//Quantidade de notificacoes
$result_estoques2 = "SELECT count(ativo) FROM notificacao where usuario_cpf = '$login' and ativo = 's'";
$resultado_estoques2 = mysqli_query($conn, $result_estoques2);
$row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);


$nome = $row_estoques['nome'];

if (isset($_GET['voltar'])){
    header("location:../doar.php");
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
<body class='w3-light-grey'>
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
        <a class="w3-bar-item w3-btn w3-padding" href="../troca.php"><i class="fa fa-exchange"></i> Trocas</a>

    <a class="w3-bar-item w3-btn w3-padding" href="../acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-btn w3-padding w3-blue" href="../doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../total.php"><i class="fa fa-line-chart"></i> Total</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../info.php"><i class="fa fa-paperclip"></i> Informações</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../historico.php"><i class="fa fa-calendar-check-o"></i> Histórico</a>
    <a class="w3-bar-item w3-btn w3-padding" href="../config.php"><i class="fa fa-cog fa-fw"></i> Configurações</a>
    <a href="sair.php" class="w3-bar-item w3-btn w3-padding"><i class="fa fa-arrow-left"></i> Sair</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class='w3-overlay w3-hide-large w3-animate-opacity' onclick='w3_close()'' style='cursor:pointer' title='Fechar Menu' id='myOverlay'></div>

<!-- !PAGE CONTENT! -->
<div class='w3-main' style='margin-left:300px;margin-top:43px;'>

  <!-- Header -->
  <header class='w3-container' style='padding-top:22px'>
    <form action="doar.php" method="get"><center>
      <input class="w3-input w3-border" style="display:none" name="cpf" type="text" value="<?php echo $row_estoques['cpf'];?>">
      <input class="w3-input w3-border" style="display:none" name="cmd" type="text" value="<?php echo $row_estoques['cmd'];?>" >

      <h2>Quantia doada: R$<?php echo $row_estoquesss['valor'];?></h2>
      <h2>Você escolheu doar para o(a): <?php echo $row_estoquesss['local_de_doacao']; ?></h2>
  

    <button type='submit' name="voltar"  class='btn btn-outline-danger w3-block w3-padding-large  w3-margin-bottom'><i class='fa fa-arrow-left 
'></i> Voltar</button></center>
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