<?php 
include('header.php'); 
include('db.php'); 

$msg=' ';

if (isset($_POST['cadastrar'])) {
  $nome = trim($_POST['nome']);
  $email = trim($_POST['email']);
  $senha = trim($_POST['senha']);
  $cpf = trim($_POST['cpf']);
  $dataNascimento = $_POST['dataNascimento'];

  $cpfLimpo = preg_replace('/\D/', '', $cpf);

  if (!preg_match('/^\d{11}$/', $cpfLimpo)) {
    $msg= "<p class='error'>CPF inválido. Digite apenas números (11 dígitos).</p>";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg= "<p class='error'>Email inválido</p>";
  } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM clientes WHERE email='$email'")) > 0) {
    $msg= "<p class='error'>Email já cadastrado. <a href='index.php'>Faça login</a>.</p>";
  } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM clientes WHERE cpf='$cpfLimpo'")) > 0) {
    $msg= "<p class='error'>CPF já cadastrado. <a href='index.php'>Faça login</a>.</p>";
  } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataNascimento)) {
    $msg= "<p class='error'>Data de nascimento inválida</p>";
  } else {
    list($ano, $mes, $dia) = explode('-', $dataNascimento);

    if ($ano < 1900 || !checkdate((int) $mes, (int) $dia, (int) $ano)) {
      $msg= "<p class='error'>Data de nascimento inválida</p>";
    } elseif ($dataNascimento > date('Y-m-d')) {
      $msg= "<p class='error'>Data de nascimento não pode ser futura</p>";
    } else {
      $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
      $query = "INSERT INTO clientes (nome, email, senha, cpf, dataNascimento) VALUES ('$nome', '$email', '$senhaHash', '$cpfLimpo', '$dataNascimento')";
      
      if (mysqli_query($conn, $query)) {
        $msg= "<p class='success'>Cadastro realizado com sucesso!</p>";
        $msg .= "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 1000);</script>";
      } else {
        $msg= "<p class='error'>Erro ao cadastrar. Tente novamente.</p>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Cadastro de Usuário</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Botões de Teste -->
  <div class="test-area">
    <details class="test-menu">
      <summary>🧪 Testar preenchimento automático</summary>
      <div class="test-buttons">
        <form method="GET">
          <input type="hidden" name="nome" value="Teste Email">
          <input type="hidden" name="email" value="cliente@email">
          <input type="hidden" name="senha" value="Senha123">
          <input type="hidden" name="cpf" value="12345678901">
          <input type="hidden" name="dataNascimento" value="2011-11-11">
          <button class="btn-test btn-email">Email Incorreto - cliente@email</button>
        </form>
        <form method="GET">
          <input type="hidden" name="nome" value="Teste CPF">
          <input type="hidden" name="email" value="cliente@email.com">
          <input type="hidden" name="senha" value="123456">
          <input type="hidden" name="cpf" value="1111aaa1111">
          <input type="hidden" name="dataNascimento" value="2011-11-11">
          <button class="btn-test btn-cpf">CPF Incorreto - Números e letras</button>
        </form>
        <form method="GET">
          <input type="hidden" name="nome" value="Teste CPF">
          <input type="hidden" name="email" value="cliente@email.com">
          <input type="hidden" name="senha" value="123456">
          <input type="hidden" name="cpf" value="12345678909">
          <input type="hidden" name="dataNascimento" value="2000-01-01">
          <button class="btn-test btn-cpf">CPF Já Cadastrado</button>
        </form>
        <form method="GET">
          <input type="hidden" name="nome" value="Teste Data">
          <input type="hidden" name="email" value="cliente@email.com">
          <input type="hidden" name="senha" value="123456">
          <input type="hidden" name="cpf" value="12345678901">
          <input type="hidden" name="dataNascimento" value="2099-01-01">
          <button class="btn-test btn-data">Data Futura - Ano 2099</button>
        </form>
        <form method="GET">
          <input type="hidden" name="nome" value="Teste Válido">
          <input type="hidden" name="email" value="cliente@email.com">
          <input type="hidden" name="senha" value="123456">
          <input type="hidden" name="cpf" value="12345678901">
          <input type="hidden" name="dataNascimento" value="2001-01-01">
          <button class="btn-test btn-okay">Todas Informações Corretas</button>
        </form>
      </div>
  </div>
  
  <div class="container" style="max-width:450px">
    <div class="box">
      <h1 class="register-title">Cadastro de Usuário</h1>
      <?php if (!empty($msg)) echo $msg; ?>

      <!-- Formulário principal -->
      <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required
          value="<?php echo isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : ''; ?>">

        <label>E-mail:</label>
        <input type="email" name="email" required
          value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">

        <label>Senha:</label>
        <input type="password" name="senha" required
          value="<?php echo isset($_GET['senha']) ? htmlspecialchars($_GET['senha']) : ''; ?>">

        <label>CPF (somente números):</label>
        <input type="text" name="cpf" required
          value="<?php echo isset($_GET['cpf']) ? htmlspecialchars($_GET['cpf']) : ''; ?>">

        <label>Data de nascimento:</label>
        <input type="date" name="dataNascimento" required
          value="<?php echo isset($_GET['dataNascimento']) ? htmlspecialchars($_GET['dataNascimento']) : ''; ?>">

        <button type="submit" name="cadastrar">Cadastrar</button>
      </form>
      <div style="margin-top: 20px;">
        <a href="index.php"
          style="background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">←
          Voltar para login</a>
      </div>
    </div>
  </div>
</body>

</html>