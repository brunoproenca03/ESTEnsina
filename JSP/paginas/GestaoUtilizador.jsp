<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.security.*" %>
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
            width: 100%;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.3s;
            margin-bottom: 20px;
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

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR ){
		
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
							<form action='PaginaUtilizador.jsp'>
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
			<div id="corpo">
				<form action="PaginaNovoUtilizador.jsp">
					<input type='submit' value='Novo Utilizador' id="btnNv">
				</form>
				<div id="tabela">
					<table width='100%' id = 't01'>
					<tr>
						<th>Nome Utilizador:</th>
						<th>Email:</th>
						<th>Tipo:</th>
						<th>Telemóvel:</th>
						<th>Validar:</th>
						<th>Editar:</th>
						<th>(Des)Promover:</th>
						<th>Promover:</th>
						<th>Apagar:</th>
					</tr>
			
<%		
		try{
			Statement stmt = conn.createStatement();
            ResultSet dadosUtilizador = stmt.executeQuery("SELECT * FROM utilizador ORDER BY tipo_utilizador,nome");
			while(dadosUtilizador.next()){
				String id = dadosUtilizador.getString("id_utilizador");
				String tipoDUtilizador = dadosUtilizador.getString("tipo_utilizador");
				int tipoDeUtilizador = Integer.parseInt(tipoDUtilizador);
				String nome = dadosUtilizador.getString("nome");
				String email = dadosUtilizador.getString("email");
				String telemovel = dadosUtilizador.getString("telemovel");
%>		

						<tr>
							<td><%= nome %></td>
							<td><%= email %></td>
					<% 
					try{
						Statement stmt2 = conn.createStatement();
						ResultSet tipo = stmt2.executeQuery("SELECT tipoutilizador FROM tipoutilizador WHERE id_tipo = '"+tipoDeUtilizador+"'");
						while(tipo.next()){
							String nomeTipo = tipo.getString("tipoutilizador");
					%>
							<td><%= nomeTipo %></td>
							
					<%		
						}
						stmt2.close();
					 } catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					 }
					%>
					
							<td><%= telemovel %></td>
							
			<% if(tipoDeUtilizador == ALUNO_NAO_VALIDADO && tipoDeUtilizador != VISITANTE){ %>											
							<td><a href='validar.jsp?nome=<%= nome %>'><img src='validar.png' width=50 height=50></a></td>
			<% } else { %>
							<td></td>
			<% } %>
					
			<% if(tipoDeUtilizador != VISITANTE){ %>
							<td><a href='editar.jsp?nome=<%= nome %>' ><img src='editar.png' width=50 height=50></a></td>
			<% } else { %>
							<td></td>
			<% } %>
			<% if(tipoDeUtilizador != VISITANTE  && tipoDeUtilizador != ALUNO_NAO_VALIDADO ){ %>
							<td><a href='despromover.jsp?nome=<%= nome %>' ><img src='despromover.png' width=50 height=50></a></td>
			<% } else { %>
							<td></td>
			<% } %>
			<% if(tipoDeUtilizador != ADMINISTRADOR && tipoDeUtilizador != ALUNO_NAO_VALIDADO && tipoDeUtilizador != VISITANTE ){ %>
							<td><a href='promover.jsp?nome=<%= nome %>'><img src='promover.png' width=50 height=50></a></td>
			<% } else { %>
							<td></td>
			<% } %>
			<% if(tipoDeUtilizador != VISITANTE){ %>
							<td><a href='apagarUtilizador.jsp?id=<%= id %>' ><img src='apagar.png' width=50 height=50></a></td>
			<% } else { %>
							<td></td>
			<% } %>
					
					
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
	} else {
		response.sendRedirect("PaginaUtilizador.jsp");
	}
%>