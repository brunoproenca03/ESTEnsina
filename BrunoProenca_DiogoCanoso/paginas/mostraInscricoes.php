<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>ESTensina</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo2.css">
	<style>
        #btnNv {
            padding: 15px 30px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            width: 20%;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.3s;
            margin-bottom: 20px;
            float: left; /* Adicionado */
        }

        #btnNv:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
    include "tipoUtilizadores.php";

    session_start();
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
                            <form action='gerirInscricoes.php'>
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

    <div id="corpo">
		<h2>Inscrições</h2> <br>
		<div id="tabela">
			<?php
            $id_curso = $_GET["curso"];

			if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] == ADMINISTRADOR || $_SESSION["tipo_utilizador"] == DOCENTE) ) {
				$pode = true;
                
				if ($pode) {
                    echo "<form action='PaginaNovaInscricao.php'>
							<input type='submit' value='Nova Inscrição' id='btnNv'>
				  		  </form>";
					// ====================================================
					$sql = 'SELECT
                                Inscricao.aluno AS id_aluno,
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
                            WHERE Inscricao.curso = '. $id_curso . '
                            ORDER BY Inscricao.data_inscricao,aluno.nome,Inscricao.aluno';
                    
					$inscricoes = mysqli_query($conn, $sql);
					if (!$inscricoes) {
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
                        <th>Aceitar Inscrição</th>
                        <th>Rejeitar Inscrição</th>
                        <th>Apagar Inscrição</th>
					</tr>";

					while ($row = mysqli_fetch_array($inscricoes)) {
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
                            <td>" . $estado . "</td>
                            <td><a href='editarInscricao.php?curso=" . $id_curso . "&aluno=".$row["id_aluno"]."'><img src='editar.png' width=50 height=50></a></td>";
                            if($estado == "Pendente"){
                                echo "<td><a href='aceitaInscricao.php?curso=" . $id_curso . "&aluno=".$row["id_aluno"]."'><img src='aceita.png' width=50 height=50></a></td>
                                      <td><a href='rejeitaInscricao.php?curso=" . $id_curso . "&aluno=".$row["id_aluno"]."'><img src='rejeitar.png' width=50 height=50></a></td>";
                            }else{
                                echo "<td></td>
                                    <td></td>";
                            }
                            echo "<td><a href='apagarInscricao.php?curso=" . $id_curso . "&aluno=".$row["id_aluno"]."'><img src='apagar.png' width=50 height=50></a></td>";
                        echo"</tr>";
					}
					echo "</table>";
				}
			} else {
                echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 000)</script>";
            } 

			?>

		</div>
</body>


