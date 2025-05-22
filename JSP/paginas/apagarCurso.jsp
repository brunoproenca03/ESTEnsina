<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="javax.servlet.http.*, javax.servlet.*, java.sql.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<% 
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR ){
		String idCurso = request.getParameter("curso");
		
		try {

			String deleteInscricao = "DELETE FROM inscricao WHERE curso = ?";

			PreparedStatement ps = conn.prepareStatement(deleteInscricao);
			ps.setString(1, idCurso);
			ps.executeUpdate();

			String delete = "DELETE FROM curso WHERE id_curso = ?";
					
			ps = conn.prepareStatement(delete);
			ps.setString(1, idCurso);
			ps.executeUpdate();

			ps.close();
			conn.close();
					
			out.println("<script> alert('Curso eliminado com sucesso'); window.location.href = 'verTodosCursos.jsp'; </script>");
			
			} catch (Exception ex) {
				ex.printStackTrace();
				out.println("Erro: " + ex.getMessage());
			}
	
	} else {
		response.sendRedirect("logout.jsp");
	}		
%>
