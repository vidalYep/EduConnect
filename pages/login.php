<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <h2>Login</h2>
  <form action="actions/login.php" method="POST">
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
  </form>
  <a href="index.php?tela=cadastro">Não tem conta? Cadastre-se</a>
</body>
</html>
