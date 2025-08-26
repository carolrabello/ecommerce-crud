<?php
include('db.php');
include('header.php');
session_start();

if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$mensagem_sucesso = '';
$mensagem_erro = '';
$id_produto = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

if (isset($_POST['alterar_produto'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $check_query = "SELECT id FROM produtos WHERE id='$id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) == 0) {
        $mensagem_erro = "Produto com ID $id não encontrado";
    } else {
        $updates = [];

        if (!empty(trim($_POST['produto']))) {
            $produto = mysqli_real_escape_string($conn, $_POST['produto']);
            $updates[] = "produto='$produto'";
        }

        if (!empty(trim($_POST['valor']))) {
            $valor = str_replace(',', '.', $_POST['valor']);
            $valor = mysqli_real_escape_string($conn, $valor);
            $updates[] = "valor='$valor'";
        }

        if (!empty(trim($_POST['descricao']))) {
            $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
            $updates[] = "descricao='$descricao'";
        }

        if (isset($_POST['qtdEstoque']) && $_POST['qtdEstoque'] !== '') {
            $qtd = (int) $_POST['qtdEstoque'];
            if ($qtd < 0) {
                $mensagem_erro = "Quantidade de estoque não pode ser negativa";
            } else {
                $updates[] = "qtdEstoque='$qtd'";
            }
        }

        if (!empty($updates) && empty($mensagem_erro)) {
            $query = "UPDATE produtos SET " . implode(', ', $updates) . " WHERE id='$id'";
            if (mysqli_query($conn, $query)) {
                if (mysqli_affected_rows($conn) > 0) {
                    $mensagem_sucesso = "Produto atualizado com sucesso!";
                } else {
                    $mensagem_erro = "Nenhuma alteração foi necessária (os dados já estavam atualizados)";
                }
            } else {
                $mensagem_erro = "Erro ao atualizar produto: " . mysqli_error($conn);
            }
        } elseif (empty($updates) && empty($mensagem_erro)) {
            $mensagem_erro = "Nenhum campo para alterar foi preenchido.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alterar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="test-area">
    <details class="test-menu">
        <summary>🧪 Testar preenchimento automático</summary>
        <div class="test-buttons">
            <form method="GET">
                <input type="hidden" name="id" value="1">
                <input type="hidden" name="produto" value="Nova caixa">
                <input type="hidden" name="valor" value="35,00">
                <input type="hidden" name="descricao" value="Caixa alterada no teste">
                <input type="hidden" name="qtdEstoque" value="50">
                <button class="btn-test btn-okay">Valores Válidos</button>
            </form>
            <form method="GET">
                <input type="hidden" name="id" value="87">
                <input type="hidden" name="produto" value="Produto de Teste">
                <input type="hidden" name="valor" value="35,00">
                <input type="hidden" name="descricao" value="">
                <input type="hidden" name="qtdEstoque" value="50">
                <button class="btn-test btn-data">Id inexistente</button>
            </form>
            <form method="GET">
                <input type="hidden" name="id" value="1">
                <input type="hidden" name="produto" value="Produto de Teste">
                <input type="hidden" name="valor" value="35,00">
                <input type="hidden" name="descricao" value="Produto criado para teste">
                <input type="hidden" name="qtdEstoque" value="-10">
                <button class="btn-test btn-cpf">Estoque Negativo</button>
            </form>
            <form method="GET">
                <input type="hidden" name="id" value="1">
                <input type="hidden" name="produto" value="Caixa de papelão N5">
                <input type="hidden" name="valor" value="7,20">
                <input type="hidden" name="descricao" value="Caixa de papelão com tampa. 20x25x5cm">
                <input type="hidden" name="qtdEstoque" value="10">
                <button class="btn-test btn-email">Cadastro inicial</button>
            </form>
        </div>
    </details>
</div>
<div class="container" style="max-width: 450px;">
    <div class="box">
        <h1 class="register-title">Alterar Produto</h1>

        <?php if (!empty($mensagem_sucesso)) echo "<p class='success'>✓ $mensagem_sucesso</p>"; ?>
        <?php if (!empty($mensagem_erro)) echo "<p class='error'>✗ $mensagem_erro</p>"; ?>

        <form method="POST">
            <label>ID do Produto (obrigatório):</label>
            <input style="width: 100px;" type="number" name="id" value="<?= $id_produto ?>" required
                value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">

            <label>Novo Nome do Produto:</label>
            <input style="width: 100%; max-width: 300px;" type="text" name="produto"
                value="<?php echo isset($_GET['produto']) ? htmlspecialchars($_GET['produto']) : ''; ?>">

            <label>Novo Valor:</label>
            <input style="width: 130px;" type="text" name="valor" placeholder="Ex: 7,20 ou 7.20"
                value="<?php echo isset($_GET['valor']) ? htmlspecialchars($_GET['valor']) : ''; ?>">

            <label>Nova Descrição:</label>
            <input style="width: 100%;" type="text" name="descricao"
                value="<?php echo isset($_GET['descricao']) ? htmlspecialchars($_GET['descricao']) : ''; ?>">

            <label>Nova Quantidade em Estoque:</label>
            <input style="width: 100px;" type="number" name="qtdEstoque"
                value="<?php echo isset($_GET['qtdEstoque']) ? htmlspecialchars($_GET['qtdEstoque']) : ''; ?>">

            <button type="submit" name="alterar_produto">Alterar Produto</button>
        </form>

        <div style="margin-top: 20px;">
            <a href="listar_produtos.php" style="background-color: #a17b4c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">← Voltar à Lista</a>
            <a href="admin_dashboard.php" style="background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">← Voltar ao Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>
