<?php  
header("Content-Type:Text/html; charset=utf8");

//Verificando se já está logado
session_start();


if (!empty($_SESSION['usuario'])) {
  include_once ("conexao.php");
  $cargo = "";
  $cargo = $_SESSION['usuario']->cargo;
  //Verificando se é um ADM
    if ($cargo == "c") {
      header("location:painel/painel.php");
    }else{
      header("location:painel_admin/painel/paineladm.php");
    }
}


//METODO PARA MENSAGEM
require_once "inicio/FALE.php";
$contato = new Contato();
if (isset($_GET['enviartext'])){
    $contato->inserir();
}


?>

<!DOCTYPE html>
<html lang="pt">

<head>

  <title>WIM</title>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="inicio/imagens/loguei.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<meta charset="utf-8">
	<meta name="viewport" content="widt=device-width" />
	<style type="text/css">
	.label-float{
  position: relative;
  padding-top: 20px;
}

.label-float input{
  border: 1px solid lightgrey;
  border-radius: 5px;
  outline: none;
  min-width: 250px;
  padding: 15px 20px;
  font-size: 16px;
  transition: all .1s linear;
  -webkit-transition: all .1s linear;
  -moz-transition: all .1s linear;
  -webkit-appearance:none;
}

.label-float input:focus{
  border: 2px solid #DodgerBlue;
}

.label-float input::placeholder{
  color:transparent;
}

.label-float label{
  pointer-events: none;
  position: absolute;
  top: calc(50% - 8px);
  left: 15px;
  transition: all .1s linear;
  -webkit-transition: all .1s linear;
  -moz-transition: all .1s linear;
  background-color: transparent;
  padding: 5px;
  box-sizing: border-box;
}

.label-float input:required:invalid + label{
  color: gray;
}
.label-float input:focus:required:invalid{
  border: 2px solid #ff6666;
}
.label-float input:required:invalid + label:before{
  content: '*';
}
.label-float input:focus + label,
.label-float input:not(:placeholder-shown) + label{
  font-size: 13px;
  top: 0;
  color: DodgerBlue;
}

</style>
   <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }  
  .jumbotron {
      background-color: #0c9ace;
      color: #fff;
      padding: 100px 25px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 60px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #0c9ace;
      font-size: 50px;
  }
  .logo {
      color: #0c9ace;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #0c9ace;
  }
  .carousel-indicators li {
      border-color: #0c9ace;
  }
  .carousel-indicators li.active {
      background-color: #0c9ace;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #0c9ace; 
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #0c9ace;
      background-color: #0c9ace !important;
      color: #0c9ace;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #0c9ace !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #0c9ace;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color:  white;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: black !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #0c9ace !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color:#0c9ace;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }

  .efeito-3{

  }

  .efeito-3:hover {

    box-shadow: inset 0 0 0 3px #0099ff;
  }
  .efeito-6{
    background:  #00b33c;
  }

  .efeito-6:hover {
    background: rgba(0,0,0,0);
    color:  #00b33c;
    box-shadow: inset 0 0 0 3px  #00b33c;
  }
  .efeito-5{
    background:  #ffd11a;
  }

  .efeito-5:hover {
    background: rgba(0,0,0,0);
       color: #ffd11a;
    box-shadow: inset 0 0 0 3px  #ffd11a;
  }
  .efeito{
    border: none;
    color: #ffffff;
    padding: 10px;
    margin: 0px;
    font-size: 24px;
    line-height: 24px;
    border-radius: 10px;
    position: relative;
    box-sizing: border-box;
    cursor: pointer;
    transition:all 400ms ease;
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
 input[type="password"] {
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

.inputWithIcon input[type="password"] {
  padding-left: 40px;
}
.inputWithIcon textarea {
  padding-left: 40px;
}
input[type="password"]:focus {
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
  top: 35px;
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
.inputWithIcon input[type="password"]:focus + i {
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
.inputWithIcon.inputIconBg input[type="password"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
.inputWithIcon.inputIconBg input[type="email"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
#grad1 {
  height: 400px;
  background-color: DodgerBlue; /* For browsers that do not support gradients */
  background-image: linear-gradient(to right, DodgerBlue ,  #66ffff
); /* Standard syntax (must be last) */
}
  </style>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <p class="navbar-brand" href="#myPage"> WIM</p>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">INÍCIO</a></li>
        <li><a href="#services">SERVIÇOS</a></li>
        <li><a href="#portfolio">SOBRE</a></li>
        <li><a href="#contact">CONTATO</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center"  id="grad1">
  <h1>WIM</h1> 
  <p>Comece a ganhar dinheiro do seu jeito e no seu tempo</p> 
 <button type="submit" class="button w3-block w3-padding-large  w3-margin-bottom efeito " onclick="document.getElementById('download').style.display='block'"  name="salvar"><i style="vertical-align:middle"></i> <span>Começar  <i class="fa fa-windows"></i>
     </span></button></p>

</div>
<form action="inicio/actlogin.php" method="POST">
<!-- Modal -->
<div id="download" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content" style="padding:32px">
    <div class="w3-container w3-white">
      <i onclick="document.getElementById('download').style.display='none'" class="fa fa-remove w3-xlarge  w3-transparent w3-right w3-xlarge" style="cursor: pointer;"></i>
      <h2 class="w3-wide">Entrar</h2>
      <p>Entre na sua conta ou cadastre-se agora</p>
    
      <div class="inputWithIcon">
      	  <div class="label-float">
  <input name="usuario" type="text" required="" placeholder=" "/>
  <label style="margin-left: 20px;">Usuário</label>
    <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i></div>
</div>
<div class="inputWithIcon">
	 <div class="label-float">
  <input name="senha" type="password" placeholder="  " required="" id="myInput"/>
   <label style="margin-left: 20px;">Senha</label>
  <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
</div></div>

<input type="checkbox" onclick="myFunction()"> Mostrar senha

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script></h4>
            <style>
.button {
  display: inline-block;
  border-radius: 10px;
  background-color: DodgerBlue;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 25px;
  padding: 20px;
background-color: DodgerBlue; /* For browsers that do not support gradients */
  background-image: linear-gradient(to right, DodgerBlue ,  #66ffff
);

  transition: all 0.5s;
  cursor: grab;
  margin: 5px;
}
.buttons {
  display: inline-block;
  border-radius: 10px;
  background-color: Orange;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 25px;
  padding: 20px;
  width: 100%;
background-color: DodgerBlue; /* For browsers that do not support gradients */
  background-image: linear-gradient(to right, Orange ,  #ffff1a
);
  transition: all 0.5s;
  cursor: grab;
  margin: 5px;
}
.botao {
  display: inline-block;
  border-radius: 10px;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 25px;
  padding: 20px;
  width: 200px;

  transition: all 0.5s;
  cursor: grab;
  margin: 5px;
}
.botao {
  display: inline-block;
  border-radius: 10px;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 25px;
  padding: 20px;
  width: 200px;

  transition: all 0.5s;
  cursor: grab;
  margin: 5px;
}
.botoes {

  border-radius: 10px;

}


.help {
  cursor: help;
}
.button span {
  cursor: grab;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

.buttons span {
  cursor: grab;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.buttons span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.buttons:hover span {
  padding-right: 25px;
}

.buttons:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
    <button type="submit" class="button w3-block w3-padding-large  w3-margin-bottom efeito " name="salvar"><i class="fa fa-external-link" style="vertical-align:middle"></i> <span> Entrar</span></button>
      <script>
</script>

    </form>
<form action="inicio/cadastrar.php" method="post">
  <button type="submit" class="buttons w3-block w3-padding-large  w3-margin-bottom efeito" name="salvar"><i class="fa fa-user-plus" style="vertical-align:middle"></i> <span> Cadastrar</span></button>

</form></h6>
    </div>
  </div>
</div>
  <div id="myCarousel" class="carousel slide text-center " data-ride="carousel">
    <!-- Indicators // indicador desativado -->
    <ol class="carousel-indicators">
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      
      <div class="item active">
        <h4><img src="inicio/imagens/doacao.png"> Doe o dinheiro ganho a partir da visualização de anúncios.</h4>
      </div>
      <div class="item">
        <h4><img src="inicio/imagens/troca.png"> Troque seu dinheiro por diferentes tipos de gift card.</h4>
      </div>
      <div class="item">
        <h4><img src="inicio/imagens/s.png" style="width: 50px"> Saque o seu dinheiro arrecadado, podendo chegar em até R$ 892,8 reais por mês.</h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Anterior  </span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Próximo</span>
    </a>
  </div>
</div>
<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      
      <h2><B>NOSSA PLATAFORMA</h2></B>
      <h2 class=" w3-text-green"><b>Como funciona?</b></h2>
      <h4>Somos uma plataforma com o objetivo de ajudar empresas ao mostrar seu anúncio para nossos usuários, no intuito de promover sua marca. Com isso, a WIM ajuda os nossos usuários que assistiram o anúncio, entregando uma certa quantia de dinheiro, podendo sacar o seu dinheiro arrecadado em nossa plataforma, doa-lo para abrigos e ongs ou trocar por gift card.
     </h4></b>
      <br><button class="btn btn-default btn-lg " onclick="document.getElementById('download').style.display='block'">Começar</button>
    </div>
    <div class="col-sm-4">
   <span class="	fa fa-desktop logo slideanim"></span>
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="fa fa-rocket logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Inovação</h2>
       <h2 class="w3-text-green"><b>Ideia inovadora, por que?</b></h2>
      <h4>Somos uma plataforma <b style="color: DodgerBlue">100% gratuita</b>, procurando sempre melhorar na facilidade e acessibilidade, para nossos usuários. Incentivando doações através de certificados, possibilitando uma renda extra, economizando compras através de trocas e beneficiando pessoas, animais e empresas. Junte-se a nós, juntos vamos fazer a diferença no mundo.</h4>
    </div>
  </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2>SERVIÇOS</h2>
  <h4>Resumo do que nós oferecemos</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-piggy-bank logo-small"></span>
      <h4>DINHEIRO</h4>
      <p>Arrecade dinheiro assistindo anúncios</p>
    </div>
    <div class="col-sm-4">
      <span class="fa fa-handshake-o logo-small"></span>
      <h4>DOAÇÃO</h4>
      <p>Você pode realizar doações em diferentes formas</p>
    </div>
    <div class="col-sm-4">
      <span class="fa fa-eye logo-small"></span>
      <h4>ACOMPANHAR</h4>
      <p>Acompanhe os resultados das doações</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="	fa fa-money logo-small"></span>
      <h4>SAQUE</h4>
      <p>Saque o seu dinheiro arrecadado todo mês</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
      <h4>CERTIFICADO</h4>
      <p>Doe e ganhe certificado de doador</p>
    </div>
    <div class="col-sm-4">
      <span class="fa fa-exchange logo-small"></span>
      <h4 style="color:#303030;">TROCA</h4>
      <p>Troque o seu dinheiro por gift card</p>
    </div>
  </div>
</div>


<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid bg-grey" ><center>

  <h2>SOBRE</h2></center>
 <div class="row">
    <div class="col-sm-8">
      
      <h2><B>SOBRE NÓS</h2></B>
      <h2 class=" w3-text-green"><b>Como surgimos?</b></h2>
      <h4>A WIM (World In Money) é uma startup que começou a ser desenvolvida em março de 2018, passando por várias etapas até chegar no conceito final de hoje no qual estamos. Atualmente nossa diretoria é formada por uma equipe de apenas três integrantes, sendo dividido entre eles um diretor executivo que atua como desenvolvedor web, um diretor analista de banco de dados e uma diretora em pesquisa e desenvolvimento tecnológico.
     </h4></b>
     
    </div>
   <div class="col-sm-4">
    <span class="fa fa-group logo slideanim"></span>
    </div>
  </div>
</div>
<br>
 

<!-- Container (Pricing Section) -->
</div>
<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-white" >
  <h2 class="text-center">CONTATO</h2>

  <div class="row" style="text-align: left;">
    <div class="col-sm-5">
      <p>Entra em contato conosco</p>
      <p><a href="https://www.instagram.com/wim.oficial/" target="blank"><span class="  fa fa-instagram"></a></span> wim.oficial</p>
      <p><a href="mailto:companywim@gmail.com"><span class="glyphicon glyphicon-envelope"></span></a> companywim@gmail.com</p>
    </div>

   <form role="form" action="index.php" method="get">
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <div class="inputWithIcon">
          	<div class="label-float">
          		  <input maxlength="45" id="nome"  name="nome" type="text" placeholder="  " required="">
  <label style="margin-left: 20px;">Nome</label>
    <i class="fa fa-address-card-o fa-lg fa-fw" aria-hidden="true" style=""></i>
</div>
</div>
        </div>
        <div class="col-sm-6 form-group">
          <div class="inputWithIcon">
          		<div class="label-float">
  <input maxlength="30" name="email" id="email" type="email" placeholder=" " required="">
   <label style="margin-left: 20px;">E-mail</label>
  <i class="  fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"></i>
</div></div>
        </div>
      </div>
         <div class="inputWithIcon">
         	<div class="label-float">
  <textarea  id="comentario" maxlength="280" name="comentario"  placeholder="Comentário" rows="5" required=""></textarea>
  <i class="  fa fa-commenting-o fa-lg fa-fw" aria-hidden="true"></i>
</div></div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button style="color: black; font-size: 20px" class="btn btn-default btn-lg pull-right" type="submit" name="enviartext"><i class=" fa fa-paper-plane-o"></i> Enviar</button>
              
        </form>

        </div>
      </div>
    </div>
  </div>
</div>
<style>
  @keyframes bounce {
    O%, 20%, 40%, 60%, 80%, 100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }

    40% {
      -webkit-transform: translateY(-20px);
        transform: translateY(-20px);
    }
    80% {
      -webkit-transform: translateY(-0px);
        transform: translateY(-0px);
    }
  }


  .efeito-4:hover {
    animation:  bounce 0.9s;
  }

</style>
<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a></b>
  <p>Corporação &copy; World In Money 2019</p></b>
</footer>
<footer role="contentinfo" class="global-footer">
    <div class="containerCentered containerExtend">
        <div style="text-align: right;">

&copy; 2019

            
<a style="color: gray" href="inicio/contrato.php">Contrato do Usuário -</a>
<a style="color: gray" href="inicio/privacidade.php"> Política de Privacidade -</a>
<a style="color: gray" href="inicio/termos.php"> Termos e Condições </a>

</div><br>
</footer>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
