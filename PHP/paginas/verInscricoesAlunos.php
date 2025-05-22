<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>ESTensina</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="estilo2.css">
</head>


<?php
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
include 'tipoUtilizadores.php';

session_start();

if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ALUNO ) {
    
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
		<h2>Inscrições</h2> <br>
		<div id="tabela">
			<?php
			if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ALUNO ) {

				$pode = true;

				if ($_SESSION["tipo_utilizador"] != ALUNO) {
					$pode = false;
					echo "<script> setTimeout(function () { window.location.href = 'PaginaUtilizador.php'; }, 000)</script>";
				}

				if ($pode) {
					// ====================================================
					$sql = 'SELECT
                                Inscricao.curso AS id_curso,
                                aluno.nome AS nome_do_aluno,
                                docente.nome AS nome_do_docente,
                                Curso.nome AS nome_do_curso,
                                estadoInscricao.descricao AS estado_inscricao,
                                Inscricao.data_inscricao AS data_inscricao,
                                Inscricao.custo AS preco
                            FROM Inscricao
                            JOIN Utilizador AS aluno ON Inscricao.aluno = aluno.id_utilizador
                            JOIN Curso ON Inscricao.curso = Curso.id_curso
                            JOIN Utilizador AS docente ON Curso.docente = docente.id_utilizador
                            JOIN estadoinscricao ON Inscricao.estadoDaInscricao = estadoinscricao.estadoInscricao
                            WHERE Inscricao.aluno = '. $_SESSION["id"] . '
                            ORDER BY Inscricao.data_inscricao';
					$retval = mysqli_query($conn, $sql);
					if (!$retval) {
						die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
					}

					echo "<table width='100%' id = 't01'>
					<tr>
						<th>Aluno:</th>
						<th>Curso:</th>
                        <th>Docente:</th>
						<th>Data de Inscrição:</th>
						<th>Preço</th>
						<th>Estado da Inscrição</th>
                        <th>Editar Inscrição</th>
                        <th>Cancelar Inscrição</th>
                        
					</tr>";
					while ($row = mysqli_fetch_array($retval)) {
						$nomeDocente = $row["nome_do_docente"];
                        $nomeAluno = $row["nome_do_aluno"];
                        $nomeCurso = $row["nome_do_curso"];
                        $estado = $row["estado_inscricao"];
                        
						echo "
						<tr>
							<td>" . $nomeAluno. "</td>
							<td>" . $nomeCurso . "</td>
							<td>" . $nomeDocente . "</td>
							<td>" . $row["data_inscricao"] . "</td>
                            <td>" . $row["preco"] . "</td>
                            <td>" . $estado . "</td>";
                            
                        if($estado == "Pendente"){
                            echo "<td><a href='editarInscricao.php?curso=".$row["id_curso"]."&aluno=". $_SESSION["id"]."'><img src='editar.png' width=50 height=50></a></td>
                                  <td><a href='apagarInscricao.php?curso=".$row["id_curso"]."'><img src='apagar.png' width=50 height=50></a></td>";
                        } else {
                            echo"<td></td>
                                 <td></td>";
                        }
                        echo"</tr>";
					}
					echo "</table>";
				}
			} else {
                echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
            }

			?>

		</div>
	</div>
</body>

</html>