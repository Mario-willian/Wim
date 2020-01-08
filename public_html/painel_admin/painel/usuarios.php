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

//Listando Dados
//Verificar se está sendo passado na URL a página atual, senao é atribuido a página
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
//Selecionar todos os estoques da tabela
$result_estoque = "SELECT * FROM usuario";
$resultado_estoque = mysqli_query($conn, $result_estoque);
//Contar o total de estoque
$total_estoques = mysqli_num_rows($resultado_estoque);
//Seta a quantidade de estoques por pagina
$quantidade_pg = 20;
//Calcular o número de páginas necessárias para apresentar os estoques
$num_pagina = ceil($total_estoques/$quantidade_pg);
//Calcular o inicio da visualizacao
$inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
//Selecionar os estoques a serem apresentado na página
$result_estoques = "SELECT * FROM usuario limit $inicio, $quantidade_pg";
$resultado_estoques = mysqli_query($conn, $result_estoques);
$total_estoques = mysqli_num_rows ($resultado_estoques);



//Recuperar arquivo da classe
require_once "movimentacao.php";
//Criar um objeto do tipo cliente
$deposito = new Movimentacao();

//botoes
if (isset($_GET['enviarvalor'])){
    $deposito->inserir();
    $cmdzao = $_GET["cmd"];
    header("location:usuarios.php?tx=".urlencode($cmdzao)."");
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
<header>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <center>
            <h3><b><i></i> Lista dos Usuários</b></h3></center>
        </div>
        
    </div>
</header>

<div class="Container">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <table class="table table-striped">
        <thead>
            <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>E-Mail</th>
            <th>Sexo</th>
            <th>Estado</th>
            <th>Endereço</th>
            <th>Telefone</th>
            </tr>
        </thead>
            <tbody>
              <!--Listagem dos Usuários-->
       <?php while ($rows_estoques = mysqli_fetch_assoc($resultado_estoques)){ ?>
                <tr>
                    <td><?php echo $rows_estoques['cpf'];?></td>
                    <td><?php echo $rows_estoques['nome'];?></td>
                    <td><?php echo $rows_estoques['email'];?></td>
                    <td><?php echo $rows_estoques['sexo'];?></td>
                    <td><?php echo $rows_estoques['estado'];?></td>
                    <td><?php echo $rows_estoques['endereco'];?></td>
                    <td><?php echo $rows_estoques['telefone'];?></td>
                </tr>
       <?php } ?>

            </tbody>
        </table>

        <?php 
                        //Verificar a pagina anterior e posterior
                    $pagina_anterior = $pagina - 1;
                    $pagina_posterior = $pagina + 1;
                     ?>
                        <nav class="text-center" aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <?php  
                                        if($pagina_anterior != 0){?>
                                    <?php echo "<a href=usuarios.php?pagina=".$pagina_anterior. "target=_self>"?>
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                        <?php }else{?>
                                        <span aria-hidden="true">&laquo;</span>
                                    <?php }    ?>
                                </li>
                                <?php 
                                    //Apresentar a paginação
                                for($i = 1; $i < $num_pagina +1; $i++)
                                {?>
                                    <?php echo "<li><a href=usuarios.php?pagina=".$i."target=_self>".$i."</a></li>"?>
                                    <?php } ?>
                                <li>
                                    <?php
                                    if($pagina_posterior <= $num_pagina){ ?>
                                        <?php echo "<a href=usuarios.php?pagina=".$pagina_posterior."target=_self>"?>
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                                <?php }else{ ?>
                            <span aria-hidden="true">&raquo;</span>
                    <?php }  ?>
    </div>
        <div class="col-md-1"></div>
    </div>

</div>


</body>
</html>