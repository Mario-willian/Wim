<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Ganhars{
    //Atributos da classe(campos da tabela cliente)
    public $codigo;
    public $valor;
    public $carteira_codigo;
    public $usuario_cpf;
    public $horario;

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
        if(isset($_GET["carteira_codigo"])){

            //preencher os atributos com os valores recebidos
            $this->carteira_codigo = $_GET["carteira_codigo"];
            $this->horario = $_GET["horario"];
            $this->usuario_cpf = $_GET["cpf"];
            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("update carteira set saldo = saldo + 0.01 where codigo = :carteira_codigo");
            $smtp->execute(array(
                ':carteira_codigo' => $this->carteira_codigo
            ));

            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("update carteira set recebido = recebido + 0.01 where codigo = :carteira_codigo");
            $smtp->execute(array(
                ':carteira_codigo' => $this->carteira_codigo
            ));

            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into propaganda(codigo,horario,usuario_cpf) values(null, :horario, :usuario_cpf)");
            $smtp->execute(array(
                ':horario' => $this->horario,
                ':usuario_cpf' => $this->usuario_cpf
            ));

            //Testar se retornou algum resultado
            if ($smtp->rowCount() > 0) {

                header("location:./");//Retornar para o index.php
            }
        }else{
            header("location:./");//Retornar para o index.php
        }
    }
}

class Compartilhamentos{
    //Atributos da classe(campos da tabela Compartilhamento)
    public $codigo;
    public $quantidade;
    public $minutos;


    //meteodo para inserir Compartilhamentos
    public function inserir(){
        //criar a conexao com o banco de dados
        $pdo = new PDO(server,usuario,senha);

        //verificar see foi enviado valores pelo formulário
        if(isset($_GET["mins"])){

            //preencher os atributos com os valores recebidos
            $this->minutos = $_GET["mins"];

            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into compartilhamento(codigo,quantidade,minutos) values(null, 1, :minutos) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':minutos' => $this->minutos
            ));
            //Testar se retornou algum resultado
            if ($smtp->rowCount() > 0) {
            }
        }
        else{
        }
    }
}
?>