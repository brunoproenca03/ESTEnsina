<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Editar Inscrição</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page import="java.sql.*, javax.servlet.*, javax.servlet.http.*, javax.servlet.jsp.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>
<%
    String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
    int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

    if (session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR) {
        String id_aluno = request.getParameter("aluno");
        String id_curso = request.getParameter("curso");
		
	    if (tipoUtilizador == ADMINISTRADOR) {
%>

<div id='cabecalho'>
    <a href='index.jsp' id='nomeSite'>ESTensina</a>
        <div class='input-div'>
            <div id='botao'>
                <form action='logout.jsp'>
                    <input type='submit' value='Logout'>
                </form>
            </div>
            <div id='botao'>
                <form action='gerirInscricoes.jsp'>
                    <input type='submit' value='Página Principal'>
                </form>
            </div>
            <div id='botao'>
                <form action='contacto.jsp'>
                    <input type='submit' value='Contactos'>
                </form>
            </div>
        </div>
</div>

<%
        try {
            
            Statement stmt4 = conn.createStatement();
            String dadosInscricao = "SELECT Inscricao.curso AS id_curso, aluno.nome AS nome_do_aluno, docente.nome AS nome_do_docente, Curso.nome AS nome_do_curso, estadoInscricao.descricao AS estado_inscricao, Inscricao.data_inscricao AS data_inscricao, Inscricao.custo AS preco FROM Inscricao JOIN Utilizador AS aluno ON Inscricao.aluno = aluno.id_utilizador JOIN Curso ON Inscricao.curso = Curso.id_curso JOIN Utilizador AS docente ON Curso.docente = docente.id_utilizador JOIN estadoinscricao ON Inscricao.estadoDaInscricao = estadoinscricao.estadoInscricao WHERE Inscricao.aluno = '" + id_aluno + "' AND Inscricao.curso = '" + id_curso + "' ORDER BY Inscricao.data_inscricao";
            ResultSet res = stmt4.executeQuery(dadosInscricao);

            if (res.next()) {
               String nomeAluno = res.getString("nome_do_aluno");
               String nomeDocente = res.getString("nome_do_docente");
               String nomeCurso = res.getString("nome_do_curso");
               String dataDeInscricao = res.getString("data_inscricao");
               String estadoInscricao = res.getString("estado_inscricao");
               String custo = res.getString("preco");
            
%>

<div class="container">
    <div class="form-container">
        <h2>Editar Inscrição</h2>
        <form method="POST" action="alteraDadosInscricaoAluno.jsp?idcurso=<%= id_curso %>&idaluno=<%= id_aluno %>">
            <div class="form-group">
                <label for="aluno">Nome do Aluno:</label>
                <div class="input-group">
                    <select class="form-control" id="aluno" name="aluno">
                        <%
                            try{
                                Statement stmt5 = conn.createStatement();
                                String alunosSql = "SELECT nome FROM utilizador WHERE tipo_utilizador = '3'";
                                ResultSet alunosRes = stmt5.executeQuery(alunosSql);
                                while (alunosRes.next()) {
                                    String alunoNome = alunosRes.getString("nome");
                                    if (alunoNome.equals(nomeAluno)) {
                                        out.println("<option value='" + alunoNome + "' selected>" + alunoNome + "</option>");
                                    } else {
                                        out.println("<option value='" + alunoNome + "'>" + alunoNome + "</option>");
                                    }
                                }
                                stmt5.close();
                            } catch (Exception e) {
                                e.printStackTrace();
                            }
                            
                        %>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="curso">Curso</label>
                <div class="input-group">
                    <select class="form-control" id="curso" name="curso">
                        <%
                            try{
                                Statement stmt6 = conn.createStatement();
                                String cursosSql = "SELECT * FROM curso";
                                ResultSet cursosRes = stmt6.executeQuery(cursosSql);
                                while (cursosRes.next()) {
                                    String cursoNome = cursosRes.getString("nome");
                                    if (cursoNome.equals(nomeCurso)) {
                                        out.println("<option value='" + cursoNome + "' selected>" + cursoNome + "</option>");
                                    } else {
                                        out.println("<option value='" + cursoNome + "'>" + cursoNome + "</option>");
                                    }
                                }
                                stmt6.close();
                            } catch (Exception e) {
                                e.printStackTrace();
                            }
                        %>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="docente">Docente:</label>
                <div class="input-group">
                    <select class="form-control" id="docente" name="docente">
                        <%  try{
                                Statement stmt7 = conn.createStatement();
                                String docentesSql = "SELECT nome FROM utilizador WHERE tipo_utilizador = '2'";
                                ResultSet docentesRes = stmt7.executeQuery(docentesSql);
                                while (docentesRes.next()) {
                                    String docenteNome = docentesRes.getString("nome");
                                    if (docenteNome.equals(nomeDocente)) {
                                        out.println("<option value='" + docenteNome + "' selected>" + docenteNome + "</option>");
                                    } else {
                                        out.println("<option value='" + docenteNome + "'>" + docenteNome + "</option>");
                                    }
                                }
                                stmt7.close();
                            } catch (Exception e) {
                                e.printStackTrace();
                            }
                            
                        %>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="data">Data de Inscricao:</label>
                <input type="date" class="form-control" id="data" name="data" value="<%= dataDeInscricao %>">
            </div>
            <div class="form-group">
                <label for="estado">Estado de Inscricao</label>
                <input type="text" class="form-control" id="estado" name="estado" readonly value="<%= estadoInscricao %>">
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" class="form-control" id="preco" name="preco" value="<%= custo %>">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
        </form>
    </div>
</div>

<%              }
                stmt4.close();
                conn.close();
            }catch (Exception e) {
                e.printStackTrace();
            }
        }
    } else {
        response.sendRedirect("logout.jsp");
    }
%>
</body>

</html>
