<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ) {

    $idCurso = $_GET["curso"];
    $idAluno = $_GET["aluno"];

    $sql = "SELECT estadoInscricao FROM estadoinscricao WHERE descricao = 'Rejeitada'";         
    $estadoInscricao = mysqli_query($conn, $sql);
    if (!$estadoInscricao) {				
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }
    $row = mysqli_fetch_array($estadoInscricao);        
    $estado = $row["estadoInscricao"];

    $sql = "UPDATE inscricao
            SET
                estadoDaInscricao = '$estado' WHERE curso = '$idCurso' AND aluno = '$idAluno'";
    $aceitaInscricao = mysqli_query($conn, $sql);
    if (!$aceitaInscricao) {				
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }
    echo "<script>  setTimeout(function () { window.location.href = 'gerirInscricoes.php'; }, 0)</script>";

}else{
    echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0)</script>";
}

?>