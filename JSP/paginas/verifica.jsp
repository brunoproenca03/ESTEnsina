<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="javax.servlet.http.*, javax.servlet.*, java.util.*, java.sql.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%
    if (session.getAttribute("user") == null || session.getAttribute("tipo_utilizador") == null) {
        session.setAttribute("bt", "Página Login");
        session.setAttribute("erro", "Algo não correu bem!!! Dirija-se para a Página de Login ou Registe-se");
        session.setAttribute("diretoria", "login.jsp");
        out.println("<script>setTimeout(function () { window.location.href = 'Msg_erro.jsp'; }, 0)</script>");

    } else {
        String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
		int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

        if (tipoUtilizador == ALUNO_NAO_VALIDADO) {
            session.setAttribute("bt", "Voltar");
            session.setAttribute("erro", "Conta Ainda Não validada!<br>Por favor, Tente mais tarde!");
            session.setAttribute("diretoria", "index.jsp");
            out.println("<script>setTimeout(function () { window.location.href = 'Msg_erro.jsp'; }, 0)</script>");

        } else if (session.getAttribute("user").equals(-1) || session.getAttribute("tipo_utilizador").equals(-1)) {
            session.setAttribute("bt", "Voltar");
            session.setAttribute("erro", "Combinação inválida!<br>Por favor, Preencha todos os campos corretamente.");
            session.setAttribute("diretoria", "login.jsp");
            out.println("<script>setTimeout(function () { window.location.href = 'Msg_erro.jsp'; }, 0)</script>");

        } else {
            out.println("<script>alert('Fez Login')</script>");
            out.println("<script>setTimeout(function () { window.location.href = 'PaginaUtilizador.jsp'; }, 0)</script>");
        }
    }
%>
