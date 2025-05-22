<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="javax.servlet.http.*, javax.servlet.*, java.util.*, java.sql.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>
<%@ include file="encripta.jsp" %>

<% 
	 request.setCharacterEncoding("UTF-8");
	 response.setContentType("text/html; charset=UTF-8");
	
	 String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	 int tipoUtilizadorSessao = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizadorSessao == ADMINISTRADOR ){
		
		String tipoUtilizador = request.getParameter("tipo");
		if(tipoUtilizador.equals("Administrador")){
			tipoUtilizador = "1";
		} else if(tipoUtilizador.equals("Docente")){
			tipoUtilizador = "2";
		}  else if(tipoUtilizador.equals("Aluno")){
			tipoUtilizador = "3";
		} else if(tipoUtilizador.equals("Aluno Não Validado")){
			tipoUtilizador = "4";
		}

		String idDoUtilizadorAEditar = request.getParameter("id");
		String idUtilizador = (String) session.getAttribute("id");
		String nomeAtual = (String) session.getAttribute("nomeURL");
		String novoNome = request.getParameter("nome");
		String data = request.getParameter("data");
		String email = request.getParameter("email");
		String pass = request.getParameter("pass");
		String confirmapass = request.getParameter("conf_pass");
		String morada = request.getParameter("morada");
		String telemovel = request.getParameter("telemovel");

		if(idDoUtilizadorAEditar.equals(idUtilizador)){
			session.setAttribute("user",novoNome);
			session.setAttribute("tipo_utilizador",tipoUtilizador);
		}
		
		
		if((pass != null && !pass.isEmpty()) || (confirmapass != null && !confirmapass.isEmpty())){
			if(pass.equals(confirmapass)){
				try{
					
					String update = "UPDATE utilizador SET nome= ?, data_nascimento= ?, email= ?, morada= ?, pass= ?, telemovel= ?, tipo_utilizador= ? WHERE nome= ?";
										
					PreparedStatement ps= conn.prepareStatement(update);
					ps.setString(1,	novoNome);
					ps.setString(2,	data);
					ps.setString(3,	email);
					ps.setString(4,	morada);
					ps.setString(5,	encriptar(pass));
					ps.setString(6,	telemovel);
					ps.setString(7,	tipoUtilizador);
					ps.setString(8,	nomeAtual);
					
					ps.executeUpdate();
										
					ps.close();
					conn.close();
					session.removeAttribute("nomeURL");
					response.sendRedirect("GestaoUtilizador.jsp");
					
				} catch (Exception ex){
					ex.printStackTrace();
					out.println("Erro: " + ex.getMessage());
				}
			} else {
				out.println("<script> alert ('ERRO! Passwords incompatíveis!') </script>");
				response.sendRedirect("edita.jsp");
			}
			
			
		} else {
			
			try{
					String update = "UPDATE utilizador SET nome= ?, data_nascimento= ?, email= ?, morada= ?, telemovel= ?, tipo_utilizador= ? WHERE nome= ?";
										
					PreparedStatement ps= conn.prepareStatement(update);
					ps.setString(1,	novoNome);
					ps.setString(2,	data);
					ps.setString(3,	email);
					ps.setString(4,	morada);
					ps.setString(5,	telemovel);
					ps.setString(6,	tipoUtilizador);
					ps.setString(7,	nomeAtual);
					
					ps.executeUpdate();
					
					ps.close();
					conn.close();
					session.removeAttribute("nomeURL");
					response.sendRedirect("GestaoUtilizador.jsp");
					
					
				} catch (Exception ex){
					ex.printStackTrace();
					out.println("Erro: " + ex.getMessage());
				}
				
		}
	} else {
		response.sendRedirect("logout.jsp");
	}
	
%>