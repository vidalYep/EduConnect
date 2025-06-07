<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

$tela = $_GET['tela'] ?? 'login';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= getPageTitle($tela) ?></title>
  <link rel="stylesheet" href="<?= $base_url ?>/css/estilo.css">
</head>
<body>

<?php
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

  case 'catalogo':
    if (!isset($_SESSION['usuario'])) {
      header('Location: index.php?tela=login');
      exit;
    }
    include 'pages/catalogo.php';
    break;

  case 'agendar':
    include 'pages/agendar.php';
    break;

  case 'perfil':
    if (!isset($_SESSION['usuario'])) {
      header("Location: index.php?tela=login");
      exit;
    }
    include 'pages/perfil.php';
    break;

  case 'aulas':
    include 'pages/aulas.php';
    break;

  default:
    include 'pages/login.php';
}

if ($tela !== 'login' && $tela !== 'cadastro') {
  includeFooter();
}
?>

</body>
</html>
