<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dados Pessoais</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <?php
    include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
    include "tipoUtilizadores.php";
    session_start();
    if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO || $_SESSION["tipo_utilizador"] != VISITANTE) ) {
        $id_user = $_SESSION["user"];

        $sql = "SELECT * FROM utilizador WHERE nome='$id_user'";
        $res = mysqli_query($conn, $sql);
        $dados_user = mysqli_fetch_array($res);
        $nome = $dados_user['nome'];
        $dataNascimento = $dados_user['data_nascimento'];
        $telemovel = $dados_user['telemovel'];
        $morada = $dados_user['morada'];
        $email = $dados_user['email'];
        $tipoUtilizador = $dados_user['tipo_utilizador'];

        if($tipoUtilizador == '1'){
            $tipoDeUtilizador = "Administrador";
        } elseif($tipoUtilizador == '2'){
            $tipoDeUtilizador = "Docente";
        } elseif($tipoUtilizador == '3'){
            $tipoDeUtilizador = "Aluno";
        } elseif($tipoUtilizador == '4'){
            $tipoDeUtilizador = "Aluno Não Validado";
        } elseif($tipoUtilizador == '5'){
            $tipoDeUtilizador = "Visitante";
        }

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
                            <form action='PaginaUtilizador.php'>
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

    } else {
        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
    }
    ?>


    <div class="container">
        <div class="form-container">
            <h2>Dados Pessoais</h2>
            <form method="POST" action="alteraDados.php">
                <div class="form-group">
                    <label for="IdUser">Nome de Utilizador:</label>
                    <input type="text" class="form-control" id="IdUser" name="IdUser" value="<?php echo $nome; ?>">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de Utilizador:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $tipoDeUtilizador; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="IdUser">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data" name="data"
                        value="<?php echo $dataNascimento; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label for="pass">Nova Password (facultativo):</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="form-group">
                    <label for="conf_pass">Confirmação da Password:</label>
                    <input type="password" class="form-control" id="conf_pass" name="conf_pass">
                </div>
                <div class="form-group">
                    <label for="telemovel">Telemóvel:</label>
                    <input type="tel" class="form-control" id="telemovel" name="telemovel"
                        value="<?php echo $telemovel; ?>">
                </div>
                <div class="form-group">
                    <label for="morada">Morada:</label>
                    <input type="text" class="form-control" id="morada" name="morada" value="<?php echo $morada; ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
            </form>
        </div>
    </div>

</body>

</html>