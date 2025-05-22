<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR ) {
    $nome_user = $_GET["nomeUser"];
    $sql = "UPDATE utilizador SET tipo_utilizador = '3' WHERE nome='$nome_user'";
    $res = mysqli_query($conn, $sql);
    header("Location:GestaoUtilizador.php");
} else{
    echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 2000)</script>";
}

?>