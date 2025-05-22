<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE)) {

    $idCurso = $_GET["curso"];
    $idAluno = $_GET["aluno"];

    $sql = "SELECT data_nascimento FROM utilizador WHERE id_utilizador = '$idAluno'";
    $data = mysqli_query($conn, $sql);
	if (!$data) {				
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
	}
	$datas = mysqli_fetch_array($data);
	$dataDeNascimento = $datas["data_nascimento"];

    $idade = calcularIdade($dataDeNascimento);

    if($idade >= 20){
        $sql = "SELECT capacidade,inscritos FROM curso WHERE id_curso = '$idCurso'";
        $quantidade = mysqli_query($conn, $sql);
        if (!$quantidade) {				
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }
        $vagas = mysqli_fetch_array($quantidade);
        $capacidadeDoCurso = $vagas["capacidade"];
        $inscritosNoCurso = $vagas["inscritos"];

        if($inscritosNoCurso == $capacidadeDoCurso){
            echo "<script> alert ('O curso atingiu o limite de vagas. Já não é possível aceitar Inscrições') </script>";
            echo "<script>  setTimeout(function () { window.location.href = 'gerirInscricoes.php'; }, 0)</script>";
        } else {
            $sql = "SELECT estadoInscricao FROM estadoinscricao WHERE descricao = 'Aceite'";
            $estadoInscricao = mysqli_query($conn, $sql);
            if (!$estadoInscricao) {				
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }
            $row = mysqli_fetch_array($estadoInscricao);
            $estado = $row["estadoInscricao"];

            $sql = "UPDATE inscricao
                            SET
                                estadoDaInscricao = '$estado' WHERE curso = '$idCurso' AND aluno = '$idAluno'";
            $aceitaInscricao = mysqli_query($conn, $sql);
            if (!$aceitaInscricao) {				
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }
            $inscritosNoCurso += 1;
            $sql = "UPDATE curso
                            SET
                                inscritos ='$inscritosNoCurso' WHERE id_curso = '$idCurso'";
            $aumentaInscritos = mysqli_query($conn, $sql);
            if (!$aumentaInscritos) {				
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }
            echo "<script>  setTimeout(function () { window.location.href = 'gerirInscricoes.php'; }, 0)</script>";
        }

    }else{
        echo "<script> alert ('O aluno têm de ter 20 anos ou mais') </script>";
        echo "<script>  setTimeout(function () { window.location.href = 'gerirInscricoes.php'; }, 0)</script>";
    }



}else{
    echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0)</script>";
}


function calcularIdade($dataNascimento) {
    // Converte a data de nascimento para timestamp
    $timestampNascimento = strtotime($dataNascimento);
    
    // Obtém as informações da data de nascimento
    $anoNascimento = date('Y', $timestampNascimento);
    $mesNascimento = date('m', $timestampNascimento);
    $diaNascimento = date('d', $timestampNascimento);
    
    // Obtém as informações da data atual
    $anoAtual = date('Y');
    $mesAtual = date('m');
    $diaAtual = date('d');
    
    // Calcula a idade
    $idade = $anoAtual - $anoNascimento;

    // Ajusta a idade se a data de aniversário ainda não ocorreu no ano atual
    if (($mesAtual < $mesNascimento) || ($mesAtual == $mesNascimento && $diaAtual < $diaNascimento)) {
        $idade--;
    }
    
    return $idade;
}

?>