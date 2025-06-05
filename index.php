<?php
session_start();
$tela = $_GET['tela'] ?? 'login';

switch ($tela) {
  case 'cadastro':
    include 'pages/cadastro.php';
    break;
  case 'home':
    if (!isset($_SESSION['usuario'])) {
      header('Location: index.php?tela=login');
      exit;
    }
    include 'pages/home.php';
    break;
  case 'educadores':
  if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?tela=login');
    exit;
  }
  include 'pages/educadores.php';
  break;
  case 'calendario':
    include 'pages/calendario.php';
    break;
  case 'agendar':
    include 'pages/agendar.php';
    break;
  default:
    include 'pages/login.php';
}
?>
