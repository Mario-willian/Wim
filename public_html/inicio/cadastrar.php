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
<title>WIM | Cadastrar</title>
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
<body class="w3-light-white">


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:200px;margin-right: 200px;margin-top:s43px;">
<style type="text/css">
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
   input[type="date"] {
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

.inputWithIcon input[type="password"] {
  padding-left: 40px;
}
input[type="password"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="text"] {
  padding-left: 40px;
}

input[type="email"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="date"] {
  padding-left: 40px;
}
input[type="date"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
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
  top: 15px;
  padding: 9px 8px;
  color: #aaa;
  transition: 0.3s;
}

.inputWithIcon input[type="text"]:focus + i {
  color: dodgerBlue;
}
.inputWithIcon input[type="password"]:focus + i {
  color: dodgerBlue;
}
.inputWithIcon input[type="date"]:focus + i {
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
.inputWithIcon.inputIconBg input[type="password"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
.inputWithIcon.inputIconBg input[type="date"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
.inputWithIcon.inputIconBg input[type="email"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}
</style>
  <!-- Header -->
 <form action="cadastrar.php" method="get">
  <div class="w3-container"><hr>
      <h2><i class="fa fa-user-plus" style="color: DodgerBlue"></i> Cadastro</h2><hr>
    <h3>Preencha todos os campos abaixo:</h3><b style="color: red">
      </b><br>
    <br>

    <h4>Nome Completo</h4>
   <b>
    <div class="inputWithIcon">
  <input maxlength="45" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  name="nome" type="text" placeholder="Digite seu nome" required="">
  <i class="fa fa-address-card-o fa-lg fa-fw" aria-hidden="true"></i>
</div><br></b>
    <h4>Nome de Usuário</h4>
    <b style="color: red">
      <?php 
        echo "".$erro_usuario;

       ?>
      </b>
   <b>
    <div class="inputWithIcon">
  <input maxlength="20" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  name="usuario" type="text" placeholder="Digite um nome de usuário" required="">
  <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
</div><br></b>
    <h4>Senha</h4>
  <b> <div class="inputWithIcon">
  <input maxlength="18" style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"   value="" id="myInput" name="senha" type="password" placeholder="Digite sua senha" required="">
  <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
</div>
</b>
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>


<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script><h5>
<div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
      <label class="custom-control-label" for="customCheck" onclick="myFunction()">Mostrar senha</label>
    </div></h5><br>
    <h4>Data de Nascimento</h4>
   <h6><b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;" name="datanascimento" type="date" required="">
  <i class="fa fa-calendar fa-lg fa-fw" aria-hidden="true"></i>
</div><br>
</b></h6><br>

    <h4>E-mail</h4>

  <b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="30" name="email" type="email" placeholder="Digite seu email" required="">
  <i class="  fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"></i>
</div><br>
</b>
     <h4>Sexo</h4>
  <select name="sexo" class="w3-input w3-border custom-select-lg">
        <option value="Masculino">Masculino</option>
         <option value="Feminino">Feminino</option>
          <option value="Outro">Outro</option>
      </select><br>

    <h4>País</h4>
  <select name="pais" maxlength="30" class="w3-input w3-border custom-select-lg">
        <option>Brasil</option>
      </select><br>

      <h4>Estado</h4>
    <select name="estado" class="w3-input w3-border custom-select-lg">
<option value="Acre">Acre</option>
<option value="Alagoas">Alagoas</option>
<option value="Amapá">Amapá</option>
<option value="Amazonas">Amazonas</option>
<option value="Bahia">Bahia</option>
<option value="Ceará">Ceará</option>
<option value="Distrito Federal">Distrito Federal</option>
<option value="Espirito Santo">Espirito Santo</option>
<option value="Goiás">Goiás</option>
<option value="Maranhão">Maranhão</option>
<option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
<option value="Mato Grosso">Mato Grosso</option>
<option value="Minas Gerais">Minas Gerais</option>
<option value="Pará">Pará</option>
<option value="Paraíba">Paraíba</option>
<option value="Paraná">Paraná</option>
<option value="Pernambuco">Pernambuco</option>
<option value="Piauí">Piauí</option>
<option value="Rio de Janeiro">Rio de Janeiro</option>
<option value="Rio Grande do Norte">Rio Grande do Norte</option>
<option value="Rio Grande do Sul">Rio Grande do Sul</option>
<option value="Rondônia">Rondônia</option>
<option value="Roraima">Roraima</option>
<option value="Santa Catarina">Santa Catarina</option>
<option value="São Paulo">São Paulo</option>
<option value="Sergipe">Sergipe</option>
<option value="Tocantins">Tocantins</option>
  </select><br>
    <h4>Endereço</h4>
  <b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="90" name="endereco" type="text" placeholder="Digite seu endereco" required="">
  <i class="  fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
</div></b><Br>

      <h4>Complemento</h4>
  <b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  maxlength="20" name="complemento" type="text" placeholder="Ex: Apartamento" required="">
  <i class="  fa fa-building-o fa-lg fa-fw" aria-hidden="true"></i>
</div>
</b><br>

      <h4>Telefone</h4>
 <b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  placeholder="Ex: 00-90000-0000" type="text" name="telefone" maxlength="13" OnKeyPress="formatar('##-#####-####', this)" required="">
  <i class="  fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
</div>
</b><br>
      <h4>CPF</h4>

      <b style="color: red">
      <?php 
        echo "".$erro_cpf;
       ?>
      </b>
  <b><div class="inputWithIcon">
  <input style="border-left-color: transparent;border-top-color: transparent;border-right-color: transparent;"  placeholder="Ex: 000.000.000-00"  type="text" name="cpf" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" required="">
  <i class="  fa fa-vcard fa-lg fa-fw" aria-hidden="true"></i>
</div>
</b><br>

  <h4>Foto de Perfil</h4>

  <div class="custom-file">
    <b><input type="file" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile"><i class="  fa fa-user-circle-o fa-lg fa-fw" aria-hidden="true"></i> Este campo não é obrigatório</label>
  </div></b>

<style>
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style><br><br>
<label class="container">
  <input type="checkbox" checked="checked" required="" >
  <span class="checkmark" ></span>
Li e aceito o <a href="contrato.php" target="_blank">Contrato do Usuário</a>, a <a href="privacidade.php" target="_blank">Política de Privacidade</a> e todas as outras políticas da WIM nos <a href="termos.php" target="_blank">Termos e Condições</a> da WIM.</label>




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

   <br><br><button type="submit" class="btn btn-outline-success w3-block w3-padding-large  w3-margin-bottom" name="enviarcadastro"><i class="fa fa-user-plus"></i> Cadastrar</button>
   <button type="reset"  class="btn btn-outline-primary w3-block w3-padding-large  w3-margin-bottom" onclick="document.getElementById('download').style.display='none'"><i class="fa fa-paint-brush"></i> Limpar</button>

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
      <form action="../index.php" method="post">
    <button type="submit"class="btn btn-outline-danger w3-block w3-padding-large  w3-margin-bottom"><i class="fa fa-arrow-left"></i>  Voltar</button>
  <hr>

</form>

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
