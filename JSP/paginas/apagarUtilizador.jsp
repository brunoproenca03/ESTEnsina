<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.security.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%
    String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
    int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

    if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR) {
        String id = request.getParameter("id");
		String idSessao = (String) session.getAttribute("id");

        try {
            Statement stmt = conn.createStatement();
            String tipo = "SELECT tipo_utilizador FROM utilizador WHERE id_utilizador='" + id + "'";
            ResultSet rs = stmt.executeQuery(tipo);

            if (rs.next()) {
                int tipoDeUtilizador = rs.getInt("tipo_utilizador");

                if (tipoDeUtilizador == DOCENTE) {
                    String cursoQuery = "SELECT id_curso FROM curso WHERE docente = '" + id + "'";
                    Statement stmt2 = conn.createStatement();
                    ResultSet cursoRS = stmt2.executeQuery(cursoQuery);

                    while (cursoRS.next()) {
                        int idCurso = cursoRS.getInt("id_curso");

							String deleteInscricoes = "DELETE FROM inscricao WHERE curso = ?";
							PreparedStatement ps = conn.prepareStatement(deleteInscricoes);
							ps.setInt(1, idCurso);
							ps.executeUpdate();
							ps.close();

							
							String deleteCurso = "DELETE FROM curso WHERE id_curso = ?";
							ps = conn.prepareStatement(deleteCurso);
							ps.setInt(1, idCurso);
							ps.executeUpdate();
							ps.close();
                    } 
                    cursoRS.close();
                    stmt2.close();

                } else if(tipoDeUtilizador == ALUNO){
                    
                                String deleteInscricoesQuery = "DELETE FROM inscricao WHERE aluno = ?";
                                PreparedStatement psDeleteInscricao = conn.prepareStatement(deleteInscricoesQuery);
                                psDeleteInscricao.setString(1, id);
                                psDeleteInscricao.executeUpdate();
                                psDeleteInscricao.close();

                                

                           
                }
                
 					
				String deleteUtilizador = "DELETE FROM utilizador WHERE id_utilizador = ?";
				PreparedStatement ps = conn.prepareStatement(deleteUtilizador);
				ps.setString(1, id);
				ps.executeUpdate();

				if(id.equals(idSessao)){
					session.removeAttribute("id");
					session.removeAttribute("pass");
					session.removeAttribute("tipo_utilizador");
					session.removeAttribute("user");
					response.sendRedirect("index.jsp");
				}
				ps.close();

				response.sendRedirect("GestaoUtilizador.jsp");
                
            } else {
                out.println("Nome utilizador não encontrado.");
                response.setHeader("Refresh", "0; URL=index.jsp");
            }

            rs.close();
            stmt.close();
            conn.close();

        } catch (Exception e) {
            e.printStackTrace();
            out.println("Erro: " + e.getMessage());
        }
    } else {
        response.sendRedirect("logout.jsp");
    }
%>
