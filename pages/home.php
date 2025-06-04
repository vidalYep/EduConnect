<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<header>
  <img src="images/logo.png" alt="EduConnect Logo" class="header-logo">
  <div class="menu">
    <a href="#">Teste 1</a>
    <a href="#">Teste 2</a>
    <a href="#">Teste 3</a>
  </div>
  <div>
    <span class="usuario">Olá, <?= htmlspecialchars($_SESSION['usuario']) ?>!</span>
    &nbsp;|&nbsp;
    <a href="actions/logout.php" class="logout">Sair</a>
  </div>
</header>

<main>
  <h2>Bem-vindo à Home!</h2>
  <p>Você está logado no sistema.</p>
</main>

</body>
</html>
