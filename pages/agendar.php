<?php
if (!isset($_SESSION)) session_start();
include 'includes/conexao.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
if (!$usuario_id) {
  header("Location: index.php?tela=login");
  exit;
}

$educador_id = $_GET['id'] ?? null;
if (!$educador_id) {
  echo "<p>Educador não encontrado.</p>";
  exit;
}

// Buscar dados do educador
$sql = "SELECT u.nome, e.* 
        FROM educadores e
        JOIN usuarios u ON u.id = e.usuario_id
        WHERE e.usuario_id = $educador_id";
$result = $conn->query($sql);
$educador = $result->fetch_assoc();

if (!$educador) {
  echo "<p>Educador não encontrado.</p>";
  exit;
}

// Horários fixos (mock)
$horarios_disponiveis = [
  '2025-06-05 10:00',
  '2025-06-05 14:00',
  '2025-06-06 09:00',
  '2025-06-06 15:00',
  '2025-06-07 11:00'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Agendar Aula</title>
  <link rel="stylesheet" href="css/estilo.css">
  <style>
    .agendar-container {
      max-width: 500px;
      margin: 30px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #f9f9f9;
    }
    .agendar-container img {
      width: 100%;
      max-height: 200px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .agendar-container h3 {
      margin-bottom: 10px;
    }
    .horario {
      margin: 8px 0;
    }
    .btn-agendar {
      background-color: #28a745;
      color: white;
      padding: 8px 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn-agendar:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="agendar-container">
  <?php
    $foto = $educador['foto'] ?? '';
    $foto_path = (!empty($foto)) ? $foto : 'images/educadorPadrao.png';
  ?>
    <img src="<?= $foto_path ?>" alt="Foto de <?= htmlspecialchars($educador['nome']) ?>">

  <h3><?= htmlspecialchars($educador['nome']) ?></h3>
  <p><strong>Matéria:</strong> <?= htmlspecialchars($educador['materia']) ?></p>
  <p><strong>Local:</strong> <?= htmlspecialchars($educador['bairro']) ?>, <?= htmlspecialchars($educador['cidade']) ?></p>

  <form action="actions/agendar.php" method="POST">

  
    <input type="hidden" name="educador_id" value="<?= $educador_id ?>">


    <label for="horario">Escolha um horário:</label>
    <select name="horario" id="horario" required>
      <?php foreach ($horarios_disponiveis as $horario): ?>
        <option value="<?= $horario ?>"><?= date('d/m/Y H:i', strtotime($horario)) ?></option>
      <?php endforeach; ?>
    </select>

    <br><br>
    <button type="submit" class="btn-agendar">Confirmar Agendamento</button>
  </form>
</div>

</body>
</html>
