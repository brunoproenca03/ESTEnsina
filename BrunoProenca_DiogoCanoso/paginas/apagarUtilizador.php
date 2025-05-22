<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if (isset($_GET["IdUser"]) && $_SESSION["id"] && $_SESSION["user"] && $_SESSION["tipo_utilizador"] == ADMINISTRADOR) {
    $id_user = $_GET["IdUser"];

    $sql = "SELECT tipo_utilizador FROM utilizador WHERE id_utilizador='$id_user'";
    $tipo = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($tipo); 
    $tipoUtilizador = $row["tipo_utilizador"];

    if($tipoUtilizador == DOCENTE){
        $sql = "SELECT id_curso FROM curso WHERE docente = '$id_user'";
        $curso = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($curso)){
            $id_curso = $row["id_curso"]; 

            $sql = "DELETE FROM inscricao WHERE curso = '$id_curso'";
            $apagaInscricao = mysqli_query($conn, $sql);

            $sql = "DELETE FROM curso WHERE id_curso = '$id_curso'";
            $apagaCurso = mysqli_query($conn, $sql);
        }

        $sql = "DELETE FROM utilizador WHERE id_utilizador='$id_user'";
        $apagaUtilizador = mysqli_query($conn, $sql);
        header("Location: GestaoUtilizador.php");

    } else if($tipoUtilizador == ALUNO){
        $sql= "SELECT curso FROM inscricao WHERE aluno = '$id_user'";
        $curso = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($curso)){
            $id_curso = $row["curso"];

            $sql = "SELECT estadoDaInscricao FROM inscricao WHERE aluno = '$id_user' AND curso = '$id_curso'";
            $estado = mysqli_query($conn, $sql);
            $estadoInsc = mysqli_fetch_array($estado);

            $estadoDaInscricao = $estadoInsc["estadoDaInscricao"];
            if($estadoDaInscricao == '1'){
                $sql = "DELETE FROM inscricao WHERE aluno = '$id_user'";
                $apagaInscricao = mysqli_query($conn, $sql);

                $sql = "DELETE FROM utilizador WHERE id_utilizador='$id_user'";
                $apagaUtilizador = mysqli_query($conn, $sql);
                header("Location: GestaoUtilizador.php");
            } else {
                $sql = "SELECT inscritos FROM curso WHERE id_curso = '$id_curso'";
                $quantidade = mysqli_query($conn, $sql);
                if (!$quantidade) {				
                    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                }
                $vagas = mysqli_fetch_array($quantidade);
                $inscritosNoCurso = $vagas["inscritos"];

                $inscritosNoCurso -= 1;
                $sql = "UPDATE curso
                            SET
                                inscritos ='$inscritosNoCurso' WHERE id_curso = '$id_curso'";
                $diminuiInscritos = mysqli_query($conn, $sql);

                $sql = "DELETE FROM inscricao WHERE aluno = '$id_user'";
                $apagaInscricao = mysqli_query($conn, $sql);

                $sql = "DELETE FROM utilizador WHERE id_utilizador='$id_user'";
                $apagaUtilizador = mysqli_query($conn, $sql);
                header("Location: GestaoUtilizador.php");

            }
        
        }

    } else {
        $sql = "DELETE FROM utilizador WHERE id_utilizador='$id_user'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            if($id_user == $_SESSION["id"]){
                unset($_SESSION["user"]);
                unset($_SESSION["tipo_utilizador"]);
                unset($_SESSION["pass"]);
                unset($_SESSION["id"]);
                header("Location: index.php");
            }
            header("Location: GestaoUtilizador.php");
            exit();
        } else {
            echo "Erro ao apagar o Utilizador: " . mysqli_error($conn);
        }
    }

    
} else {
    echo "Nome utilizador não encontrado.";
    echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 0)</script>";
}

?>