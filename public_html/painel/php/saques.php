<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Saques{
    //Atributos da classe(campos da tabela cliente)
    public $codigo;
    public $banco;
    public $tipo;
    public $agencia;
    public $conta;
    public $quantia;
    public $status;
    public $minutos;
    public $carteira_codigo;
    public $usuario_cpf;

    //meteodo para inserir Clientes
    public function inserir(){
        //criar a conexao com o banco de dados
        $pdo = new PDO(server,usuario,senha);

        //verificar see foi enviado bancoes pelo formulário
        if(isset($_GET["banco"]) && isset($_GET["tipo"]) && isset($_GET["agencia"]) && isset($_GET["conta"]) && isset($_GET["data"]) && isset($_GET["quantia"]) && isset($_GET["minutos"]) && isset($_GET["carteira_codigo"]) && isset($_GET["usuario_cpf"])){

            //preencher os atributos com os valores recebidos
            $this->banco = $_GET["banco"];
            $this->tipo = $_GET["tipo"];
            $this->agencia = $_GET["agencia"];
            $this->conta = $_GET["conta"];
            $this->data = $_GET["data"];
            $this->quantia = $_GET["quantia"];
            $this->minutos = $_GET["minutos"];
            $this->carteira_codigo = $_GET["carteira_codigo"];
            $this->usuario_cpf = $_GET["usuario_cpf"];
            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into saque(codigo,banco,tipo,agencia,conta,data,quantia,status,minutos,carteira_codigo,usuario_cpf) values(null, :banco, :tipo, :agencia, :conta, :data, :quantia, :status, :minutos, :carteira_codigo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':banco' => $this->banco,
                ':tipo' => $this->tipo,
                ':agencia' => $this->agencia,
                ':conta' => $this->conta,
                ':data' => $this->data,
                ':quantia' => $this->quantia,
                ':status' => 'pendente',
                ':minutos' => $this->minutos,
                ':carteira_codigo' => $this->carteira_codigo,
                ':usuario_cpf' => $this->usuario_cpf
            ));

            //Retirando da carteira o valor solicitado para saque pelo usuario
            $smtpp = $pdo->prepare("update carteira set saldo = saldo - :quantia where codigo = :carteira_codigo");
            $smtpp->execute(array(
                ':quantia' => $this->quantia,
                ':carteira_codigo' => $this->carteira_codigo
            ));

            //Notificaçao sobre o saque do usuario
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            $smtp->execute(array(
                ':titulo' => 'Sucesso!',
                ':descricao' => 'A solicitação para sacar o seu dinheiro ja foi enviada para os administradores! Quando houver o deposito em sua conta, você será notificado.',
                ':cor' => 'alert success',
                ':ativo' => 's',
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