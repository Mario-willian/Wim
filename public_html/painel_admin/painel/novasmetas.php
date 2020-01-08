<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Novasmetas{
    //Atributos da classe(campos da tabela cliente)
    public $codigo;
    public $total_atual;
    public $total_anterior;
    public $abrigo_atual;
    public $abrigo_anterior;
    public $instituicoes_atual;
    public $instituicoes_anterior;
    public $data;
    public $minutos;


    //meteodo para inserir Clientes
    public function inserir(){
        //criar a conexao com o banco de dados
        $pdo = new PDO(server,usuario,senha);

            //verificar see foi enviado valores pelo formulário
        if(isset($_GET["total_atual"]) && isset($_GET["total_anterior"]) && isset($_GET["abrigo_atual"]) && isset($_GET["abrigo_anterior"]) && isset($_GET["instituicoes_atual"]) && isset($_GET["instituicoes_anterior"]) && isset($_GET["data"]) && isset($_GET["minutos"])){

            //preencher os atributos com os valores recebidos
            $this->total_atual = $_GET["total_atual"];
            $this->total_anterior = $_GET["total_anterior"];
            $this->abrigo_atual = $_GET["abrigo_atual"];
            $this->abrigo_anterior = $_GET["abrigo_anterior"];
            $this->instituicoes_atual = $_GET["instituicoes_atual"];
            $this->instituicoes_anterior = $_GET["instituicoes_anterior"];
            $this->data = $_GET["data"];
            $this->minutos = $_GET["minutos"];

            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into metas(codigo, total_atual, total_anterior, abrigo_atual, abrigo_anterior, instituicoes_atual, instituicoes_anterior, data, minutos) values(null, :total_atual, :total_anterior, :abrigo_atual, :abrigo_anterior, :instituicoes_atual, :instituicoes_anterior, :data, :minutos) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':total_atual' => $this->total_atual,
                ':total_anterior' => $this->total_anterior,
                ':abrigo_atual' => $this->abrigo_atual,
                ':abrigo_anterior' => $this->abrigo_anterior,
                ':instituicoes_atual' => $this->instituicoes_atual,
                ':instituicoes_anterior' => $this->instituicoes_anterior,
                ':data' => $this->data,
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