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
<title>WIM | Política de Privacidade</title>
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

<br>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:200px;margin-right: 200px;margin-top:s43px;">
<header class="table-row pp-header" role="banner">
    <div>
        <div class="containerCentered minimal">

        <br>

            

</div>
    </div>
</header>
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



<div role="main" id="main" class="containerMobileFullWidth">
    
<section class="row-fluid"> <div class="containerCentered"><section id="content"> <section id="headline">
  </p> <h1>Política de Privacidade</h1> <p> </p> <p>Data de vigência: 13 de fevereiro de 2019</p> 
<div id="ua_skinny_view" style="text-align: right;">  <div id="ua_skinny_view" style="text-align: right;">
      <button id="print" class="btn btn-outline-dark"><img src="imagens/print.png" style="width: 50px"><B> IMPRIMIR</B></button>
 
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Fechar Menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:200px;margin-right: 200px;margin-top:s43px;">

  <!-- Header -->
 <div role="main" id="main" class="containerMobileFullWidth">
    
<section class="row-fluid">
     </div>
</section><center>
<h4><B>POLÍTICA DE PRIVACIDADE</h4></B></center>
<h5><b>1. Informações gerais</h5></b>
<p>A presente Política de Privacidade contém informações a respeito do modo de como tratamos, total ou parcialmente, de forma automatizada ou não, os dados pessoais dos usuários que acessam nosso site. Seu objetivo é esclarecer os interessados acerca dos tipos de dados que são coletados, dos motivos da coleta e da forma como o usuário poderá atualizar, gerenciar ou excluir estas informações.</p>
<p>Esta Política de Privacidade foi elaborada em conformidade com a Lei Federal n. 12.965 de 23 de abril de 2014 (Marco Civil da Internet), com a Lei Federal n. 13.709, de 14 de agosto de 2018 (Lei de Proteção de Dados Pessoais) e com o Regulamento UE n. 2016/679 de 27 de abril de 2016 (Regulamento Geral Europeu de Proteção de Dados Pessoais - RGDP).</p>
<P>Esta Política de Privacidade poderá ser atualizada em decorrência de eventual atualização normativa, razão pela qual se convida o usuário a consultar periodicamente esta seção.</P><br>
<h5><b>2. Direitos do usuário</h5></b>
<p>O site se compromete a cumprir as normas previstas no RBDP, em respeito aos seguintes príncipios:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p> &nbsp; &nbsp; &nbsp; &nbsp; - Os dados pessoais do usuário serão processados de forma lícita, leal e transparente (licitude, lealdade e transparência);</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; - Os dados pessoais do usuário serão coletados apenas para finalidades determinadas, explícitas e legítimas, não podendo ser tratados posteriormente de uma forma incompatível com essas finalidades (limitação das finalidades);</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; - Os dados pessoais do usuário serão coletados de forma adequada, pertinente e limitada às necessidades do objetivo para os quais eles são processados (minimização dos dados);</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; - Os dados pessoais do usuário serão exatos e atualizados sempre que necessário, de maneira que os dados inexatos sejam apagados ou retificados quando possível (exatidão);</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; - Os dados pessoais do usuário serão conservados de uma forma que permita a identificação dos titulares dos dados apenas durante o período necessário para as finalidades para as quais são tratados (limitação da conservação);</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; - Os dados pessoais do usuário serão tratados de forma segura, protegidos do tratamento não autorizado ou ilícito e contra a sua perda, destruição ou danificação acidental, adotando as medidas técnicas ou organizativas adequadas (integridade e confidencialidade).</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<p>O usuário do site possui os seguintes direitos, conferidos pela Lei de Proteção de Dados Pessoais e pelo RGPD:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Direito de confirmação e acesso: é o direito do usuário de obter do site a confirmação de que os dados pessoais que lhe digam respeito são ou não objeto de tratamento e, se for esse o caso, o direito de acessar e editar os seus dados pessoais;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Direito de retificação: é o direito do usuário de obter do site, sem demora injustificada, a retificação dos dados pessoais inexatos que lhe digam respeito;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Direito à eliminação dos dados (direito ao esquecimento): é o direito do usuário de ter seus dados apagados do site;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Direito à limitação do tratamento dos dados: é o direito do usuário de limitar o tratamento de seus dados pessoais, podendo obtê-la quando contesta a exatidão dos dados, quando o tratamento for ilícito, quando o site não precisar mais dos dados para as finalidades propostas e quando tiver se oposto ao tratamento dos dados e em caso de tratamento de dados desnecessários;</p>
<P>&nbsp; &nbsp; &nbsp; &nbsp;- Direito de oposição: é o direito do usuário de, a qualquer momento, se opor por motivos relacionados com a sua situação particular, ao tratamento dos dados pessoais que lhe digam respeito, podendo se opor ainda ao uso de seus dados pessoais para definição de perfil de marketing (profiling);</P>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Direito de portabilidade dos dados: é o direito do usuário de receber os dados pessoais que lhe digam respeito e que tenha fornecido ao site, num formato estruturado, de uso corrente e de leitura automática, e o direito de transmitir esses dados a outro site;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Direito de não ser submetido a decisões automatizadas: é o direito do usuário de não ficar sujeito a nenhuma decisão tomada exclusivamente com base no tratamento automatizado, incluindo a definição de perfis (profiling), que produza efeitos na sua esfera jurídica ou que o afete significativamente de forma similar.</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<p>O usuário poderá exercer os seus direitos por meio de comunicação escrita enviada ao site com o assunto "RGDP-http://www.wimoficial.com.br", especificando:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p>- Nome completo ou razão social, número do CPF (Cadastro de Pessoas Físicas, da Receita Federal do Brasil) e endereço de e-mail do usuário e, se for o caso, do seu representante;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Direito que deseja exercer junto ao site;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Data do pedido e assinatura do usuário;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Todo documento que possa demonstrar ou justificar o exercício de seu direito.</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<p>O pedido deverá ser enviado ao e-mail: companywim@gmail.com, ou por correio, ao seguinte endereço:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p><b>&nbsp; &nbsp; &nbsp; &nbsp;World In Money</b></p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;Rua Madre Tereza, 76 - Europa, Belo Horizonte - MG</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
O usuário será informado em caso de retificação ou eliminação dos seus dados.<br><br>
<h5><b>3. Dever de não fornecer dados de terceiros</h5></b>
<p>Durante a utilização do site, a fim de resguardar e de proteger os direitos de terceiros, o usuário do site deverá fornecer somente seus dados pessoais, e não os de terceiros.</p><br>
<h5><b>4. Tipos de dados coletados</h5></b>
<h5><b>4.1 Dados de identificação do usuário para realização de cadastro</h5></b>
<p>A utilização pelo usuário, de determinadas funcionalidades do site dependerá de cadastro, sendo que, nestes casos, os seguintes dados do usuário serão coletados e armazenados:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Nome</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Data de nascimento</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Endereço de e-mail</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Sexo</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Estado</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Endereço postal</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Complemento</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Número de telefone</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Número de CPF</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<h5><b>4.1.1 Dados informados no formulário de contato</h5></b>
<p>Os dados eventualmente informados pelo usuário que utilizar o formulário de contato disponibilizado no site, incluindo o teor da mensagem enviada, serão coletados e armazenados.</p>
<h5><b>4.1.2 Newsletter</h5></b>
<p>O endereço de e-mail cadastrado pelo usuário que optar por se inscrever em nossa Newsletter será coletado e armazenado até que o usuário solicite seu descadastro.</p>
<h5><b>4.1.3 Dados sensíveis</h5></b>
<p>O site poderá coletar os seguintes dados sensíveis dos usuários:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Dados relativos à vida sexual ou à orientação sexual do usuário</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Banco no qual tem a conta bancária, número de agência, número de conta e outros dados bancários se necessário</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<h5><b>4.2 Fundamento jurídico para o tratamento dos dados pessoais</h5></b>
<p>Ao utilizar os serviços do site, o usuário está consentindo com a presente Política de Privacidade.</p>
<p>O usuário tem o direito de retirar seu consentimento a qualquer momento, não comprometendo a licitude do tratamento de seus dados pessoais antes da retirada. A retirada do consentimento poderá ser feita pelo e-mail: companywim@gmail.com, ou por correio enviado ao seguinte endereço:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p>&nbsp; &nbsp; &nbsp; &nbsp;Rua Madre Tereza, 76 - Europa, Belo Horizonte - MG</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<P>O consentimento dos relativamente ou absolutamente incapazes, especialmente de crianças menores de 16 (dezesseis) anos, apenas poderá ser feito, respectivamente, se devidamente assistidos ou representados.</P>
<p>O tratamento de dados pessoais sem o consentimento do usuário apenas será realizado em razão de interesse legítimo ou para as hipóteses previstas em lei, ou seja, dentre outras, as seguintes:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para o cumprimento de obrigação legal ou regulatória pelo controlador;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para a realização de estudos por órgão de pesquisa, garantida, sempre que possível, a anonimização dos dados pessoais;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Quando necessário para a execução de contrato ou de procedimentos preliminares relacionados a contrato do qual seja parte o usuário, a pedido do titular dos dados;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para o exercício regular de direitos em processo judicial, administrativo ou arbitral, esse último nos termos da Lei nº 9.307, de 23 de setembro de 1996 (Lei de Arbitragem);</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para a proteção da vida ou da incolumidade física do titular dos dados ou de terceiro;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para a tutela da saúde, em procedimento realizado por profissionais da área da saúde ou por entidades sanitárias</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Quando necessário para atender aos interesses legítimos do controlador ou de terceiro, exceto no caso de prevalecerem direitos e liberdades fundamentais do titular dos dados que exijam a proteção dos dados pessoais;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para a proteção do crédito, inclusive quanto ao disposto na legislação pertinente.</p><br>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<h5><b>4.3 Finalidades do tratamento dos dados pessoais</h5></b>
<p>Os dados pessoais do usuário coletados pelo site têm por finalidade facilitar, agilizar e cumprir os compromissos estabelecidos com o usuário e a fazer cumprir as solicitações realizadas por meio do preenchimento de formulários.</p>
<p>Os dados pessoais poderão ser utilizados também com uma finalidade comercial, para personalizar o conteúdo oferecido ao usuário, bem como para dar subsídio ao site para a melhora da qualidade e funcionamento de seus serviços.</p>
<p>O site recolhe os dados do usuário para que seja realizada definição de perfis (profiling), ou seja, tratamento automatizado de dados pessoais que consista em utilizar estes dados para avaliar certos aspectos pessoais do usuário, principalmente para analisar ou prever características relacionadas ao seu desempenho profissional, a sua situação econômica, saúde, preferências pessoais, interessesm fiabilidade, comportamento, localização ou deslocamento.</p>
<p>Os dados de cadastro serão utilizados para permitir o acesso do usuário a determinados conteúdos do site, exclusivos para usuários cadastrados.</p>
<p>O tratamento de dados pessoais para finalidades não previstas nesta Política de Privacidade somente ocorrerá mediante comunicação prévia ao usuário, sendo que, em qualquer caso, os direitos e obrigações aqui previstos permanecerão aplicáveis.</p>
<h5><b>4.4 Prazo de conservação dos dados pessoais</h5></b>
<p>Os dados pessoais do usuário serão conservados por um período não superior ao exigido para cumprir os objetivos em razão dos quais eles são processados.</p>
<p>O período de conservação dos dados são definidos de acordo com os seguintes critérios:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p>&nbsp; &nbsp; &nbsp; &nbsp;Os dados serão armazenados pelo tempo necessário para a prestação dos serviços fornecidos pelo site, que pode variar de 1 a 6 meses, de acordo com o status do pedido da pessoa.</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<p>Os dados pessoais dos usuários apenas poderão ser conservados após o término de seu tratamento nas seguintes hipóteses:</p>
<!-- FAZER ESPAÇAMENTO-->
<!-- FAZER ESPAÇAMENTO-->
<p>&nbsp; &nbsp; &nbsp; &nbsp;-  Para o cumprimento de obrigação legal ou regulatória pelo controlador;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para estudo por órgão de pesquisa, garantida, sempre que possível, a anonimização dos dados pessoais;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para a transferência a terceiro, desde que respeitados os requisitos de tratamento de dados dispostos na legislação;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp;- Para uso exclusivo do controlador, vedado seu acesso por terceiro, e desde que anonimizados os dados.</p>
<!-- FECHAR ESPAÇAMENTO-->
<!-- FECHAR ESPAÇAMENTO-->
<h5><b>4.5 Destinatórios e transferência dos dados pessoais</h5></b>
<P>Os dados pessoais do usuário poderão ser compartilhados conforme alguma pessoa ou empresa entre em contato pelo e-mail: companywim@gmail.com, com o comprometimento de transferir em segurança os dados do usuário e apenas se os dados forem utilizados para realização de pesquisas sociais.</P>
<p>Aa transferência apenas poderá ser feita para outro país caso o país ou território em questão ou a organização internacional em causa assegurem um nível de proteção adequado dos dados do usuário.</p>
<p>Caso não haja nível de proteção adequado, o site se compromete a garantir a proteção dos seus dados de acordo com as regras mais rigorosas, por meio de cláusulas contratuais específicas e códigos de conduta regularmente emitidos.</p><br>
<h5><b>5 Do tratamento dos dados pessoais</h5></b>
<h5><b>5.1 Do responsável pelo tratamento dos dados (data controller)</h5></b>
<p>O controlador, responsável pelo tratamento dos dados pessoais do usuário, é a pessoa física ou jurídica, a autoridade pública, a agência ou outro organismo que, individualmente ou em conjunto com outras, determina as finalidades e os meios de tratamento de dados pessoais.</p>
<P>Neste sitem o responsável pelo tratamento dos dados pessoais coletados é <b>Ítalo Chaves De Almeida Camargo</b>, que poderá ser contactado pelo e-mail: italoalmeida440@hotmail.com ou presencialmente no endereço:</P>
<P>&nbsp; &nbsp; &nbsp; &nbsp;Rua Madre Tereza, 76 - Europa, Belo Horizonte - MG</P>
<p>O site possui também os seguintes responsáveis pelo tratamento dos dados pessoais coletados:</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Lorena Alves Vasconcelos de Assis, lorena.alves345@gmail.com, Rua Bahia, bairro Vila Universal, nº416, Betim, MG. </p>

<h5><b>5.2 Do operador de dados  subcontratado (data processor)</h5></b>
<p>O operador de dados subcontratado é a pessoa física ou jurídica, a autoridade pública, a agência ou outro organismo que trata os dados pessoais sob a supervisão do responsável pelo tratamento dos dados do usuário.</p>
<p>Os dados pessoais do usuário serão tratados por <b>Lorena Alves Vasconcelos de Assis</b>, e-mail: lorena.alves345@gmail.com, com endereço à:</p>
  <p>&nbsp; &nbsp; &nbsp; &nbsp; R. Bahia, 416 - Vl Universal, Betim, MG.</p>
<h5><b>5.3 Do encarregado de proteção de dados (data protection officer)</h5></b>
<p>O encarregado de proteção de dados (data protection officer) é o profissional encarregado de informar, aconselhar e controlar o responsável pelo tratamento dos dados e o processador de dados subcontratado, bem como os trabalhadores que tratem os dados, a respeito das obrigações do site nos termos do RGDP, da Lei de Proteção de Dados Pessoais e de outras disposições de proteção de dados presentes na legislação nacional e internacional, em cooperação com a autoridade de controle competente.</p>
<p>Neste site o encarregado de proteção de dados (data protection officer) é Ítalo Chaves De Almeida Camargo, que poderá ser contactado pelo e-mail: italoalmeida440@hotmail.com.</p><br>
<h5><b>6 Segurança no tratamento dos dados pessoais do usuário</h5></b>
<P>O site se compromete a aplicar as medidas técnicas e organizativas aptas a proteger os dados pessoais de acessos não autorizados e de situações de destruição, perda, alteração, comunicação ou difusão de tais dados.</P>
<p>Para garantia da segurança, serão adotadas soluções que levem em consideração: as técnicas adequadas; os custos de aplicação; a natureza. o âmbito, o contexto e as finalidades do tratamento; e os riscos para os direitos e liberdades do usuário</p>
<p>O site utiliza certificado SSL (Secure Socket Layer) que garante que os dados pessoais se transmitam de forma segura e confidencial, de maneira que a transmissão dos dados entre o servidor e o usuário, e em retroalimentação, ocorra de maneira totalmente cifrada ou encriptada.</p>
<p>No entanto, o site não se exime de responsabilidade por culpa exclusiva de terceiro, como em caso de ataque de hackers ou crackers, ou culpa exclusiva do usuário, como no caso em que ele mesmo transfere seus dados a terceiro. O site não se compromete a comunicar ao usuário caso ocorra algum tipo de violação da segurança de seus dados pessoais que possa lhe causar um alto risco para seus direitos e liberdades pessoais.</p>
<P>A violação de dados pessoais é uma violação de segurança que provoque, de modo acidental ou ilícito, a destruição, a perda, a alteração, a divulgação ou o acesso não autorizados a dados pessoais transmitidos, conservados ou sujeitos a qualquer outro tipo de tratamento.</P>
<P>Por fim, o site se compromete a tratar os dados pessoais do usuário com confidencialidade, dentro dos limites legais.</P>
<h5><b>7 Dados de navegação (cookies)</h5></b>
<p>Cookies são pequenos arquivos de texto enviados pelo site ao computador do usuário e que nele ficam armazenados, com as informações relacionadas à navegação do site.</p>
<p>Por meio dos cookies, pequenas quantidades de informação são armazenadas pelo navegador do usuário para que nosso servidor possa lê-las posteriormente. Podem ser armazenados, por exemplo, dados sobre o dispositivo utilizado pelo usuário, bem como seu local e horário de acesso ao site.</p>
<p>Os cookies não permitem que qualquer arquivo ou informação sejam extraídos do disco rígido do usuário, não sendo possível, ainda, que, por meio deles, se tenha acesso a informações pessoais que não tenham partido do usuário ou da forma como utiliza os recursos do site.</p>
<p>É importante ressaltar que nem todo cookie contém informações que permitem a identificação do usuário, sendo que determinados tipos de cookies podem ser empregados simplesmente para que o site sejam carregado corretamente ou para que suas funcionalidades funcionem do modo esperado.</p>
<p>As informações eventualmente armazenadas em cookies que permitam identificar um usuário são consideradas dados pessoais. Dessa forma, todas as regras previstas nesta Política de Privacidade também lhes são aplicáveis.</p>
<h5><b>7.1 Cookies do site</h5></b>
<p>Os cookies do site são aqueles enviados ao computador ou dispositivo do usuário e administrador exclusivamente pelo site
.</p>
<p>As informações coletadas por meio destes cookies são utilizadas para melhorar e personalizaar a experiência do usuário, sendo que alguns cookies podem, por exemplo, ser utilizados para lembrar as preferências e escolhas do usuário, bem como para oferecimento de conteúdo personalizado.</p>
<p>Estes dados de navegação poderão, ainda, ser compartilhados com eventuais parceiros do site, buscando o aprimoramento dos produtos e serviços ofertados ao usuário.</p>
<h5><b>7.2 Cookies de redes sociais</h5></b>
O site poderá utilizar plugins de redes sociais, que permitem acessá-las a partir do site. Assim, ao fazê-lo, os cookies utilizados por elas poderão ser armazenados no navegador do usuário.
<p>Cada rede social possui uma própria política de privacidade e de proteção de dados pessoais, sendo as pessoas físicas ou jurídicas que as mantém responsáveis pelos dados coletados e pelas práticas de privacidade adotadas.</p>
<p>O usuário pode pesquisar, junto às redes sociais, informações sobre como seus dados pessoais são tratados. A título informativo, disponibilizamos os seguintes links, a partir dos quais poderão ser consultadas as políticas de privacidade e de cookies adotadas por algumas das principais redes sociais:</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Facebook: https://www.facebook.com/policies/cookies/</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Twitter: https://www.twitter.com/pt/privacy</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Instagram: https://pt-br.facebook.com/help/instagram/155833707900388/</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Youtube: https://www.youtube.com/intl/pt-BR/yt/about/policies/</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Google+: https://policies.google.com/privacy?hl=pt-BR</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; LinkedIn: https://www.linkedin.com/legal/privacy-policy?_l=pt_BR</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Whatsapp: https://www.whatsapp.com/legal</p>
<h5><b>7.3 Gestão dos cookies e configurações do navegador</h5></b>
<p>O usuário poderá se opor ao registro de cookies pelo site, bastando que desative esta opção no seu próprio navegador ou aparelho.</p>
<p>A desativação dos cookies, no entanto, pode afetar a disponibilidade de algumas ferramentas e funcionalidades do site, comprometendo seu correto e esperado funcionamento. Outra consequência possível é remoção das preferências do usuário que eventualmente tiverem sido salvas, prejudicando sua experiência.</p>
<p>A seguir, são disponibilizados alguns links para as páginas de ajuda e suporte dos navegadores mais utilizados, que poderão ser acessadas pelo usuário interessado em obter mais informações sobre a gestão de cookies em seu navegador:</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Internet Explorer:<br>
&nbsp; &nbsp; &nbsp; &nbsp; https://support.microsoft.com/pt-br/help/17442/windows-internet-explorer-delete-manage-cookies</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Safari:<br>
&nbsp; &nbsp; &nbsp; &nbsp; https://support.apple.com/pt-br/guide/safari/sfri11471/mac</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Google Chrome:<br>
&nbsp; &nbsp; &nbsp; &nbsp; https://support.google.com/chrome/answer/95647?co=GENIE.Platform%3DDesktop&hl=pt-BR</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; Mozila Firefox:<br>
&nbsp; &nbsp; &nbsp; &nbsp; https://support.mozilla.org/pt-PT/kb/ativar-desativar-cookies-websites-utilizam-monitorizar-preferencias</p><br>
<h5><b>8. Das alterações</h5></b>
<p>A presente versão desta Política de Privacidade foi atualizada pela última vez em: 16/02/2019</p>
<p>O editor se reserva o direito de modificar, a qualquer momento o site as presentes normas, especialmente para adaptá-las às evoluções do site <b>wimoficial.com.br</b>, seja pela disponibilização de novas funcionalidades, seja pela supressão ou modificação daquelas já existentes.</p>
<p>O usuário será explicitamente notificado em caso de alteração desta política.</p>
<P>Ao utilizar o serviço após eventuais modificações, o usuário demonstra sua concordância com as novas normas. Caso discorde de alguma das modificações, deverá pedir, imediatamente, o cancelamento de sua conta e apresentar a sua ressalva ao serviço de atendimento, se assim o desejar.</P><br>
<h5><b>9. Do direito aplicável e do foro</h5></b>
<p>Para a solução das controvérsias decorrentes do presente instrumento, será aplicado integralmente o Direito brasileiro.</p>
<p>Os eventuais litígios deverão ser apresentados no foro da comarca em que se encontra a sede do editor do site.</p>
</div>
</div>
</div>
<footer role="contentinfo" class="global-footer">
    <div class="containerCentered containerExtend">
        <div style="text-align: right;">

            
<hr>

&copy; 2019

            
<a style="color: gray" href="contrato.php">Contrato do Usuário -</a>
<a style="color: gray" href="privacidade.php"> Política de Privacidade -</a>
<a style="color: gray" href="termos.php"> Termos e Condições</a>

<br>
        
</div><br>
</footer>



    
<script nonce="3OT4MQKBzIr3pJ9DK3fqm8S/Am2YEa9SNjpYC1WmZBLEw2Xo"  >
  
  var dataLayer = {

    
    contentCountry: 'BR'.toLowerCase(),

    
    contentLanguage: 'pt'.toLowerCase(),

    
    localTimeZone: '',

    
    localTime: (new Date()).toString(),

    
    fptiGuid: 'b1287152168ac1200017fbecffff615c',

    
    gaCid: '',

    
    gaUid: ''
  };
</script>


<script nonce="rhnHYHk23Ek49z+zRSgsR1FU3Ru4A2PBtUQpokNYkqn30Mtq"  >
    var PP_GLOBAL_JS_STRINGS = {
        "CLOSE": "Fechar",
        "TOGGLE_FULL_SCREEN": "Ativar\/desativar tela cheia",
        "NO_PLAY_VIDEO": "Seu navegador não pode exibir este vídeo",
        "CLICK_TO_PLAY": "Pausado. Clique para reproduzir.",
        "PLAY": "Reproduzir",
        "PAUSE": "Pausar",
        "PLAY_OR_PAUSE": "Reproduzir ou Pausar",
        "MUTE": "Mudo",
        "SEEK_VIDEO": "Ir para outro ponto no vídeo",
        "REWIND": "" || "",
        "RESTART": "" || "",
        "FORWARD": "" || "",

        "MESSAGE_REQUIRED": "",
        "MESSAGE_REMOTE": "",
        "MESSAGE_EMAIL": "",
        "MESSAGE_EMAIL_OR_PHONE": "",
        "MESSAGE_URL": "",
        "MESSAGE_DATE": "",
        "MESSAGE_DATEISO": "",
        "MESSAGE_NUMBER": "",
        "MESSAGE_DIGITS": "",
        "MESSAGE_CREDITCARD": "",
        "MESSAGE_EQUALTO": "",
        "MESSAGE_ACCEPT": "",
        "MESSAGE_MAXLENGTH": "",
        "MESSAGE_MINLENGTH": "",
        "MESSAGE_RANGELENGTH": "",
        "MESSAGE_RANGE": "",
        "MESSAGE_MAX": "",
        "MESSAGE_MIN": "",
        "MESSAGE_BADPHONE": ""
    };

    var HOLIDAYS = '';

    var BROWSER_TYPE = 'Chrome';
</script>
 <script src="https://www.paypalobjects.com/eboxapps/js/1d/1c06df09a4940ccd6ff56918d5e8313b800289.js"></script>    
<script nonce="rhnHYHk23Ek49z+zRSgsR1FU3Ru4A2PBtUQpokNYkqn30Mtq"  >
  
  var dataLayer = {

    
    contentCountry: 'BR'.toLowerCase(),

    
    contentLanguage: 'pt'.toLowerCase(),

    
    localTimeZone: '',

    
    localTime: (new Date()).toString(),

    
    fptiGuid: 'b1287152168ac1200017fbecffff615c',

    
    gaCid: '',

    
    gaUid: ''
  };
</script>





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



<script nonce="3OT4MQKBzIr3pJ9DK3fqm8S/Am2YEa9SNjpYC1WmZBLEw2Xo"  >
    $(document).ready(function(){
        if(window.console || "console" in window) {
            console.log("%c WARNING!!!", "color:#FF8F1C; font-size:40px;");
            console.log("%c This browser feature is for developers only. Please do not copy-paste any code or run any scripts here. It may cause your PayPal account to be compromised.", "color:#003087; font-size:12px;");
            console.log("%c For more information, http://en.wikipedia.org/wiki/Self-XSS", "color:#003087; font-size:12px;");
        }
    });
</script>





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
