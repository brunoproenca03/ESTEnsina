<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();

if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ALUNO){
    $id_curso = $_GET["idCurso"];
    $sql = "SELECT * FROM Inscricao
        INNER JOIN Utilizador ON Inscricao.aluno = Utilizador.id_utilizador
        INNER JOIN Curso ON Inscricao.curso = Curso.id_curso
        WHERE Curso.id_curso = '".$id_curso."' AND Inscricao.aluno = '".$_SESSION["id"]."'";

    $existeInscricao = mysqli_query($conn, $sql);
    if (!$existeInscricao) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    if(mysqli_num_rows($existeInscricao) > 0){
        echo "<script> alert ('Já foi feita a inscrição neste curso') </script>";
        echo "<script>  setTimeout(function () { window.location.href = 'verCursos.php'; }, 0)</script>";

    } else {

        $sql = "SELECT * FROM curso WHERE id_curso = $id_curso";
        $dadosCurso = mysqli_query($conn, $sql);
        if (!$dadosCurso) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }
        $todosOsDados = mysqli_fetch_assoc($dadosCurso);

        if(mysqli_num_rows($dadosCurso) > 0){

            $duracao = $todosOsDados["duracao"];
            $preço = 3 * $duracao; // O preço é calculado 3€ à hora * duração do curso   
            $dataDeInscricao =  date('Y-m-d', time());

            $sql = "INSERT INTO inscricao (`aluno`, `curso`, `data_inscricao`, `custo`, `estadoDaInscricao`)
                    VALUES ('" . $_SESSION["id"] . "', '" . $id_curso . "','" . $dataDeInscricao . "','" . $preço . "','1')";
            $inscricao = mysqli_query($conn, $sql);
            if (!$inscricao) {
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }
            
        }else{
            echo "<script> alert ('Não existe dados neste curso') </script>";
            echo "<script>  setTimeout(function () { window.location.href = 'verCursos.php'; }, 0)</script>";
        }
        

    }
    echo "<script>  setTimeout(function () { window.location.href = 'verInscricoesAlunos.php'; }, 1000)</script>";

} else {
    echo "<script>  setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
}

?>