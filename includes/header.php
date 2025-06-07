<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once __DIR__ . "/config.php"; ?>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Estilos -->
<link rel="stylesheet" href="<?= $base_url ?>/css/estilo.css?v=<?= time() ?>">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- CSS de tema e toggle -->
<link rel="stylesheet" href="<?= $base_url ?>/css/theme-toggle.css?v=<?= time() ?>">
<link rel="stylesheet" href="<?= $base_url ?>/css/background.css?v=<?= time() ?>">
<link rel="stylesheet" href="<?= $base_url ?>/css/theme.css?v=<?= time() ?>">
<link rel="stylesheet" href="<?= $base_url ?>/css/dark-theme.css?v=<?= time() ?>">
<link rel="stylesheet" href="<?= $base_url ?>/css/chat-fix-dark.css?v=<?= time() ?>">

<nav class="navbar">
  <div class="nav-container">
    <a href="<?= $base_url ?>/index.php" class="nav-logo">
      <img src="<?= $base_url ?>/images/logo.png" alt="EduConnect Logo" class="header-logo">
    </a>

    <button class="nav-toggle" aria-label="Abrir Menu">
      <span class="hamburger"></span>
    </button>

    <?php $tela_atual = $_GET['tela'] ?? 'login'; ?>
    <div class="nav-menu">
      <div class="nav-links">
        <a href="<?= $base_url ?>/index.php?tela=home" class="nav-link <?= $tela_atual === 'home' ? 'active' : '' ?>">
          <i class="fas fa-home"></i>
          <span>Início</span>
        </a>
        <a href="<?= $base_url ?>/index.php?tela=educadores" class="nav-link <?= $tela_atual === 'educadores' ? 'active' : '' ?>">
          <i class="fas fa-chalkboard-teacher"></i>
          <span>Educadores</span>
        </a>
        <a href="<?= $base_url ?>/index.php?tela=aulas" class="nav-link <?= $tela_atual === 'aulas' ? 'active' : '' ?>">
          <i class="fas fa-book-reader"></i>
          <span>Aulas Complementares</span>
        </a>
        <a href="<?= $base_url ?>/pages/chat.php" class="nav-link <?= $tela_atual === 'chat' ? 'active' : '' ?>">
          <i class="fas fa-comments"></i>
          <span>Chat de Dúvidas</span>
        </a>
        <a href="<?= $base_url ?>/pages/calendario.php" class="nav-link <?= $tela_atual === 'calendario' ? 'active' : '' ?>">
          <i class="fas fa-calendar-alt"></i>
          <span>Calendário</span>
        </a>
      </div>

      <div class="nav-user">
        <span class="user-greeting">
          <i class="fas fa-user-circle"></i>
          <a href="<?= $base_url ?>/index.php?tela=perfil"><?= htmlspecialchars($_SESSION['usuario'] ?? '') ?></a>
        </span>
        <button id="theme-toggle" class="theme-toggle" aria-label="Alterar tema">
          <i class="fas fa-moon" id="theme-icon"></i>
        </button>
        <a href="<?= $base_url ?>/actions/logout.php" class="nav-logout">
          <i class="fas fa-sign-out-alt"></i>
          <span>Sair</span>
        </a>
      </div>
    </div>
  </div>
</nav>

<script>
  document.querySelector('.nav-toggle').addEventListener('click', function() {
    document.querySelector('.nav-menu').classList.toggle('active');
    this.classList.toggle('active');
  });
  
  // Funcionalidade de alternância de tema
  document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    
    // Verificar tema atual no localStorage
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);
    
    // Atualizar ícone baseado no tema atual
    if (currentTheme === 'dark') {
      themeIcon.classList.replace('fa-moon', 'fa-sun');
    } else {
      themeIcon.classList.replace('fa-sun', 'fa-moon');
    }
    
    // Função para alternar o tema
    themeToggle.addEventListener('click', function() {
      let theme = document.documentElement.getAttribute('data-theme');
      let newTheme = theme === 'light' ? 'dark' : 'light';
      
      // Atualizar o tema
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      
      // Atualizar o ícone
      if (newTheme === 'dark') {
        themeIcon.classList.replace('fa-moon', 'fa-sun');
      } else {
        themeIcon.classList.replace('fa-sun', 'fa-moon');
      }
    });
  });
</script>
