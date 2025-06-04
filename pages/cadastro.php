<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body class="body-form">
  <div class="form-container">
    <img src="images/logo.png" alt="EduConnect Logo" class="header-logo">
    <h2>Cadastro</h2>
    <form action="actions/cadastro.php" method="POST">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Cadastrar</button>
  </form>
    <a href="index.php?tela=login">Já tem conta? Login</a>
  </div>
</body>
</html>
