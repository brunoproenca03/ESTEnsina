<html>

<head>

<body>
</body>
</head>

</html>

<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include 'tipoUtilizadores.php';
session_start();

if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] != VISITANTE || $_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO) ) {
    session_destroy();
    header("refresh:0;url = index.php");
} else {
    header("refresh:0;url = Msg_erro.php");
}

?>