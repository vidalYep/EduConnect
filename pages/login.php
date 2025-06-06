<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/estilo.css?v=<?= time() ?>">
</head>
<body class="body-form">
  <div class="login-page-container">
    <div class="login-info-panel">
      <h3>Bem-vindo de volta! 👋</h3>
      <p>Conecte-se à nossa plataforma e tenha acesso a professores qualificados para aulas particulares sob medida para você.</p>
      <p>Encontre especialistas em diversas áreas, solicite aulas com facilidade e acompanhe tudo diretamente pela sua conta.</p>
      <p class="highlight">🎓 Aprenda no seu ritmo, com quem entende do assunto.</p>
      <p>Faça login para continuar.</p>
    </div>
    <div class="login-form-panel">
      <img src="images/logo.png" alt="EduConnect Logo" class="header-logo">
      <h2>Login</h2>
      <form action="actions/login.php" method="POST">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
      </form>
      <a href="index.php?tela=cadastro">Não tem conta? Cadastre-se</a>
    </div>
  </div>
</body>
</html>
