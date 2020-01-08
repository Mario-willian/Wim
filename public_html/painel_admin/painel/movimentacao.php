<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Movimentacao{
    //Atributos da classe(campos da tabela cliente)
    public $codigo;
    public $valor;
    public $usuario_cpf;

    //Meteodo para listar todos os Cliente (select)
    public function listarTodos(){
        //Criar a conexao com o banco de dados com o PDO
        $pdo = new PDO(server,usuario,senha);
        //Criar o comando sql
        $smtp = $pdo->prepare('select * from carteira');
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
        if(isset($_GET["valor"]) && isset($_GET["usuario_cpf"])){

            //preencher os atributos com os valores recebidos
            $this->valor = $_GET["valor"];
            $this->usuario_cpf = $_GET["usuario_cpf"];

            //Verificando se CPF é valido
            $smtp = $pdo->prepare("select * from usuario where cpf = :cpf ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':cpf' => $this->usuario_cpf
           ));
            $row =  $smtp->fetch();
                $cpf = $row['0'];
            if($cpf == ""){
                //Sinalização de Erro
                $_SESSION['msg']= "<div class='alert alert-danger text-center'>O CPF Está Incorreto!</div>";
        }else{

            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("update carteira set saldo = saldo + :valor where usuario_cpf = :usuario_cpf ");
            $smtp->execute(array(
            	':valor' => $this->valor,
                ':usuario_cpf' => $this->usuario_cpf
            ));
            //Sinalização de Sucesso
            $_SESSION['msg']= "<div class='alert alert-success text-center'>Deposito Feito Sucesso!</div>";
        }

            //Testar se retornou algum resultado
            if ($smtp->rowCount() > 0) {

                header("location:./");//Retornar para o index.php
            }
        }else{
            header("location:./");//Retornar para o index.php
        }
    }
}
?>