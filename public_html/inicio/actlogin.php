<?php
session_start();
    //Conexao
    $con =  new PDO("mysql:host=localhost; dbname=wim","root","");
        //Criar o comando sql
        $sql = $con->prepare("SELECT * FROM usuario WHERE usuario=? AND senha=md5(?)");
        $sql->execute( array($_POST['usuario'], $_POST['senha'] ) );
        $row = $sql->fetchObject();  // devolve um único registro

        if ($row) { 
            $row_usuario = mysqli_fetch_assoc($resultado_usuario);
            $_SESSION['usuario'] = $row;
            $cmdzao = $_SESSION['usuario']->cmd;

            include_once ("conexao2.php");
            $result_estoques4 = "SELECT cargo FROM usuario where cmd = '$cmdzao'";
            $resultado_estoques4 = mysqli_query($conn, $result_estoques4);
            $row_estoques4 = mysqli_fetch_assoc($resultado_estoques4);

                if ($row_estoques4['cargo'] == "a") {
                    header("location:../painel_admin/painel/paineladm.php");
                }else{
                    header("location:../painel/painel.php");
                }
        }else{
            //AVISAR QUANDO ERRAR
            echo '<script type="text/javascript">alert("USUARIO OU SENHA INCORRETOS");</script>';
            header("location:../");
        }
?>