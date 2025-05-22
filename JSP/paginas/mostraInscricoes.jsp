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

<% 
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && (tipoUtilizador != ALUNO_NAO_VALIDADO && tipoUtilizador != VISITANTE) ){
		String idCurso = request.getParameter("curso");
		String idDoAluno = (String) session.getAttribute("id");
		
		
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
						<div id="corpo">
							<h2>Inscrições</h2> <br>
							<div id="tabela">
								<form action='PaginaNovaInscricao.jsp'>
									<input type='submit' value='Nova Inscrição' id='btnNv'>
								</form>
								<table width='100%' id = 't01'>
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
									</tr>
									<% try{
										Statement stmt = conn.createStatement();
										ResultSet inscricao = stmt.executeQuery("SELECT " +
																					"Inscricao.aluno AS id_aluno, " +
																					"Inscricao.curso AS id_curso, " +
																					"aluno.nome AS nome_do_aluno, " +
																					"docente.nome AS nome_do_docente, " +
																					"Curso.nome AS nome_do_curso, " +
																					"estadoInscricao.descricao AS estado_inscricao, " +
																					"Inscricao.data_inscricao AS data_inscricao, " +
																					"Inscricao.custo AS preco " +
																				 "FROM Inscricao " +
																				 "JOIN Utilizador AS aluno ON Inscricao.aluno = aluno.id_utilizador " +
																				 "JOIN Curso ON Inscricao.curso = Curso.id_curso " +
																				 "JOIN Utilizador AS docente ON Curso.docente = docente.id_utilizador " +
																				 "JOIN estadoinscricao ON Inscricao.estadoDaInscricao = estadoinscricao.estadoInscricao " +
																				 "WHERE Inscricao.curso = '" + idCurso + "' " +
																				 "ORDER BY Inscricao.data_inscricao, aluno.nome, Inscricao.aluno");
										while(inscricao.next()){
											String idAluno = inscricao.getString("id_aluno");
											String docente = inscricao.getString("nome_do_docente");
											String aluno = inscricao.getString("nome_do_aluno");
											String curso = inscricao.getString("nome_do_curso");
											String dataInscricao = inscricao.getString("data_inscricao");
											String preco = inscricao.getString("preco");
											String estadoInscricao = inscricao.getString("estado_inscricao");
									%>
										<tr>
											<td><%=aluno%></td>
											<td><%=curso%></td>
											<td><%=docente%></td>
											<td><%=dataInscricao%></td>
											<td><%=preco%></td>
											<td><%=estadoInscricao%></td>
											<td><a href='editarInscricao.jsp?curso=<%=idCurso%>&aluno=<%=idAluno%>'><img src='editar.png' width=50 height=50></a></td>
										<% if(estadoInscricao.equals("Pendente")){ %>
												<td><a href='aceitaInscricao.jsp?curso=<%=idCurso%>&aluno=<%=idAluno%>'><img src='aceita.png' width=50 height=50></a></td>
												<td><a href='rejeitaInscricao.jsp?curso=<%=idCurso%>&aluno=<%=idAluno%>'><img src='rejeitar.png' width=50 height=50></a></td>
										<% } else { %>
												<td></td>
												<td></td>
										<% } %>
												<td><a href='apagarInscricao.jsp?curso=<%=idCurso%>&aluno=<%=idAluno%>'><img src='apagar.png' width=50 height=50></a></td>
										</tr>
										
									<% } 
									stmt.close();
									conn.close();
								} catch (Exception ex) {
									ex.printStackTrace();
									out.println("Erro: " + ex.getMessage());
								} %>
									</table>
								</div>
							</div>
							
		<% } else if (tipoUtilizador == ALUNO) { %>
		
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
							<h2>Inscrições</h2> <br>
							<div id="tabela">
								<table width='100%' id = 't01'>
									<tr>
										<th>Aluno:</th>
										<th>Curso:</th>
										<th>Docente:</th>
										<th>Data de Inscrição:</th>
										<th>Preço</th>
										<th>Estado da Inscrição</th>
									</tr>
									<% try{
										Statement stmt = conn.createStatement();
										ResultSet inscricao = stmt.executeQuery("SELECT " +
																				"Inscricao.curso AS id_curso, " +
																				"aluno.nome AS nome_do_aluno, " +
																				"docente.nome AS nome_do_docente, " +
																				"Curso.nome AS nome_do_curso, " +
																				"estadoInscricao.descricao AS estado_inscricao, " +
																				"Inscricao.data_inscricao AS data_inscricao, " +
																				"Inscricao.custo AS preco " +
																				"FROM Inscricao " +
																				"JOIN Utilizador AS aluno ON Inscricao.aluno = aluno.id_utilizador " +
																				"JOIN Curso ON Inscricao.curso = Curso.id_curso " +
																				"JOIN Utilizador AS docente ON Curso.docente = docente.id_utilizador " +
																				"JOIN estadoinscricao ON Inscricao.estadoDaInscricao = estadoinscricao.estadoInscricao " +
																				"WHERE Inscricao.aluno = '" + idDoAluno + "' " +
																				"ORDER BY Inscricao.data_inscricao");
										while(inscricao.next()){
											String docente = inscricao.getString("nome_do_docente");
											String aluno = inscricao.getString("nome_do_aluno");
											String curso = inscricao.getString("nome_do_curso");
											String dataInscricao = inscricao.getString("data_inscricao");
											String preco = inscricao.getString("preco");
											String estadoInscricao = inscricao.getString("estado_inscricao");
									%>
										<tr>
											<td><%=aluno%></td>
											<td><%=curso%></td>
											<td><%=docente%></td>
											<td><%=dataInscricao%></td>
											<td><%=preco%></td>
											<td><%=estadoInscricao%></td>
										</tr>
										
									<% } 
									stmt.close();
									conn.close();
								} catch (Exception ex) {
									ex.printStackTrace();
									out.println("Erro: " + ex.getMessage());
								} %>
									</table>
								</div>
							</div>	
<% 
		} else if (tipoUtilizador == DOCENTE){ %>
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
						<div id="corpo">
							<h2>Inscrições</h2> <br>
							<div id="tabela">
								<table width='100%' id = 't01'>
									<tr>
										<th>Aluno:</th>
										<th>Curso:</th>
										<th>Docente:</th>
										<th>Data de Inscrição:</th>
										<th>Preço</th>
										<th>Estado da Inscrição</th>
									</tr>
									<% try{
										Statement stmt = conn.createStatement();
										ResultSet inscricao = stmt.executeQuery("SELECT " +
																					"Inscricao.aluno AS id_aluno, " +
																					"Inscricao.curso AS id_curso, " +
																					"aluno.nome AS nome_do_aluno, " +
																					"docente.nome AS nome_do_docente, " +
																					"Curso.nome AS nome_do_curso, " +
																					"estadoInscricao.descricao AS estado_inscricao, " +
																					"Inscricao.data_inscricao AS data_inscricao, " +
																					"Inscricao.custo AS preco " +
																				 "FROM Inscricao " +
																				 "JOIN Utilizador AS aluno ON Inscricao.aluno = aluno.id_utilizador " +
																				 "JOIN Curso ON Inscricao.curso = Curso.id_curso " +
																				 "JOIN Utilizador AS docente ON Curso.docente = docente.id_utilizador " +
																				 "JOIN estadoinscricao ON Inscricao.estadoDaInscricao = estadoinscricao.estadoInscricao " +
																				 "WHERE Inscricao.curso = '" + idCurso + "' " +
																				 "ORDER BY Inscricao.data_inscricao, aluno.nome, Inscricao.aluno");
										while(inscricao.next()){
											String idAluno = inscricao.getString("id_aluno");
											String docente = inscricao.getString("nome_do_docente");
											String aluno = inscricao.getString("nome_do_aluno");
											String curso = inscricao.getString("nome_do_curso");
											String dataInscricao = inscricao.getString("data_inscricao");
											String preco = inscricao.getString("preco");
											String estadoInscricao = inscricao.getString("estado_inscricao");
									%>
										<tr>
											<td><%=aluno%></td>
											<td><%=curso%></td>
											<td><%=docente%></td>
											<td><%=dataInscricao%></td>
											<td><%=preco%></td>
											<td><%=estadoInscricao%></td>
										</tr>
										
									<% } 
									stmt.close();
									conn.close();
								} catch (Exception ex) {
									ex.printStackTrace();
									out.println("Erro: " + ex.getMessage());
								} %>
									</table>
								</div>
							</div>
		
		
		
			
<%		}
	} else {
		response.sendRedirect("logout.jsp");
	}
%>