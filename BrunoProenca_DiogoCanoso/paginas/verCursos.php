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

			if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ALUNO) {
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
	<!-- GRAFISMO CORPO -->
	<div id="corpo">
		<h2>Cursos</h2> <br>
		<div id="tabela">
			<?php
			if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ALUNO) {

				$pode = true;

				if ($_SESSION["tipo_utilizador"] != ALUNO) {
					$pode = false;
					echo "<script> setTimeout(function () { window.location.href = 'PaginaUtilizador.php'; }, 000)</script>";
				}

				if ($pode) {
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
					while ($row = mysqli_fetch_array($cursos)) {
                        $id_curso = $row["id_curso"];
						$sql = "SELECT u.nome FROM Utilizador u INNER JOIN Curso c ON c.docente = u.id_utilizador WHERE c.id_curso = '$id_curso'";
						$nomesDocentes = mysqli_query($conn, $sql);
						if (!$nomesDocentes) {
							die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
						}
						$nome = mysqli_fetch_array($nomesDocentes);
						$nomeDocente = $nome["nome"];

						echo "
						<tr>
							<td>" . $row["nome"] . "</td>
							<td>" . $row["duracao"] . " horas</td>
							<td>".$row["inscritos"]."/" . $row["capacidade"] . "</td>
							<td>" . $nomeDocente . "</td>";

						echo"<td><a href = 'inscricaoAluno.php?idCurso=".$id_curso."'> Inscreva-se </a></td>";
						echo "</tr>";
					}
					echo "</table>";
				}
			} else {

				echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 2000)</script>";

			}
			?>

		</div>
	</div>
</body>

</html>