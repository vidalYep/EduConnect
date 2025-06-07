<?php
if (!isset($_SESSION)) session_start();
include 'includes/conexao.php';

$sql = "
SELECT u.id, u.nome, u.email, e.materia, e.bairro, e.cidade, e.avaliacao, e.foto, e.valor_hora
FROM usuarios u
JOIN educadores e ON u.id = e.usuario_id
WHERE u.tipo = 'educador'
ORDER BY u.nome ASC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Educadores</title>
  <link rel="stylesheet" href="./css/estilo.css?v=<?= time() ?>">
  <link rel="stylesheet" href="./css/critical-fixes.css?v=<?= time() ?>">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
  <h2 style="text-align:center; margin-top: 20px;">Educadores Disponíveis</h2>

  <div class="educadores-container">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="educador-card">
          <?php
            $foto = $row['foto'] ?? '';
            $foto_path = (!empty($foto)) ? $foto : 'images/default-profile.jpg';
          ?>
          <img src="<?= $foto_path ?>" alt="Foto de <?= htmlspecialchars($row['nome']) ?>">
          <h3><?= htmlspecialchars($row['nome']) ?></h3>
          <p><i class="fas fa-book"></i> <strong>Matéria:</strong> <?= htmlspecialchars($row['materia']) ?></p>
          <p><i class="fas fa-map-marker-alt"></i> <strong>Cidade:</strong> <?= htmlspecialchars($row['cidade']) ?></p>
          <?php
            $valor = !empty($row['valor_hora']) ? number_format($row['valor_hora'], 2, ',', '.') : '100,00';
          ?>
          <p><i class="fas fa-dollar-sign"></i> <strong>Valor/Hora:</strong> R$ <?= $valor ?></p>
          <a href="index.php?tela=agendar&id=<?= $row['id'] ?>" class="btn-agendar"><i class="fas fa-calendar-plus"></i> Agendar Aula</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center;">Nenhum educador cadastrado no momento.</p>
    <?php endif; ?>
  </div>
</main>

<!-- Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</body>
</html>
