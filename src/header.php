<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <nav>
    <div class="logo">
      <img src="logo.png" alt="MaxiPack Logo">
    </div>
    <div class="search">
      <input type="text" placeholder="Digite o que você procura">
      <button type="button" class="search-btn"><i class="fas fa-search"></i></button>
    </div>
    <div class="links">
      <div class="link-item">
        <span class="icon"><i class="fas fa-headset"></i></span>
        <a href="#">Central de<br>Atendimento</a>
      </div>
      <?php if (isset($_SESSION['admin_logado']) && $_SESSION['admin_logado'] === true): ?>
          <div class="link-item">
            <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
            <a href="admin_dashboard.php">Dashboard Admin</a>
          </div>
          <div class="link-item">
            <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
            <a href="logout_admin.php">Logout Admin</a>
          </div>
      <?php else: ?>
          <div class="link-item">
            <span class="icon"><i class="fas fa-user"></i></span>
            <a href="index.php">Entrar ou<br>Cadastrar</a>
          </div>
          <div class="link-item">
            <span class="icon"><i class="fas fa-cog"></i></span>
            <a href="admin_login.php">Área de<br>Administrador</a>
          </div>
      <?php endif; ?>
      <div class="link-item">
        <span class="icon"><i class="fas fa-shopping-cart"></i></span>
        <a href="#">Meu Carrinho</a>
      </div>
    </div>
  </nav>
  <nav class="categories">
    <a href="#" class="dropdown-toggle">PÁSCOA ▼</a>
    <a href="#" class="dropdown-toggle">FESTAS ▼</a>
    <a href="#" class="dropdown-toggle">BALÕES ▼</a>
    <a href="#" class="dropdown-toggle">CONFEITARIA ▼</a>
    <a href="#" class="dropdown-toggle">DESCARTÁVEIS ▼</a>
    <a href="#" class="dropdown-toggle">EMBALAGENS ▼</a>
    <a href="#" class="dropdown-toggle">PROMOÇÕES ▼</a>
  </nav>
</body>
</html>