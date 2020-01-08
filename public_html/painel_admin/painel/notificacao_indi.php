<?php 
header("Content-Type:Text/html; charset=utf8");

session_start();
include_once ("conexao2.php");

//Evitar Bugs
if (!empty($_SESSION['usuario'])) {
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

//Recuperar arquivo da classe
require_once "MENSAGENS_indi.php";
//Criar um objeto do tipo cliente
$mensagem = new Mensagens();
//Chamar a funcao apra inserir testando se foi clicado no botao salvar
if (isset($_GET['enviarmensagem'])){

    $mensagem->inserir();
    header("location:notificacao_indi.php");
}

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
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="notificacao_indi.php" method="get"><center>
            <h3><b><i class="fa fa-bell"></i> Inserir Notificação Individual</b></h3></center>
            <div class="form-group">
                <label for="usuario_cpf">CPF do Usuário</label>
                <b><input type="text" maxlength="17" name="usuario_cpf" placeholder="Ex: 000.000.000-00" class="form-control" required><br></b>
                <label for="titulo">Titulo</label>
                <b><input type="text" maxlength="30" name="titulo" placeholder="Ex: Sucesso! / Cuidado!" class="form-control" required><br></b>
                <label for="descricao">Descrição</label>
                <b><input type="text" maxlength="180" name="descricao" placeholder="Ex: Obrigado por usar a nossa plataforma." class="form-control" required><br></b>
                <input type="" style="display:none" value="s" name="ativo">
                 <label for="descricao">Cor de Notificação</label>
<select name="cor" class="form-control">
    <option value="alert warning">Laranja</option>
    <option value="alert">Vermelho</option>
    <option value="alert info">Azul</option>
    <option value="alert success">Verde</option>
</select>

            </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <br><button type="submit" class="btn btn-success btn-block" name="enviarmensagem">Enviar</button><br>
                    </div></form><form action="paineladm.php">
                    <div class="col-md-6 col-xs-6">
                        <br><button type="submit" class="btn btn-danger btn-block">Cancelar</button>
                    </div>
                </div>
                <!--Apresenta possiveis mensagens de erro-->

                <?php
                      if (!empty($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                      }
                ?>
            </div>
        </form>
    </div></form>
    <div class="col-md-4"></div>
</div>


</body>
</html>