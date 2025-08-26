<?php 
include('db.php'); 
include('header.php'); 
session_start();

// Verificar se o administrador está logado
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Processar remoção de produto
if (isset($_POST['remover_produto'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_produto']);
    
    $query = "DELETE FROM produtos WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        if (mysqli_affected_rows($conn) > 0) {
            $sucesso = "Produto removido com sucesso!";
        } else {
            $erro = "Produto não encontrado.";
        }
    } else {
        $erro = "Erro ao remover produto: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Produtos - MaxiPack</title>
    <link rel="stylesheet" href="style.css">

    <script>
      function confirmarRemocao(id, nome) {
          return confirm('Tem certeza que deseja remover o produto "' + nome + '" (ID: ' + id + ')?\n\nEsta ação não pode ser desfeita.');
      }
    </script>
</head>
<body>
<div class="container">
  <div class="box">
    <h1 class="register-title">Produtos Cadastrados</h1>
    <p class="identification-subtitle">Logado(a) como: <?php echo htmlspecialchars($_SESSION['admin_nome']); ?></p>

    <?php
    // Exibir mensagens de sucesso ou erro
    if (isset($sucesso)) {
        echo "<div class='success'>$sucesso</div>";
    }
    if (isset($erro)) {
        echo "<div class='error'>$erro</div>";
    }

    $resultado = mysqli_query($conn, "SELECT * FROM produtos ORDER BY id ASC");

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Produto</th><th>Valor</th><th>Descrição</th><th>Estoque</th><th>Ações</th></tr>";
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['produto']) . "</td>";
            echo "<td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>";
            echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
            echo "<td>" . htmlspecialchars($row['qtdEstoque']) . "</td>";
            echo "<td class='acoes-container'>";
            
            // Link para alterar
            echo "<a href='alterar_produto.php?id=" . $row['id'] . "' class='btn-alterar'>Alterar</a>";

            // Formulário para remover
            echo "<form class='form-inline' method='POST' onsubmit='return confirmarRemocao(" . $row['id'] . ", \"" . htmlspecialchars($row['produto']) . "\")'>";
            echo "<input type='hidden' name='id_produto' value='" . $row['id'] . "'>";
            echo "<button type='submit' name='remover_produto' class='btn-remover'>Remover</button>";
            echo "</form>";
            
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum produto cadastrado.</p>";
    }
    ?>

    <div style="margin-top: 20px;">
        <a href="admin_dashboard.php" style="background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">← Voltar ao Dashboard</a>
    </div>
  </div>
</div>
</body>
</html>