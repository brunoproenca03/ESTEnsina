<?php
session_start();
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE)){
    $id_curso = $_GET["curso"];

    $nomeDocente = $_POST["docente"];
    $nomeCurso = $_POST["nome"];

    $sql = "SELECT id_utilizador FROM utilizador WHERE nome = '$nomeDocente'";
    $id = mysqli_query($conn, $sql);

    if (!$id) {                    
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    $ids = mysqli_fetch_assoc($id);
    $idNovoDocente = $ids["id_utilizador"];

        $sql = "SELECT * FROM curso WHERE nome = '$nomeCurso' AND id_curso != '$id_curso'";
        $existeCurso = mysqli_query($conn, $sql);

        if (!$existeCurso) {                    
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }

        if(mysqli_num_rows($existeCurso) > 0){

            echo "<script> alert ('O curso que tentou alterar o nome já se encontra criado') </script>";
            echo "<script>  setTimeout(function () { window.location.href = 'verTodosCursos.php'; }, 0000)</script>";

        }else{

            $sql = "SELECT docente FROM curso WHERE id_curso = '".$_GET["curso"]."'";
            $idAntDocente = mysqli_query($conn, $sql);
            
            if (!$idAntDocente) {                    
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }
            
            $row = mysqli_fetch_array($idAntDocente);
            $idAtualDocente = $row["docente"];

            if($idAtualDocente == $idNovoDocente){
                $duracao = $_POST["duracao"];
                $capacidade = $_POST["vagas"];

                 // Verifica se a duração ou capacidade são negativas
                if ($duracao < 0 || $capacidade < 0) {
                    echo "<script> alert ('O campo Duração e o Campo Vagas não podem ser negativos') </script>";
                    echo "<script> setTimeout(function () { window.location.href = 'verTodosCursos.php'; }, 0000)</script>";
                    exit(); 
                }

                $sql = "UPDATE curso
                            SET
                                nome='" . $nomeCurso . "',
                                duracao='" . $duracao . "',
                                capacidade='" . $capacidade . "'
                                WHERE id_curso='". $id_curso ."'";
                $updateCurso = mysqli_query($conn, $sql);
                if (!$updateCurso) {                    
                    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                }

            } else {

                $duracao = $_POST["duracao"];
                $capacidade = $_POST["vagas"];
                
                 // Verifica se duração ou capacidade são negativas
                if ($duracao < 0 || $capacidade < 0) {
                    echo "<script> alert ('O campo Duração e o Campo Vagas não podem ser negativos') </script>";
                    echo "<script> setTimeout(function () { window.location.href = 'verTodosCursos.php'; }, 0000)</script>";
                    exit(); 
                }
                
                $sql = "UPDATE curso
                            SET
                                nome='" . $nomeCurso . "',
                                duracao='" . $duracao . "',
                                capacidade='" . $capacidade . "',
                                docente='". $idNovoDocente ."'
                                WHERE id_curso='". $id_curso ."'";
                $updateCursos = mysqli_query($conn, $sql);
                if (!$updateCursos) {                    
                    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                }

            }

            

            echo "<script>  setTimeout(function () { window.location.href = 'verTodosCursos.php'; }, 0000)</script>";

        }
  
} else {
    echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
}

?>