<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.security.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%	
	request.setCharacterEncoding("UTF-8");
	response.setContentType("text/html; charset=UTF-8");

	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR){
		String nomeAluno = request.getParameter("nome");
		try{
			String update = "UPDATE utilizador SET tipo_utilizador= ? WHERE nome= ?";			
			PreparedStatement ps= conn.prepareStatement(update);
			ps.setString(1,	"3");
			ps.setString(2,	nomeAluno);
			
			ps.executeUpdate();
			
			ps.close();
			conn.close();
			
			response.sendRedirect("GestaoUtilizador.jsp");
			
		} catch (Exception ex){
			ex.printStackTrace();
			out.println("Erro: " + ex.getMessage());
		}
		
	} else {
		response.sendRedirect("logout.jsp");
	}
%>