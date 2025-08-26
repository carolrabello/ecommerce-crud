<?php
session_start();

unset($_SESSION['admin_logado']);
unset($_SESSION['admin_id']);
unset($_SESSION['admin_nome']);

$_SESSION['mensagem_logout'] = "Deslogado(a) com sucesso";

header("Location: admin_login.php");
exit();
?>
