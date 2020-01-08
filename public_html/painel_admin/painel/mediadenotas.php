<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Notas{
    //Atributos da classe(campos da tabela cliente)
    public $codigo;
    public $nota;
    public $hora;
    public $minutos;

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
        if(isset($_GET["nota"]) && isset($_GET["hora"]) && isset($_GET["minutos"])){

            //preencher os atributos com os valores recebidos
            $this->nota = $_GET["nota"];
            $this->hora = $_GET["hora"];
            $this->minutos = $_GET["minutos"];
            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into nota(codigo,nota,hora,minutos) values(null, :nota, :hora, :minutos) ");
            $smtp->execute(array(
            	':nota' => $this->nota,
                ':hora' => $this->hora,
                ':minutos' => $this->minutos
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