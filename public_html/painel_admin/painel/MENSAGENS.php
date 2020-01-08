<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Mensagens{
    //Atributos da classe(campos da tabela cliente)
    public $codigo;
    public $titulo;
    public $descricao;
    public $cor;
    public $ativo;
    public $usuario_cpf;


    //Meteodo para listar todos os Cliente (select)
    public function listarTodos(){
        //Criar a conexao com o banco de dados com o PDO
        $pdo = new PDO(server,usuario,senha);
        //Criar o comando sql
        $smtp = $pdo->prepare('select * from notificacao');
        //Executar o comando no Banco de Dados
        $smtp->execute();
        //Verificar se o comando retornou resultados
        if ($smtp->rowCount() > 0){
            //Retornar os dados para o HTML
            return $result = $smtp->fetchAll (PDO::FETCH_CLASS);
        }
    }


    //meteodo para inserir Clientes
    public function inserir(){

include_once ("conexao3.php");
//Verificar se está sendo passado na URL a página atual, senao é atribuido a página
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//Selecionar todos os estoques da tabela
$result_estoque = "SELECT * FROM usuario";
$resultado_estoque = mysqli_query($conn, $result_estoque);

//Contar o total de estoque
$total_estoques = mysqli_num_rows($resultado_estoque);

//Seta a quantidade de estoques por pagina
$quantidade_pg = 180000;

//Calcular o número de páginas necessárias para apresentar os estoques
$num_pagina = ceil($total_estoques/$quantidade_pg);

//Calcular o inicio da visualizacao
$inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os estoques a serem apresentado na página
$result_estoques = "SELECT * FROM usuario limit $inicio, $quantidade_pg";
$resultado_estoques = mysqli_query($conn, $result_estoques);
$total_estoques = mysqli_num_rows ($resultado_estoques);


        while ($rows_estoques = mysqli_fetch_assoc($resultado_estoques)){ 
    $pdo = new PDO(server,usuario,senha);

        //verificar see foi enviado valores pelo formulário
        if(isset($_GET["titulo"]) && isset($_GET["descricao"]) && isset($_GET["cor"]) && isset($_GET["ativo"])){

            //preencher os atributos com os valores recebidos
            $this->titulo = $_GET["titulo"];
            $this->descricao = $_GET["descricao"];
            $this->cor = $_GET["cor"];
            $this->ativo = $_GET["ativo"];
            $this->usuario_cpf = $rows_estoques['cpf'];
            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':titulo' => $this->titulo,
                ':descricao' => $this->descricao,
                ':cor' => $this->cor,
                ':ativo' => $this->ativo,
                ':usuario_cpf' => $this->usuario_cpf
            ));
} 
            //Testar se retornou algum resultado
            if ($smtp->rowCount() > 0) {

                header("location:./");//Retornar para o index.php
            }
        }
    }


    //Funcao para listar os dados do banco
    public function listarcpf($cpf){

        //Verificar se recebeu o cpf como parametro
        if(isset($cpf)){
            //Preenche os atributos com os valroes do formulário
            $this->cpf = $cpf;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("select * from notificacao where usuario_cpf = :usuario_cpf");

            //Executar no banco passando o numero como parametro
            $smtp->execute(array(
                ':cpf' => $this->cpf
            ));

            //Verficar se retornou dados
            if ($smtp->rowCount() > 0) {
                return $result = $smtp->fetchObject();
            }
        }
    }

    //Metodo para Excluir
    public function Excluir($cpf){

        //Verificar se recebeu o cpf par aexcluir
        if (isset($cpf)) {
            $this->cpf = $cpf;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("delete from notificacao where cpf = :cpf");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':cpf' => $this->cpf
            ));
            //Verificar se o comando funcionou
            if($smtp->rowCount() > 0){
                //Retornar para index.php
                header('location:./');
            }

        }else{//Se o ousuario nao selecionou o cpf voltar para index.php
            //retornar para index.php
            header('location:./');
        }
    }
}
?>