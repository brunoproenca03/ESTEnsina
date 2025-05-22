<?php
session_start();
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

if(isset($_SESSION["user"]) && $_SESSION["id"] && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE)){
    $nomeDocente = $_POST["docente"];
    $nomeCurso = $_POST["nome"];
    $sql = "SELECT id_utilizador FROM utilizador WHERE nome = '$nomeDocente'";
    $retval = mysqli_query($conn, $sql);

    if (!$retval) {                    
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }
    $row = mysqli_fetch_array($retval);
    $idDocente = $row["id_utilizador"];
        $sql = "SELECT * FROM curso WHERE nome = '$nomeCurso'";
        $retval = mysqli_query($conn, $sql);

        if (!$retval) {                    
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }
        if(mysqli_num_rows($retval) > 0){
            echo "<script> alert ('O curso que tentou criar já se encontra criado') </script>";
            echo "<script>  setTimeout(function () { window.location.href = 'PaginaNovoCurso.php'; }, 0)</script>";
        }else{
            $duracao = $_POST["duracao"];
            $capacidade = $_POST["vagas"];

            if ($duracao < 0 || $capacidade < 0) {
                echo "<script> alert ('Duração e vagas não podem ser negativas') </script>";
                echo "<script> setTimeout(function () { window.location.href = 'PaginaNovoCurso.php'; }, 0)</script>";
                exit(); 
            }

            $sql = "INSERT INTO `curso`
                (`nome`, `duracao`, `capacidade`, `docente`)
                VALUES
                ('" . $nomeCurso . "', '" . $duracao . "','" . $capacidade . "','" . $idDocente . "')";
            $retval = mysqli_query($conn, $sql);
            if (!$retval) {                    
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }

            echo "<script>  setTimeout(function () { window.location.href = 'verTodosCursos.php'; }, 0)</script>";


        }

  
} else {
    echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0)</script>";
}





?>