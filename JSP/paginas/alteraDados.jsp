<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="javax.servlet.http.*, javax.servlet.*, java.util.*, java.sql.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>
<%@ include file="encripta.jsp" %>

<% 
	 request.setCharacterEncoding("UTF-8");
	 response.setContentType("text/html; charset=UTF-8");
	
	 String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	 int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && (tipoUtilizador != ALUNO_NAO_VALIDADO || tipoUtilizador != VISITANTE) ){
		
		String nomeAtual = (String) session.getAttribute("user");
		String novoNome = request.getParameter("nome");
		String data = request.getParameter("data");
		String email = request.getParameter("email");
		String pass = request.getParameter("pass");
		String confirmapass = request.getParameter("conf_pass");
		String morada = request.getParameter("morada");
		String telemovel = request.getParameter("telemovel");
		
		
		if((pass != null && !pass.isEmpty()) || (confirmapass != null && !confirmapass.isEmpty())){
			if(pass.equals(confirmapass)){
				try{
					
					String update = "UPDATE utilizador SET nome= ?, data_nascimento= ?, email= ?, morada= ?, pass= ?, telemovel= ? WHERE nome= ?";
										
					PreparedStatement ps= conn.prepareStatement(update);
					ps.setString(1,	novoNome);
					ps.setString(2,	data);
					ps.setString(3,	email);
					ps.setString(4,	morada);
					ps.setString(5,	encriptar(pass));
					ps.setString(6,	telemovel);
					ps.setString(7,	nomeAtual);
					
					ps.executeUpdate();
					
					session.setAttribute("user",novoNome);
										
					ps.close();
					conn.close();
					response.sendRedirect("PaginaUtilizador.jsp");
					
				} catch (Exception ex){
					ex.printStackTrace();
					out.println("Erro: " + ex.getMessage());
				}
			} else {
				out.println("<script> alert ('ERRO! Passwords incompatíveis!') </script>");
				response.sendRedirect("DadosPessoais.jsp");
			}
			
			
		} else {
			
			try{
					String update = "UPDATE utilizador SET nome= ?, data_nascimento= ?, email= ?, morada= ?, telemovel= ? WHERE nome= ?";
										
					PreparedStatement ps= conn.prepareStatement(update);
					ps.setString(1,	novoNome);
					ps.setString(2,	data);
					ps.setString(3,	email);
					ps.setString(4,	morada);
					ps.setString(5,	telemovel);
					ps.setString(6,	nomeAtual);
					
					ps.executeUpdate();
					
					session.setAttribute("user",novoNome);
					
					ps.close();
					conn.close();
					response.sendRedirect("PaginaUtilizador.jsp");
					
					
				} catch (Exception ex){
					ex.printStackTrace();
					out.println("Erro: " + ex.getMessage());
				}
				
		}
		
	} else {
		response.sendRedirect("logout.jsp");
	}
	
%>