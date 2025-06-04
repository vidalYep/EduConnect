<?php
session_start();
$tela = $_GET['tela'] ?? 'login';

switch ($tela) {
  case 'cadastro':
    include 'pages/cadastro.php';
    break;
  case 'home':
    if (!isset($_SESSION['usuario'])) {
      header('Location: ?tela=login');
      exit;
    }
    include 'pages/home.php';
    break;
  default:
    include 'pages/login.php';
}
?>
