<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO || $_SESSION["tipo_utilizador"] != VISITANTE) ){    

    $id_curso = $_GET["curso"];

    $sql = "SELECT tipo_utilizador FROM utilizador WHERE id_utilizador = '".$_SESSION["id"]."'";
    $tipoU = mysqli_query( $conn, $sql );
    
    if(!$tipoU ){			
        die('Could not get data: ' . mysqli_error($conn));// se não funcionar dá erro
	}

    $row= mysqli_fetch_array($tipoU);
    $tipoUtilizador = $row["tipo_utilizador"];

    if($tipoUtilizador == ALUNO){

        $sql = "DELETE FROM inscricao WHERE aluno = '".$_SESSION["id"]."' AND curso = '$id_curso'";
        $elimina = mysqli_query( $conn, $sql );
        if(! $elimina ){			
            die('Could not get data: ' . mysqli_error($conn));// se não funcionar dá erro
        }
        echo "<script>setTimeout(function(){ window.location.href = 'verInscricoesAlunos.php'; }, 1000)</script>";

    } else {

        $id_aluno = $_GET["aluno"];

        $sql = "SELECT estadoDaInscricao FROM inscricao WHERE aluno = '$id_aluno' AND curso = '$id_curso'";
        $verEstado = mysqli_query( $conn, $sql );
        if(! $verEstado ){			
            die('Could not get data: ' . mysqli_error($conn));// se não funcionar dá erro
        }

        $veOEstado= mysqli_fetch_array($verEstado);

        $estadoDaInscricao = $veOEstado["estadoDaInscricao"];

        if($estadoDaInscricao == '2'){
            $sql = "SELECT inscritos FROM curso WHERE id_curso = '$id_curso'";
            $numeroInscritos = mysqli_query( $conn, $sql );
            if(!$numeroInscritos ){			
                die('Could not get data: ' . mysqli_error($conn));// se não funcionar dá erro
            }
            $numero = mysqli_fetch_array($numeroInscritos);
            $inscritosNoCurso = $numero["inscritos"];

            if($inscritosNoCurso != 0){
                $inscritosNoCurso -= 1;
                $sql = "UPDATE curso 
                                SET inscritos = '$inscritosNoCurso' WHERE id_curso = '$id_curso'";
                $alteraInscritos = mysqli_query( $conn, $sql );
                if(!$alteraInscritos ){			
                    die('Could not get data: ' . mysqli_error($conn));// se não funcionar dá erro
                }
                
            }
        }

        $sql = "DELETE FROM inscricao WHERE aluno = '$id_aluno' AND curso = '$id_curso'";
        $eliminaInscricao = mysqli_query( $conn, $sql );
        if(! $eliminaInscricao ){			
            die('Could not get data: ' . mysqli_error($conn));// se não funcionar dá erro
        }

        echo "<script>setTimeout(function(){ window.location.href = 'gerirInscricoes.php'; }, 1000)</script>";
    }

    
} else {
     echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 0)</script>";
}