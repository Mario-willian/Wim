<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe cargos
class Editars{
    //Atributos da classe(campos da tabela cargo)
    public $cpf;
    public $nome;
    public $usuario;
    public $senha;
    public $datanascimento;
    public $email;
    public $sexo;
    public $pais;
    public $estado;
    public $endereco;
    public $complemento;
    public $telefone;

    //Metodo para Excluir
    public function Excluir($cpf){

        //Verificar se recebeu o cpf par aexcluir
        if (isset($cpf)) {
            $this->cpf = $cpf;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("delete from usuario where cpf = :cpf");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':cpf' => $this->cpf
            ));
            //Verificar se o comando funcionou
            if($smtp->rowCount() > 0){
                //Retornar para index.php
            }

        }else{//Se o ousuario nao selecionou o cpf voltar para index.php
            //retornar para index.php
            header('location:index.php');
        }
    }


    //Metodo para Alterar CARGOS
    public function Alterar(){
        if (isset($_GET["alterar"])) {
            
            //Preenche os atributos com os valores do formulario
            $this->cpf = $_GET["cpf"];
            $this->nome = $_GET["nome"];
            $this->usuario = $_GET["usuario"];
            $this->senha = $_GET["senha"];
            $this->datanascimento = $_GET["datanascimento"];
            $this->email = $_GET["email"];
            $this->sexo = $_GET["sexo"];
            $this->pais = $_GET["pais"];
            $this->estado = $_GET["estado"];
            $this->endereco = $_GET["endereco"];
            $this->complemento = $_GET["complemento"];
            $this->telefone = $_GET["telefone"];

            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("update usuario set cpf = :cpf, nome = :nome, usuario = :usuario, senha = md5(:senha), datanascimento = :datanascimento, email = :email, sexo = :sexo, pais = :pais, estado = :estado, endereco = :endereco, complemento = :complemento, telefone = :telefone where cpf = :cpf");

            //Executar no banco passando os valores recebidos como parametros
            $smtp->execute(array(
                ':cpf' => $this->cpf,
                ':nome' => $this->nome,
                ':usuario' => $this->usuario,
                ':senha' => $this->senha,
                ':datanascimento' => $this->datanascimento,
                ':email' => $this->email,
                ':sexo' => $this->sexo,
                ':pais' => $this->pais,
                ':estado' => $this->estado,
                ':endereco' => $this->endereco,
                ':complemento' => $this->complemento,
                ':telefone' => $this->telefone
            ));
            //Sinalização de Sucesso
            $_SESSION['conclusao']= "<div class='alert alert-success text-center'>Alterações feitas com sucesso!</div>";

            //Verificar se retornou dados
            if ($smtp->rowCount() > 0) {
                //Voltar para index
            }
        }else{
            //Voltar para index
            header("location:./");
        }
    }


    //Funcao para listar os dados do banco
    public function listarcpf($cpf){

        //Verificar se recebeu o cpf como parametro
        if(isset($cpf)){
            //Preenche os atributos com os valroes do formulário
            $this->cpf = $cpf;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("select * from usuario where cpf = :cpf");

            //Executar no banco passando o cpf como parametro
            $smtp->execute(array(
                ':cpf' => $this->cpf
            ));

            //Verficar se retornou dados
            if ($smtp->rowCount() > 0) {
                return $result = $smtp->fetchObject();
            }
        }
    }
}
?>