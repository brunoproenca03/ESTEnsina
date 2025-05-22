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

            echo '
                <div class="container">
                <div class="form-container">
                    <h2>Nova Inscrição</h2>
                    <form method="POST" action="novaInscricao.php">                    
                        <div class="form-group">
                            <label for="tipo">Nome do Aluno :</label>
                            <div class="input-group">
                                <select class="form-control" id="nomeAluno" name="nomeAluno">';
                       
                            $sql = "SELECT nome FROM utilizador WHERE tipo_utilizador = '3'";
                            $nome = mysqli_query($conn, $sql);
        
                            if (!$nome) {
                                die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                            }
                        
                            
                            while ($row = mysqli_fetch_array($nome)){
                                $nomeAluno = $row["nome"];
                                echo '<option value="'.$nomeAluno.'">'.$nomeAluno.'</option>';
                            }      
                            echo'</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Nome do Curso :</label>
                            <div class="input-group">
                                <select class="form-control" id="nomeCurso" name="nomeCurso">';
                                
                                if($_SESSION["tipo_utilizador"] == DOCENTE){

                                    $sql = "SELECT nome FROM curso WHERE docente = '".$_SESSION["id"]."'";
                                    $nome = mysqli_query($conn, $sql);
            
                                    if (!$nome) {
                                        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                                    }
                            
                                
                                    while ($row = mysqli_fetch_array($nome)){
                                        $nomeCurso = $row["nome"];
                                        echo '<option value="'.$nomeCurso.'">'.$nomeCurso.'</option>';
                                    }

                                }elseif($_SESSION["tipo_utilizador"] == ADMINISTRADOR){

                                    $sql = "SELECT nome FROM curso";
                                    $nome = mysqli_query($conn, $sql);
            
                                    if (!$nome) {
                                        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                                    }
                            
                                
                                    while ($row = mysqli_fetch_array($nome)){
                                        $nomeCurso = $row["nome"];
                                        echo '<option value="'.$nomeCurso.'">'.$nomeCurso.'</option>';
                                    }  
                                }

                                  
                    
                        echo'   </select>
                            </div> 
                        </div>';

                    echo'       
                        <button type="submit" class="btn btn-primary btn-block">Inscrever</button>
                    </form>
                 </div>
                </div>';

    } else {
        echo "<script> setTimeout(function () { window.location.href = 'index.php'; }, 0000)</script>";
    }
?>

</body>
</html>