<?php if (!isset($_SESSION)) session_start(); ?>
<header>
  <img src="images/logo.png" alt="EduConnect Logo" class="header-logo">
  <?php $tela_atual = $_GET['tela'] ?? 'login'; ?>
  <div class="menu">
    <a href="index.php?tela=home" class="<?= $tela_atual === 'home' ? 'active' : '' ?>">Início</a>
    <a href="index.php?tela=educadores" class="<?= $tela_atual === 'educadores' ? 'active' : '' ?>">Educadores</a>
    <a href="index.php?tela=calendario" class="<?= $tela_atual === 'calendario' ? 'active' : '' ?>">Calendário</a>
  </div>
  <div>
    <span class="usuario">Olá, <a href="index.php?tela=perfil"><?= htmlspecialchars($_SESSION['usuario'] ?? '') ?></a>!</span>
    &nbsp;|&nbsp;
    <a href="actions/logout.php" class="logout">Sair</a>
  </div>
</header>
