<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";
session_start();

if(isset($_SESSION["user"]) && isset($_SESSION["edita"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR){
    if($_POST["tipo"] == "Administrador") {
        $tipo = 1;
    } elseif($_POST["tipo"] == "Docente"){
        $tipo = 2;
    } elseif($_POST["tipo"] == "Aluno"){
        $tipo = 3;
    } elseif($_POST["tipo"] == "Aluno nao Validado"){
        $tipo = 4;
    }

    $idUtilizador = $_GET["id"];

    if($idUtilizador == $_SESSION["id"]){
        $_SESSION["user"] = $_POST["IdUser"];
        $_SESSION["tipo_utilizador"] = $tipo;
    }
    
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
                            telemovel='" . $_POST["telemovel"] . "',
                            tipo_utilizador='" . $tipo . "'
                            WHERE nome='" . $_SESSION["edita"] . "'";
            $retval = mysqli_query($conn, $sql);
            if (!$retval) {
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }

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
                    telemovel='" . $_POST["telemovel"] . "',
                    tipo_utilizador='" . $tipo . "'
                    WHERE nome='" . $_SESSION["edita"] . "'";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }
    
    unset($_SESSION["edita"]);
    }
    echo "<script> setTimeout(function () { window.location.href = 'GestaoUtilizador.php'; }, 0000)</script>";
}else{
    echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
}



?>