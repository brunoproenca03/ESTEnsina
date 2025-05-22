<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.util.*" %>
<%@ include file="..\basedados\basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

    if (session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR ) {
        String id_curso = request.getParameter("curso");
        String nomeDocente = request.getParameter("docente");
        String nomeCurso = request.getParameter("nome");

        try {
            // Obter id_utilizador do docente
            Statement stmt1 = conn.createStatement();
            ResultSet idDocente = stmt1.executeQuery("SELECT id_utilizador FROM utilizador WHERE nome = '" + nomeDocente + "'");

			while(idDocente.next()){
				String idNovoDocente = idDocente.getString("id_utilizador");
				try {
					// Verificar se já existe um curso com o mesmo nome
					Statement stmt2 = conn.createStatement();
					ResultSet existeCurso = stmt2.executeQuery("SELECT * FROM curso WHERE nome = '" + nomeCurso + "' AND id_curso != " + id_curso + "");
				   
					if (existeCurso.next()) {
						out.println("<script> alert('O curso que tentou alterar o nome já se encontra criado'); window.location.href = 'verTodosCursos.jsp'; </script>");
					} else {
						
						try {
							// Obter docente atual do curso
							Statement stmt3 = conn.createStatement();
							ResultSet idAntDocente = stmt3.executeQuery("SELECT docente FROM curso WHERE id_curso = " + id_curso + "");
							
							while(idAntDocente.next()){
								 String idAtualDocente = idAntDocente.getString("docente");
									String duracao = request.getParameter("duracao");
									String capacidade = request.getParameter("vagas");

									try {
										int duracaoo = Integer.parseInt(duracao);
										int capacidadee = Integer.parseInt(capacidade);
										if (duracaoo < 0 || capacidadee < 0) {
											out.println("<script> alert('O campo Duração e o Campo Vagas não podem ser negativos'); window.location.href = 'verTodosCursos.jsp'; </script>");
											return;
										}
									} catch (NumberFormatException e) {
										out.println("<script> alert('Erro ao converter valores para números inteiros'); window.location.href = 'verTodosCursos.jsp'; </script>");
										return;
									}
										try {
										String updateQuery;
										if (idAtualDocente.equals(idNovoDocente)) {
											// Atualizar curso sem mudar o docente
											updateQuery = "UPDATE curso SET nome = ?, duracao = ?, capacidade = ? WHERE id_curso = ?";
											PreparedStatement stmt4 = conn.prepareStatement(updateQuery);
											
											stmt4.setString(1, nomeCurso);
											stmt4.setString(2, duracao);
											stmt4.setString(3, capacidade);
											stmt4.setString(4, id_curso);
											
											stmt4.executeUpdate();
											stmt4.close();
											response.sendRedirect("verTodosCursos.jsp");
										} else {
											// Atualizar curso e mudar o docente
											updateQuery = "UPDATE curso SET nome = ?, duracao = ?, capacidade = ?, docente = ? WHERE id_curso = ?";
											
											PreparedStatement stmt4 = conn.prepareStatement(updateQuery);
											
											stmt4.setString(1, nomeCurso);
											stmt4.setString(2, duracao);
											stmt4.setString(3, capacidade);
											stmt4.setString(4, idNovoDocente);
											stmt4.setString(5, id_curso);
											
											stmt4.executeUpdate();
											stmt4.close();
											response.sendRedirect("verTodosCursos.jsp");
										}

										
										
									} catch (Exception ex) {
										ex.printStackTrace();
										out.println("Erro: " + ex.getMessage());
									}
											 
										}
										stmt3.close();
									} catch (Exception ex) {
										ex.printStackTrace();
										out.println("Erro: " + ex.getMessage());
									}
						
					}

					stmt2.close();
					conn.close();
				} catch (Exception ex) {
					ex.printStackTrace();
					out.println("Erro: " + ex.getMessage());
				}
				
			}
            stmt1.close();
			
		} catch (Exception ex) {
            ex.printStackTrace();
            out.println("Erro: " + ex.getMessage());
        }
		
		
    } else {
        response.sendRedirect("logout.jsp");
    }
%>
