<?php  
header("Content-Type:Text/html; charset=utf8");
//Recuperar arquivo da classe
require_once "CLIENTES.php";
$cpf = "";
$erro_cpf = "";
$usuarioo = "";
$erro_usuario = "";
//Criar um objeto do tipo cliente
$cliente = new Clientes();
//Chamar a funcao apra inserir testando se foi clicado no botao salvar
if (isset($_GET['enviarcadastro'])){
    //verificar se há tentativa de clonar dados
    $cpf = $_GET["cpf"];
    $usuarioo = $_GET["usuario"];
    include_once ("conexao.php");

    
    $result_estoques2 = "SELECT count(usuario) FROM usuario where usuario = '$usuarioo'";
    $resultado_estoques2 = mysqli_query($conn, $result_estoques2);
    $row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);

    $result_estoques = "SELECT count(cpf) FROM usuario where cpf = '$cpf'";
    $resultado_estoques = mysqli_query($conn, $result_estoques);
    $row_estoques = mysqli_fetch_assoc($resultado_estoques);

    if($row_estoques['count(cpf)']>=1 && $row_estoques2['count(usuario)']>=1){
      $erro_usuario = "Este Usuario já está Cadastrado";
        $erro_cpf = "Este CPF já está sendo utilizado";
    }
    else if($row_estoques['count(cpf)']>=1){
        $erro_cpf = "Este CPF já está sendo utilizado";
    }
    else if ($row_estoques2['count(usuario)']>=1) {
        $erro_usuario = "Este Usuario já está Cadastrado";
    }
   else{
     $cliente->inserir();
   }

}
?>
<!DOCTYPE html>
<html>
<title>WIM | Termos e Condições</title>
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
 <link rel="stylesheet" href="http://code.jquery.com/qunit/qunit-1.11.0.css" type="text/css" media="all">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="UTF-8">
  <link rel="shortcut icon" href="imagens/loguei.png">
  <style>
/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}
.custom-select select {
  display: none; /*hide original SELECT element:*/
}
.select-selected {
  background-color: DodgerBlue;
}
/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}
/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}
/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}
/*style items (options):*/
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}
/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}
.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
</style>
  <style>
/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}
.custom-select select {
  display: none; /*hide original SELECT element:*/
}
.select-selected {
  background-color: DodgerBlue;
}
/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}
/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}
/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}
/*style items (options):*/
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}
/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}
.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"><img src="imagens/wim.png" style="width: 20px"> WIM</span>
</div>

<!-- Sidebar/menu -->
<hr>
<hr>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Fechar Menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:200px;margin-right: 200px;margin-top:s43px;">

<header class="table-row pp-header" role="banner">
    <div>
        <div class="containerCentered minimal">

</div>
    </div>
</header>

<div role="main" id="main" class="containerMobileFullWidth">
    
<section class="row-fluid">

<div role="main" id="main" class="containerMobileFullWidth">
    
<section class="row-fluid">
  <div class="containerCentered"><section id="content"> <section id="headline"> </section> <div id="messageBox">&nbsp;</div> <section id="main"> <h1>Atualiza&ccedil;&otilde;es dos contratos</h1> <p>&nbsp;</p> <h5><strong>Atualiza&ccedil;&otilde;es dos contratos</strong></h5> <p>Esta p&aacute;gina informa os Usu&aacute;rios da WIM sobre atualiza&ccedil;&otilde;es importantes nos Termos e Condi&ccedil;&otilde;es dos Servi&ccedil;os da WIM. Estas atualiza&ccedil;&otilde;es est&atilde;o sendo divulgadas nesta p&aacute;gina pelo menos 1 (um) dia antes da data em que entrar&atilde;o em vigor.</p> <p><strong>Aconselhamos que voc&ecirc; revise estas atualiza&ccedil;&otilde;es, pois elas se aplicam ao uso dos Servi&ccedil;os da WIM a partir da sua data de entrada em vigor. </strong></p> <p>&nbsp;</p> <H5><strong>1. Atualiza&ccedil;&atilde;o</strong><strong> do Contrato do Usu&aacute;rio da WIM </strong></H5> <p><strong>Data de entrada em vigor: 22 de julho de 2019</strong></p> <p>Estamos atualizando o Contrato do Usu&aacute;rio da WIM (&ldquo;Contrato&rdquo;), documento que regula os termos e condi&ccedil;&otilde;es da presta&ccedil;&atilde;o dos Servi&ccedil;os da WIM aos seus Usu&aacute;rios.</p> <p>Abaixo, apresentamos um resumo das principais atualiza&ccedil;&otilde;es do contrato.</p> <ul> <li>Atualizaremos nosso contrato para descrever mudan&ccedil;as que d&atilde;o a voc&ecirc; maior controle.</li>  <li>Atualizaremos nosso contrato para esclarecer que a tarifa de transferência bancária é cobrada no valor de R$ 1,00 real (hum real), na retirada de seu saldo da carteira WIM para sua conta banc&aacute;ria local </li>
  <li>Atualizaremos nosso contrato do usuário parar esclarecer a inclusão do sistema de trocas em nossa plataforma.</li> </ul> <p>&nbsp;</p> <p>Para conhecer a vers&atilde;o atualizada do Contrato Clique <a href="contrato.php">Aqui</a>.</p> <p>&nbsp;</p> <p><strong><u>Aviso de altera&ccedil;&atilde;o da Declara&ccedil;&atilde;o de Privacidade da WIM</u></strong></p> <p>Realizaremos altera&ccedil;&otilde;es na Declara&ccedil;&atilde;o de Privacidade que disponibiliza informa&ccedil;&otilde;es sobre como utilizamos seus dados.</p> <p>N&oacute;s fornecemos detalhes adicionais&nbsp;sobre como utilizamos os dados quando voc&ecirc; transaciona com seus amigos, bem como mais informa&ccedil;&otilde;es&nbsp;sobre como utilizamos dados para prevenir fraudes e risco.</p> <p>Voc&ecirc; pode revisar as altera&ccedil;&otilde;es e a atual Política de Privacidade&nbsp;<a href="privacidade.php"><u>aqui</u></a>.</p> </section> </section>  </div>
</section>

</div>

</section>



</div>
<footer role="contentinfo" class="global-footer">
    <div class="containerCentered containerExtend">
        <div style="text-align: right;"><br><br><br><br><br>
<hr>
&copy; 2019

            
<a style="color: gray" href="contrato.php">Contrato do Usuário -</a>
<a style="color: gray" href="privacidade.php"> Política de Privacidade -</a>
<a style="color: gray" href="termos.php"> Termos e Condições </a>

</div><br>
</footer>





      <input type="date" style="display:none" value="<?php 
    $total = date("Y-m-d");
    echo $total?>" name="data">

    <input type="time" style="display:none" value="<?php 
    date_default_timezone_set('America/Sao_Paulo');
    $total = date('H:i:s');
    echo $total?>" name="hora">

<!--MINUTOS GERAL-->
    <input type="text" style="display:none" value="<?php 
    date_default_timezone_set('America/Sao_Paulo');
    $data_min = date("Y") * 525600 + date("m") * 43800 + date("d") * 1440;
    $minutos = date('H')*60 + date('i');
    $minutos_geral = $data_min + $minutos;
    echo $minutos_geral?>" name="minutos">


      <script>
// NOTIFICADOR;

</script>
<script>
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 0; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

   </form>
    <hr>

  <!-- End page content -->
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
