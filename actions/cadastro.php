<?php
include '../includes/conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
if ($conn->query($sql)) {
  header("Location: ../index.php?tela=login");
} else {
  echo "Erro: " . $conn->error;
}
?>
