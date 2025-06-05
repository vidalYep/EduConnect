<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
  <h1>Olá, <?= htmlspecialchars($_SESSION['usuario']) ?>! </h1>
  <h2>Bem-vindo à Home! </h2>
  <p>Você está logado no sistema.</p>
</main>

</body>
</html>
