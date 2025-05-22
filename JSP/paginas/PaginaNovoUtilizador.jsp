<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.security.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<!DOCTYPE html>
<html>

<head>
    <title> Novo Utilizador </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>

<%
	String tipo = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipo);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR){
		
		
		if(tipoUtilizador != ADMINISTRADOR) {
			response.sendRedirect("PaginaUtilizador.jsp");
		}
		
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
						<h2>Novo Utilizador</h2>
						<form method="POST" action="novoUtilizador.jsp">
							<div class="form-group">
								<label for="user">Nome de Utilizador:</label>
								<input type="text" class="form-control" id="nome" name="nome" required>
							</div>
							<div class="form-group">
								<label for="data">Data de Nascimento:</label>
								<input type="date" class="form-control" id="data" name="data" required>
							</div>
							<div class="form-group">
								<label for="tipo">Tipo de Utilizador:</label>
								<div class="input-group">
									<select class="form-control" id="tipo" name="tipo">
										<option value="Administrador">Administrador</option>
										<option value="Docente">Docente</option>
										<option value="Aluno">Aluno</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control" id="email" name="email" required>
							</div>
							<div class="form-group">
								<label for="morada">Morada:</label>
								<input type="text" class="form-control" id="morada" name="morada" required>
							</div>
							<div class="form-group">
								<label for="pass">Password:</label>
								<input type="password" class="form-control" id="pass" name="pass" required>
							</div>
							<div class="form-group">
								<label for="telemovel">Telemóvel:</label>
								<input type="tel" class="form-control" id="telemovel" name="telemovel" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block">Criar</button>
						</form>
					 </div>
					</div>
<%
		
	} else {
		response.sendRedirect("logout.jsp");
	}

%>

</body>

</html>