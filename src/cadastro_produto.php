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
    <title>Cadastro de Produto - MaxiPack</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="test-area">
    <details class="test-menu">
        <summary>🧪 Testar preenchimento automático</summary>
        <div class="test-buttons">
            <form method="GET">
                <input type="hidden" name="produto" value="Produto de Teste">
                <input type="hidden" name="valor" value="35,00">
                <input type="hidden" name="descricao" value="">
                <input type="hidden" name="qtdEstoque" value="50">
                <button class="btn-test btn-data">Faltando Descrição</button>
            </form>
            <form method="GET">
                <input type="hidden" name="produto" value="Produto de Teste">
                <input type="hidden" name="valor" value="35,00">
                <input type="hidden" name="descricao" value="Produto criado para teste">
                <input type="hidden" name="qtdEstoque" value="-10">
                <button class="btn-test btn-cpf">Estoque Negativo</button>
            </form>
            <form method="GET">
                <input type="hidden" name="produto" value="Produto de Teste">
                <input type="hidden" name="valor" value="35,00">
                <input type="hidden" name="descricao" value="Produto criado para teste">
                <input type="hidden" name="qtdEstoque" value="50">
                <button class="btn-test btn-okay">Valores Válidos</button>
            </form>
        </div>
    </details>
</div>
<div class="container" style="max-width:450px">
  <div class="box">
    <h1 class="register-title">Cadastro de Produto</h1>
    <p class="identification-subtitle">Logado como: <?php echo htmlspecialchars($_SESSION['admin_nome']); ?></p>
    
    <form method="POST">
      <label>Produto:</label>
      <input type="text" name="produto" required 
        value="<?php echo isset($_GET['produto']) ? htmlspecialchars($_GET['produto']) : ''; ?>">

      <label>Valor:</label>
      <input type="text" name="valor" required style="width: 100px"
        value="<?php echo isset($_GET['valor']) ? htmlspecialchars($_GET['valor']) : ''; ?>">

      <label>Descrição:</label>
      <input type="text" name="descricao" required style="width: 100%;"
        value="<?php echo isset($_GET['descricao']) ? htmlspecialchars($_GET['descricao']) : ''; ?>">

      <label>Quantidade em Estoque:</label>
      <input type="number" name="qtdEstoque" required style="width: 100px"
        value="<?php echo isset($_GET['qtdEstoque']) ? htmlspecialchars($_GET['qtdEstoque']) : ''; ?>">

      <button type="submit" name="cadastrar_produto">Cadastrar Produto</button>
    </form>
    
    <?php
    if (isset($_POST['cadastrar_produto'])) {
      $produto = $_POST['produto'];
      $valor = $_POST['valor'];
      $descricao = $_POST['descricao'];
      $qtd = $_POST['qtdEstoque'];

      if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produtos WHERE produto='$produto'")) > 0){
        echo "<p class='error'>Produto já cadastrado</p>";
      } elseif ($qtd < 0) {
        echo "<p class='error'>Valor de estoque inválido</p>";
      } else {
        mysqli_query($conn, "INSERT INTO produtos(produto,valor,descricao,qtdEstoque) VALUES('$produto','$valor','$descricao','$qtd')");
        echo "<p class='success'>Produto cadastrado com sucesso</p>";
      }
    }
    ?>
    
    <div style="margin-top: 20px;">
      <a href="listar_produtos.php" style="background-color:rgb(160, 109, 47); color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">← Voltar à Lista</a>
      <a href="admin_dashboard.php" style="background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">← Voltar ao Dashboard</a>
    </div>
  </div>
</div>
</body>
</html>