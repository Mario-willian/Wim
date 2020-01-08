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
<title>WIM | Contrato do Usuário</title>
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

  <!-- Header -->
 <div role="main" id="main" class="containerMobileFullWidth">
      <form action="contrato.pdf">
<section class="row-fluid">
  <div class="containerCentered"><section id="content"> <section id="headline"> <h1 class="accessAid">Contrato do Usuário</h1> </section><BR>  <h3>Contrato do Usu&aacute;rio da WIM</h3> <p>Data de vig&ecirc;ncia:&nbsp;<strong>Voc&ecirc; concorda que esta vers&atilde;o do Contrato do Usu&aacute;rio da WIM entra em vigor em 16 de janeiro de 2019.</strong></p> <p>&nbsp;</p> <div id="ua_skinny_view" style="text-align: right;">  <div id="ua_skinny_view" style="text-align: right;">
      <button id="print" class="btn btn-outline-dark"><img src="imagens/print.png" style="width: 50px"><B> IMPRIMIR</B></button>
    
      <button type="submit" id="print" class="btn btn-outline-success"><img src="imagens/d.png" style="width: 50px"><B> BAIXAR PDF</B></button>
  </div> </div> <p><a name="top"></a>&nbsp;</p> <p><strong>Ir para se&ccedil;&atilde;o:</strong></p> <p><a href="#1"><strong>1. Introdu&ccedil;&atilde;o e Informa&ccedil;&otilde;es Relevantes a voc&ecirc;.</strong></a><br /> <a href="#2"><strong>2. Servi&ccedil;os de Pagamento e Elegibilidade.</strong></a><br /> <a href="#3"><strong>3. Envio de pagamentos.</strong></a>&nbsp;<br />  <a href="#5"><strong>4. Saldos em sua Conta.</strong></a><br /> <a href="#6"><strong>5. Retirada de recursos.</strong></a><br /> <a href="#7"><strong>6. Encerramento de Conta.</strong></a><br /> <a href="#8"><strong>7. Erros e Pagamentos Não Autorizados.</strong></a><br /> <a href="#10"><strong>8. Sistema de Trocas.</strong></a><br /> &nbsp;</p> <p>Este Contrato do Usu&aacute;rio (&quot;<u>Contrato</u>&quot;) &eacute; um contrato celebrado entre voc&ecirc; e a WIM. (&quot;<u>World In Money</u>&quot;), uma sociedade constitu&iacute;da de acordo com as leis do Brasil, localizada na rua Madre Tereza, 76, 3&deg; andar, CEP 31620260, na cidade de Belo Horizonte, Estado de Minas Gerais, e regula os termos e condi&ccedil;&otilde;es da presta&ccedil;&atilde;o a voc&ecirc; dos Servi&ccedil;os da WIM.</p> <p>Todos os termos iniciados em mai&uacute;scula neste documento ter&atilde;o os significados a eles atribu&iacute;dos na Cl&aacute;usula 16 (<em>Defini&ccedil;&otilde;es</em>) abaixo.</p> <p>&nbsp;</p> <p><a name="1"></a>1. Introdu&ccedil;&atilde;o e Informa&ccedil;&otilde;es Relevantes a Voc&ecirc;.</p> <p><strong>1.1</strong>&nbsp;A WIM é uma instituição de arrecadação de dinheiro através de propagandas assistidas pelo usuário sendo também possível sacar e doar seu dinheiro arrecadado entre outros serviços inclusos como certificados e suporte ao usuário.</p> <p><strong>1.2</strong>&nbsp;Ao se tornar um Usu&aacute;rio da WIM voc&ecirc; concorda com todos os termos e condi&ccedil;&otilde;es contidos neste Contrato e com quaisquer outros termos e condi&ccedil;&otilde;es constantes na p&aacute;gina <a href="termos.php"><strong>Termos e Condi&ccedil;&otilde;es</strong></a>.</p> <p><strong>1.3</strong>&nbsp;A WIM reserva-se o direito de alterar os termos deste Contrato a qualquer momento, sem aviso pr&eacute;vio, bastando, para tanto, postar uma vers&atilde;o revisada em seu website, por meio do <a href="contrato.php"><strong>link do Contrato do Usu&aacute;rio</strong></a><strong>.&nbsp;</strong>Qualquer nova vers&atilde;o revisada entrar&aacute; em vigor assim que postada no link acima mencionado. Se tal vers&atilde;o incluir alguma Altera&ccedil;&atilde;o Substancial, n&oacute;s o informaremos com no m&iacute;nimo 1 (hum) dia de anteced&ecirc;ncia por e-mail ou postando um aviso na p&aacute;gina &ldquo;Atualiza&ccedil;&otilde;es dos contratos&rdquo; de nosso website, por meio do link <a href="atualizacao.php"><strong>Atualiza&ccedil;&otilde;es dos contratos</strong></a>.</p> <p><strong>1.3.1</strong>&nbsp;A continuidade no uso dos servi&ccedil;os da WIM pelo Usu&aacute;rio ap&oacute;s a entrada em vigor de nova vers&atilde;o revisada deste Contrato implicar&aacute; automaticamente a plena ci&ecirc;ncia e aceita&ccedil;&atilde;o pelo usu&aacute;rio de todos os seus termos e condi&ccedil;&otilde;es.</p> <p><strong>1.4</strong>&nbsp;Este Contrato &eacute; um documento importante, o qual voc&ecirc; deve avaliar atentamente antes de decidir se tornar um usu&aacute;rio da WIM, apto a utilizar os Servi&ccedil;os da WIM. Observe os seguintes riscos inerentes ao uso dos Servi&ccedil;os da WIM:</p> <ol> <li>Ao se tornar um Usu&aacute;rio da WIM, voc&ecirc; pode atuar tanto como Usu&aacute;rio doador, adquirindo certificado, utilizando a WIM como instrumento de pagamento, podendo realizar saque de sua carteira, ou como Usu&aacute;rio anunciante, anunciando produtos e/ou prestando servi&ccedil;os. </li> 


    <li>A WIM realiza transferência de saques dos usuários manualmente para uma maior segurança e poderá ser acompanhado a data de liberação de saque na página acompanhar após logado na plataforma;</li> 

    <li>Usuários terão apenas do dia 5 dias para realizar seus saques, após isso o saque só será liberado no mês seguinte nos dias 5 a 10;</li> 

    <li>A WIM reserva-se o direito de encerrar, suspender ou limitar o seu acesso &agrave; sua Conta ou aos Servi&ccedil;os do PayPal e/ou limitar o acesso aos seus recursos detidos em sua Conta caso voc&ecirc; viole este Contrato, a Pol&iacute;tica de Uso Aceit&aacute;vel da WIM ou qualquer outro contrato que voc&ecirc; tenha firmado com a WIM. Tal disposi&ccedil;&atilde;o aplica-se tanto se voc&ecirc; estiver atuando como um Usu&aacute;rio Doador ou um Usu&aacute;rio Recebedor.</li> </ol>

     <p>&nbsp;</p> <p align="right"><a href="#top"><strong>Voltar para o in&iacute;cio</strong></a></p> <p><a name="2"></a>2. Servi&ccedil;os de Pagamento e Elegibilidade.</p> <p><strong>2.1 Servi&ccedil;os de Pagamento.</strong>&nbsp;A WIM registra pessoas f&iacute;sicas para que elas se tornem Usu&aacute;rios Recebedores para que assim possam receber dinheiro resultantes de suas propagandas assistidas na plataforma, no qual, seu dinheiro arrecadado só poderá sacar nos dias 5 a 10 do mês, após esta data a WIM se compromete a travar o sistema de transfêrencia bancária.; </p> 
     <p><strong>2.1.1</strong>&nbsp;
     Além de ter uma data específica para transfêrencia bancária, a WIM tem como forma de cobrança, cobrar uma taxa de R$ 1,00 (hum real) para transferência.</p>
        <p><strong>2.2</strong>&nbsp;
     A WIM tem o requisito mínimo de R$ 10,00 (dez reais) de saldo em sua carteira WIM para realizar saques.</p>
     <p><strong>2.2.2</strong>&nbsp;
     A WIM se compromete pegar em até 70% do valor das propagandas anunciadas no site sendo distribuido 30% para o usuário que assistiu. O valor é calculado através de CPV (Custo por Visualização).</p>

   <p><strong>2.3 Informa&ccedil;&otilde;es.</strong>&nbsp;Para abrir uma Conta na WIM, é importante voc&ecirc; deve fornecer-nos informa&ccedil;&otilde;es corretas e atualizadas, conforme abaixo:</p> <ol style="list-style-type:lower-alpha;"> <li><strong>Verifica&ccedil;&atilde;o de identidade.</strong>&nbsp;A WIM, tem como serviço de segurança enviar um e-mail para a caixa de entrada do e-mail do usuário registrado em sua conta para a verificação de identidade. Para que o usuário confirme a realização de saque em sua conta.</li> <li><strong>Atualização das informações.</strong>É de extrema importância que a WIM recomenda, os dados verídicos do usuário na hora de seu cadastro. Caso você tenha que alterar algum dado, acesse a sua conta, vá para a aba conta e clique no botão Editar Dados para alterar..</li> </ol> <p align="right"><a href="#top"><strong>Voltar para o in&iacute;cio</strong></a></p>
       <p><a name="3"></a><strong>3. Envio de Pagamentos.</p></strong> <p><strong>3.1 Dados.</strong>&nbsp;A WIM recolhe apenas os dados necessários da conta bancária do usuário para a realização da transferência, sendo eles:</p>
       <P>&nbsp; &nbsp; &nbsp; &nbsp;- Nome do Banco</P>
       <P>&nbsp; &nbsp; &nbsp; &nbsp;- Tipo de conta (corrente ou poupança)</P>
       <P>&nbsp; &nbsp; &nbsp; &nbsp;- Número da agência.</P> 
       <P>&nbsp; &nbsp; &nbsp; &nbsp;- Número da conta.</P>
       <P>&nbsp; &nbsp; &nbsp; &nbsp;- Quantia a sacar na carteira WIM.</P><p>
        <strong>3.2 Limites de envio.</strong>&nbsp;Não há limite de envio de saques, contando que você tenha o valor inserido em sua carteira WIM. Sendo o mínimo de R$ 10,00 (dez reais).</p> <p><strong><em>3.</em></strong>
          <strong>3&nbsp;Meios</strong>&nbsp;<strong>de</strong>&nbsp;<strong>Pagamento Padr&atilde;o<em>.&nbsp;</em></strong>Ao se cadastrar o usuário concorda que a WIM só tem um único meio de pagamento que é a transferência bancária, e que em caso de informar alguma informação incorreta de sua conta bancária, a WIM irá enviar pelo e-mail para confirmação de seus dados e de realização do saque, caso o usuário confirme sem verificar se seus dados estão corretos o usuário não poderá cancelar a transação e nem pedir o dinheiro de volta sendo o erro de sua total responsabilidade. </p> <ol style="list-style-type:lower-alpha;"> </ol> 
          <p><strong>3.4 Verifica&ccedil;&atilde;o dos Meios de Pagamento.</strong></p> <p><strong>3.4.1</strong>&nbsp;Verificação de realização de saque. Ao solicitar o saque, o usuário deverá entrar em seu e-mail registrado no seu cadastro WIM, sendo assim confirmando, através pelo nosso e-mail enviado, respondendo o nosso e-mail com o nome do assunto o número em que enviamos para confirmação.</p> <p><strong>3.4.2</strong>&nbsp;Verificação de dados bancários. O usuário se compromete como total responsável em inserção de dados incorretos, caso confirme o desejo de sacar o dinheiro sem a verificação dados bancários antes.</p> 
<p><strong>3.5 Reembolsos</strong>. Quando você realiza uma doação vale ressaltar que a WIM não irá devolver o seu dinheiro. </p> <p><strong>3.6 Cancelamento de Saque.</strong>&nbsp;Os Usu&aacute;rios poderão cancelar a transferência bancária não respondendo o nosso e-mail de confirmação.</p> 

<p><strong>3.7 Atraso de transferência bancária para o usuário.</strong>&nbsp;Em caso de atraso para a transferência bancária do usuário, verifique se você inseriu os dados corretos em nosso e-mail de confirmação, caso esteja correto, o seu dinheiro irá cair em até 5 dias úteis após o pedido para sacar.</p> <p><strong>3.10 Conta Bancária.</strong>&nbsp;Todas as informa&ccedil;&otilde;es pessoais dos Usu&aacute;rios armazenadas pela WIM s&atilde;o mantidas confidenciais.</p> 
 <p align="right"><a href="#top"><strong>Voltar para o in&iacute;cio</strong></a></p>  <p><a name="5"></a>4. Saldos em sua Conta.</p> <p><strong>4.1 Saldos em sua Conta WIM</strong>. Você poderá somente visualizar o saldo de sua carteira WIM caso esteja logado, na aba carteira.</p> <p><strong>4.1.1</strong>&nbsp;A WIM se compromete a entregar no mínimo 30% do valor assistido do usuário sobre a propaganda,  somente na propaganda clicada no botão ganhar dinheiro na aba carteira. A WIM não irá dar ao usuário nenhuma quantia sobre quaisquer outros anúncios inseridos no site.</p>  <p><strong>4.2 Saldos em reais.</strong>&nbsp;O valor de seu saldo é dado em reais, podendo somente realizar o saque para usuários localizados no Brasil.</p> <p>&nbsp;</p> <p align="right"><a href="#top"><strong>Voltar para o in&iacute;cio</strong></a></p>
 <p><a name="6"></a>5. Retirada de Recursos.</p> <p><strong>5.1 Como retirar recursos.</strong>&nbsp;Voc&ecirc; poder&aacute; retirar recursos de sua Conta da WIM no Brasil, sendo um destes recursos o certificado de doador na aba total se garantindo com um total de R$ 100,00 reais (cem reais).</p> <p><strong>5.2 Limites de retirada.</strong>&nbsp;Não há limite contando com que o usuário tenho o valor inserido em sua carteira WIM.</p> <p><strong>5.3 Convers&atilde;o de Moeda.</strong>&nbsp;A WIM não converte sua moeda, sendo somente em reais. </p> <p>&nbsp;</p> <p align="right"><a href="#top"><strong>Voltar para o in&iacute;cio</strong></a></p> <p><a name="7"></a>6. Encerramento de Conta.</p> <p><strong>6.1 Encerramento de sua conta.</strong>&nbsp;Você poderá a qualquer momento cancelar sua conta, caso queria fazer este procedimento é necessário você estar logado e ir em configurações, clicando no botão vermelho Excluir conta.</p> <p><strong>6.2 Procedimento de segurança no encerramento de sua conta.</strong>&nbsp;Ao você optar em excluir sua conta, a wim tem como procedimento de segurança solitando o usuário a inserir novamente sua senha para a confirmação.</p> <p>&nbsp;</p> <p align="right"><a href="#top"><strong>Voltar para o in&iacute;cio</strong></a></p> <p><a name="8"></a>

  <p><a name="9"></a>7. Erros e Pagamentos N&atilde;o Autorizados.</p> <p><strong>7.1 Prote&ccedil;&atilde;o contra Erros e Pagamentos N&atilde;o Autorizados</strong>. Caso ocorra um Erro ou Pagamento n&atilde;o autorizado em sua conta, a WIM lhe devolver&aacute; o valor integral correspondente ao Pagamento n&atilde;o autorizado ou ao Erro, desde que a opera&ccedil;&atilde;o seja eleg&iacute;vel e contanto que voc&ecirc; siga os procedimentos descritos a seguir.</p> <p><strong>7.1.1</strong>&nbsp;O Pagamento N&atilde;o Autorizado caracteriza-se pelo envio de um pagamento, por meio de sua Conta, que n&atilde;o tenha sido autorizado por voc&ecirc;, Usu&aacute;rio Pagador, e que n&atilde;o o beneficie. Por exemplo, se algu&eacute;m furtar sua senha e us&aacute;-la para acessar e enviar um pagamento por meio da sua Conta, verifica-se um Pagamento N&atilde;o Autorizado. Caso voc&ecirc;, Usu&aacute;rio Pagador, conceda a uma pessoa acesso &agrave; sua Conta (fornecendo-lhe seu nome de usu&aacute;rio e senha), e essa pessoa efetuar transa&ccedil;&otilde;es sem seu conhecimento ou permiss&atilde;o, voc&ecirc; ser&aacute; o respons&aacute;vel por tal Pagamento N&atilde;o Autorizado.</p> <p><strong>7.1.2</strong>&nbsp;Um Erro ocorre quando no seu Perfil da Conta ou atividade ou na confirma&ccedil;&atilde;o da transa&ccedil;&atilde;o enviada para voc&ecirc; por e-mail ocorre um erro de processamento incluindo, mas sem se limitar ao valor debitado, transa&ccedil;&otilde;es pendentes e/ou transfer&ecirc;ncias pr&eacute;-autorizadas.</p> <p>&nbsp;</p> <p><strong>7.2 Requisitos para notifica&ccedil;&atilde;o.&nbsp;</strong>Voc&ecirc;, Usu&aacute;rio Pagador, deve notificar a WIM imediatamente se tiver motivos para acreditar que:</p> <ol style="list-style-type:lower-alpha;"> <li>houve um acesso ou um Pagamento N&atilde;o Autorizado em sua Conta;&nbsp;</li> <li>houve um Erro no hist&oacute;rico da sua Conta (voc&ecirc; pode acess&aacute;-lo entrando em sua Conta e clicando no link &ldquo;Exibir todas as minhas transa&ccedil;&otilde;es&rdquo;) ou na confirma&ccedil;&atilde;o de uma transa&ccedil;&atilde;o enviada a voc&ecirc; por e-mail;</li> <li>houve um Erro nos valores debitados de voc&ecirc;, em uma cobran&ccedil;a debitada de sua Conta, nas transa&ccedil;&otilde;es pendentes e/ou em transfer&ecirc;ncias pr&eacute;-autorizadas;</li> <li>sua senha ou senha de celular da WIM  foram violadas;</li> <li>seu celular ativado para a WIM foi perdido, furtado ou desativado; ou</li> <li>precisa de mais informa&ccedil;&otilde;es sobre uma transa&ccedil;&atilde;o relacionada no demonstrativo ou na confirma&ccedil;&atilde;o da transa&ccedil;&atilde;o.</li> </ol> <p><strong>7.3 Elegibilidade.</strong>&nbsp;Para qualificar-se para a prote&ccedil;&atilde;o contra Pagamentos N&atilde;o Autorizados voc&ecirc;, Usu&aacute;rio Pagador,&nbsp;deve notificar-nos em at&eacute; 60 (sessenta) dias da data em que o Pagamento N&atilde;o Autorizado for exibido pela primeira vez no hist&oacute;rico da sua Conta. N&oacute;s prorrogaremos esse prazo caso um motivo de for&ccedil;a maior &ndash; como uma interna&ccedil;&atilde;o hospitalar &ndash; o impe&ccedil;a de notificar-nos dentro de 60 (sessenta) dias.</p>   <p>&nbsp;</p> <p align="right"><a href="#top"><strong>Voltar para o in&iacute;cio</strong></a>
    <p><a name="10"></a>8. Sistemas de Trocas.</p> <p><strong>8.1 Prote&ccedil;&atilde;o contra Erros e Trocas N&atilde;o Realizadas</strong>. Caso ocorra um erro ou troca n&atilde;o realizada em sua conta, a WIM irá lhe devolver&aacute; o valor correspondente a troca na qual foi descontada em sua carteira WIM, desde que a opera&ccedil;&atilde;o seja eleg&iacute;vel e contanto que voc&ecirc; tenha seguido os procedimentos descritos antes da troca.</p> <p><strong>8.1.1</strong>&nbsp;A troca n&atilde;o realizada caracteriza-se pelo envio de solicitação de troca, por meio de sua conta, que n&atilde;o tenha sido autorizado por voc&ecirc;, usu&aacute;rio, e que n&atilde;o o beneficie. Por exemplo, se algu&eacute;m furtar sua senha da WIM, do seu e-mail e us&aacute;-la para acessar e enviar o código de troca do gift card por meio da sua conta, verifica-se uma troca n&atilde;o autorizada. Caso voc&ecirc;, Usu&aacute;rio, conceda a uma pessoa acesso &agrave; sua conta (fornecendo-lhe seu nome de usu&aacute;rio e senha), e essa pessoa efetuar trocas com ou sem seu conhecimento ou permiss&atilde;o, voc&ecirc; ser&aacute; o respons&aacute;vel por tal troca N&atilde;o autorizada.</p> <p><strong>8.1.2</strong>&nbsp;A WIM não têm procedimento de segurança para realizações de trocas, portanto, caso sua conta seja hackeada ou você deixe a mesma salva em algum dispositivo, a WIM não irá se responsabilizar. Recomendamos que nunca salva sua senha e que sempre realize o logout para evitar transtornos.</p> <p>&nbsp;</p> </ol> <p><strong>8.2 Prazo de Entrega do Código do Gift Card.</strong>&nbsp; A WIM tem como responsabilidade enviar o código do gift card correspondente a sua troca em um prazo de 7 dias pelo e-mail ou telefone cadastrado do usuário. Caso ultraprasse o prazo estabelecido a WIM se lamenta e irá devolver seu dinheiro.</p>   <p>&nbsp;</p> <p align="right"><a href="#top"><strong>Voltar para o in&iacute;cio</strong></a>&nbsp;</p> <p>&nbsp;</p> </section> </section> </div>
</section>

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




    
<!--[if lte IE 9]>
 <script src="https://www.paypalobjects.com/eboxapps/js/b2/f34e53f94c2a6fb2a579294142f824ea64fad5.js"></script> 
<![endif]-->



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

</body>
</html>
