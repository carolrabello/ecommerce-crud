<?php
include('db.php');
include('header.php');
session_start();

if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remover Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <div class="box">
    <h2>Remover Produto</h2>
    <form method="POST">
      <label>ID do Produto:</label>
      <input type="number" name="idProduto" required>
      <button type="submit" name="remover_produto">Remover Produto</button>
    </form>

    <?php
    if (isset($_POST['remover_produto'])) {
        $id = $_POST['idProduto'];
        $query = "DELETE FROM produtos WHERE idProduto='$id'";

        if (mysqli_query($conn, $query)) {
            if (mysqli_affected_rows($conn) > 0) {
                echo "<p class='success'>Produto removido com sucesso</p>";
            } else {
                echo "<p class='error'>ID não encontrado</p>";
            }
        } else {
            echo "<p class='error'>Erro ao remover produto</p>";
        }
    }
    ?>
  </div>
</div>
</body>
</html>
