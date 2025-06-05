<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="css/estilo.css">
  <style>
    .extra-campos {
      display: none;
      margin-top: 10px;
    }
  </style>
</head>
<body class="body-form">
  <div class="form-container">
    <img src="images/logo.png" alt="EduConnect Logo" class="header-logo">
    <h2>Cadastro</h2>

    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
      <script>
      alert("Cadastro realizado com sucesso!");
      window.location.href = "index.php?tela=login";
      </script>
    <?php endif; ?>

    <form action="actions/cadastro.php" method="POST" onsubmit="return validarEducador()">

      <select name="tipo" id="tipo" required onchange="mostrarCamposEducador()">
        <option value="aluno">Aluno</option>
        <option value="educador">Educador</option>
      </select>

      <input type="text" name="nome" placeholder="Nome" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>

      <div class="extra-campos" id="camposEducador">
        <input type="text" name="materia" id="materia" placeholder="Matéria que leciona">
        <input type="text" name="bairro" id="bairro" placeholder="Bairro">
        <input type="text" name="cidade" id="cidade" placeholder="Cidade">
      </div>

      <button type="submit">Cadastrar</button>
    </form>

    <a href="index.php?tela=login">Já tem conta? Login</a>
  </div>

  <script>
    function mostrarCamposEducador() {
      const tipo = document.getElementById('tipo').value;
      const campos = document.getElementById('camposEducador');
      campos.style.display = (tipo === 'educador') ? 'block' : 'none';
    }

    function validarEducador() {
  const tipo = document.getElementById('tipo').value;
  if (tipo === 'educador') {
    const materia = document.getElementById('materia').value.trim();
    const bairro = document.getElementById('bairro').value.trim();
    const cidade = document.getElementById('cidade').value.trim();

    if (!materia || !bairro || !cidade) {
      alert("Por favor, preencha todos os campos do educador.");
      return false;
    }
  }
  return true;
}
  </script>
</body>
</html>
