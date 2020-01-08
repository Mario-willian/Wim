<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Eleicoes
class Transferencias{
    //Atributos da classe(campos da tabela Eleicao)
    public $codigo;
    public $banco;
    public $tipo;
    public $agencia;
    public $conta;
    public $data;
    public $quantia;
    public $status;
    public $minutos;
    public $carteira_codigo;
    public $usuario_cpf;

    //Metodo quando Pendente
    public function pendente($codigo){

        //Verificar se recebeu o codigo par aexcluir
        if (isset($codigo)) {
            $this->codigo = $codigo;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("update saque set status = :status where codigo = :codigo");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':status' => 'pendente',
                ':codigo' => $this->codigo
            ));

            //Puxando informacoes do usuario para retormar a pagina
            include_once ("conexao3.php");
            $result_estoques = "SELECT * FROM saque where codigo = '$codigo'";
            $resultado_estoques = mysqli_query($conn, $result_estoques);
            $row_estoques = mysqli_fetch_assoc($resultado_estoques);

            $userao = $row_estoques['usuario_cpf'];

            $result_estoques2 = "SELECT cmd FROM usuario where cpf = '$userao'";
            $resultado_estoques2 = mysqli_query($conn, $result_estoques2);
            $row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);
            //Retornar
            header("location:pendentes.php");
        }
    }

    //Metodo quando Depositado
    public function depositado($codigo){

        //Verificar se recebeu o codigo par aexcluir
        if (isset($codigo)) {
            $this->codigo = $codigo;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("update saque set status = :status where codigo = :codigo");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':status' => 'depositado',
                ':codigo' => $this->codigo
            ));

            //Puxando informacoes do usuario para notifica-lo
            include_once ("conexao3.php");
            $result_estoques = "SELECT * FROM saque where codigo = '$codigo'";
            $resultado_estoques = mysqli_query($conn, $result_estoques);
            $row_estoques = mysqli_fetch_assoc($resultado_estoques);

            //Mandando a notificacao sobre o deposito
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':titulo' => 'Depositado com Sucesso!',
                ':descricao' => 'Olá, a solicitacão do saque de R$'.$row_estoques['quantia'].', feita no dia '.date("d/m/Y", strtotime($row_estoques['data']) ).', acabou de ser aceita. Dentro de algumas horas o dinheiro estará em sua conta.',
                ':cor' => 'alert success',
                ':ativo' => 's',
                ':usuario_cpf' => $row_estoques['usuario_cpf']
           ));

            //Puxando informacoes do usuario para retormar a pagina
            include_once ("conexao3.php");
            $result_estoques = "SELECT * FROM saque where codigo = '$codigo'";
            $resultado_estoques = mysqli_query($conn, $result_estoques);
            $row_estoques = mysqli_fetch_assoc($resultado_estoques);

            $userao = $row_estoques['usuario_cpf'];

            $result_estoques2 = "SELECT cmd FROM usuario where cpf = '$userao'";
            $resultado_estoques2 = mysqli_query($conn, $result_estoques2);
            $row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);
            //Retornar
            header("location:concluidas.php");
            
        }
    }

    //Metodo quando Invalido
    public function invalido($codigo){

        //Verificar se recebeu o codigo par aexcluir
        if (isset($codigo)) {
            $this->codigo = $codigo;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Criar o comando sql
            $smtp = $pdo->prepare("update saque set status = :status where codigo = :codigo");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':status' => 'invalido',
                ':codigo' => $this->codigo
            ));

            //Puxando informacoes do usuario para notifica-lo
            include_once ("conexao3.php");
            $result_estoques = "SELECT * FROM saque where codigo = '$codigo'";
            $resultado_estoques = mysqli_query($conn, $result_estoques);
            $row_estoques = mysqli_fetch_assoc($resultado_estoques);

            //Mandando a notificacao sobre o deposito
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':titulo' => 'Dados Para o Saque Invalidos!',
                ':descricao' => 'A solicitacão do saque de R$'.$row_estoques['quantia'].', feita no dia '.date("d/m/Y", strtotime($row_estoques['data']) ).', não foi aceita, pois os dados da conta destinada estavam incorretos. Caso tenha duvidas, entre em contato conosco',
                ':cor' => 'alert',
                ':ativo' => 's',
                ':usuario_cpf' => $row_estoques['usuario_cpf']
           ));
            //Puxando informacoes do usuario para retormar a pagina
            include_once ("conexao3.php");
            $result_estoques = "SELECT * FROM saque where codigo = '$codigo'";
            $resultado_estoques = mysqli_query($conn, $result_estoques);
            $row_estoques = mysqli_fetch_assoc($resultado_estoques);

            $userao = $row_estoques['usuario_cpf'];

            $result_estoques2 = "SELECT cmd FROM usuario where cpf = '$userao'";
            $resultado_estoques2 = mysqli_query($conn, $result_estoques2);
            $row_estoques2 = mysqli_fetch_assoc($resultado_estoques2);
            //Retornar
            header("location:erro.php");

        }
    }

    //Metodo para devolver o dinheiro
    public function devolucao($codigo){

        //Verificar se recebeu o codigo par aexcluir
        if (isset($codigo)) {
            $this->codigo = $codigo;
            //Criar a conexao com o banco de dados
            $pdo = new PDO(server,usuario,senha);
            //Puxando informacoes do usuario
            include_once ("conexao3.php");
            $result_estoques5 = "SELECT * FROM saque where codigo = '$codigo'";
            $resultado_estoques5 = mysqli_query($conn, $result_estoques5);
            $row_estoques5 = mysqli_fetch_assoc($resultado_estoques5);

             //Devolvendo o dinheiro
            $smtp = $pdo->prepare("update carteira set saldo += :saldo where usuario_cpf = :usuario_cpf");
            //Executar o comando no banco de dados passando os valroes por parametros
            $smtp->execute(array(
                ':saldo' => $row_estoques5['quantia'],
                ':usuario_cpf' => $row_estoques5['usuario_cpf']
            ));

            //Mandando a notificacao sobre a devolucao do dinheiro
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':titulo' => 'Dinheiro Devolvido!',
                ':descricao' => 'A quantia de R$'.$row_estoque5['quantia'].', solitada no dia '.date("d/m/Y", strtotime($row_estoques5['data']) ).' para sacar, foi devolvida. Caso tenha duvidas, entre em contato conosco',
                ':cor' => 'alert warning',
                ':ativo' => 's',
                ':usuario_cpf' => $row_estoques5['usuario_cpf']
           ));

            //Mandando a notificacao sobre o deposito
            $smtp = $pdo->prepare("delete * from saque where codigo = :codigo) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':codigo' => $this->codigo
           ));

        }
    }
}
?>