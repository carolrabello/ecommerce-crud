<?php
include('db.php');
include('header.php');
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Administrador - MaxiPack</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="test-area">
        <details class="test-menu">
            <summary>🧪 Testar preenchimento automático</summary>
            <div class="test-buttons">
                <form method="GET">
                    <input type="hidden" name="email" value="maria@email">
                    <input type="hidden" name="senha" value="123456">
                    <button class="btn-test btn-email">Email Incorreto</button>
                </form>
                <form method="GET">
                    <input type="hidden" name="email" value="maria@email.com">
                    <input type="hidden" name="senha" value="Senha123">
                    <button class="btn-test btn-data">Senha Incorreta</button>
                </form>
                <form method="GET">
                    <input type="hidden" name="email" value="maria@email.com">
                    <input type="hidden" name="senha" value="123456">
                    <button class="btn-test btn-okay">Login Válido</button>
                </form>
            </div>
        </details>
    </div>

    <div class="container" style="width: max-content;">
        <div class="box">
            <h1 class="register-title">Login de Administrador</h1>

            <?php
            $msg = '';

            if (isset($_SESSION['mensagem_logout'])) {
                $msg = "<p class='success'>" . $_SESSION['mensagem_logout'] . "</p>";
                unset($_SESSION['mensagem_logout']);
            }

            if (isset($_POST['login_admin'])) {
                $email = trim($_POST['email']);
                $senha = $_POST['senha'];

                $query = "SELECT * FROM administradores WHERE email='$email'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $admin = mysqli_fetch_assoc($result);
                    if (password_verify($senha, $admin['senha'])) {
                        $_SESSION['admin_logado'] = true;
                        $_SESSION['admin_id'] = $admin['id'];
                        $_SESSION['admin_nome'] = $admin['nome'];
                        $msg = "<p class='success'>Logado(a) com sucesso</p>";
                        echo "<script>setTimeout(function(){ window.location.href = 'admin_dashboard.php'; }, 1000);</script>";
                    } else {
                        $msg = "<p class='error'>Senha incorreta</p>";
                    }
                } else {
                    $msg = "<p class='error'>Email inválido</p>";
                }
            }

            echo $msg;
            ?>

            <form method="POST" action="">
                <label>E-mail:</label>
                <input type="email" name="email" required
                    value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">

                <label>Senha:</label>
                <input type="password" name="senha" required
                    value="<?php echo isset($_GET['senha']) ? htmlspecialchars($_GET['senha']) : ''; ?>">

                <button type="submit" name="login_admin">Login</button>
            </form>

            <div style="margin-top: 10px;">
                <a href="admin_cadastro.php" style="color: #907240; text-decoration: none;">Não tem conta? Cadastre-se
                    como administrador</a>
            </div>
            <div style="margin-top: 10px;">
                <a href="index.php" style="color: #907240; text-decoration: none;">← Voltar para a home</a>
            </div>
        </div>
    </div>

</body>

</html>