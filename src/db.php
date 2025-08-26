<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'maxipackbd';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>