<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include 'tipoUtilizadores.php';

session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["id"]) && !isset($_SESSION["tipo_utilizador"])){
    if (isset($_POST["name"]) && isset($_POST["pass"])) {
        $utilizador = $_POST["name"];
        $password = $_POST["pass"];
    
        $sql = "SELECT * FROM utilizador WHERE nome = '$utilizador' AND pass = '" . md5($password) . "' AND tipo_utilizador != " . VISITANTE . "";
        $retval = mysqli_query($conn, $sql);
    
        if (!$retval) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }
    
        $row = mysqli_fetch_array($retval);
    
        if (isset($row["nome"]) && strcmp($row["nome"], $utilizador) == 0 && isset($row["pass"]) && strcmp($row["pass"], md5($password)) == 0) {
            //=========================DADOS VÁLIDOS=========================//
            //Identifica o utilizador 
            $_SESSION["user"] = $row["nome"];
            $_SESSION["tipo_utilizador"] = $row["tipo_utilizador"];
            $_SESSION["id"] = $row["id_utilizador"];
        } else {
            $_SESSION["user"] = -1;
            $_SESSION["tipo_utilizador"] = -1;
        }
    
        echo "<div id='loading'>Aguarde a ser reencaminhado...</div> <script> setTimeout(function () { window.location.href = 'verifica.php'; }, 1000)</script>";
    } else {
        session_destroy();
        header("refresh:0;url=index.php");
    }
} else {
    session_destroy();
    header("refresh:0;url=index.php");
}

?>