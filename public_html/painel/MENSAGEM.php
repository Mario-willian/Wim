<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe cargos
class Mensagens{
    //Atributos da classe(campos da tabela cargo)
    public $codigo;

    //Metodo para Excluir
    public function Excluir($codigo){

        //Verificar se recebeu o codigo par aexcluir
        if (isset($codigo)) {
            $this->codigo = $codigo;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("update notificacao set ativo = 'n' where codigo = :codigo");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':codigo' => $this->codigo
            ));
            //PUXAR O CPF
            $smtp = $pdo->prepare("select usuario_cpf from notificacao where codigo = :codigo ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':codigo' => $this->codigo
           ));
            //Verificar se o comando funcionou
            if($smtp->rowCount() > 0){
                $row =  $smtp->fetch();
                $login = $row['0'];

            //PUXAR O CMD
            $smtp = $pdo->prepare("select cmd from usuario where cpf = :cpf ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':cpf' => $login
           ));
            $row =  $smtp->fetch();
                $cmdzao = $row['0'];

                header("location:notificacao.php");
            }

        }else{//Se o ousuario nao selecionou o codigo voltar para index.php
            //retornar para index.php
        }
    }
}
?>