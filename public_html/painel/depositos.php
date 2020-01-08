<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe cargos
class Depositos{
    //Atributos da classe(campos da tabela cargo)
    public $codigo;
    public $num_cartao;
    public $validade;
    public $proprietario;
    public $seguranca;
    public $carteira_codigo;
    public $usuario_cpf;

    //meteodo para inserir Clientes
    public function inserir(){
        //criar a conexao com o banco de dados
        $pdo = new PDO(server,usuario,senha);

        //verificar see foi enviado valores pelo formulário
        if(isset($_GET["num_cartao"]) && isset($_GET["validade"]) && isset($_GET["proprietario"]) && isset($_GET["seguranca"]) && isset($_GET["usuario_cpf"]) && isset($_GET["carteira_codigo"])){

            //preencher os atributos com os valores recebidos
            $this->num_cartao = $_GET["num_cartao"];
            $this->validade = $_GET["validade"];
            $this->proprietario = $_GET["proprietario"];
            $this->seguranca = $_GET["seguranca"];
            $this->carteira_codigo = $_GET["carteira_codigo"];
            $this->usuario_cpf = $_GET["usuario_cpf"];
            
            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into deposito(codigo,num_cartao,validade,proprietario,seguranca,carteira_codigo,usuario_cpf) values(null, :num_cartao, :validade, :proprietario, :seguranca, :carteira_codigo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':num_cartao' => $this->num_cartao,
                ':validade' => $this->validade,
                ':proprietario' => $this->proprietario,
                ':seguranca' => $this->seguranca,
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