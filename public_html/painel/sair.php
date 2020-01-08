<?php
session_start();
unset($_SESSION['usuario']);
unset($_SESSION['valor']);
unset($_SESSION['conclusao']);
header("location:../index.php");
?>