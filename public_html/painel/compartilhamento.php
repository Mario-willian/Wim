<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Compartilhamentos
class Compartilhamentos{
    //Atributos da classe(campos da tabela Compartilhamento)
    public $codigo;
    public $quantidade;
    public $minutos;


    //Meteodo para listar todos os Compartilhamento (select)
    public function listarTodos(){
        //Criar a conexao com o banco de dados com o PDO
        $pdo = new PDO(server,usuario,senha);
        //Criar o comando sql
        $smtp = $pdo->prepare('select * from usuario');
        //Executar o comando no Banco de Dados
        $smtp->execute();
        //Verificar se o comando retornou resultados
        if ($smtp->rowCount() > 0){
            //Retornar os dados para o HTML
            return $result = $smtp->fetchAll (PDO::FETCH_CLASS);
        }
    }


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
        }else{
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
            $smtp = $pdo->prepare("select * from compartilhamento where codigo = :codigo");

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
            $smtp = $pdo->prepare("delete from compartilhamento where codigo = :codigo");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':codigo' => $this->codigo
            ));
            //Verificar se o comando funcionou
            if($smtp->rowCount() > 0){
                //Retornar para index.php
                header('location:./');
            }

        }else{//Se o ousuario nao selecionou o codigo voltar para index.php
            //retornar para index.php
            header('location:./');
        }
    }
}
?>