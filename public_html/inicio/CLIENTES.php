<?php
//Definir as variaveis para conexao com o Banco de Dados
define('server','mysql:host=localhost; dbname=wim');
define('usuario','root');
define('senha','');

//Classe Clientes
class Clientes{
    //Atributos da classe(campos da tabela cliente)
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
    public $data;
    public $hora;
    public $minutos;
    public $erro;
    public $cmd;

    //Meteodo para enviar E-mail
    public function enviarEmail(){
        // Recebendo dados do formulário
$name = $_GET['nome'];
$email = $_GET['email'];
$usuario = $_GET['usuario'];
$cpf = $_GET['cpf'];
$subject = "Mensagem do Site";

$headers = "Content-Type: text/html; charset=utf-8\r\n";
$headers .= "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Dados que serão enviados
$corpo = "Formulário da página de contato <br>";
$corpo .= "Nome: " . $name . " <br>";
$corpo .= "Usuário: " . $usuario . " <br>";
$corpo .= "Email: " . $email . " <br>";
$corpo .= "CPF: " . $cpf . " <br>";

// Email que receberá a mensagem (Não se esqueça de substituir)
$email_to = 'mariogodaoo@hotmail.com';

// Enviando email
$status = mail($email_to, mb_encode_mimeheader($subject, "utf-8"), $corpo, $headers);
    }

    //meteodo para inserir Clientes
    public function inserir(){
        //criar a conexao com o banco de dados
        $pdo = new PDO(server,usuario,senha);

            //verificar see foi enviado valores pelo formulário
        if(isset($_GET["cpf"]) && isset($_GET["nome"]) && isset($_GET["usuario"]) && isset($_GET["senha"]) && isset($_GET["datanascimento"]) && isset($_GET["email"]) && isset($_GET["sexo"]) && isset($_GET["pais"]) && isset($_GET["estado"]) && isset($_GET["endereco"]) && isset($_GET["complemento"]) && isset($_GET["telefone"]) && isset($_GET["data"]) && isset($_GET["hora"]) && isset($_GET["minutos"])){

            //preencher os atributos com os valores recebidos
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
            $this->data = $_GET["data"];
            $this->hora = $_GET["hora"];
            $this->minutos = $_GET["minutos"];
            $this->cmd = password_hash($_GET["cpf"], PASSWORD_DEFAULT);


            //Criar o comando SQL com parametros para insercao
            $smtp = $pdo->prepare("insert into usuario(cpf,nome,usuario,senha,datanascimento,email,sexo,pais,estado,endereco,complemento,telefone,data,hora,minutos,cargo,cmd) values(:cpf, :nome, :usuario, md5(:senha), :datanascimento, :email, :sexo, :pais, :estado, :endereco, :complemento, :telefone, :data, :hora, :minutos, :cargo, :cmd) ");
            //Executar o comando banco de dados passando os valores recebidos
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
                ':telefone' => $this->telefone,
                ':data' => $this->data,
                ':hora' => $this->hora,
                ':minutos' => $this->minutos,
                ':cargo' => 'c',
                ':cmd' => $this->cmd
            ));
            //Criar o comando SQL com parametros para insercao - CARTEIRA
            $smtp = $pdo->prepare("insert into carteira(codigo,saldo,recebido,cmd,usuario_cpf) values(null, 0, 0, :cmd, :cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':cmd' => $this->cmd,
                ':cpf' => $this->cpf
           ));

            //Criar o comando SQL com parametros para insercao - MENSAGEM INICIAL
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':titulo' => 'Sucesso!',
                ':descricao' => 'Obrigado por usar a nossa plataforma.',
                ':cor' => 'alert success',
                ':ativo' => 's',
                ':usuario_cpf' => $this->cpf
           ));

            //Criar o comando SQL com parametros para insercao - MENSAGEM INICIAL
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':titulo' => 'Curiosidade!',
                ':descricao' => 'Você pode enviar dúvida ou sugestão na nossa página inicial.',
                ':cor' => 'alert info',
                ':ativo' => 's',
                ':usuario_cpf' => $this->cpf
           ));

            //Criar o comando SQL com parametros para insercao - MENSAGEM INICIAL
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':titulo' => 'Cuidado!',
                ':descricao' => 'Evite trapacear em nossa plataforma.',
                ':cor' => 'alert',
                ':ativo' => 's',
                ':usuario_cpf' => $this->cpf
           ));

            //Criar o comando SQL com parametros para insercao - MENSAGEM INICIAL
            $smtp = $pdo->prepare("insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, :titulo, :descricao, :cor, :ativo, :usuario_cpf) ");
            //Executar o comando banco de dados passando os valores recebidos
            $smtp->execute(array(
                ':titulo' => 'Aviso!',
                ':descricao' => 'Pense bem caso queira excluir sua conta.',
                ':cor' => 'alert warning',
                ':ativo' => 's',
                ':usuario_cpf' => $this->cpf
           ));

            //Testar se retornou algum resultado
            if ($smtp->rowCount() > 0) {

                header("location:../index.php");//Retornar para o index.php
            }


        }else{
            header("location:../index.php");//Retornar para o index.php
        }
    }
}
?>