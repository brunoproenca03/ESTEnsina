<?php 
  include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
  include "tipoUtilizadores.php";
  session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Editar Dados Pessoais </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>

    <?php
    if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR){
        $_SESSION["edita"] = $_GET["nomeUser"];
        $id_user =  $_SESSION["edita"];

        $sql = "SELECT * FROM utilizador WHERE nome='$id_user'";
        $res = mysqli_query($conn, $sql);
        $dados_user = mysqli_fetch_array($res);
        $idUtilizador = $dados_user['id_utilizador'];
        $nome = $dados_user['nome'];
        $dataNascimento= $dados_user['data_nascimento'];
        $telemovel = $dados_user['telemovel'];
        $morada = $dados_user['morada'];
        $email = $dados_user['email'];
        $tipou = $dados_user['tipo_utilizador'];

        //Cabeçalho juntamente com botões
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
    } else {
        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
    }
    
    ?>

    <div class="container">
            <div class="form-container">
                <h2>Editar Dados</h2>
                <form method="POST" action="editaDados.php?id=<?= $idUtilizador; ?>">
                    <div class="form-group">
                        <label for="IdUser">Nome de Utilizador:</label>
                        <input type="text" class="form-control" id="IdUser" name="IdUser" value="<?php echo $nome; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="data">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data" name="data" value="<?php echo $dataNascimento;?>" >
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Utilizador:</label>
                        <div class="input-group">
                            <select class="form-control" id="tipo" name="tipo">
                                <?php
                                if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR){
                                    // Consulta SQL para buscar o tipo de usuário pré-selecionado
                                    $sql = "SELECT tipoutilizador FROM tipoutilizador WHERE id_tipo = '$tipou'";
                                    $resultado_preselecionado = mysqli_query($conn, $sql);

                                    // Verifica se a consulta foi bem-sucedida
                                    if ($resultado_preselecionado) {
                                        $tipo = mysqli_fetch_assoc($resultado_preselecionado);
                                        $tipo_usuario_preselecionado = $tipo['tipoutilizador'];
                                    } else {
                                        echo "Erro na consulta SQL: " . mysqli_error($conn);
                                    }

                                    // Consulta SQL para buscar os tipos de usuário, excluindo os tipos com ids 5
                                    $sql_ = "SELECT tipoutilizador FROM tipoutilizador WHERE id_tipo != '5'";
                                    $resultado = mysqli_query($conn, $sql_);

                                    // Verifica se a consulta foi bem-sucedida
                                    if ($resultado) {
                                        // Loop através dos resultados da consulta
                                        while ($row = mysqli_fetch_assoc($resultado)) {
                                            $tipo_usuario = $row['tipoutilizador'];
                                            
                                            // Verifica se o tipo de usuário atual é o pré-selecionado
                                            $selected = ($tipo_usuario === $tipo_usuario_preselecionado) ? "selected" : "";

                                            // Imprime as opções do select, com a opção pré-selecionada marcada
                                            echo "<option value='$tipo_usuario' $selected>$tipo_usuario</option>";
                                        }
                                    } else {
                                        echo "Erro na consulta SQL: " . mysqli_error($conn);
                                    }
                                } else {
                                    echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
                                }
                                
                                ?>
                            </select>
                        </div>
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
                        <input type="tel" class="form-control" id="telemovel" name="telemovel" value="<?php echo $telemovel; ?>">
                    </div>
                    <div class="form-group">
                        <label for="morada">Morada:</label>
                        <input type="text" class="form-control" id="morada" name="morada" value="<?php echo $morada; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Editar</button>
                </form>
            </div>
        </div>
    </body>

</html>