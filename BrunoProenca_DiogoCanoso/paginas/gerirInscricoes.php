<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>ESTensina</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="estilo2.css">
</head>

<body>
<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include "tipoUtilizadores.php";

ob_start();
session_start();

			if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE)) {
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
	<div id="corpo">
		<h2>Cursos</h2> 
		<div id="tabela">

			<?php
			if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ) {

				if ($_SESSION["tipo_utilizador"] == DOCENTE) {
					// ====================================================
					$sql = "SELECT * FROM curso WHERE docente = '".$_SESSION["id"]."'ORDER BY nome,docente";
					$cursos = mysqli_query($conn, $sql);
					if (!$cursos) {
						die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
					}

					echo "<table width='100%' id = 't01'>
					<tr>
						<th>Curso:</th>
						<th>Duração:</th>
						<th>Vagas:</th>
						<th>Docente:</th>
                        <th></th>
					</tr>";
					while ($row = mysqli_fetch_assoc($cursos)) {
						$id_curso = $row["id_curso"]; 
						$sql = "SELECT u.nome FROM Utilizador u INNER JOIN Curso c ON c.docente = u.id_utilizador WHERE c.id_curso = '$id_curso'";
						$nomesDocentes = mysqli_query($conn, $sql);
						if (!$nomesDocentes) {
							die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
						}
						$nome = mysqli_fetch_assoc($nomesDocentes);
						$nomeDocente = $nome["nome"];

						echo "
						<tr>
							<td>" . $row["nome"] . "</td>
							<td>" . $row["duracao"] . " horas</td>
							<td>".$row["inscritos"]."/" . $row["capacidade"] . "</td>
							<td>" . $nomeDocente . "</td>";
                            echo"<td><a href = 'mostraInscricoes.php?curso=".$row["id_curso"]."'> Gere as inscrições </a></td>";
						echo "</tr>";
					} 
					echo "</table>";
				} elseif($_SESSION["tipo_utilizador"] == ADMINISTRADOR) {
                    // ====================================================
					$sql = "SELECT * FROM curso ORDER BY nome";
					$cursos = mysqli_query($conn, $sql);
					if (!$cursos) {
						die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
					}

					echo "<table width='100%' id = 't01'>
					<tr>
						<th>Curso:</th>
						<th>Duração:</th>
						<th>Vagas:</th>
						<th>Docente:</th>
						<th></th>
					</tr>";
					while ($row = mysqli_fetch_assoc($cursos)) {
						$id_curso = $row["id_curso"]; 
						$sql = "SELECT u.nome FROM Utilizador u INNER JOIN Curso c ON c.docente = u.id_utilizador WHERE c.id_curso = '$id_curso'";
						$nomesDocentes = mysqli_query($conn, $sql);
						if (!$nomesDocentes) {
							die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
						}
						$nome = mysqli_fetch_assoc($nomesDocentes);
						$nomeDocente = $nome["nome"];

						echo "
						<tr>
							<td>" . $row["nome"] . "</td>
							<td>" . $row["duracao"] . " horas</td>
							<td>".$row["inscritos"]."/" . $row["capacidade"] . "</td>
							<td>" . $nomeDocente . "</td>";
                            echo"<td><a href = 'mostraInscricoes.php?curso=".$row["id_curso"]."'> Gere as inscrições </a></td>";
						echo "</tr>";
					}
					echo "</table>";
                    
                }
			}else{
				echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 1000)</script>";
			}

			?>

		</div>
	</div>
</body>

</html>