<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ESTensina</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
     body {
      font-family: 'Roboto', sans-serif;
      background-color: #f0f2f5;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    #cabecalho {
      background-color: #007bff; /* Alterada para azul */
      color: white;
      padding: 10px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    #logo img {
      height: 50px;
      margin-left: 20px;
    }
    .input-div {
      display: flex;
      margin-right: 20px;
    }
    #botao {
      margin-left: 10px;
    }
    #botao input {
      padding: 10px 20px;
      background-color: #007bff; /* Alterada para azul */
      border: 2px solid #007bff; /* Alterada para azul */
      color: white;
      cursor: pointer;
      border-radius: 5px;
      font-weight: 500;
      transition: background-color 0.3s, color 0.3s;
    }
    #botao input:hover {
      background-color: #0056b3; /* Alterada para azul mais escuro */
      border-color: #0056b3; /* Alterada para azul mais escuro */
    }
    #corpo {
      padding: 20px;
      background-color: white;
      margin: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 60%;
      max-width: 800px;
      text-align: center;
    }
    .botaoCorpo {
      margin: 20px 0;
    }
    .botaoCorpo input {
      padding: 15px 30px;
      background-color: #007bff; /* Alterada para azul */
      border: none;
      color: white;
      cursor: pointer;
      border-radius: 5px;
      width: 100%;
      font-size: 18px;
      font-weight: 500;
      transition: background-color 0.3s;
    }
    .botaoCorpo input:hover {
      background-color: #0056b3; /* Alterada para azul mais escuro */
    }
    h1, h2 {
      color: #007bff; /* Alterada para azul */
      font-weight: 700;
      text-align: center;
    }

	#nomeSite {
      color: white; /* Alterada para branco */
      margin-left: 20px; /* Adicionado margem à esquerda */
      font-size: 24px; /* Ajustado tamanho da fonte */
      font-weight: 700; /* Ajustado peso da fonte */
      text-decoration: none; /* Removida sublinhado */
      transition: color 0.3s; /* Adicionada transição de cor */
    }
    #nomeSite:hover {
      color: #cfe2ff; /* Alterada cor ao passar o mouse */
    }

  </style>
</head>


<body>  
	
	<?php
		include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
		include "./tipoUtilizadores.php";
		session_start();
		
		if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO || $_SESSION["tipo_utilizador"] != VISITANTE) ){				
			$user = $_SESSION["user"];
			unset($_SESSION);
			$_SESSION["user"] = $user;

			//Selecionar user correspondente da base de dados
			$sql = "SELECT * FROM utilizador WHERE nome= '".$_SESSION["user"]."'";
			$retval = mysqli_query( $conn, $sql );
			if(! $retval ){
				die('Could not get data: ' . mysqli_error($conn));// se não funcionar dá erro
			}
			$row = mysqli_fetch_array($retval);
			
			if($row["tipo_utilizador"]!= ALUNO_NAO_VALIDADO && $row["tipo_utilizador"]!= VISITANTE){
				// ===============================================================
				
				echo"<div id='cabecalho'>
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
								<form action='index.php'>
									<input type='submit' value='Página Principal'>
								</form>
							</div>
							<div id='botao'>
							  <form action='contacto.php'>
								<input type='submit' value='Contactos'>
							  </form>
							</div>
						</div>
					</div>";				
				
				//PERSONALIZAÇÃO
				switch($row["tipo_utilizador"]){
						
					case ADMINISTRADOR:
						//==============================ADMINISTRADOR===============================//
						echo "<div id='corpo'>";
						printDadosPessoais();
						printGestaoInscrições();
						printGestaoCursos();
						printGestãoUtilizadores();
						echo"</div>";
					break;
					
					case DOCENTE:
						//===============================DOCENTE================================//
						echo "<div id='corpo'>";
						printDadosPessoais();
						printGestaoInscrições();
						printGestaoCursos();
						echo"</div>";
					break;
						
					case ALUNO:
						//=================================ALUNO==================================//
						echo "<div id='corpo'>";
						printDadosPessoais();
						printContactos();
						printInscriçõesAlunos();
						printCursos();
						printGestaoCursos();						
						echo"</div>";
					break;
					
				}
				
			}else{
				echo "<script>setTimeout(function(){ window.location.href = 'logout.php'; }, 0)</script>";
			}
			
		}else{
			echo "<script>setTimeout(function(){ window.location.href = 'Msg_erro.php'; }, 0)</script>";
		}
			
			
			
			
			
		function printContactos(){
			//Contactos
			echo 
			"<div class='botaoCorpo'>
				<form action='./contacto.php'>
					<input type='submit' value='Contactos' id='btCorpo'>
				</form>
			</div>";
			
		}
		
		function printDadosPessoais(){
			//Dados Pessoais
			echo
			"<div class='botaoCorpo'>
				<form action= './DadosPessoais.php' method='POST'>
					<input type='text' name='IdUser' value='".$_SESSION["user"]."' hidden/>
					<input type='submit' value='Dados Pessoais' id='btCorpo'/>
				</form>
			</div>";
		}

		
		function printGestaoInscrições(){
			//Gestão Reservas
			echo
			"<div class='botaoCorpo'>
				<form action='gerirInscricoes.php'>
					<input type='submit' value='Gestão De Inscrições' id='btCorpo'>
				</form>
			</div>";
		}

		function printInscriçõesAlunos(){
			//Gestão Reservas
			echo
			"<div class='botaoCorpo'>
				<form action='verInscricoesAlunos.php'>
					<input type='submit' value='Ver Inscrições' id='btCorpo'>
				</form>
			</div>";
		}

		
		function printGestãoUtilizadores(){
			//Gestão Utilizadores
			echo 
			"<div class='botaoCorpo'>
				<form action='GestaoUtilizador.php'>
					<input type='submit' value='Gestão de Utilizadores' id='btCorpo'>
				</form>
			</div>";
		}

		function printCursos(){
			//Gestão Utilizadores
			echo 
			"<div class='botaoCorpo'>
				<form action='verCursos.php'>
					<input type='submit' value='Cursos' id='btCorpo'>
				</form>
			</div>";
		}

		function printGestaoCursos(){
			//Gestão Utilizadores
			echo 
			"<div class='botaoCorpo'>
				<form action='verTodosCursos.php'>
					<input type='submit' value='Gestão de Cursos' id='btCorpo'>
				</form>
			</div>";
		}
	?>
</body>
</html>