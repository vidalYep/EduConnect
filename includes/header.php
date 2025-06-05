<?php if (!isset($_SESSION)) session_start(); ?>
<header>
  <img src="images/logo.png" alt="EduConnect Logo" class="header-logo">
  <div class="menu">
    <a href="index.php?tela=home">Início</a>
    <a href="index.php?tela=calendario">Calendário</a>
    <a href="index.php?tela=educadores">Educadores</a>
  </div>
  <div>
    <span class="usuario">Olá, <?= htmlspecialchars($_SESSION['usuario'] ?? '') ?>!</span>
    &nbsp;|&nbsp;
    <a href="actions/logout.php" class="logout">Sair</a>
  </div>
</header>
