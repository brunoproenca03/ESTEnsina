<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include 'tipoUtilizadores.php';

session_start();

if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] != VISITANTE || $_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO) ) {
    echo "<script> alert ('Têm uma sessão iniciada, faça o logout da conta atual!!') </script>";
	  echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0)</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="main.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="form-wrap">
        <h1>Login</h1>
        <form method="POST" action="processa_login.php">
          <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" required />
          </div>
          <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" id="pass" name="pass" required />
          </div>
          <div class="form-group">
            <input type="submit" value="OK" />
          </div>
        </form>
        <p>
          Ainda não tem uma conta? <a href="registo.php">Registe-se aqui</a>.
        </p>
      </div>
    </div>
  </body>
</html>
