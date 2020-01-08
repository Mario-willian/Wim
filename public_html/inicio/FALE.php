<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');


//Classe Clientes
class Contato{
    //Atributos da classe(campos da tabela cliente)
    public $codigo;
    public $nome;
    public $email;
    public $comentario;
    //meteodo para inserir Clientes
    public function inserir(){
        //criar a conexao com o banco de dados
        $pdo = new PDO(server,usuario,senha);

        //verificar see foi enviado valores pelo formulário
        if(isset($_GET["nome"]) && isset($_GET["email"]) && isset($_GET["comentario"])){

            //preencher os atributos com os valores recebidos
            $this->nome = $_GET["nome"];
            $this->email = $_GET["email"];
            $this->comentario = $_GET["comentario"];
            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into contato(codigo,nome,email,comentario) values(null, :nome, :email,:comentario) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':comentario' => $this->comentario
            ));

            //Testar se retornou algum resultado
            if ($smtp->rowCount() > 0) {

                header("location:.");//Retornar para o index.php
            }
        }else{
            header("location:./");//Retornar para o index.php
        }
    }
}
?>