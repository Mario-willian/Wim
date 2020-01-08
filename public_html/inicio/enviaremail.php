<?php
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

if ($status):
  // Enviada com sucesso
  header('location:index.php?status=sucesso');
else:
  // Se der erro
  header('location:index.php?status=erro');
endif;
?>