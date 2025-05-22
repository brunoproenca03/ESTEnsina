<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>ESTensina</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<?php
		if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ) {
			echo " <div id='cabecalho'>
               		<a href='index.php' id = 'nomeSite'>
                   			ESTensina
               		</a>
						<div class= 'input-div'>
							<div id='botao'>
								<form action='logout.php'>
									<input type='submit' value='Logout'>
								</form>
							</div>
							<div id='botao'>
								<form action='PaginaUtilizador.php'>
									<input type='submit' value='Página Inicial'>
								</form>
							</div>
							<div id='botao'>
								<form action='contacto.php'>
									<input type='submit' value='Contactos'>
								</form>
							</div>
						</div>
					</div>
					";
		} else {
			echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
		}

?>

<?php
    if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE)) {

        if($_SESSION["tipo_utilizador"] == DOCENTE){

            $id_curso = $_GET["curso"];
            $sql = "SELECT * FROM curso WHERE id_curso = '$id_curso'";
            $dados = mysqli_query($conn, $sql);

            if (!$dados) {
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }

            $dadosCurso = mysqli_fetch_array($dados);
            $nomeCurso = $dadosCurso["nome"];
            $duracaoCurso = $dadosCurso["duracao"];
            $vagasCurso = $dadosCurso["capacidade"];
            
            echo '
                <div class="container">
                <div class="form-container">
                    <h2>Alterar Dados do Curso</h2>
                    <form method="POST" action="alteraDadosCurso.php?curso='.$id_curso.'">
                        <div class="form-group">
                            <label for="nome">Nome do Curso :</label>
                            <input type="text" class="form-control" id="nome" name="nome" value = "'.$nomeCurso.'"required>
                        </div>
                        <div class="form-group">
                            <label for="duracao">Duração do curso (horas) :</label>
                            <input type="text" class="form-control" id="duracao" name="duracao" value = "'.$duracaoCurso.'" required>
                        </div>
                        <div class="form-group">
                            <label for="vagas">Vagas do curso:</label>
                            <input type="text" class="form-control" id="vagas" name="vagas" value = "'.$vagasCurso.'" required>
                        </div>
                    ';
                    $sql = "SELECT nome FROM utilizador WHERE id_utilizador = " .$_SESSION["id"]."";
                    $nome = mysqli_query($conn, $sql);

                    if (!$nome) {
                        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                    }
                
                    $row = mysqli_fetch_array($nome);
                    $nomeDocente = $row["nome"];

                    echo'       
                        <div class="form-group">
                            <label for="docente">Docente:</label>
                            <input type="text" class="form-control" id="docente" name="docente" value ="'.$nomeDocente.'" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Altera</button>
                    </form>
                 </div>
                </div>';

        } elseif($_SESSION["tipo_utilizador"] == ADMINISTRADOR){
            
            $id_curso = $_GET["curso"];
            $sql = "SELECT * FROM curso WHERE id_curso = '$id_curso'";
            $dados = mysqli_query($conn, $sql);

            if (!$dados) {
                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
            }

            $dadosCurso = mysqli_fetch_array($dados);
            $nomeCurso = $dadosCurso["nome"];
            $duracaoCurso = $dadosCurso["duracao"];
            $vagasCurso = $dadosCurso["capacidade"];
            $id_docente = $dadosCurso["docente"];

            echo '
                <div class="container">
                <div class="form-container">
                    <h2>Alterar Dados do Curso</h2>
                    <form method="POST" action="alteraDadosCurso.php?curso='.$id_curso.'">
                        <div class="form-group">
                            <label for="nome">Nome do Curso :</label>
                            <input type="text" class="form-control" id="nome" name="nome" value = "'.$nomeCurso.'" required>
                        </div>
                        <div class="form-group">
                            <label for="duracao">Duração do curso (horas) :</label>
                            <input type="text" class="form-control" id="duracao" name="duracao" value = "'.$duracaoCurso.'" required>
                        </div>
                        <div class="form-group">
                            <label for="vagas">Vagas do curso:</label>
                            <input type="text" class="form-control" id="vagas" name="vagas" value = "'.$vagasCurso.'" required >
                        </div>
                    ';
                    
                    echo '<div class="form-group">
                            <label for="docente">Docente:</label>
                            <div class="input-group">
                                <select class="form-control" id="docente" name="docente">';

                    $sql = "SELECT nome FROM utilizador WHERE id_utilizador = '".$id_docente."'";
                    $nomeDoDocenteALecionarCurso = mysqli_query($conn, $sql);

                    if (!$nomeDoDocenteALecionarCurso) {
                        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                    }

                    $nomeDocente = mysqli_fetch_array($nomeDoDocenteALecionarCurso);

                    $nome = $nomeDocente["nome"];

                    echo '<option value="'.$nome.'" selected>'.$nome.'</option>';

                    $sql = "SELECT nome FROM utilizador WHERE tipo_utilizador = 2 AND nome != '".$nome."'";
                    $nomesDocentes = mysqli_query($conn, $sql);

                    if (!$nomesDocentes) {
                        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                    }
                
                    while ($row = mysqli_fetch_array($nomesDocentes)){
                        $nomeDosDocentes = $row['nome'];
                        echo '<option value="'.$nomeDosDocentes.'">'.$nomeDosDocentes.'</option>';
                    }
                    echo'
                                </select>
                            </div>
                        </div> 
                        <button type="submit" class="btn btn-primary btn-block">Altera</button>
                    </form>
                 </div>
                </div>';
                    
        }

    } else {
        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
    }
?>