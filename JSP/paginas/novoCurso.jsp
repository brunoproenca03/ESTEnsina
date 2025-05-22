<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="javax.servlet.http.*, javax.servlet.*, java.util.*, java.sql.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR){
		String nomeDocente = request.getParameter("docente");
		String nomeCurso = request.getParameter("nome");
		
		try {
			Statement stmt = conn.createStatement();
			ResultSet verificaCurso = stmt.executeQuery("SELECT * FROM curso WHERE nome = '"+nomeCurso+"'");
			
			if(verificaCurso.next()){
				out.println("<script> alert('O curso que tentou criar já se encontra criado'); window.location.href = 'PaginaNovoCurso.jsp'; </script>");
			} else {
				try {
					Statement stmt2 = conn.createStatement();
					ResultSet idDoc = stmt.executeQuery("SELECT id_utilizador FROM utilizador WHERE nome = '"+nomeDocente+"'");
					while(idDoc.next()){
						String idDocente = idDoc.getString("id_utilizador");
						try {
							String duracao = request.getParameter("duracao");
							String vagas = request.getParameter("vagas");
							String insert = "INSERT	INTO curso (nome,duracao,inscritos,capacidade,docente) VALUES (?,?,?,?,?)";
							
							PreparedStatement ps= conn.prepareStatement(insert); 
							ps.setString(1,	nomeCurso); 
							ps.setString(2,	duracao); 
							ps.setString(3,	"0"); 
							ps.setString(4,	vagas); 
							ps.setString(5,	idDocente);
							
							ps.executeUpdate();
						
							ps.close();
							conn.close();
							
							response.sendRedirect("verTodosCursos.jsp");
							
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