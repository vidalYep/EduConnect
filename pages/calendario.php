<?php
if (!isset($_SESSION)) session_start();
include 'includes/conexao.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
$tipo = $_SESSION['tipo'] ?? null;

if (!$usuario_id || !$tipo) {
  header("Location: index.php?tela=login");
  exit;
}

if ($tipo === 'aluno') {
  $sql = "
    SELECT a.data, u.nome AS educador_nome, e.materia, e.bairro, e.cidade
    FROM agendamentos a
    JOIN usuarios u ON a.educador_id = u.id
    JOIN educadores e ON u.id = e.usuario_id
    WHERE a.aluno_id = $usuario_id
    ORDER BY a.data ASC
  ";
} elseif ($tipo === 'educador') {
  $sql = "
    SELECT a.data, u.nome AS aluno_nome, u.email
    FROM agendamentos a
    JOIN usuarios u ON a.aluno_id = u.id
    WHERE a.educador_id = $usuario_id
    ORDER BY a.data ASC
  ";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Calendário</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
  <h2 style="text-align:center; margin-top: 20px;">
    <?= ($tipo === 'aluno') ? "Minhas Aulas Agendadas" : "Aulas Marcadas com Alunos" ?>
  </h2>

  <div style="max-width: 600px; margin: 0 auto;">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="aula">
          <?php if ($tipo === 'aluno'): ?>
            <h4><?= htmlspecialchars($row['educador_nome']) ?> – <?= htmlspecialchars($row['materia']) ?></h4>
            <p>📅 <?= date('d/m/Y H:i', strtotime($row['data'])) ?></p>
            <p>📍 <?= htmlspecialchars($row['bairro']) ?>, <?= htmlspecialchars($row['cidade']) ?></p>
          <?php else: ?>
            <h4><?= htmlspecialchars($row['aluno_nome']) ?></h4>
            <p>📅 <?= date('d/m/Y H:i', strtotime($row['data'])) ?></p>
            <p>📧 <?= htmlspecialchars($row['email']) ?></p>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center;">Nenhuma aula agendada.</p>
    <?php endif; ?>
  </div>
</main>

</body>
</html>
