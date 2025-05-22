<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.security.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Editar Dados Pessoais </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>

<% 
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR){
		String nomeUrl = request.getParameter("nome");
		session.setAttribute("nomeURL",nomeUrl);
		
		if(tipoUtilizador != ADMINISTRADOR){
			response.sendRedirect("PaginaUtilizador.jsp");
		} else if(tipoUtilizador == ADMINISTRADOR) { 
			
			try{
				Statement stmt = conn.createStatement();
				ResultSet dadosUtilizador = stmt.executeQuery("SELECT * FROM utilizador WHERE nome ='"+ nomeUrl +"'");
				while(dadosUtilizador.next()){
					String idUtilizador = dadosUtilizador.getString("id_utilizador");
					String tipoDUtilizador = dadosUtilizador.getString("tipo_utilizador");
					int tipoDeUtilizador = Integer.parseInt(tipoDUtilizador);
					String nome = dadosUtilizador.getString("nome");
					String email = dadosUtilizador.getString("email");
					String telemovel = dadosUtilizador.getString("telemovel");
					String morada = dadosUtilizador.getString("morada");
					String data = dadosUtilizador.getString("data_nascimento");
					
%>	
					<div id='cabecalho'>
						<a href='index.jsp' id = 'nomeSite'>
							ESTensina
						</a>
						<div class= 'input-div'>
							<div id='botao'>
								<form action='logout.jsp'>
									<input type='submit' value='Logout'>
								</form>
							</div>
							<div id='botao'>
								<form action='GestaoUtilizador.jsp'>
									<input type='submit' value='Página Principal'>
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
						<h2>Editar Dados</h2>
						<form method="POST" action="editaDados.jsp?id=<%= idUtilizador %>">
							<div class="form-group">
								<label for="nome">Nome de Utilizador:</label>
								<input type="text" class="form-control" id="nome" name="nome" value="<%= nome %>" >
							</div>
							<div class="form-group">
								<label for="data">Data de Nascimento</label>
								<input type="date" class="form-control" id="data" name="data" value="<%= data %>" >
							</div>
							<div class="form-group">
								<label for="tipo">Tipo de Utilizador:</label>
								<div class="input-group">
									<select class="form-control" id="tipo" name="tipo">


							<% if(tipoDeUtilizador == ADMINISTRADOR){ %>
										<option value='Administrador' selected>Administrador</option>
							<% } else { %>				
										<option value='Administrador'>Administrador</option>
							<% } if(tipoDeUtilizador == DOCENTE){ %>
										<option value='Docente' selected>Docente</option>
							<% } else { %>				
										<option value='Docente'>Docente</option>
							<% } if(tipoDeUtilizador == ALUNO){ %>
										<option value='Aluno' selected>Aluno</option>
							<% } else { %>				
										<option value='Aluno'>Aluno</option>
							<%} %>
							<% if(tipoDeUtilizador == ALUNO_NAO_VALIDADO){ %>
										<option value='Aluno Não Validado' selected>Aluno Não Validado</option>
							<% } else { %>				
										<option value='Aluno Não Validado'>Aluno Não Validado</option>
							<%} %>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control" id="email" name="email" value="<%= email %>">
							</div>
							<div class="form-group">
								<label for="pass">Nova Password (facultativo):</label>
								<input type="password" class="form-control" id="pass" name="pass">
							</div>
							<div class="form-group">
								<label for="conf_pass">Confirmação da Password:</label>
								<input type="password" class="form-control" id="conf_pass" name="conf_pass">
							</div>
							<div class="form-group">
								<label for="telemovel">Telemóvel:</label>
								<input type="tel" class="form-control" id="telemovel" name="telemovel" value="<%= telemovel %>">
							</div>
							<div class="form-group">
								<label for="morada">Morada:</label>
								<input type="text" class="form-control" id="morada" name="morada" value="<%= morada %>">
							</div>
							<button type="submit" class="btn btn-primary btn-block">Editar</button>
						</form>
					</div>
					</div>
										
										
										
										
<%				}
				stmt.close();
				conn.close();
			}catch (Exception ex) {
				ex.printStackTrace();
				out.println("Erro: " + ex.getMessage());
			}
		
		
		}
	} else {
		response.sendRedirect("logout.jsp");
	}
%>
</body>

</html>	
		
		