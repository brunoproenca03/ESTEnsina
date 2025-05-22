
<?php

session_start();
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';    
include "./tipoUtilizadores.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title> Novo Utilizador </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    
    <?php
    if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR) {

        $pode = true;

        if ( $_SESSION["tipo_utilizador"] != ADMINISTRADOR ) {
            $pode = false;
            echo "<script> setTimeout(function () { window.location.href = 'PaginaUtilizador.php'; }, 000)</script>";
        }

        if ($pode) {
            echo "<div id='cabecalho'>
                    <a href='index.php' id = 'nomeSite'>
                        ESTensina
                    </a>
                    <div class= 'input-div'>
                        <div id='botao'>
                            <form action='logout.php'>
                                <input type='submit' value='Logout'>
                            </form>
                        </div>
                        <div id='botao'>
                            <form action='GestaoUtilizador.php'>
                                <input type='submit' value='Página Principal'>
                            </form>
                        </div>
                        <div id='botao'>
                        <form action='contacto.php'>
                            <input type='submit' value='Contactos'>
                        </form>
                        </div>
                        </div>
                    </div>";

            echo '
                <div class="container">
                <div class="form-container">
                    <h2>Novo Utilizador</h2>
                    <form method="POST" action="novoUtilizador.php">
                        <div class="form-group">
                            <label for="user">Nome de Utilizador:</label>
                            <input type="text" class="form-control" id="user" name="user" required>
                        </div>
                        <div class="form-group">
                            <label for="data">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data" name="data" required/>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo de Utilizador:</label>
                            <div class="input-group">
                                <select class="form-control" id="tipo" name="tipo">
                                    <option value="Administrador">Administrador</option>
                                    <option value="Docente">Docente</option>
                                    <option value="Aluno">Aluno</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="morada">Morada:</label>
                            <input type="text" class="form-control" id="morada" name="morada">
                        </div>
                        <div class="form-group">
                            <label for="pass">Password:</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div>
                        <div class="form-group">
                            <label for="telemovel">Telemóvel:</label>
                            <input type="tel" class="form-control" id="telemovel" name="telemovel">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Criar</button>
                    </form>
                 </div>
                </div>';

        }
    } else {
        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
    }
        
    ?>
</body>

</html>