<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Doacoes{
    //Atributos da classe(campos da tabela cliente)
    public $codigo;
    public $valor;
    public $local_de_doacao;
    public $data;
    public $horario;
    public $minutos;
    public $carteira_codigo;
    public $usuario_cpf;

    //Meteodo para listar todos os Cliente (select)
    public function listarTodos(){
        //Criar a conexao com o banco de dados com o PDO
        $pdo = new PDO(server,usuario,senha);
        //Criar o comando sql
        $smtp = $pdo->prepare('select * from doacao');
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
        //criar a conexao com o banco de dados
        $pdo = new PDO(server,usuario,senha);

        //verificar see foi enviado valores pelo formulário
        if(isset($_GET["valor"]) && isset($_GET["local_de_doacao"]) && isset($_GET["data"]) && isset($_GET["horario"]) && isset($_GET["minutos"]) && isset($_GET["carteira_codigo"]) && isset($_GET["usuario_cpf"])){

            //preencher os atributos com os valores recebidos
            $this->valor = $_GET["valor"];
            $this->local_de_doacao = $_GET["local_de_doacao"];
            $this->data = $_GET["data"];
            $this->horario = $_GET["horario"];
            $this->minutos = $_GET["minutos"];
            $this->carteira_codigo = $_GET["carteira_codigo"];
            $this->usuario_cpf = $_GET["usuario_cpf"];
            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into doacao(codigo,valor,local_de_doacao,data,horario,minutos,carteira_codigo,usuario_cpf) values(null, :valor, :local_de_doacao, :data, :horario, :minutos, :carteira_codigo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':valor' => $this->valor,
                ':local_de_doacao' => $this->local_de_doacao,
                ':data' => $this->data,
                ':horario' => $this->horario,
                ':minutos' => $this->minutos,
                ':carteira_codigo' => $this->carteira_codigo,
                ':usuario_cpf' => $this->usuario_cpf
            ));
            $smtpp = $pdo->prepare("update carteira set saldo = saldo - :valor where codigo = :carteira_codigo");
            $smtpp->execute(array(
                ':valor' => $this->valor,
                ':carteira_codigo' => $this->carteira_codigo
            ));

            //Testar se retornou algum resultado
            if ($smtp->rowCount() > 0) {

                header("location:./");//Retornar para o index.php
            }
        }else{
            header("location:./");//Retornar para o index.php
        }
    }


    //Funcao para listar os dados do banco
    public function listarcodigo($codigo){

        //Verificar se recebeu o codigo como parametro
        if(isset($codigo)){
            //Preenche os atributos com os valroes do formulário
            $this->codigo = $codigo;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("select * from doacao where codigo = :codigo");

            //Executar no banco passando o numero como parametro
            $smtp->execute(array(
                ':codigo' => $this->codigo
            ));

            //Verficar se retornou dados
            if ($smtp->rowCount() > 0) {
                return $result = $smtp->fetchObject();
            }
        }
    }

    //Metodo para Excluir
    public function Excluir($codigo){

        //Verificar se recebeu o codigo par aexcluir
        if (isset($codigo)) {
            $this->codigo = $codigo;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("delete from doacao where codigo = :codigo");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':codigo' => $this->codigo
            ));
            //Verificar se o comando funcionou
            if($smtp->rowCount() > 0){
                //Retornar para index.php
                header('location:./');
            }

        }else{//Se o olocal_de_doacao nao selecionou o codigo voltar para index.php
            //retornar para index.php
            header('location:./');
        }
    }
}

?>