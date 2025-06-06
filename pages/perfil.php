<?php
if (!isset($_SESSION)) session_start();
include 'includes/conexao.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
$tipo = $_SESSION['tipo'] ?? null;

if (!$usuario_id) {
  header("Location: index.php?tela=login");
  exit;
}

$sql = "SELECT * FROM usuarios WHERE id = $usuario_id";
$usuario = $conn->query($sql)->fetch_assoc();

$educador = null;
if ($tipo === 'educador') {
  $sql_educador = "SELECT * FROM educadores WHERE usuario_id = $usuario_id";
  $educador = $conn->query($sql_educador)->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Perfil</title>
  <link rel="stylesheet" href="css/estilo.css?v=<?= time() ?>">
  <style>
    .perfil-container {
      max-width: 500px;
      margin: 30px auto;
      padding: 20px;
      background: #f4f4f4;
      border-radius: 10px;
    }
    .perfil-container input {
      display: block;
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
    }
    .perfil-container label {
      font-weight: bold;
    }
    .readonly {
      background-color: #e9e9e9;
    }
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="perfil-container">
  <h2>Meu Perfil</h2>
  <form action="actions/atualizarPerfil.php" method="POST" enctype="multipart/form-data">
    <label>Tipo de Conta:</label>
    <input type="text" value="<?= htmlspecialchars($usuario['tipo']) ?>" class="readonly" disabled>

    <label>E-mail:</label>
    <input type="email" value="<?= htmlspecialchars($usuario['email']) ?>" class="readonly" disabled>

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>

    <?php if ($tipo === 'educador'): ?>
      <label>Matéria:</label>
      <input type="text" name="materia" value="<?= htmlspecialchars($educador['materia'] ?? '') ?>">

      <label>Bairro:</label>
      <input type="text" name="bairro" value="<?= htmlspecialchars($educador['bairro'] ?? '') ?>">

      <label>Cidade:</label>
      <input type="text" name="cidade" value="<?= htmlspecialchars($educador['cidade'] ?? '') ?>">

      <label>Foto de Perfil:</label>
      <input type="file" name="foto" accept="image/*">
    <?php endif; ?>

    <button type="submit">Atualizar Perfil</button>
  </form>

  
</div>

</body>
</html>
