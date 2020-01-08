<?php
session_start();
unset($_SESSION['usuario']);
unset($_SESSION['msg']);
header("location:../../index.php");
?>