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

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR){
		String idUtilizador = (String) session.getAttribute("id");
		
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
					
					<% try{
						String idCurso = request.getParameter("curso");
						Statement stmt = conn.createStatement();
						ResultSet dadosCurso = stmt.executeQuery("SELECT * FROM curso WHERE id_curso ='"+idCurso+"'");
						while(dadosCurso.next()){
							String docente = dadosCurso.getString("docente");
							String nome = dadosCurso.getString("nome");
							String duracao = dadosCurso.getString("duracao");
							String vagas = dadosCurso.getString("capacidade");
							String inscritos = dadosCurso.getString("inscritos");
					%>
					
					<div class="container">
						<div class="form-container">
							<h2>Alterar Dados do Curso</h2>
							<form method="POST" action="alteraDadosCurso.jsp?curso=<%=idCurso%>">
								<div class="form-group">
									<label for="nome">Nome do Curso :</label>
									<input type="text" class="form-control" id="nome" name="nome" value = "<%=nome%>" required>
								</div>
								<div class="form-group">
									<label for="duracao">Duração do curso (horas) :</label>
									<input type="text" class="form-control" id="duracao" name="duracao" value = "<%=duracao%>" required>
								</div>
								<div class="form-group">
									<label for="vagas">Vagas do curso:</label>
									<input type="text" class="form-control" id="vagas" name="vagas" value = "<%=vagas%>" required >
								</div>
								<div class="form-group">
									<label for="docente">Docente:</label>
									<div class="input-group">
										<select class="form-control" id="docente" name="docente">
							 <% try{
									Statement stmt2 = conn.createStatement();
									ResultSet docentesCurso = stmt2.executeQuery("SELECT nome FROM utilizador WHERE tipo_utilizador = 2");
									while(docentesCurso.next()){
										String nomes = docentesCurso.getString("nome");
										try {
											Statement stmt3 = conn.createStatement();
											ResultSet docentes = stmt3.executeQuery("SELECT nome FROM utilizador WHERE id_utilizador = '"+docente+"'");
											while(docentes.next()){
												String nomeDocente = docentes.getString("nome");
												if(nomeDocente.equals(nomes)){
								%>		
													<option value='<%=nomeDocente%>' selected><%=nomeDocente%></option>
											
										 <%     } else {  %>
													<option value='<%=nomes%>'><%=nomes%></option>
										 <%		}
											}
										stmt3.close();
									 } catch (Exception ex) {
										ex.printStackTrace();
										out.println("Erro: " + ex.getMessage());
									 }
									}
									stmt2.close();
								 } catch (Exception ex) {
									ex.printStackTrace();
									out.println("Erro: " + ex.getMessage());
								 }
								%>
										</select>
									</div>
								</div> 
								<button type="submit" class="btn btn-primary btn-block">Altera</button>
							</form>
						 </div>
						</div>	
					<%		 }
						stmt.close();
						conn.close();
					} catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					}
					
					%>

		<%	 }
		} else {
			response.sendRedirect("logout.jsp");
		}
		
		%>