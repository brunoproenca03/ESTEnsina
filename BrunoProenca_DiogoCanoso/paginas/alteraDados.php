<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";
session_start();

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO || $_SESSION["tipo_utilizador"] != VISITANTE) ){

    $data = str_replace("/", "-", $_POST["data"]);
    $dataNascimento= date('Y-m-d', strtotime($data));

    if (strcmp($_POST["pass"], "") != 0 || strcmp($_POST["conf_pass"], "") != 0) {
        if (strcmp($_POST["pass"], $_POST["conf_pass"]) == 0) {
            //Password pode ser modificada
            $sql = "UPDATE utilizador
                        SET
                            nome='" . $_POST["IdUser"] . "',
                            data_nascimento='" . $dataNascimento . "',
                            email='" . $_POST["email"] . "',
                            morada='" . $_POST["morada"] . "',
                            pass='" . md5($_POST["pass"]) . "',
                            telemovel='" . $_POST["telemovel"] . "'
                            WHERE nome='" . $_SESSION["user"] . "'";
            $retval = mysqli_query($conn, $sql);
            if (!$retval) {
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }

            $_SESSION["user"] = $_POST["IdUser"];

        } else {
            //Passwords incompatíveis
            echo " <script> alert ('ERRO! Passwords incompatíveis!') </script>";
            echo "<script> setTimeout(function () { window.location.href = 'DadosPessoais.php'; }, 0000)</script>";
        }
    } else {
        $sql = "UPDATE utilizador
                    SET
                    nome='" . $_POST["IdUser"] . "',
                    data_nascimento='" . $dataNascimento . "',
                    email='" . $_POST["email"] . "',
                    morada='" . $_POST["morada"] . "',
                    telemovel='" . $_POST["telemovel"] . "'
                    WHERE nome='" . $_SESSION["user"] . "'";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }

        $_SESSION["user"] = $_POST["IdUser"];

    }
    echo "<script> setTimeout(function () { window.location.href = 'GestaoUtilizador.php'; }, 0000)</script>";
} else {
    echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
}



?>