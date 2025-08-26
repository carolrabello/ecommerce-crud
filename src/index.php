<?php 
include('db.php');
session_start();

// Processar login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $query = "SELECT * FROM clientes WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($senha, $user['senha'])) {
            $login_message = "<p class='success'>Logado com sucesso</p>";
        } else {
            $login_message = "<p class='error'>Senha incorreta</p>";
        }
    } else {
        $login_message = "<p class='error'>Email inválido</p>";
    }
}

// Processar verificação de email para cadastro
if (isset($_POST['verificar_email'])) {
    $novo_email = trim(strtolower($_POST['novo_email']));
    $verifica = mysqli_query($conn, "SELECT id FROM clientes WHERE email = '$novo_email'");
    if (mysqli_num_rows($verifica) > 0) {
        $register_message = "<p class='error'>Email já cadastrado. Faça login.</p>";
    } elseif (!filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
        $register_message = "<p class='error'>Email inválido</p>";
    } else {
        header("Location: cadastro.php?email=" . urlencode($novo_email));
        exit();
    }
}

include ('header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - MaxiPack</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="test-area">
        <details class="test-menu">
            <summary>🧪 Testar preenchimento automático - Login</summary>
            <div class="test-buttons">
                <form method="GET">
                    <input type="hidden" name="email" value="teste@email">
                    <input type="hidden" name="senha" value="123456">
                    <button class="btn-test btn-email">Email Incorreto</button>
                </form>
                <form method="GET">
                    <input type="hidden" name="email" value="teste@email.com">
                    <input type="hidden" name="senha" value="senhaerrada">
                    <button class="btn-test btn-data">Senha Incorreta</button>
                </form>
                <form method="GET">
                    <input type="hidden" name="email" value="teste@email.com">
                    <input type="hidden" name="senha" value="123456">
                    <button class="btn-test btn-okay">Login Válido</button>
                </form>
                <form method="GET">
                    <input type="hidden" name="novo_email" value="teste@email.com">
                    <button class="btn-test btn-email">Email Já Cadastrado</button>
                </form>
            </div>
        </details>
    </div>
    <div class="identification-section">
        <h1 class="identification-title">Identificação</h1>
        <p class="identification-subtitle">Faça seu login ou crie sua conta</p>
    </div>

<div class="container" style="gap: 90px;">
    <!-- Login -->
    <div class="box login-box">
        <div class="box-header">
            <i class="fas fa-user box-icon"></i>
            <h2>Já sou cadastrado</h2>
        </div>
        <form method="POST" action="">
            <label>E-mail:</label>
            <input type="email" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" required>
            <label>Senha:</label>
            <input type="password" name="senha" value="<?php echo isset($_GET['senha']) ? htmlspecialchars($_GET['senha']) : ''; ?>" required>
            <button type="submit" name="login" class="login-btn">Login</button>
        </form>
        <a href="#" class="forgot-password">
            <i class="fas fa-lock"></i>
            Esqueci minha senha
        </a>
        <?php
        if (isset($login_message)) {
            echo $login_message;
        }
        ?>
    </div>

    <!-- Pré-cadastro com verificação -->
    <div class="box register-box">
        <div class="box-header">
            <i class="fas fa-edit box-icon"></i>
            <h2>Criar conta</h2>
        </div>
        <p class="register-subtitle">Digite o email que deseja cadastrar:</p>

        <form method="POST" action="">
            <label>E-mail:</label>
            <input type="email" name="novo_email" value="<?php echo isset($_GET['novo_email']) ? htmlspecialchars($_GET['novo_email']) : ''; ?>" required>
            <button type="submit" name="verificar_email" class="register-btn">Cadastrar</button>
        </form>
        <?php
        if (isset($register_message)) {
            echo $register_message;
        }
        ?>
    </div>
</div>

</body>
</html>