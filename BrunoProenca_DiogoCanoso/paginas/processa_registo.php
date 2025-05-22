<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";
session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["id"]) && !isset($_SESSION["tipo_utilizador"])){
        $nomeUtilizador = $_POST["new-name"];
        $data = str_replace("/", "-", $_POST["new-data"]);
        $dataNascimento= date('Y-m-d', strtotime($data));
        $email = $_POST["new-email"];
        $morada = $_POST["new-morada"];
        $pass = $_POST["new-password"];
        $telefone = $_POST["new-phone"];

        

        $sql = "SELECT * FROM utilizador WHERE nome = '$nomeUtilizador'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);

        if ($row) {
                echo "<script> alert ('Já existe esse utilizador') </script>";
                echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0)</script>";
        } else {
        $sql = "INSERT INTO `utilizador` (`nome`, `data_nascimento`,`pass`, `morada`, `email`, `telemovel`, `tipo_utilizador`) 
                VALUES ('" . $nomeUtilizador . "','" . $dataNascimento. "', '" . md5($pass) . "','" . $morada . "','" . $email . "','" . $telefone . "', '3');";

        $res = mysqli_query($conn, $sql);
        header("Location: ./index.php");  
        }

} else {
        echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 0)</script>";
}



?>