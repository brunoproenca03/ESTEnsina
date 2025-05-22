<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="javax.servlet.http.*, javax.servlet.*, java.util.*, java.sql.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

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

<% 

	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);
	
	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR ){
		
		if(tipoUtilizador == ADMINISTRADOR) {
			
%>

				<div id='cabecalho'>
               		<a href='index.jsp' id = 'nomeSite'>
                   			ESTensina
               		</a>
						<div class= 'input-div'>
							<div id='botao'>
								<form action='logout.php'>
									<input type='submit' value='Logout'>
								</form>
							</div>
							<div id='botao'>
								<form action='PaginaUtilizador.jsp'>
									<input type='submit' value='Página Inicial'>
								</form>
							</div>
							<div id='botao'>
								<form action='contacto.jsp'>
									<input type='submit' value='Contactos'>
								</form>
							</div>
						</div>
					</div>
					
					<div class="container">
						<div class="form-container">
							<h2>Novo Curso</h2>
							<form method="POST" action="novoCurso.jsp">
								<div class="form-group">
									<label for="nome">Nome do Curso :</label>
									<input type="text" class="form-control" id="nome" name="nome"  required>
								</div>
								<div class="form-group">
									<label for="duracao">Duração do curso (horas) :</label>
									<input type="text" class="form-control" id="duracao" name="duracao" required>
								</div>
								<div class="form-group">
									<label for="vagas">Vagas do curso:</label>
									<input type="text" class="form-control" id="vagas" name="vagas" required >
								</div>
								<div class="form-group">
									<label for="docente">Docente:</label>
									<div class="input-group">
										<select class="form-control" id="docente" name="docente">
							 <% try{
									Statement stmt = conn.createStatement();
									ResultSet docentesCurso = stmt.executeQuery("SELECT nome FROM utilizador WHERE tipo_utilizador = 2");
									while(docentesCurso.next()){
										String nomeDocente = docentesCurso.getString("nome");
											
										
								%>		
											<option value='<%=nomeDocente%>' ><%=nomeDocente%></option>
											
								<%		 }
											stmt.close();
											conn.close();
										} catch (Exception ex) {
											ex.printStackTrace();
											out.println("Erro: " + ex.getMessage());
										}
										
										%>
			
										</select>
									</div>
								</div> 
								<button type="submit" class="btn btn-primary btn-block">Cria</button>
							</form>
						 </div>
						</div>	
					

		<%	 }
		} else {
			response.sendRedirect("logout.jsp");
		}
		
		%>