<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ){
    $nomeAluno = $_POST["nomeAluno"];
    $nomeCurso = $_POST["nomeCurso"];

    $sql = "SELECT id_utilizador FROM utilizador WHERE nome = '$nomeAluno'";
    $idA = mysqli_query($conn, $sql);
    if (!$idA) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    $row = mysqli_fetch_array($idA);
    $idAluno = $row["id_utilizador"];

    $sql = "SELECT id_curso FROM curso WHERE nome = '$nomeCurso'";
    $idC = mysqli_query($conn, $sql);
    if (!$idC) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    $row = mysqli_fetch_array($idC);
    $idCurso = $row["id_curso"];

    $sql = "SELECT * FROM Inscricao
        INNER JOIN Utilizador ON Inscricao.aluno = Utilizador.id_utilizador
        INNER JOIN Curso ON Inscricao.curso = Curso.id_curso
        WHERE Curso.id_curso = '".$idCurso."' AND Inscricao.aluno = '".$idAluno."'";

    $existeInscricao = mysqli_query($conn, $sql);
    if (!$existeInscricao) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    if(mysqli_num_rows($existeInscricao) > 0){
        echo "<script> alert ('Já foi feita a inscrição neste curso') </script>";
        echo "<script>  setTimeout(function () { window.location.href = 'PaginaNovaInscricao.php'; }, 0)</script>";

    } else {
        $sql = "SELECT * FROM curso WHERE id_curso = $idCurso";
        $dadosCurso = mysqli_query($conn, $sql);
        if (!$dadosCurso) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }
        $todosOsDados = mysqli_fetch_assoc($dadosCurso);

        if(mysqli_num_rows($dadosCurso) > 0){

            $duracao = $todosOsDados["duracao"];
            $preço = 3 * $duracao; // O preço é calculado 3€ à hora * duração do curso   
            $dataDeInscricao =  date('Y-m-d', time());

            $sql = "INSERT INTO inscricao (`aluno`, `curso`, `data_inscricao`, `custo`, `estadoDaInscricao`)
                    VALUES ('" . $idAluno . "', '" . $idCurso . "','" . $dataDeInscricao . "','" . $preço . "','1')";
            $inscricao = mysqli_query($conn, $sql);
            if (!$inscricao) {
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }
            
        }else{
            echo "<script> alert ('Não existe dados neste curso') </script>";
            echo "<script>  setTimeout(function () { window.location.href = 'PaginaUtilizador.php'; }, 0)</script>";
        }
        

    }
    echo "<script>  setTimeout(function () { window.location.href = 'mostraInscricoes.php?curso=".$idCurso."'; }, 1000)</script>";




} else {
    echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
}


?>