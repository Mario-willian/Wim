<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Exclusaos{
    //Atributos da classe(campos da tabela cliente)
    public $cmd;

    //Metodo para Excluir
    public function Excluir($cmd){

        //Verificar se recebeu o cmd par aexcluir
        if (isset($cmd)) {
            $this->cmd = $cmd;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("delete from usuario where cmd = :cmd");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':cmd' => $this->cmd
            ));

            //Verificar se o comando funcionou
            if($smtp->rowCount() > 0){
                header("location:../../index.php");
            }

        }else{//Se o ousuario nao selecionou o cmd voltar para index.php
            //retornar para index.php
            header("location:../../index.php");
        }
    }
}