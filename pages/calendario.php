<?php
if (!isset($_SESSION)) session_start();
include 'includes/conexao.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
if (!$usuario_id) {
  header("Location: index.php?tela=login");
  exit;
}

// Consulta os agendamentos do usuário
$sql = "
SELECT a.data, e.nome, e.materia, e.bairro, e.cidade
FROM agendamentos a
JOIN educadores e ON a.educador_id = e.id
WHERE a.usuario_id = $usuario_id
ORDER BY a.data ASC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Calendário</title>
  <link rel="stylesheet" href="css/estilo.css">
  <style>
    .aula {
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 10px;
      background-color: #f9f9f9;
      text-align: left;
      width: 300px;
      margin: 10px auto;
    }
    .aula h4 {
      margin: 0 0 5px;
    }
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
  <h2>Minhas Aulas</h2>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="aula">
        <h4><?= htmlspecialchars($row['nome']) ?> – <?= htmlspecialchars($row['materia']) ?></h4>
        <p>📅 <?= date('d/m/Y H:i', strtotime($row['data'])) ?></p>
        <p>📍 <?= htmlspecialchars($row['bairro']) ?>, <?= htmlspecialchars($row['cidade']) ?></p>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>Você ainda não tem aulas agendadas.</p>
  <?php endif; ?>
</main>

</body>
</html>
