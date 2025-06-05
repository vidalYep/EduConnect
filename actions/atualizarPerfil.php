<?php
session_start();
include '../includes/conexao.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
$tipo = $_SESSION['tipo'] ?? null;

if (!$usuario_id) {
  header("Location: ../index.php?tela=login");
  exit;
}

$nome = $_POST['nome'] ?? '';

$conn->query("UPDATE usuarios SET nome = '$nome' WHERE id = $usuario_id");

if ($tipo === 'educador') {
  $materia = $_POST['materia'] ?? '';
  $bairro = $_POST['bairro'] ?? '';
  $cidade = $_POST['cidade'] ?? '';

  $sql = "UPDATE educadores 
          SET materia = '$materia', bairro = '$bairro', cidade = '$cidade'
          WHERE usuario_id = $usuario_id";
  $conn->query($sql);
}

// Atualiza a variavel nome depois do update
$conn->query("UPDATE usuarios SET nome = '$nome' WHERE id = $usuario_id");
$_SESSION['usuario'] = $nome; 

echo "<script>alert('Perfil atualizado com sucesso!'); window.location='../index.php?tela=perfil';</script>";
