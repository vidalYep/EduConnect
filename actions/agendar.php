<?php
session_start();
include '../includes/conexao.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
$educador_id = $_POST['educador_id'] ?? null;
$data = $_POST['horario'] ?? null;

if (!$usuario_id || !$educador_id || !$data) {
  echo "Dados incompletos para agendamento.";
  exit;
}

// Verificar se já existe um agendamento nesse horário
$verificar = "
SELECT * FROM agendamentos
WHERE usuario_id = $usuario_id
AND data = '$data'
";
$res = $conn->query($verificar);
if ($res->num_rows > 0) {
  echo "<script>alert('Você já tem uma aula marcada nesse horário!'); window.location='../index.php?tela=calendario';</script>";
  exit;
}

// Inserir novo agendamento
$sql = "
INSERT INTO agendamentos (usuario_id, educador_id, data)
VALUES ($usuario_id, $educador_id, '$data')
";
if ($conn->query($sql)) {
  echo "<script>alert('Aula agendada com sucesso!'); window.location='../index.php?tela=calendario';</script>";
} else {
  echo "Erro ao agendar aula: " . $conn->error;
}
?>
