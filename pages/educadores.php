<?php
if (!isset($_SESSION)) session_start();
include 'includes/conexao.php';

$sql = "
SELECT u.id, u.nome, u.email, e.materia, e.bairro, e.cidade, e.avaliacao
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
  <link rel="stylesheet" href="css/estilo.css">
  <style>
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
    }
    .card {
      border: 1px solid #ddd;
      border-radius: 10px;
      width: 250px;
      text-align: center;
      padding: 15px;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
      background-color: #fff;
    }
    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
    }
    .card h3 {
      margin: 10px 0 5px;
    }
    .card p {
      margin: 5px 0;
      font-size: 14px;
      color: #444;
    }
    .card .avaliacao {
      color: #f39c12;
      font-weight: bold;
    }
    .card a.btn {
      display: inline-block;
      margin-top: 10px;
      background-color: #007bff;
      color: white;
      padding: 8px 12px;
      text-decoration: none;
      border-radius: 5px;
    }
    .card a.btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
  <h2 style="text-align:center; margin-top: 20px;">Educadores Disponíveis</h2>

  <div class="container">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">
          <img src="images/educadores.png" alt="Foto de <?= htmlspecialchars($row['nome']) ?>">
          <h3><?= htmlspecialchars($row['nome']) ?></h3>
          <p><strong>Matéria:</strong> <?= htmlspecialchars($row['materia']) ?></p>
          <p><strong>Local:</strong> <?= htmlspecialchars($row['bairro']) ?>, <?= htmlspecialchars($row['cidade']) ?></p>
          <p><strong>E-mail:</strong> <?= htmlspecialchars($row['email']) ?></p>
          <p class="avaliacao">⭐ <?= htmlspecialchars($row['avaliacao']) ?>/5</p>
          <a href="index.php?tela=agendar&id=<?= $row['id'] ?>" class="btn">Agendar Aula</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center;">Nenhum educador cadastrado no momento.</p>
    <?php endif; ?>
  </div>
</main>

</body>
</html>
