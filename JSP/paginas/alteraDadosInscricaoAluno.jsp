<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.util.*, java.text.SimpleDateFormat, java.util.Date" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%
    request.setCharacterEncoding("UTF-8");
    response.setContentType("text/html; charset=UTF-8");

    boolean ocorreuErro = false; // Variável de controle de erro
    
    String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

    if (session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR) {
        String nomeAluno = request.getParameter("aluno");
        String nomeCurso = request.getParameter("curso");
        String nomeDocente = request.getParameter("docente");
        String dataDeInscricao = request.getParameter("data");
        String estadoInscricao = request.getParameter("estado");
        String preco = request.getParameter("preco");

        String estado = "";

        if(estadoInscricao.equals("Pendente")){
            estado = "1";
        } else if(estadoInscricao.equals("Aceite")){
            estado = "2";
        }else if(estadoInscricao.equals("Rejeitada")){
            estado = "3";
        }
        
        try {
            Statement stmt = conn.createStatement();
            String sql = "SELECT id_utilizador FROM utilizador WHERE nome = '" + nomeAluno + "'";
            ResultSet idAlunoo = stmt.executeQuery(sql);
            if (idAlunoo.next()) {
                String idAluno = idAlunoo.getString("id_utilizador");

                if (tipoUtilizador == ADMINISTRADOR) {

                    Statement stmt2 = conn.createStatement();
                    sql = "SELECT id_utilizador FROM utilizador WHERE nome = '" + nomeDocente + "'";
                    ResultSet idDocentee = stmt2.executeQuery(sql);
                    if (idDocentee.next()) {
                        String idDocente = idDocentee.getString("id_utilizador");

                        Statement stmt3 = conn.createStatement();
                        sql = "SELECT * FROM curso WHERE nome = '" + nomeCurso + "' AND docente = '" + idDocente + "'";
                        ResultSet verificaCursoAssociadoAoDocente = stmt3.executeQuery(sql);
                        if (verificaCursoAssociadoAoDocente.next()) {
                            Statement stmt4 = conn.createStatement();
                            sql = "SELECT id_curso FROM curso WHERE nome = '" + nomeCurso + "'";
                            ResultSet idCursoo = stmt4.executeQuery(sql);
                            if (idCursoo.next()) {
                                String idCurso = idCursoo.getString("id_curso");
                                            try {
                                                sql = "UPDATE inscricao SET aluno = ?, curso = ?, data_inscricao = ?, custo = ?, estadoDaInscricao = ? WHERE aluno = ? AND curso = ?";
                                                PreparedStatement pstmt = conn.prepareStatement(sql);
                                                pstmt.setString(1, idAluno);
                                                pstmt.setString(2, idCurso);
                                                pstmt.setString(3, dataDeInscricao);
                                                pstmt.setString(4, preco);
                                                pstmt.setString(5, estado);
                                                pstmt.setString(6, request.getParameter("idaluno"));
                                                pstmt.setString(7, request.getParameter("idcurso"));
                                                pstmt.executeUpdate();
                                                pstmt.close();
                                                response.sendRedirect("mostraInscricoes.jsp?curso=" + idCurso); // Redireciona após sucesso
                                            } catch (Exception e) {
                                                ocorreuErro = true;
                                                out.println("<script> alert('Erro ao atualizar inscrição: " + e.getMessage() + "'); </script>");
                                            }
                                       
                            } else {
                                ocorreuErro = true;
                                out.println("<script> alert('Não foi possível obter os dados do curso'); </script>");
                            }
                            stmt4.close();
                        } else {
                            ocorreuErro = true;
                            out.println("<script> alert('Não existe um curso associado a este docente'); </script>");
                        }
                        stmt3.close();
                    } else {
                        ocorreuErro = true;
                        out.println("<script> alert('Não foi possível obter os dados do docente'); </script>");
                    }
                    stmt2.close();
                }
            } else {
                ocorreuErro = true;
                out.println("<script> alert('Não foi possível obter os dados do aluno'); </script>");
            }
            stmt.close();
            conn.close();
        } catch (Exception e) {
            e.printStackTrace();
            ocorreuErro = true;
            out.println("<script> alert('Erro: " + e.getMessage() + "'); </script>");
        }

        if (ocorreuErro) {
            out.println("<script> setTimeout(function () { window.location.href = 'gerirInscricoes.jsp'; }, 1000); </script>");
        }

    } else {
        response.sendRedirect("logout.jsp");
    }
%>
