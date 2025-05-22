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
	request.setCharacterEncoding("UTF-8");
	response.setContentType("text/html; charset=UTF-8");
	
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR ){
		
		if(tipoUtilizador == ADMINISTRADOR) {
%>
					<div id='cabecalho'>
                		<a href='index.php' id = 'nomeSite'>
                    			ESTensina
                		</a>
							<div class= 'input-div'>
								<div id='botao'>
									<form action='logout.jsp'>
										<input type='submit' value='Logout'>
									</form>
								</div>
								<div id='botao'>
									<form action='gerirInscricoes.jsp'>
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
							<h2>Nova Inscrição</h2>
							<form method="POST" action="novaInscricao.jsp">                    
								<div class="form-group">
									<label for="tipo">Nome do Aluno :</label>
									<div class="input-group">
										<select class="form-control" id="nomeAluno" name="nomeAluno"> 
										<% try{
											Statement stmt = conn.createStatement();
											ResultSet alunoCurso = stmt.executeQuery("SELECT nome FROM utilizador WHERE tipo_utilizador = 3");
											while(alunoCurso.next()){
												String nomeAluno = alunoCurso.getString("nome");
													
												
										%>		
													<option value='<%=nomeAluno%>' ><%=nomeAluno%></option>
													
										<%		 }
													stmt.close();
												} catch (Exception ex) {
													ex.printStackTrace();
													out.println("Erro: " + ex.getMessage());
												}
												
												%>
					
										</select>
									</div>
								</div> 
								<div class="form-group">
									<label for="tipo">Nome do Curso :</label>
									<div class="input-group">
										<select class="form-control" id="nomeCurso" name="nomeCurso">
										<% try{
											Statement stmt2 = conn.createStatement();
											ResultSet cursos = stmt2.executeQuery("SELECT nome FROM curso");
											while(cursos.next()){
												String nomeCursos = cursos.getString("nome");
													
												
										%>		
													<option value='<%=nomeCursos%>' ><%=nomeCursos%></option>
													
										<%		 }
													stmt2.close();
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
