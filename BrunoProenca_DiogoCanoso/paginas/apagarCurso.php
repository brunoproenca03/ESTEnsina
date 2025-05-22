<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ){ 
   $id_curso = $_GET["curso"];

    $sql = "DELETE FROM inscricao WHERE curso = $id_curso";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }
   
    $sql = "DELETE FROM curso WHERE id_curso = $id_curso";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    echo "<script>  setTimeout(function () { window.location.href = 'verTodosCursos.php'; }, 0000)</script>";
} else {
    echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
}

?>