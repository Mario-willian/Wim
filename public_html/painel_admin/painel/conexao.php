<?php
header("Content-Type:Text/html; charset=utf8");

$login = "companywim";
$senha = "companywim@123456";

if(isset($_POST["usuario"]) && isset($_POST["psw"])){
	$login = $_POST["usuario"];
	$senha = $_POST["psw"];
}else{ // devolver usario a pagina index
	header("location:../index.php");
}

if ($login == "companywim" && $senha = "companywim@123456") {
	header("location:paineladm.php");


}else{

	header("location:../index.php");

}

?>