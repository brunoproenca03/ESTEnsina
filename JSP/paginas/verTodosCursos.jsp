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
    <link rel="stylesheet" href="estilo2.css">
</head>

<body>

<%
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && (tipoUtilizador != ALUNO_NAO_VALIDADO || tipoUtilizador != VISITANTE) ){
		String idUtilizador = (String) session.getAttribute("id");
		
		
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
						<div id="corpo">
							<h2>Cursos</h2> 
							<div id="tabela">
								<form action='PaginaNovoCurso.jsp'>
									<input type='submit' value='Novo Curso' id='btnNv'>
								</form>
								<table width='100%' id = 't01'>
								<tr>
									<th>Curso:</th>
									<th>Duração:</th>
									<th>Vagas:</th>
									<th>Docente:</th>
									<th></th>
									<th></th>
								</tr>
			<% try{
				Statement stmt = conn.createStatement();
				ResultSet dadosCurso = stmt.executeQuery("SELECT * FROM curso ORDER BY nome");
				while(dadosCurso.next()){
					String idCurso = dadosCurso.getString("id_curso");
					String docente = dadosCurso.getString("docente");
					String nome = dadosCurso.getString("nome");
					String duracao = dadosCurso.getString("duracao");
					String vagas = dadosCurso.getString("capacidade");
					String inscritos = dadosCurso.getString("inscritos");
			%>
								<tr>
									<td><%= nome %></td>
									<td><%= duracao %></td>
									<td><%= inscritos %>/<%= vagas %></td>
					<%
					try {
						Statement stmt2 = conn.createStatement();
						ResultSet dadosDocente = stmt2.executeQuery("SELECT u.nome FROM Utilizador u INNER JOIN Curso c ON c.docente = u.id_utilizador WHERE c.id_curso = '"+idCurso+"'");
						while(dadosDocente.next()){
							String nomeDocente = dadosDocente.getString("u.nome");
					
					%>
									<td><%= nomeDocente %></td>
					<%		
						}
						stmt2.close();
					 } catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					 }
					%>
					
									<td><a href = 'dadosCurso.jsp?curso=<%= idCurso %>'> Alterar dados do curso </a></td>
									<td><a href = 'apagarCurso.jsp?curso=<%= idCurso %>'> Apagar curso </a></td>
								</tr>
								
			<%		  }
				stmt.close();
				conn.close();
			} catch (Exception ex) {
				ex.printStackTrace();
				out.println("Erro: " + ex.getMessage());
			}
			
			%>
								</table>
							</div>
						</div>


<%			} else if (tipoUtilizador == DOCENTE){ %>

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
						<div id="corpo">
							<h2>Cursos</h2> 
							<div id="tabela">
								<table width='100%' id = 't01'>
								<tr>
									<th>Curso:</th>
									<th>Duração:</th>
									<th>Vagas:</th>
									<th>Docente:</th>
								</tr>
			<% try{
				Statement stmt = conn.createStatement();
				ResultSet dadosCurso = stmt.executeQuery("SELECT * FROM curso WHERE docente ='"+idUtilizador+"' ORDER BY nome");
				while(dadosCurso.next()){
					String idCurso = dadosCurso.getString("id_curso");
					String docente = dadosCurso.getString("docente");
					String nome = dadosCurso.getString("nome");
					String duracao = dadosCurso.getString("duracao");
					String vagas = dadosCurso.getString("capacidade");
					String inscritos = dadosCurso.getString("inscritos");
			%>
								<tr>
									<td><%= nome %></td>
									<td><%= duracao %></td>
									<td><%= inscritos %>/<%= vagas %></td>
					<%
					try {
						Statement stmt2 = conn.createStatement();
						ResultSet dadosDocente = stmt2.executeQuery("SELECT u.nome FROM Utilizador u INNER JOIN Curso c ON c.docente = u.id_utilizador WHERE c.id_curso = '"+idCurso+"'");
						while(dadosDocente.next()){
							String nomeDocente = dadosDocente.getString("u.nome");
					
					%>
									<td><%= nomeDocente %></td>
					<%		
						}
						stmt2.close();
					 } catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					 }
					%>
								</tr>
								
			<%		  }
				stmt.close();
				conn.close();
			} catch (Exception ex) {
				ex.printStackTrace();
				out.println("Erro: " + ex.getMessage());
			}
			
			%>
								</table>
							</div>
						</div>			

<%
		} else if(tipoUtilizador == ALUNO) {  %>

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
						<div id="corpo">
							<h2>Cursos</h2> 
							<div id="tabela">
								<table width='100%' id = 't01'>
								<tr>
									<th>Curso:</th>
									<th>Duração:</th>
									<th>Vagas:</th>
									<th>Docente:</th>
								</tr>
			<% try{
				Statement stmt = conn.createStatement();
				ResultSet dadosCurso = stmt.executeQuery("SELECT * FROM curso ORDER BY nome");
				while(dadosCurso.next()){
					String idCurso = dadosCurso.getString("id_curso");
					String docente = dadosCurso.getString("docente");
					String nome = dadosCurso.getString("nome");
					String duracao = dadosCurso.getString("duracao");
					String vagas = dadosCurso.getString("capacidade");
					String inscritos = dadosCurso.getString("inscritos");
			%>
								<tr>
									<td><%= nome %></td>
									<td><%= duracao %></td>
									<td><%= inscritos %>/<%= vagas %></td>
					<%
					try {
						Statement stmt2 = conn.createStatement();
						ResultSet dadosDocente = stmt2.executeQuery("SELECT u.nome FROM Utilizador u INNER JOIN Curso c ON c.docente = u.id_utilizador WHERE c.id_curso = '"+idCurso+"'");
						while(dadosDocente.next()){
							String nomeDocente = dadosDocente.getString("u.nome");
					
					%>
									<td><%= nomeDocente %></td>
					<%		
						}
						stmt2.close();
					 } catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					 }
					%>
					
								</tr>
								
			<%		  }
				stmt.close();
				conn.close();
			} catch (Exception ex) {
				ex.printStackTrace();
				out.println("Erro: " + ex.getMessage());
			}
			
			%>
								</table>
							</div>
						</div>
				

<%
		}		
	} else {
		response.sendRedirect("logout.jsp");
	}
%>
					