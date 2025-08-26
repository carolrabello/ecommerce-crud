<?php 
include('db.php');
include('header.php');
session_start();

// Verificar se o administrador está logado
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Administrador - MaxiPack</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="box">
        <h2>Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['admin_nome']); ?>!</h2>
        <p>Você está logado como administrador.</p>
        
        <div style="margin: 20px 0;">
            <a href="cadastro_produto.php" style="background-color:rgb(134, 190, 136); color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px;">
                Cadastrar Produto
            </a>
            <a href="alterar_produto.php" style="background-color:#b66ce7; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px;">
                Alterar Produto
            </a>
            <a href="listar_produtos.php" style="background-color:#65abe4; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px;">
                Listar Produtos
            </a>
            <a href="logout_admin.php" style="background-color:#f0857e; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px;">
                Logout
            </a>
        </div>
    </div>
</div>
</body>
</html>