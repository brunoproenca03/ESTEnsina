<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR ){

    $nome_user = $_GET["nomeUser"];
    $sql = "SELECT tipo_utilizador FROM utilizador WHERE nome='$nome_user'";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    $row = mysqli_fetch_array($res);
    $tipoUtilizador = $row["tipo_utilizador"];

    if ($tipoUtilizador == ALUNO) {

        if($nome_user == $_SESSION["user"]){
            $_SESSION["tipo_utilizador"] = 2; 
        }

        $sql = "UPDATE utilizador SET tipo_utilizador = '2' WHERE nome='$nome_user'";
        $res = mysqli_query($conn, $sql);
        header("Location:GestaoUtilizador.php");

    }

    if ($tipoUtilizador == DOCENTE) {

        if($nome_user == $_SESSION["user"]){
            $_SESSION["tipo_utilizador"] = 1; 
        }

        $sql = "UPDATE utilizador SET tipo_utilizador = '1' WHERE nome='$nome_user'";
        $res = mysqli_query($conn, $sql);
        header("Location:GestaoUtilizador.php");

    }

} else {
    echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 0)</script>";
}



?>