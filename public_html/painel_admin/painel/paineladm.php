<?php 

header("Content-Type:Text/html; charset=utf8");

session_start();
include_once ("conexao2.php");

//Evitar Bugs
if (!empty($_SESSION['usuario'])) {
  unset($_SESSION['msg']);
  $cargo = "";
  $cargo = $_SESSION['usuario']->cargo;
    //Verificando se é um ADM
    if ($cargo == "a") {
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

?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Painel Administrativo</title>
  <meta charset="utf-8">
    <link rel="shortcut icon" href="icone.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
  <link rel="shortcut icon" href="../imagens/engrenagem.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    

    <ul class="nav navbar-nav">
      <li class="active"><a href="paineladm.php">Página Inicial</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Inserir <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="notificacao.php">Notificação Geral</a></li>
          <li><a href="notificacao_indi.php">Notificação Individual</a></li>
          <li><a href="deposito.php">Deposito</a></li>
        </ul>
      </li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Exibir <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="usuarios.php">Usuários</a></li>
          <li><a href="carteiras.php">Carteiras</a></li>
          <li><a href="comentarios.php">Comentários</a></li>
        </ul>
      </li>
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Alterar <span class="caret"></span></a>
       <ul class="dropdown-menu">
        <li><a href="metas.php">Metas</a></li>
       <li><a href="acompanhar.php">Acompanhar</a></li>
</ul>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Transferências<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="pendentes.php">Pendentes</a></li>
          <li><a href="concluidas.php">Concluídas</a></li>
          <li><a href="erro.php">Erro</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Trocas<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="trocaspendentes.php">Pendentes</a></li>
          <li><a href="trocasconcluidas.php">Concluídas</a></li>
          <li><a href="trocaserro.php">Erro</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Certificados<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="certificadospendentes.php">Pendentes</a></li>
          <li><a href="certificadosconcluidos.php">Concluídas</a></li>
          <li><a href="certificadoserro.php">Erro</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="sair.php"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
    </ul>
  </div>
</nav>
  <center>
    <h1>Olá <?php echo $_SESSION['usuario']->nome; ?></h1>
  	       <div class="col-md-4">
            <br>
            <h4> SITE</h4>
           <a href="../../index.php" target="_blank"> <img src="../imagens/site.png"></a>
        </div>
        <div class="col-md-4">
            <br>
            <h4> GMAIL</h4>
          <a href="https://www.google.com/gmail/" target="_blank"> <img src="../imagens/gmail.png"></a> 
        </div>
        <div class="col-md-4">
            <br>
            <h4> INSTAGRAM</h4>
           <a href="https://www.instagram.com/wim.oficial/" target="_blank"> <img src="../imagens/insta.png"></a>
        </div>
<div class="container">
<img src="../imagens/fundo.png" style="width: 720px">
</div>

</body>
</html>
