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

$eventos = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $eventos[] = [
      'title' => ($tipo === 'aluno')
        ? $row['educador_nome'] . ' - ' . $row['materia']
        : $row['aluno_nome'],
      'start' => $row['data']
    ];
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Calendário de Aulas</title>
  <link rel="stylesheet" href="css/estilo.css">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
  <style>
    .calendar-wrapper {
      display: flex;
      max-width: 1200px;
      margin: 30px auto;
      gap: 30px;
    }
    #calendar {
      flex: 2;
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .cards-laterais {
      flex: 1;
    }
    .aula-card {
      background: #f9f9f9;
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
  <h2 style="text-align:center; margin-top: 20px;">
    <?= ($tipo === 'aluno') ? "Minhas Aulas Agendadas" : "Aulas Marcadas com Alunos" ?>
  </h2>

  <div class="calendar-wrapper">
    <div id='calendar'></div>

    <div class="cards-laterais">
      <?php foreach ($eventos as $evento): ?>
        <div class="aula-card">
          <strong><?= htmlspecialchars($evento['title']) ?></strong><br>
          📅 <?= date('d/m/Y H:i', strtotime($evento['start'])) ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'pt-br',
      events: <?= json_encode($eventos) ?>
    });
    calendar.render();
  });
</script>

</body>
</html>
