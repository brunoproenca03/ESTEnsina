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
		
		if (tipoUtilizador == ADMINISTRADOR){
			 try {
					Statement stmt = conn.createStatement();
					String estado = "SELECT estadoDaInscricao FROM inscricao WHERE aluno = '" + idAluno + "' AND curso = '" + idCurso + "'";
					ResultSet verEstado = stmt.executeQuery(estado);
						while (verEstado.next()){
							String estadoDaInscricao = verEstado.getString("estadoDaInscricao");
							if ("2".equals(estadoDaInscricao)) {
								try {
									Statement stmt2 = conn.createStatement();
									String inscrit = "SELECT inscritos FROM curso WHERE id_curso = '" + idCurso + "'";
									ResultSet numeroInscritos = stmt2.executeQuery(inscrit);
										while(numeroInscritos.next()){
											int inscritosNoCurso = numeroInscritos.getInt("inscritos");
											
											if (inscritosNoCurso != 0) {
												
												inscritosNoCurso -= 1;
												String update = "UPDATE curso SET inscritos = ? WHERE id_curso = ?";
												PreparedStatement ps = conn.prepareStatement(update);
												
												String inscritosCurso = Integer.toString(inscritosNoCurso);
												
												ps.setString(1,	inscritosCurso);
												ps.setString(2,	idCurso);
												
												ps.executeUpdate();
												ps.close();
												
											}
											
										}
									
									stmt2.close();
								 } catch (Exception ex) {
									ex.printStackTrace();
									out.println("Erro: " + ex.getMessage());
								 }
								
							}
						}
					
					stmt.close();

			 } catch (Exception ex) {
				ex.printStackTrace();
				out.println("Erro: " + ex.getMessage());
			 }
			 
			 try {
					String delete = "DELETE FROM inscricao WHERE aluno = ? AND curso = ?";
					PreparedStatement ps = conn.prepareStatement(delete);
				
					ps.setString(1,	idAluno);
					ps.setString(2,	idCurso);
					
					ps.executeUpdate();
					ps.close();
					conn.close();
					
					response.sendRedirect("gerirInscricoes.jsp");
					
			} catch (Exception ex) {
				ex.printStackTrace();
				out.println("Erro: " + ex.getMessage());
			}
		}
		

    } else {
        response.sendRedirect("logout.jsp");
    }
%>
