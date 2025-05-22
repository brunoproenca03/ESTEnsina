<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO || $_SESSION["tipo_utilizador"] != VISITANTE)){
    
    $tipoUtilizador = $_SESSION["tipo_utilizador"];

    $nomeAluno = $_POST["aluno"];
    $nomeCurso = $_POST["curso"];
    $nomeDocente = $_POST["docente"];
    $data = str_replace("/", "-", $_POST["data"]);
    $dataDeInscricao= date('Y-m-d', strtotime($data));

    $estadoInscricao = $_POST["estado"];
    $preco = $_POST["preco"];


    $sql = "SELECT id_utilizador FROM utilizador WHERE nome = '$nomeAluno'";
    $idA = mysqli_query($conn, $sql);
    if (!$idA) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    $row = mysqli_fetch_array($idA);
    $idAluno = $row["id_utilizador"];

    if($tipoUtilizador == ADMINISTRADOR || $tipoUtilizador == DOCENTE ){

        $sql = "SELECT id_utilizador FROM utilizador WHERE nome = '$nomeDocente'";
        $idD = mysqli_query($conn, $sql);
        if (!$idD) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }

        $row = mysqli_fetch_array($idD);
        $idDocente = $row["id_utilizador"];

        $sql = "SELECT * FROM curso WHERE nome = '$nomeCurso' AND docente = '$idDocente'";
        $verificaSeCursoPertenceAoDocente = mysqli_query($conn, $sql);
        if (!$verificaSeCursoPertenceAoDocente) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }

        if(mysqli_num_rows($verificaSeCursoPertenceAoDocente) <= 0){
            echo "<script> alert ('Não existe um curso associado a este docente') </script>";
            echo "<script>  setTimeout(function () { window.location.href = 'gerirInscricoes.php'; }, 0)</script>";

        } else {
            $sql = "SELECT id_curso FROM curso WHERE nome = '$nomeCurso'";
            $idC = mysqli_query($conn, $sql);
            if (!$idC) {
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }
    
            $row = mysqli_fetch_array($idC);
            $idCurso = $row["id_curso"];
            
                $dataAtual = date("Y-m-d");

                $sql = 'SELECT data_inscricao FROM Inscricao WHERE aluno = "' . $_GET["idaluno"] . '" AND curso = "' . $_GET["idcurso"] . '"';
                        $res = mysqli_query($conn, $sql);
                        $dadosInscricao = mysqli_fetch_array($res);
                        $dataInscricaoOriginal = $dadosInscricao['data_inscricao'];

                        // Verificar se a nova data é anterior à data atual
                        if ($dataDeInscricao < $dataAtual && $dataDeInscricao != $dataInscricaoOriginal) {
                            echo "<script> alert ('A nova data de inscrição não pode ser anterior à data atual.') </script>";
                            echo "<script>  setTimeout(function () { window.location.href = 'gerirInscricoes.php'; }, 0)</script>";
                        } else {
                            if($dataDeInscricao > $dataAtual){
                                echo "<script> alert ('A nova data de inscrição não pode ser superior à data atual.') </script>";
                                echo "<script>  setTimeout(function () { window.location.href = 'gerirInscricoes.php'; }, 0)</script>";
                            } else {
                                $sql = "UPDATE inscricao
                                            SET aluno = '$idAluno', curso = '$idCurso', data_inscricao = '$dataDeInscricao', custo = '$preco', estadoDaInscricao = '1' WHERE aluno = '".$_GET["idaluno"]."' AND curso = '".$_GET["idcurso"]."'";

                                $updateInsc = mysqli_query($conn, $sql);
                                if (!$updateInsc) {
                                    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                                }
                            }
                            
                            
                            
                        }
            
            echo "<script>  setTimeout(function () { window.location.href = 'mostraInscricoes.php?curso=".$idCurso."'; }, 1000)</script>";
        }


       

    } elseif ($tipoUtilizador == ALUNO){
        $sql = "SELECT id_utilizador FROM utilizador WHERE nome = '$nomeDocente'";
        $idD = mysqli_query($conn, $sql);
        if (!$idD) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }

        $row = mysqli_fetch_array($idD);
        $idDocente = $row["id_utilizador"];

        $sql = "SELECT * FROM curso WHERE nome = '$nomeCurso' AND docente = '$idDocente'";
        $verificaSeCursoPertenceAoDocente = mysqli_query($conn, $sql);
        if (!$verificaSeCursoPertenceAoDocente) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }

        if(mysqli_num_rows($verificaSeCursoPertenceAoDocente) <= 0){
            echo "<script> alert ('Não existe um curso associado a este docente') </script>";
            echo "<script>  setTimeout(function () { window.location.href = 'verInscricoesAlunos.php'; }, 0)</script>";

        } else {
            $sql = "SELECT id_curso FROM curso WHERE nome = '$nomeCurso'";
            $idC = mysqli_query($conn, $sql);
            if (!$idC) {
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }
    
            $row = mysqli_fetch_array($idC);
            $idCurso = $row["id_curso"];
           
                $dataAtual = date("Y-m-d");

                $sql = 'SELECT data_inscricao FROM Inscricao WHERE aluno = "' . $_GET["idaluno"] . '" AND curso = "' . $_GET["idcurso"] . '"';
                        $res = mysqli_query($conn, $sql);
                        $dadosInscricao = mysqli_fetch_array($res);
                        $dataInscricaoOriginal = $dadosInscricao['data_inscricao'];

                        // Verificar se a nova data é anterior à data atual
                        if ($dataDeInscricao < $dataAtual && $dataDeInscricao != $dataInscricaoOriginal) {
                            echo "<script> alert ('A nova data de inscrição não pode ser anterior à data atual.') </script>";
                            echo "<script>  setTimeout(function () { window.location.href = 'verInscricoesAlunos.php'; }, 0)</script>";
                        } else {
                            if($dataDeInscricao > $dataAtual){
                                echo "<script> alert ('A nova data de inscrição não pode ser superior à data atual.') </script>";
                                echo "<script>  setTimeout(function () { window.location.href = 'verInscricoesAlunos.php'; }, 0)</script>";
                            } else {
                                $sql = "UPDATE inscricao
                                            SET data_inscricao = '$dataDeInscricao', curso = '$idCurso' WHERE aluno = '".$_GET["idaluno"]."' AND curso = '".$_GET["idcurso"]."'";

                                $updateInsc = mysqli_query($conn, $sql);
                                if (!$updateInsc) {
                                    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                                }
                            }
                            
                            
                            
                        }
            
            echo "<script>  setTimeout(function () { window.location.href = 'verInscricoesAlunos.php'; }, 1000)</script>";
    }


    } else {
        echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
    }

} else {
    echo "<script>  setTimeout(function () { window.location.href = 'logout.php'; }, 0000)</script>";
}
?>