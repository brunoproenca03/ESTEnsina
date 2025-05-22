<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="java.sql.*, javax.servlet.*, javax.servlet.http.*, java.util.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

    if (session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR) {
        String idCurso = request.getParameter("curso");
        String idAluno = request.getParameter("aluno");
		
		try {
			Statement stmt = conn.createStatement();
			String select = "SELECT estadoInscricao FROM estadoinscricao WHERE descricao = 'Rejeitada'";
			ResultSet estadoInscricao = stmt.executeQuery(select);										
			while(estadoInscricao.next()){
				String estado = estadoInscricao.getString("estadoInscricao");				
				try {
					String update = "UPDATE inscricao SET estadoDaInscricao = ? WHERE curso = ? AND aluno = ?";
					PreparedStatement ps = conn.prepareStatement(update);												
					ps.setString(1,	estado);
					ps.setString(2,	idCurso);
					ps.setString(3,	idAluno);

					ps.executeUpdate();

					ps.close();
					
					response.sendRedirect("gerirInscricoes.jsp");
					
				} catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
				}
			}
				
				stmt.close();
				conn.close();
				
		} catch (Exception ex) {
			ex.printStackTrace();
			out.println("Erro: " + ex.getMessage());
		}		
		
	} else {
		 response.sendRedirect("logout.jsp");
	}
%>