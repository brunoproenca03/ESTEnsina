<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="java.sql.*, javax.servlet.*, javax.servlet.http.*, java.util.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%
	request.setCharacterEncoding("UTF-8");
	response.setContentType("text/html; charset=UTF-8");

    String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);
	
    if (session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR ) {
        String nomeAluno = request.getParameter("nomeAluno");
        String nomeCurso = request.getParameter("nomeCurso");

        try {
            Statement stmt = conn.createStatement();
            // Obter id do Aluno
            String idUtilizador = "SELECT id_utilizador FROM utilizador WHERE nome = '" + nomeAluno + "'";
            ResultSet idDoAluno = stmt.executeQuery(idUtilizador);
            while (idDoAluno.next()) {
                String idAluno = idDoAluno.getString("id_utilizador");
                try {
                    Statement stmt2 = conn.createStatement();
                    // Obter id do Curso
                    String idDoCurso = "SELECT id_curso FROM curso WHERE nome = '" + nomeCurso + "'";
                    ResultSet curso = stmt2.executeQuery(idDoCurso);

                    while (curso.next()) {
                        String idCurso = curso.getString("id_curso");

                        try {
                            Statement stmt3 = conn.createStatement();
                            // Verificar se a inscrição já existe
                            String existe = "SELECT * FROM Inscricao " +
                                    "INNER JOIN Utilizador ON Inscricao.aluno = Utilizador.id_utilizador " +
                                    "INNER JOIN Curso ON Inscricao.curso = Curso.id_curso " +
                                    "WHERE Curso.id_curso = '" + idCurso + "' AND Inscricao.aluno = '" + idAluno + "'";
                            ResultSet existeInscricao = stmt3.executeQuery(existe);
                            if (existeInscricao.next()) {
                                out.println("<script>alert('Já foi feita a inscrição neste curso');</script>");
                                out.println("<script>setTimeout(function () { window.location.href = 'verTodosCursos.jsp'; }, 0);</script>");
                            } else {
                                try {
                                    Statement stmt4 = conn.createStatement();
                                    // Obter dados do curso
                                    String dadosDoCurso = "SELECT * FROM curso WHERE id_curso = '" + idCurso + "'";
                                    ResultSet dadosCurso = stmt4.executeQuery(dadosDoCurso);
                                    while (dadosCurso.next()) {
                                        int duracao = dadosCurso.getInt("duracao");
                                        double preco = 3 * duracao; // O preço é calculado 3€ à hora * duração do curso
                                        String dataDeInscricao = new java.text.SimpleDateFormat("yyyy-MM-dd").format(new java.util.Date());

                                        try {
                                            // Inserir inscrição
                                            String insert = "INSERT INTO inscricao (aluno, curso, data_inscricao, custo, estadoDaInscricao) " +
                                                            "VALUES (?, ?, ?, ?, ?)";
                                            PreparedStatement ps = conn.prepareStatement(insert);
                                            ps.setString(1, idAluno);
                                            ps.setString(2, idCurso);
                                            ps.setString(3, dataDeInscricao);
                                            ps.setDouble(4, preco);
                                            ps.setInt(5, 1);

                                            ps.executeUpdate();
                                            ps.close();
											response.sendRedirect("gerirInscricoes.jsp");
                                            
                                        } catch (Exception ex) {
                                            ex.printStackTrace();
                                            out.println("Erro ao inserir inscrição: " + ex.getMessage());
                                        }

                                    }

                                    stmt4.close();

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
                } catch (Exception ex) {
                    ex.printStackTrace();
                    out.println("Erro: " + ex.getMessage());
                }

            }

            stmt.close();
            conn.close();
			// Redirecionamento após inserção
            
        } catch (Exception ex) {
            ex.printStackTrace();
            out.println("Erro: " + ex.getMessage());
        }


    } else {
        response.sendRedirect("index.jsp");
    }
%>
