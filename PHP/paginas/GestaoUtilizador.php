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
            width: 100%;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.3s;
            margin-bottom: 20px;
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

ob_start();
session_start();

			if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR) {
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

				echo "<script> setTimeout(function () { window.location.href = 'PaginaUtilizador.php'; }, 0000)</script>";

			}
?>
	<!-- GRAFISMO CORPO -->
	<div id="corpo">
		<form action="PaginaNovoUtilizador.php">
			<input type='submit' value='Novo Utilizador' id="btnNv">
		</form>
		<div id="tabela">
			<?php
			if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && $_SESSION["tipo_utilizador"] == ADMINISTRADOR) {

				$pode = true;

				if ($pode) {
					// ====================================================
					$sql = "SELECT * FROM utilizador ORDER BY nome,tipo_utilizador";
					$retval = mysqli_query($conn, $sql);
					if (!$retval) {
						die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
					}

					echo "<table width='100%' id = 't01'>
					<tr>
						<th>Nome Utilizador:</th>
						<th>Email:</th>
						<th>Tipo:</th>
						<th>Telemóvel:</th>
						<th>Validar:</th>
						<th>Editar:</th>
						<th>(Des)Promover:</th>
						<th>Promover:</th>
						<th>Apagar:</th>
					</tr>";
					while ($row = mysqli_fetch_array($retval)) {
						echo "
						<tr>
							<td>" . $row["nome"] . "</td>
							<td>" . $row["email"] . "</td>
							<td>" . getDescricaoUtilizador($row["tipo_utilizador"]) . "</td>
							<td>" . $row["telemovel"] . "</td>";
						//VALIDAR						
						if ($row["tipo_utilizador"] == ALUNO_NAO_VALIDADO && $row["tipo_utilizador"] != VISITANTE)
							echo "	<td><a href='validar.php?nomeUser=" . $row["nome"] . "' ><img src='validar.png' width=50 height=50></a></td>";
						else
							echo "<td></td>";
						//EDITAR
						if ($row["tipo_utilizador"] != VISITANTE ) {
							echo "	<td><a href='editar.php?nomeUser=" . $row["nome"] . "' ><img src='editar.png' width=50 height=50></a></td>";
						} else
							echo "<td></td>";
						//DESPROMOVER
						if ($row["tipo_utilizador"] != ALUNO_NAO_VALIDADO && $row["tipo_utilizador"] != VISITANTE )
							echo "<td><a href='despromover.php?nomeUser=" . $row["nome"] . "' ><img src='despromover.png' width=50 height=50></a></td>";
						else
							echo "<td></td>";
						//PROMOVER
						if ($row["tipo_utilizador"] != ADMINISTRADOR && $row["tipo_utilizador"] != ALUNO_NAO_VALIDADO && $row["tipo_utilizador"] != VISITANTE)
							echo "<td><a href='promover.php?nomeUser=" . $row["nome"] . "' ><img src='promover.png' width=50 height=50></a></td>";
						else
							echo "<td></td>";
						//APAGAR
						if ($row["tipo_utilizador"] != VISITANTE)
							echo "<td><a href='apagarUtilizador.php?IdUser=" . $row["id_utilizador"] . "'><img src='apagar.png' width=50 height=50></a></td>";
						else
							echo "<td></td>";



						echo "</tr>";
					}
					echo "</table>";
				}
			} else {
				echo "<script> setTimeout(function () { window.location.href = 'PaginaUtilizador.php'; }, 0000)</script>";
			}

			function getDescricaoUtilizador($tipoNumerico)
			{
				switch ($tipoNumerico) {
					case ADMINISTRADOR:
						return "Administrador";
						break;
					case DOCENTE:
						return "Docente";
						break;
					case ALUNO:
						return "Aluno";
						break;
					case ALUNO_NAO_VALIDADO:
						return "Aluno não validado";
						break;
					default:
						return "Desconhecido";
						break;
				}

			}

			?>

		</div>
	</div>
</body>

</html>