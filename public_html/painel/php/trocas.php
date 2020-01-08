<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Trocas{
    //Atributos da classe(campos da tabela cliente)
    public $valor;
    public $produto;
    public $data;
    public $status;
    public $carteira_codigo;
    public $usuario_cpf;

    //meteodo para inserir Clientes
    public function inserir(){
        //criar a conexao com o banco de dados
        $pdo = new PDO(server,usuario,senha);

        //verificar see foi enviado bancoes pelo formulário
        if(isset($_GET["valor"]) && isset($_GET["usuario_cpf"])){

            //preencher os atributos com os valores recebidos
            $this->valor = $_GET["valor"];
            $this->produto = $_GET["produto"];
            $this->data = $_GET["data"];
            $this->carteira_codigo = $_GET["carteira_codigo"];
            $this->usuario_cpf = $_GET["usuario_cpf"];

            //Retirando da carteira o valor solicitado para saque pelo usuario
            $smtp = $pdo->prepare("update carteira set saldo = saldo - :valor where usuario_cpf = :usuario_cpf");
            $smtp->execute(array(
                ':valor' => $this->valor,
                ':usuario_cpf' => $this->usuario_cpf
            ));

            //Notificaçao sobre o saque do usuario
            $smtpp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            $smtpp->execute(array(
                ':titulo' => 'Sucesso!',
                ':descricao' => 'A solicitação para retirar seu produto de troca já foi enviada para os administradores! Quando concluido o processo, você será notificado.',
                ':cor' => 'alert success',
                ':ativo' => 's',
                ':usuario_cpf' => $this->usuario_cpf
           ));

            //Inserindo na tabela "TROCA"
            $smtppp = $pdo->prepare("insert into troca(codigo,produto,valor,data,status,carteira_codigo,usuario_cpf) values(null, :produto, :valor, :data, :status, :carteira_codigo, :usuario_cpf)");
            $smtppp->execute(array(
                ':produto' => $this->produto,
                ':valor' => $this->valor,
                ':data' => $this->data,
                ':status' => 'pendente',
                ':carteira_codigo' => $this->carteira_codigo,
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

?>