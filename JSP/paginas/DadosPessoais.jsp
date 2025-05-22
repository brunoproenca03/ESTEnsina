<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="javax.servlet.http.*, javax.servlet.*, java.util.*, java.sql.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dados Pessoais</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
<%
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && (tipoUtilizador != ALUNO_NAO_VALIDADO || tipoUtilizador != VISITANTE) ){
				
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
							<form action='index.jsp'>
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
			
	<%
		try{
			String idUtilizador = (String) session.getAttribute("id");
			Statement stmt = conn.createStatement();
            ResultSet dadosUtilizador = stmt.executeQuery("SELECT * FROM utilizador WHERE id_utilizador = '"+ idUtilizador +"'");
			while(dadosUtilizador.next()){
				String nome = dadosUtilizador.getString("nome");
				String dataNascimento = dadosUtilizador.getString("data_nascimento");
				String email = dadosUtilizador.getString("email");
				String morada = dadosUtilizador.getString("morada");
				String telemovel = dadosUtilizador.getString("telemovel");
				
	%>
			
	

	
			 <div class="container">
				<div class="form-container">
					<h2>Dados Pessoais</h2>
					<form method="POST" action="alteraDados.jsp">
						<div class="form-group">
							<label for="nome">Nome de Utilizador:</label>
							<input type="text" class="form-control" id="nome" name="nome" value="<%= nome %>">
						</div>
						<div class="form-group">
							<label for="data">Data de Nascimento:</label>
							<input type="date" class="form-control" id="data" name="data" value="<%= dataNascimento %>">
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
						<button type="submit" class="btn btn-primary btn-block">Atualizar</button>
					</form>
				</div>
			</div>
	
	<%
			}
				} catch (Exception ex){
					ex.printStackTrace();
					out.println("Erro: " + ex.getMessage());
				}
	
	%>
		
<%	} else {
		response.sendRedirect("logout.jsp");
	}

%>

</body>

</html>