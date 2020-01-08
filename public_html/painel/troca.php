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


//puxar a carteira
$result_estoquess = "SELECT * FROM carteira where cmd = '$cmdzao'";
$resultado_estoquess = mysqli_query($conn, $result_estoquess);
$row_estoquess = mysqli_fetch_assoc($resultado_estoquess);

//Quantidade de notificacoes
$result_estoques2 = "SELECT count(ativo) FROM notificacao where usuario_cpf = '$login' and ativo = 's'";
$resultado_estoques2 = mysqli_query($conn, $result_estoques2);
$row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);

//botoes
if(isset($_GET['continuar'])){
    $_SESSION['produto']= $_GET['produto'];
    header("location:php/troca.php");
}
?>

<!DOCTYPE html>
<html>
<title>WIM | Carteira</title>
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

<body class="w3-light-white">

<!-- Top container -->
<div class="w3-bar w3-top w3-green w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right" ><img src="imagens/ww.png" style="width: 20px"> WIM</span>
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
        <a class="w3-bar-item w3-btn w3-padding  w3-blue" href="troca.php"><i class="fa fa-exchange"></i> Trocas</a>

    <a class="w3-bar-item w3-btn w3-padding" href="acompanhar.php"><i class="fa fa-eye fa-fw"></i> Acompanhar</a>
    <a class="w3-bar-item w3-btn w3-padding" href="doar.php"><i class="fa fa-handshake-o"></i> Doar Dinheiro</a>
    <a class="w3-bar-item w3-btn w3-padding" href="total.php"><i class="fa fa-line-chart"></i> Total</a>
    <a class="w3-bar-item w3-btn w3-padding" href="info.php"><i class="fa fa-paperclip"></i> Informações</a>
    <a class="w3-bar-item w3-btn w3-padding" href="historico.php"><i class="fa fa-calendar-check-o"></i> Histórico</a>
    <a class="w3-bar-item w3-btn w3-padding" href="config.php"><i class="fa fa-cog fa-fw"></i> Configurações</a>
    <a href="sair.php" class="w3-bar-item w3-btn w3-padding"><i class="fa fa-arrow-left"></i> Sair</a><br><br>
  </div>
</nav>
<!--TIRAR O SUBLINHADOOOOOOOOOOOOOOOOOOO-->
<!--TIRAR O SUBLINHADOOOOOOOOOOOOOOOOOOO-->
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
    <div class="w3-main">
      <div class="container">

    <h2><b><i class="fa fa-exchange"></i> Trocas</b></h2>


   <br><br><h3><b>Saldo</h3></b>
  <h4><div class="inputWithIcon">
<input id="myInput" class="w3-input w3-border"  name="carteira" value="<?php echo $row_estoquess['saldo'];?>" type="number" disabled=""> <i class="fa fa-money fa-lg fa-fw" aria-hidden="true" ></i></div><br></h4>

  <!-- The Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Aviso</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <!-- Modal body -->
      <form action="troca.php" method="get">
      <div class="modal-body">
            Certifique-se se seus dados pessoais cadastrados estão corretos, pois você irá receber o código do gift card via e-mail ou telefone celular. Caso seus dados estejam incorretos, nós não iremos nos responsabilizar.
            <!--Resultado é puxado com a ajuda do JavaScript-->
            <input type="text" class="form-control" style="display:none" name="produto" id="produto">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">

        <button type="submit" class="btn btn-success" name="continuar">Continuar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<div class="w3-row ">
     <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="imagens/steam.png" style="width:100%" name="steam">
          <span class="w3-tag w3-green w3-display-topleft">Disponível</span>
          <div class="w3-display-middle w3-display-hover">
            <button type="button" class="w3-btn w3-blue" data-toggle="modal" data-target="#exampleModal" data-whatever="Gift Card Steam" name="produto1"> Trocar <i class="fa fa-exchange"></i></button>
          </div>
        </div>
        <p>Gift Card Steam<br><b>R$ 20,00</b></p>
      </div>

    </div>
     <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="imagens/netflix.jpg" style="width:100%" name="netflix">
          <span class="w3-tag w3-green w3-display-topleft">Disponível</span>
          <div class="w3-display-middle w3-display-hover">
            <button type="button" class="w3-btn w3-blue" data-toggle="modal" data-target="#exampleModal" data-whatever="Gift Card Digital Netflix" name="produto2"> Trocar <i class="fa fa-exchange"></i></button>
          </div>
        </div>
        <p>Gift Card Digital Netflix<br><b>R$ 40,00</b></p>
      </div>

    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="imagens/uber.jpg" style="width:100%" name="uber">
          <span class="w3-tag w3-green w3-display-topleft">Disponível</span>
          <div class="w3-display-middle w3-display-hover">
            <button type="button" class="w3-btn w3-blue" data-toggle="modal" data-target="#exampleModal" data-whatever="Gift Card Digital Uber" name="produto3"> Trocar <i class="fa fa-exchange"></i></button>
          </div>
        </div>
        <p>Gift Card Digital Uber<br><b>R$ 50,00</b></p>
      </div>

    </div>
  <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="imagens/google.jpg" style="width:100%" name="google">
          <span class="w3-tag w3-green w3-display-topleft">Disponível</span>
          <div class="w3-display-middle w3-display-hover">
            <button type="button" class="w3-btn w3-blue" data-toggle="modal" data-target="#exampleModal" data-whatever="Gift Card Digital Google Play" name="produto4"> Trocar <i class="fa fa-exchange"></i></button>
          </div>
        </div>
        <p>Gift Card Digital Google Play<br><b>R$ 30,00</b></p>
      </div>
<br>
    </div>
      <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="imagens/spotify.jpg" style="width:100%" name="spotify">
          <span class="w3-tag w3-green w3-display-topleft">Disponível</span>
          <div class="w3-display-middle w3-display-hover">
            <button type="button" class="w3-btn w3-blue" data-toggle="modal" data-target="#exampleModal" data-whatever="Gift Card Digital Spotify" name="produto5"> Trocar <i class="fa fa-exchange"></i></button>
          </div>
        </div>
        <p>Gift Card Digital Spotify<br><b>R$ 17,00</b></p>
      </div>

    </div>
  <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="imagens/xbox.jpg" style="width:100%" name="xbox">
          <span class="w3-tag w3-green w3-display-topleft">Disponível</span>
          <div class="w3-display-middle w3-display-hover">
            <button type="button" class="w3-btn w3-blue" data-toggle="modal" data-target="#exampleModal" data-whatever="Gift Card Digital Xbox Game Pass 1 Mês" name="produto6"> Trocar <i class="fa fa-exchange"></i></button>
          </div>
        </div>
        <p>Gift Card Digital Xbox Game Pass 1 Mês<br><b>R$ 29,00</b></p>
      </div>

    </div>
      <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="imagens/lol.jpg" style="width:100%" name="lol">
          <span class="w3-tag w3-green w3-display-topleft">Disponível</span>
          <div class="w3-display-middle w3-display-hover">
            <button type="button" class="w3-btn w3-blue" data-toggle="modal" data-target="#exampleModal" data-whatever="Gift Card Digital Riot League Of Legends" name="produto7"> Trocar <i class="fa fa-exchange"></i></button>
          </div>
        </div>
        <p>Gift Card Digital Riot League Of Legends<br><b>R$ 20,00</b></p>
      </div>

    </div>
      <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="imagens/ps.jpg" style="width:100%" name="ps">
          <span class="w3-tag w3-red w3-display-topleft">Indisponível</span>
          <div class="w3-display-middle w3-display-hover">
            <button type="button" class="w3-btn w3-blue" data-toggle="modal" data-target="#exampleModal" data-whatever="Gift Card Digital Sony Playstation" name="produto8"> Trocar <i class="fa fa-exchange"></i></button>
          </div>
        </div>
        <p>Gift Card Digital Sony Playstation <br><b>R$ 60,00</b></p>
      </div>

    </div>

    <script type="text/javascript">
      $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body input').val(recipient)

})
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

</body>
</html>
