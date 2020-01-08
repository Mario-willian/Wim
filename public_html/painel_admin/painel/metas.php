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

//Puxar do Banco as Metas
$result_estoques1 = "SELECT max(minutos) FROM metas";
$resultado_estoques1 = mysqli_query($conn, $result_estoques1);
$row_estoques1 = mysqli_fetch_assoc($resultado_estoques1);

$minutos = "";
$minutos = $row_estoques1['max(minutos)'];

$result_estoques3 = "SELECT * FROM metas where minutos = '$minutos'";
$resultado_estoques3 = mysqli_query($conn, $result_estoques3);
$row_estoques3 = mysqli_fetch_assoc($resultado_estoques3);



//Minutos até agr
$minutos_ate_agora = (date("Y") * 525600 + date("m") * 43800 + date("d") * 1440) + date('H')*60 + date('i');


//Recuperar arquivo da classe
require_once "novasmetas.php";
//Criar um objeto do tipo cliente
$metas = new Novasmetas();
//botoes
if (isset($_GET['alterar'])){
    $metas->inserir();
    header("location:metas.php");
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
          <li><a href="notificacao.php">Notificação</a></li>
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
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form action="metas.php" method="get"><center>
            <h3><b><i ></i> Alterar Metas</b></h3><label for="total_atual" style="color: red">(Ultima alteração: <?php echo date('d/m/Y', strtotime($row_estoques3['data'])); ?>)</label><br><label for="total_atual">Obs: Acabou de alterar? Aguarde 1 minuto para alterar novamente.</label></center><br>

            <div class="form-group">
                 <label for="total_atual">Mês Atual(Total)</label>
                <b><input type="number" max="90000000000" name="total_atual" class="form-control" value="<?php echo $row_estoques3['total_atual']; ?>" required></b>
            </div>

            <div class="form-group">
                 <label for="total_anterior">Mês Anterior(Total)</label>
                <b><input type="number" max="90000000000" name="total_anterior" class="form-control" value="<?php echo $row_estoques3['total_anterior']; ?>" required></b>
            </div>

            <div class="form-group">
                 <label for="abrigo_atual">Mês Atual(Abrigo)</label>
                <b><input type="number" max="90000000000" name="abrigo_atual" class="form-control" value="<?php echo $row_estoques3['abrigo_atual']; ?>" required></b>
            </div>

            <div class="form-group">
                 <label for="abrigo_anterior">Mês Anterior(Abrigo)</label>
                <b><input type="number" max="90000000000" name="abrigo_anterior" class="form-control" value="<?php echo $row_estoques3['abrigo_anterior']; ?>" required></b>
            </div>

            <div class="form-group">
                 <label for="instituicoes_atual">Mês Atual(Instituições)</label>
                <b><input type="number" max="90000000000" name="instituicoes_atual" class="form-control" value="<?php echo $row_estoques3['instituicoes_atual']; ?>" required></b>
            </div>

            <div class="form-group">
                 <label for="instituicoes_anterior">Mês Anterior(Instituições)</label>
                <b><input type="number" max="90000000000" name="instituicoes_anterior" class="form-control" value="<?php echo $row_estoques3['instituicoes_anterior']; ?>" required></b>

                <b><input type="number"  name="minutos" class="form-control" value="<?php echo $minutos_ate_agora; ?>" style="display:none" required></b>
            </div>

            <div style="display:none" class="form-group">
                <b><input type="number"  name="minutos" class="form-control" value="<?php echo $minutos_ate_agora; ?>"  required></b>
            </div>

              <!--Data-->
                    <input type="date" style="display:none" value="<?php 
                    $total = date("Y-m-d");
                    echo $total?>" name="data">

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <br><button type="submit" class="btn btn-success btn-block" name="alterar">Alterar</button><br>
                    </div></form><form action="paineladm.php">
                    <div class="col-md-6 col-xs-6">
                        <br><button type="submit" class="btn btn-danger btn-block">Cancelar</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>


</body>
</html>