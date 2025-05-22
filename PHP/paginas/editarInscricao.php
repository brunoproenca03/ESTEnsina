<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Editar Inscrição</title>
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
        
        $id_aluno = $_GET["aluno"];
        $id_curso = $_GET["curso"];

        $sql = 'SELECT
                    Inscricao.curso AS id_curso,
                    aluno.nome AS nome_do_aluno,
                    docente.nome AS nome_do_docente,
                    Curso.nome AS nome_do_curso,
                    estadoInscricao.descricao AS estado_inscricao,
                    Inscricao.data_inscricao AS data_inscricao,
                    Inscricao.custo AS preco
                    FROM Inscricao
                    JOIN Utilizador AS aluno ON Inscricao.aluno = aluno.id_utilizador
                    JOIN Curso ON Inscricao.curso = Curso.id_curso
                    JOIN Utilizador AS docente ON Curso.docente = docente.id_utilizador
                    JOIN estadoinscricao ON Inscricao.estadoDaInscricao = estadoinscricao.estadoInscricao
                    WHERE Inscricao.aluno = "'. $id_aluno . '" AND Inscricao.curso = "'.$id_curso.'" ORDER BY Inscricao.data_inscricao';
        $res = mysqli_query($conn, $sql);
        $dadosInscricao = mysqli_fetch_array($res);
        $nomeAluno = $dadosInscricao['nome_do_aluno'];
        $nomeDocente = $dadosInscricao['nome_do_docente'];
        $nomeCurso = $dadosInscricao['nome_do_curso'];
        $dataDeInscricao = $dadosInscricao['data_inscricao'];
        $estadoInscricao = $dadosInscricao['estado_inscricao'];
        $custo = $dadosInscricao['preco'];

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
                            <form action='verInscricoesAlunos.php'>
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

    <?php

        if($_SESSION["tipo_utilizador"] == ALUNO){ 

    ?>
    
    <div class="container">
        <div class="form-container">
            <h2>Editar Inscrição</h2>
            <form method="POST" action="alteraDadosInscricaoAluno.php?idcurso=<?php echo $id_curso; ?>&idaluno=<?php echo $id_aluno; ?>">
                <div class="form-group">
                    <label for="aluno">Nome do Aluno:</label>
                    <input type="text" class="form-control" id="aluno" name="aluno" value="<?php echo $nomeAluno; ?>" readonly>
                </div>
                <div class="form-group">
                        <label for="curso">Curso</label>
                        <div class="input-group">
                            <select class="form-control" id="curso" name="curso">
                                <?php
                                if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ALUNO) {
                                    $cursos = "SELECT * FROM curso";
                                    $tdCursos = mysqli_query($conn, $cursos);
                                    
                                    while($todosOsCursos = mysqli_fetch_array($tdCursos)){
                                        $todCursos = $todosOsCursos["nome"];

                                        if($todCursos == $nomeCurso){
                                            echo "<option value='$todCursos' selected>$todCursos</option>";
                                        } else {
                                            echo "<option value='$todCursos'>$todCursos</option>";
                                        }

                                    }

                                } else {
                                    echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="docente">Docente:</label>
                            <div class="input-group">
                                <select class="form-control" id="docente" name="docente">
                                    <?php
                                    if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ALUNO) {
                                        $docentes = "SELECT nome FROM utilizador WHERE tipo_utilizador = '2'";
                                        $tdDocentes= mysqli_query($conn, $docentes);
                                        
                                        while($todosOsDocentes = mysqli_fetch_array($tdDocentes)){
                                            $todDocentes = $todosOsDocentes["nome"];

                                            if($todDocentes == $nomeDocente){
                                                echo "<option value='$todDocentes' selected>$todDocentes</option>";
                                            } else {
                                                echo "<option value='$todDocentes'>$todDocentes</option>";
                                            }

                                        }

                                    } else {
                                        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                <div class="form-group">
                    <label for="data">Data de Inscricao:</label>
                    <input type="date" class="form-control" id="data" name="data" value="<?php echo $dataDeInscricao; ?>">
                </div>
                <div class="form-group">
                    <label for="estado">Estado de Inscricao</label>
                    <input type="text" class="form-control" id="estado" name="estado" readonly value="<?php echo $estadoInscricao; ?>">
                </div>
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input type="text" class="form-control" id="preco" name="preco"
                        value="<?php echo $custo; ?> " readonly>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
            </form>
        </div>
    </div>
    <?php
        } elseif($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE){

        
    ?>
            <div class="container">
            <div class="form-container">
                <h2>Editar Inscrição</h2>
                <form method="POST" action="alteraDadosInscricaoAluno.php?idcurso=<?php echo $id_curso; ?>&idaluno=<?php echo $id_aluno; ?>">
                <div class="form-group">
                        <label for="aluno">Nome do Aluno:</label>
                        <div class="input-group">
                            <select class="form-control" id="aluno" name="aluno">
                            <?php
                                    if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ) {
                                        $alunos = "SELECT nome FROM utilizador WHERE tipo_utilizador = '3'";
                                        $tdAlunos = mysqli_query($conn, $alunos);
                                        
                                        while($todosOsAlunos = mysqli_fetch_array($tdAlunos)){
                                            $todAlunos = $todosOsAlunos["nome"];

                                            if($todAlunos == $nomeAluno){
                                                echo "<option value='$todAlunos' selected>$todAlunos</option>";
                                            } else {
                                                echo "<option value='$todAlunos'>$todAlunos</option>";
                                            }

                                        }

                                    } else {
                                        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="curso">Curso</label>
                            <div class="input-group">
                                <select class="form-control" id="curso" name="curso">
                                    <?php
                                    if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ) {
                                        $cursos = "SELECT * FROM curso";
                                        $tdCursos = mysqli_query($conn, $cursos);
                                        
                                        while($todosOsCursos = mysqli_fetch_array($tdCursos)){
                                            $todCursos = $todosOsCursos["nome"];

                                            if($todCursos == $nomeCurso){
                                                echo "<option value='$todCursos' selected>$todCursos</option>";
                                            } else {
                                                echo "<option value='$todCursos'>$todCursos</option>";
                                            }

                                        }

                                    } else {
                                        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="docente">Docente:</label>
                            <div class="input-group">
                                <select class="form-control" id="docente" name="docente">
                                    <?php
                                    if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ) {
                                        $docentes = "SELECT nome FROM utilizador WHERE tipo_utilizador = '2'";
                                        $tdDocentes= mysqli_query($conn, $docentes);
                                        
                                        while($todosOsDocentes = mysqli_fetch_array($tdDocentes)){
                                            $todDocentes = $todosOsDocentes["nome"];

                                            if($todDocentes == $nomeDocente){
                                                echo "<option value='$todDocentes' selected>$todDocentes</option>";
                                            } else {
                                                echo "<option value='$todDocentes'>$todDocentes</option>";
                                            }

                                        }

                                    } else {
                                        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="data">Data de Inscricao:</label>
                        <input type="date" class="form-control" id="data" name="data" value="<?php echo $dataDeInscricao; ?>">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado de Inscricao</label>
                        <input type="text" class="form-control" id="estado" name="estado" readonly value="<?php echo $estadoInscricao; ?>">
                    </div>
                    <div class="form-group">
                        <label for="preco">Preço:</label>
                        <input type="text" class="form-control" id="preco" name="preco"
                            value="<?php echo $custo; ?> ">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
                </form>
            </div>
        </div>



    <?php
        }
    ?>
</body>

</html>