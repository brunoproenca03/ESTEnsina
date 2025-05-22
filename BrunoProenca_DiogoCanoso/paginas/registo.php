<?php
  include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
  include "tipoUtilizadores.php";
  
  session_start();
  if(!isset($_SESSION["user"]) && !isset($_SESSION["id"]) && !isset($_SESSION["tipo_utilizador"])){
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registo</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="main.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="form-wrap">
        <h1>Registo</h1>
        <form method="POST" action="processa_registo.php">
          <div class="form-group">
            <label for="new-name">Nome</label>
            <input type="text" id="new-name" name="new-name" required />
          </div>
          <div class="form-group">
            <label for="new-data">Data de Nascimento</label>
            <input type="date" id="new-data" name="new-data" required data-placeholder="yyyy/mm/dd"/>
          </div>
          <div class="form-group">
            <label for="new-email">E-mail</label>
            <input type="email" id="new-email" name="new-email" required />
          </div>
          <div class="form-group">
            <label for="new-morada">Morada</label>
            <input type="text" id="new-morada" name="new-morada" required />
          </div>
          <div class="form-group">
            <label for="new-password">Senha</label>
            <input
              type="password"
              id="new-password"
              name="new-password"
              required
            />
          </div>
          <div class="form-group">
            <label for="new-phone">Telefone</label>
            <input type="text" id="new-phone" name="new-phone" required />
          </div>
          <div class="form-group">
            <input type="submit" value="Registrar" />
          </div>
        </form>
        <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
      </div>
    </div>
  </body>
</html>
<?php  
  } else {
    echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 0)</script>";
  }
?>