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
			echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 2000)</script>";
		}

?>

<?php
    if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ) {

        if($_SESSION["tipo_utilizador"] == DOCENTE){
            echo '
                <div class="container">
                <div class="form-container">
                    <h2>Novo Curso</h2>
                    <form method="POST" action="novoCurso.php">
                        <div class="form-group">
                            <label for="nome">Nome do Curso :</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="duracao">Duração do curso (horas) :</label>
                            <input type="text" class="form-control" id="duracao" name="duracao" required>
                        </div>
                        <div class="form-group">
                            <label for="vagas">Vagas do curso:</label>
                            <input type="text" class="form-control" id="vagas" name="vagas">
                        </div>
                    ';
                    $sql = "SELECT nome FROM utilizador WHERE id_utilizador = " .$_SESSION["id"]."";
                    $retval = mysqli_query($conn, $sql);

                    if (!$retval) {
                        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                    }
                
                    $row = mysqli_fetch_array($retval);
                    $nomeDocente = $row["nome"];

                    echo'       
                        <div class="form-group">
                            <label for="docente">Docente:</label>
                            <input type="text" class="form-control" id="docente" name="docente" value ="'.$nomeDocente.'" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Criar</button>
                    </form>
                 </div>
                </div>';

        } elseif($_SESSION["tipo_utilizador"] == ADMINISTRADOR){
            echo '
                <div class="container">
                <div class="form-container">
                    <h2>Novo Curso</h2>
                    <form method="POST" action="novoCurso.php">
                        <div class="form-group">
                            <label for="nome">Nome do Curso :</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="duracao">Duração do curso (horas) :</label>
                            <input type="text" class="form-control" id="duracao" name="duracao" required>
                        </div>
                        <div class="form-group">
                            <label for="vagas">Vagas do curso:</label>
                            <input type="text" class="form-control" id="vagas" name="vagas">
                        </div>
                    ';
                    
                    echo '<div class="form-group">
                            <label for="tipo">Docente:</label>
                            <div class="input-group">
                                <select class="form-control" id="docente" name="docente">';

                    $sql = "SELECT nome FROM utilizador WHERE tipo_utilizador = 2";
                    $retval = mysqli_query($conn, $sql);

                    if (!$retval) {
                        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                    }
                
                    while ($row = mysqli_fetch_array($retval)){
                        $nomeDosDocentes = $row['nome'];
                        echo '<option value="'.$nomeDosDocentes.'">'.$nomeDosDocentes.'</option>';
                    }
                    echo'
                                </select>
                            </div>
                        </div> 
                        <button type="submit" class="btn btn-primary btn-block">Criar</button>
                    </form>
                 </div>
                </div>';
                    
        }

    } else {
        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
    }
?>

</body>
</html>