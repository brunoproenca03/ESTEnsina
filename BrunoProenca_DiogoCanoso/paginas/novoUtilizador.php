<?php
session_start();
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR ){
        $nomeUtilizador = $_POST["user"];
        $tipoUtilizador = $_POST["tipo"];
        $data = str_replace("/", "-", $_POST["data"]);
        $dataNascimento= date('Y-m-d', strtotime($data));
        $mail = $_POST["email"];
        $morada = $_POST["morada"];
        $pass = $_POST["pass"];
        $tlm = $_POST["telemovel"];

        if($tipoUtilizador == "Administrador"){
                $sql = "INSERT INTO `utilizador`
                (`nome`,`data_nascimento`, `email`, `morada`, `pass`, `telemovel`, `tipo_utilizador`)
                VALUES
                ('" . $nomeUtilizador . "', '" . $dataNascimento . "', '" . $mail . "','" . $morada . "','" . md5($pass) . "','" . $tlm . "', '1');";
                $res = mysqli_query($conn, $sql);
        
        } else if($tipoUtilizador == "Docente"){
                $sql = "INSERT INTO `utilizador`
                (`nome`,`data_nascimento`, `email`, `morada`, `pass`, `telemovel`, `tipo_utilizador`)
                VALUES
                ('" . $nomeUtilizador . "', '" . $dataNascimento . "', '" . $mail . "','" . $morada . "','" . md5($pass) . "','" . $tlm . "', '2');";
                $res = mysqli_query($conn, $sql);
        } else if($tipoUtilizador == "Aluno"){
                $sql = "INSERT INTO `utilizador`
                (`nome`,`data_nascimento`, `email`, `morada`, `pass`, `telemovel`, `tipo_utilizador`)
                VALUES
                ('" . $nomeUtilizador . "', '" . $dataNascimento . "', '" . $mail . "','" . $morada . "','" . md5($pass) . "','" . $tlm . "', '3');";
                $res = mysqli_query($conn, $sql);
        }

        header("Location:GestaoUtilizador.php");
} else {
        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 000)</script>";
}

?>