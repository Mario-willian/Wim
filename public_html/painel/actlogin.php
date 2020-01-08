<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Login{
    //Atributos da classe(campos da tabela cliente)
    public $usuario;
    public $senha;
    
     public function validar(){
          //Criar a conexao com o banco de dados com o PDO
        $pdo = new PDO(server,usuario,senha);
        //Criar o comando sql
        
        $smtp = $pdo->prepare('select cmd from usuario where usuario = :usuario and senha = md5(:senha)' );
        //verificar see foi enviado valores pelo formulário
        if(isset($_GET["usuario"]) && isset($_GET["senha"])){

 //preencher os atributos com os valores recebidos
            $this->usuario = $_GET["usuario"];
            $this->senha = $_GET["senha"];

        $smtp->execute(array(
                ':usuario' => $this->usuario,
                ':senha'=> $this->senha
            ));
        if ($smtp->rowCount() > 0) { 
       $row =  $smtp->fetch();
       $cmdzao = $row['0'];

        header("location:php/excluir.php");


            }else{
                  echo '<script type="text/javascript">alert("USUARIO OU SENHA INCORRETOS");</script><body onload=window.history.back();>';
            }
            }else{
                 echo  '<script type="text/javascript">alert("DIGITE TODAS AS INFORMAÇÕES!");</script><body onload=window.history.back();>';
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